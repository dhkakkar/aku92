<?php

namespace App\Filament\Pages;

use App\Models\Section as SectionModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section as FormSection;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditHealthcareHubPage extends Page
{
    protected string $view = 'filament.pages.edit-healthcare-hub-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Healthcare Hub';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'Edit Healthcare Hub';

    protected static ?string $slug = 'healthcare-hub-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'aku92-hub')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("aku92.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = []) => data_get($rows->get("aku92.$k")?->meta, $metaKey, $default);

        $this->form->fill([
            'sidebar_brand' => $text('sidebar_brand'),
            'sidebar_tagline' => $text('sidebar_tagline'),
            'sidebar_footer' => $text('sidebar_footer'),
            'hub_sidebar_links' => $meta('hub_sidebar_links', 'items'),
            'hub_cards' => $meta('hub_cards', 'items'),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FormSection::make('Sidebar')
                ->schema([
                    TextInput::make('sidebar_brand')->label('Brand text'),
                    TextInput::make('sidebar_tagline')->label('Tagline'),
                    TextInput::make('sidebar_footer')->label('Footer (HTML allowed)')->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Sidebar navigation links')
                ->schema([
                    Repeater::make('hub_sidebar_links')
                        ->label('Links')
                        ->schema([
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-clinic-medical'),
                            TextInput::make('title')->label('Title')->required(),
                            TextInput::make('sub')->label('Subtitle')->columnSpanFull(),
                            TextInput::make('url')->label('URL'),
                            Select::make('target')->label('Target')->options(['_self' => 'Same tab', '_blank' => 'New tab'])->default('_self'),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add sidebar link')
                        ->columnSpanFull(),
                ])->collapsible(),

            FormSection::make('Main grid cards (8 tiles)')
                ->schema([
                    Repeater::make('hub_cards')
                        ->label('Cards')
                        ->schema([
                            Select::make('variant')->label('Card style')->options([
                                'image' => 'Image background',
                                'youtube' => 'YouTube / centered',
                                'cta' => 'Dashed CTA card',
                            ])->default('image')->required(),
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-clinic-medical'),
                            TextInput::make('image')->label('Background image path')->placeholder('images/firms/example.jpg')->helperText('Path under /public.'),
                            TextInput::make('badge')->label('Badge')->columnSpanFull(),
                            TextInput::make('title')->label('Title')->required()->columnSpanFull(),
                            Textarea::make('description')->label('Description')->rows(2)->columnSpanFull(),
                            TextInput::make('url')->label('Click URL'),
                            Select::make('target')->label('Target')->options(['_self' => 'Same tab', '_blank' => 'New tab'])->default('_self'),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add card')
                        ->columnSpanFull(),
                ])->collapsible(),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')->label('Save changes')->submit('save')->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ([
            'sidebar_brand' => 'Hub Sidebar Brand',
            'sidebar_tagline' => 'Hub Sidebar Tagline',
            'sidebar_footer' => 'Hub Sidebar Footer',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "aku92.$key"],
                ['page' => 'aku92-hub', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        foreach ([
            'hub_sidebar_links' => 'Hub Sidebar Links',
            'hub_cards' => 'Hub Main Grid Cards',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "aku92.$key"],
                ['page' => 'aku92-hub', 'title' => $title, 'meta' => ['items' => array_values($data[$key] ?? [])], 'is_active' => true],
            );
        }

        Notification::make()->title('Healthcare hub saved')->success()->send();
    }
}
