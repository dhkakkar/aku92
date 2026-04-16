<?php

namespace App\Filament\Pages;

use App\Models\Section as SectionModel;
use BackedEnum;
use Filament\Actions\Action;
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

class EditAku92OpdFormPage extends Page
{
    protected string $view = 'filament.pages.edit-aku92-opd-form-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedClipboardDocument;

    protected static ?string $navigationLabel = 'OPD Form Page';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 8;

    protected static ?string $title = 'Edit OPD Form Page';

    protected static ?string $slug = 'aku92-opd-form-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'aku92-opd-form')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("opd.$k")?->content ?? $default;

        $this->form->fill([
            'page_title' => $text('page_title'),
            'page_sub'   => $text('page_sub'),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FormSection::make('Form heading')
                ->description('Heading text shown above the OPD registration form. The form fields themselves are fixed.')
                ->schema([
                    TextInput::make('page_title')->label('Heading')->columnSpanFull(),
                    Textarea::make('page_sub')->label('Sub-text')->rows(2)->columnSpanFull(),
                ])->collapsible(),
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
            'page_title' => 'Form Heading',
            'page_sub' => 'Form Sub-text',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "opd.$key"],
                ['page' => 'aku92-opd-form', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        Notification::make()->title('OPD Form page saved')->success()->send();
    }
}
