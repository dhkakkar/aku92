<?php

namespace App\Filament\Pages;

use App\Models\Section as SectionModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section as FormSection;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditAku92JainMedicalStorePage extends Page
{
    protected string $view = 'filament.pages.edit-aku92-jain-medical-store-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $navigationLabel = 'Jain Medical Store';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 10;

    protected static ?string $title = 'Edit Jain Medical Store Page';

    protected static ?string $slug = 'aku92-jain-medical-store-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'aku92-jain-medical-store')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("jms.$k")?->content ?? $default;

        $this->form->fill([
            'hero_title'      => $text('hero_title'),
            'hero_sub'        => $text('hero_sub'),
            'products_image'  => $text('products_image'),
            'contact_title'   => $text('contact_title'),
            'contact_address' => $text('contact_address'),
            'contact_phone'   => $text('contact_phone'),
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

            FormSection::make('Products Image')
                ->description('The catalogue image shown in the middle of the page. You can upload a new file (replaces the path automatically) or paste a path you already have under /public.')
                ->schema([
                    FileUpload::make('products_image')
                        ->image()
                        ->disk('public')
                        ->directory('firms')
                        ->visibility('public')
                        ->maxSize(8192)
                        ->imageEditor()
                        ->columnSpanFull()
                        ->helperText('Tip: stored path will look like firms/xxxxx.jpg.'),
                ])->collapsible(),

            FormSection::make('Contact')
                ->schema([
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
            'hero_title' => 'Hero Title',
            'hero_sub' => 'Hero Sub',
            'products_image' => 'Products Image Path',
            'contact_title' => 'Contact Title',
            'contact_address' => 'Address',
            'contact_phone' => 'Phone',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "jms.$key"],
                ['page' => 'aku92-jain-medical-store', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        Notification::make()->title('Jain Medical Store page saved')->success()->send();
    }
}
