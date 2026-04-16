<?php

namespace App\Filament\Pages;

use App\Models\Section as SectionModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
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

class EditAku92PhysiotherapyPage extends Page
{
    protected string $view = 'filament.pages.edit-aku92-physiotherapy-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHandRaised;

    protected static ?string $navigationLabel = 'Aku Physiotherapy';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 6;

    protected static ?string $title = 'Edit Aku Physiotherapy Page';

    protected static ?string $slug = 'aku92-physiotherapy-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'aku92-physiotherapy')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("physio.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = []) => data_get($rows->get("physio.$k")?->meta, $metaKey, $default);

        $this->form->fill([
            'hero_title'       => $text('hero_title'),
            'hero_sub'         => $text('hero_sub'),
            'about_title'      => $text('about_title'),
            'about_content'    => $text('about_content'),
            'treatments_title' => $text('treatments_title'),
            'treatments_list'  => $meta('treatments_list', 'items'),
            'contact_title'    => $text('contact_title'),
            'contact_address'  => $text('contact_address'),
            'contact_phone'    => $text('contact_phone'),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FormSection::make('Hero')->schema([
                TextInput::make('hero_title')->label('Title'),
                TextInput::make('hero_sub')->label('Subtitle'),
            ])->columns(2)->collapsible(),

            FormSection::make('About')->schema([
                TextInput::make('about_title')->label('Section title'),
                Textarea::make('about_content')->label('Body (HTML allowed)')->rows(6)->columnSpanFull(),
            ])->collapsible(),

            FormSection::make('Treatments')->schema([
                TextInput::make('treatments_title')->label('Section title'),
                Repeater::make('treatments_list')
                    ->label('Treatment cards')
                    ->schema([
                        TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-bone'),
                        TextInput::make('title')->label('Title')->required(),
                        Textarea::make('description')->label('Description')->rows(2)->columnSpanFull(),
                    ])
                    ->columns(2)->reorderable()->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->addActionLabel('Add treatment')
                    ->columnSpanFull(),
            ])->collapsible(),

            FormSection::make('Contact')->schema([
                TextInput::make('contact_title')->label('Section title'),
                TextInput::make('contact_address')->label('Address')->columnSpanFull(),
                TextInput::make('contact_phone')->label('Phone'),
            ])->columns(2)->collapsible(),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')->livewireSubmitHandler('save')
                ->footer([Actions::make([
                    Action::make('save')->label('Save changes')->submit('save')->keyBindings(['mod+s']),
                ])]),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ([
            'hero_title' => 'Hero Title', 'hero_sub' => 'Hero Sub',
            'about_title' => 'About Title', 'about_content' => 'About Body',
            'treatments_title' => 'Treatments Title',
            'contact_title' => 'Contact Title', 'contact_address' => 'Address', 'contact_phone' => 'Phone',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "physio.$key"],
                ['page' => 'aku92-physiotherapy', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        SectionModel::updateOrCreate(
            ['key' => 'physio.treatments_list'],
            ['page' => 'aku92-physiotherapy', 'title' => 'Treatments List', 'meta' => ['items' => array_values($data['treatments_list'] ?? [])], 'is_active' => true],
        );

        Notification::make()->title('Aku Physiotherapy page saved')->success()->send();
    }
}
