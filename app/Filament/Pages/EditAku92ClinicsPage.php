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

class EditAku92ClinicsPage extends Page
{
    protected string $view = 'filament.pages.edit-aku92-clinics-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHeart;

    protected static ?string $navigationLabel = 'Aku92 Clinics';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Edit Aku92 Clinics Page';

    protected static ?string $slug = 'aku92-clinics-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'aku92-clinics')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("clinics.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = []) => data_get($rows->get("clinics.$k")?->meta, $metaKey, $default);

        $this->form->fill([
            'hero_title'       => $text('hero_title'),
            'hero_sub'         => $text('hero_sub'),
            'about_title'      => $text('about_title'),
            'about_content'    => $text('about_content'),
            'doctors_title'    => $text('doctors_title'),
            'doctors_sub'      => $text('doctors_sub'),
            'doctors_list'     => $meta('doctors_list', 'items'),
            'timings_title'    => $text('timings_title'),
            'timings_list'     => $meta('timings_list', 'items'),
            'location_title'   => $text('location_title'),
            'location_address' => $text('location_address'),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FormSection::make('Hero')
                ->schema([
                    TextInput::make('hero_title')->label('Title'),
                    TextInput::make('hero_sub')->label('Subtitle'),
                ])->columns(2)->collapsible(),

            FormSection::make('About')
                ->schema([
                    TextInput::make('about_title')->label('Section title'),
                    Textarea::make('about_content')->label('Body (HTML allowed)')->rows(6)->columnSpanFull(),
                ])->collapsible(),

            FormSection::make('Doctors')
                ->schema([
                    TextInput::make('doctors_title')->label('Section title'),
                    TextInput::make('doctors_sub')->label('Subtitle'),
                    Repeater::make('doctors_list')
                        ->label('Doctor cards')
                        ->schema([
                            TextInput::make('name')->label('Name')->required(),
                            TextInput::make('role')->label('Role'),
                            Textarea::make('bio')->label('Bio')->rows(2)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->addActionLabel('Add doctor')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('OPD Timings')
                ->schema([
                    TextInput::make('timings_title')->label('Section title'),
                    Repeater::make('timings_list')
                        ->label('Schedule rows')
                        ->schema([
                            TextInput::make('day')->label('Day')->required(),
                            TextInput::make('morning')->label('Morning'),
                            TextInput::make('evening')->label('Evening'),
                        ])
                        ->columns(3)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['day'] ?? null)
                        ->addActionLabel('Add row')
                        ->columnSpanFull(),
                ])->collapsible(),

            FormSection::make('Location')
                ->schema([
                    TextInput::make('location_title')->label('Section title'),
                    TextInput::make('location_address')->label('Address')->columnSpanFull(),
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

        $textFields = [
            'hero_title' => 'Hero Title',
            'hero_sub' => 'Hero Sub',
            'about_title' => 'About Title',
            'about_content' => 'About Body',
            'doctors_title' => 'Doctors Title',
            'doctors_sub' => 'Doctors Sub',
            'timings_title' => 'OPD Timings Title',
            'location_title' => 'Location Title',
            'location_address' => 'Address',
        ];

        foreach ($textFields as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "clinics.$key"],
                ['page' => 'aku92-clinics', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        foreach ([
            'doctors_list' => 'Doctors List',
            'timings_list' => 'OPD Timings',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "clinics.$key"],
                ['page' => 'aku92-clinics', 'title' => $title, 'meta' => ['items' => array_values($data[$key] ?? [])], 'is_active' => true],
            );
        }

        Notification::make()->title('Aku92 Clinics page saved')->success()->send();
    }
}
