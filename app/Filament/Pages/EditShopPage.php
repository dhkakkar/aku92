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

class EditShopPage extends Page
{
    protected string $view = 'filament.pages.edit-shop-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $navigationLabel = 'Shop Page';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 9;

    protected static ?string $title = 'Edit Shop Page';

    protected static ?string $slug = 'shop-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'shop')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("shop.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = []) => data_get($rows->get("shop.$k")?->meta, $metaKey, $default);

        $this->form->fill([
            'hero_title'              => $text('hero_title'),
            'hero_sub'                => $text('hero_sub'),
            'search_placeholder'      => $text('search_placeholder'),
            'category_all'            => $text('category_all'),
            'apply_label'             => $text('apply_label'),
            'product_desc_fallback'   => $text('product_desc_fallback'),
            'categories'              => $meta('categories', 'items'),
            'info_banner'             => $meta('info_banner', 'items'),
            'product_features'        => $meta('product_features', 'items'),
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
                    TextInput::make('hero_sub')->label('Sub-text'),
                ])->columns(2)->collapsible(),

            FormSection::make('Filter bar labels')
                ->schema([
                    TextInput::make('search_placeholder')->label('Search placeholder'),
                    TextInput::make('category_all')->label('All-categories option label'),
                    TextInput::make('apply_label')->label('Apply button label'),
                ])->columns(3)->collapsible(),

            FormSection::make('Category options')
                ->description('Dropdown options shown in the category filter. The value is used for URL filtering.')
                ->schema([
                    Repeater::make('categories')
                        ->label('Categories')
                        ->schema([
                            TextInput::make('label')->label('Label shown to users')->required(),
                            TextInput::make('value')->label('Filter value')->required()->placeholder('e.g. medicines'),
                        ])
                        ->columns(2)->reorderable()->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->addActionLabel('Add category')
                        ->columnSpanFull(),
                ])->collapsible(),

            FormSection::make('Info banner (bottom of shop page)')
                ->schema([
                    Repeater::make('info_banner')
                        ->label('Feature cards')
                        ->schema([
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-truck'),
                            TextInput::make('title')->label('Title')->required(),
                            TextInput::make('description')->label('Description')->columnSpanFull(),
                        ])
                        ->columns(2)->reorderable()->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add feature')
                        ->columnSpanFull(),
                ])->collapsible(),

            FormSection::make('Product detail page')
                ->schema([
                    Textarea::make('product_desc_fallback')
                        ->label('Fallback description (used when a product has no description)')
                        ->rows(4)->columnSpanFull(),
                    Repeater::make('product_features')
                        ->label('Inline feature strip (under price)')
                        ->schema([
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-truck'),
                            TextInput::make('color')->label('Colour class')->placeholder('text-success'),
                            TextInput::make('text')->label('Text')->required()->columnSpanFull(),
                        ])
                        ->columns(2)->reorderable()->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                        ->addActionLabel('Add feature')
                        ->columnSpanFull(),
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
            'hero_title' => 'Hero Title',
            'hero_sub' => 'Hero Sub-text',
            'search_placeholder' => 'Search placeholder',
            'category_all' => 'All-categories option label',
            'apply_label' => 'Apply button label',
            'product_desc_fallback' => 'Product detail fallback description',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "shop.$key"],
                ['page' => 'shop', 'title' => $title, 'content' => $data[$key] ?? '', 'is_active' => true],
            );
        }

        foreach ([
            'categories' => 'Shop Categories',
            'info_banner' => 'Shop Info Banner',
            'product_features' => 'Product detail inline features',
        ] as $key => $title) {
            SectionModel::updateOrCreate(
                ['key' => "shop.$key"],
                ['page' => 'shop', 'title' => $title, 'meta' => ['items' => array_values($data[$key] ?? [])], 'is_active' => true],
            );
        }

        Notification::make()->title('Shop page saved')->success()->send();
    }
}
