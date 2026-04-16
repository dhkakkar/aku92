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

class EditHomePage extends Page
{
    protected string $view = 'filament.pages.edit-home-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Home Page';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 0;

    protected static ?string $title = 'Edit Home Page';

    protected static ?string $slug = 'home-page';

    public ?array $data = [];

    public function mount(): void
    {
        $sections = SectionModel::where('page', 'home')->pluck('content', 'key');
        $data = [];
        foreach ($sections as $fullKey => $content) {
            $data[str_replace('home.', '', $fullKey)] = $content;
        }
        $this->form->fill($data);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FormSection::make('Sidebar')
                ->description('Text shown in the left sidebar of the home page.')
                ->schema([
                    TextInput::make('sidebar_tagline')
                        ->label('Brand tagline'),
                    TextInput::make('sidebar_footer')
                        ->label('Footer text')
                        ->helperText('HTML entities allowed (e.g. &copy;, &bull;).'),
                ])
                ->columns(2),

            FormSection::make('Card 1 — Dr. Akash Jain')
                ->schema([
                    TextInput::make('akash_badge')->label('Badge'),
                    TextInput::make('akash_title')->label('Title'),
                    Textarea::make('akash_desc')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('akash_sidebar_sub')->label('Sidebar subtitle')->columnSpanFull(),
                ])
                ->columns(2),

            FormSection::make('Card 2 — Dr. Prashuka Jain')
                ->schema([
                    TextInput::make('prashuka_badge')->label('Badge'),
                    TextInput::make('prashuka_title')->label('Title'),
                    Textarea::make('prashuka_desc')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('prashuka_sidebar_sub')->label('Sidebar subtitle')->columnSpanFull(),
                ])
                ->columns(2),

            FormSection::make('Card 3 — AKU 92 Media & Healthcare')
                ->schema([
                    TextInput::make('aku92_badge')->label('Badge'),
                    TextInput::make('aku92_title')->label('Title'),
                    Textarea::make('aku92_desc')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('aku92_sidebar_sub')->label('Sidebar subtitle')->columnSpanFull(),
                ])
                ->columns(2),

            FormSection::make('Card 4 — Our Products')
                ->schema([
                    TextInput::make('shop_badge')->label('Badge'),
                    TextInput::make('shop_title')->label('Title'),
                    Textarea::make('shop_desc')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('shop_sidebar_sub')->label('Sidebar subtitle')->columnSpanFull(),
                ])
                ->columns(2),
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
                        Action::make('save')
                            ->label('Save changes')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $titles = $this->fieldTitles();

        foreach ($data as $shortKey => $content) {
            SectionModel::updateOrCreate(
                ['key' => 'home.' . $shortKey],
                [
                    'page' => 'home',
                    'title' => $titles[$shortKey] ?? ucwords(str_replace('_', ' ', $shortKey)),
                    'content' => $content ?? '',
                    'is_active' => true,
                ],
            );
        }

        Notification::make()
            ->title('Home page saved')
            ->success()
            ->send();
    }

    protected function fieldTitles(): array
    {
        return [
            'sidebar_tagline' => 'Sidebar Tagline',
            'sidebar_footer' => 'Sidebar Footer',
            'akash_badge' => 'Akash Card Badge',
            'akash_title' => 'Akash Card Title',
            'akash_desc' => 'Akash Card Description',
            'akash_sidebar_sub' => 'Akash Sidebar Subtitle',
            'prashuka_badge' => 'Prashuka Card Badge',
            'prashuka_title' => 'Prashuka Card Title',
            'prashuka_desc' => 'Prashuka Card Description',
            'prashuka_sidebar_sub' => 'Prashuka Sidebar Subtitle',
            'aku92_badge' => 'AKU92 Card Badge',
            'aku92_title' => 'AKU92 Card Title',
            'aku92_desc' => 'AKU92 Card Description',
            'aku92_sidebar_sub' => 'AKU92 Sidebar Subtitle',
            'shop_badge' => 'Shop Card Badge',
            'shop_title' => 'Shop Card Title',
            'shop_desc' => 'Shop Card Description',
            'shop_sidebar_sub' => 'Shop Sidebar Subtitle',
        ];
    }
}
