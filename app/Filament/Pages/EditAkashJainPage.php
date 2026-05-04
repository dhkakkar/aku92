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

class EditAkashJainPage extends Page
{
    protected string $view = 'filament.pages.edit-akash-jain-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $navigationLabel = 'Dr. Akash Jain';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Edit Dr. Akash Jain Page';

    protected static ?string $slug = 'akash-jain-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'akash-jain')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("akash.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = null) => data_get($rows->get("akash.$k")?->meta, $metaKey, $default);

        $this->form->fill([
            // Hero
            'hero_label' => $text('hero_label'),
            'hero_name' => $text('hero_name'),
            'hero_title' => $text('hero_title'),
            'hero_org' => $text('hero_org'),
            'hero_registration' => $text('hero_registration'),
            'hero_email' => $text('hero_email'),
            'hero_bio' => $text('hero_bio'),

            // Social links
            'social_linkedin'     => $text('social_linkedin'),
            'social_twitter'      => $text('social_twitter'),
            'social_researchgate' => $text('social_researchgate'),

            // Stats
            'stat_publications_value' => $text('stat_publications'),
            'stat_publications_label' => $meta('stat_publications', 'label', 'Publications'),
            'stat_books_value' => $text('stat_books'),
            'stat_books_label' => $meta('stat_books', 'label', 'Book Chapters'),
            'stat_years_value' => $text('stat_years'),
            'stat_years_label' => $meta('stat_years', 'label', 'Years Experience'),

            // Education
            'education_label' => $text('education_label'),
            'education_title' => $text('education_title'),
            'education_list' => $meta('education_list', 'items', []),

            // Expertise
            'expertise_label' => $text('expertise_label'),
            'expertise_title' => $text('expertise_title'),
            'expertise_blocks' => $meta('expertise_blocks', 'items', []),

            // Publications
            'publications_label' => $text('publications_label'),
            'publications_title' => $text('publications_title'),
            'publications_sub' => $text('publications_sub'),
            'publications_list' => $meta('publications_list', 'items', []),

            // Books
            'books_label' => $text('books_label'),
            'books_title' => $text('books_title'),
            'books_list' => $meta('books_list', 'items', []),

            // Extra
            'extra_label' => $text('extra_label'),
            'extra_title' => $text('extra_title'),
            'extra_list' => $meta('extra_list', 'items', []),

            // Blog
            'blog_label' => $text('blog_label'),
            'blog_title' => $text('blog_title'),
            'blog_sub' => $text('blog_sub'),

            // Contact
            'contact_label' => $text('contact_label'),
            'contact_title' => $text('contact_title'),
            'contact_cards' => $meta('contact_cards', 'items', []),
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
                    TextInput::make('hero_label')->label('Label (small caption)'),
                    TextInput::make('hero_name')->label('Name'),
                    TextInput::make('hero_title')->label('Title / role'),
                    TextInput::make('hero_org')->label('Organisation / location'),
                    TextInput::make('hero_registration')->label('Registration ID'),
                    TextInput::make('hero_email')->label('Email'),
                    Textarea::make('hero_bio')->label('Bio')->rows(4)->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Social Links')
                ->description('Leave blank to hide an icon. Use the full URL (https://...).')
                ->schema([
                    TextInput::make('social_linkedin')->label('LinkedIn URL')->url()->prefixIcon('heroicon-m-link'),
                    TextInput::make('social_twitter')->label('Twitter / X URL')->url()->prefixIcon('heroicon-m-link'),
                    TextInput::make('social_researchgate')->label('ResearchGate URL')->url()->prefixIcon('heroicon-m-link')->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Hero Stats')
                ->schema([
                    TextInput::make('stat_publications_value')->label('Stat 1 value'),
                    TextInput::make('stat_publications_label')->label('Stat 1 label'),
                    TextInput::make('stat_books_value')->label('Stat 2 value'),
                    TextInput::make('stat_books_label')->label('Stat 2 label'),
                    TextInput::make('stat_years_value')->label('Stat 3 value'),
                    TextInput::make('stat_years_label')->label('Stat 3 label'),
                ])->columns(2)->collapsible(),

            FormSection::make('Education Section')
                ->schema([
                    TextInput::make('education_label')->label('Section label'),
                    TextInput::make('education_title')->label('Section title'),
                    Repeater::make('education_list')
                        ->label('Education items')
                        ->schema([
                            TextInput::make('title')->label('Degree / programme')->required(),
                            TextInput::make('institution')->label('Institution'),
                            TextInput::make('location')->label('Location'),
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-user-graduate'),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add education item')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Expertise Section')
                ->schema([
                    TextInput::make('expertise_label')->label('Section label'),
                    TextInput::make('expertise_title')->label('Section title'),
                    Repeater::make('expertise_blocks')
                        ->label('Expertise blocks')
                        ->schema([
                            TextInput::make('title')->label('Block title')->required(),
                            Textarea::make('bullets')
                                ->label('Bullets (one per line)')
                                ->rows(5)
                                ->helperText('Each line becomes a bullet point.'),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add expertise block')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Publications Section')
                ->schema([
                    TextInput::make('publications_label')->label('Section label'),
                    TextInput::make('publications_title')->label('Section title'),
                    Textarea::make('publications_sub')->label('Section sub-text')->rows(2),
                    Repeater::make('publications_list')
                        ->label('Publications')
                        ->schema([
                            Textarea::make('html')
                                ->label('Citation (HTML allowed)')
                                ->rows(3)
                                ->required(),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => \Illuminate\Support\Str::limit(strip_tags($state['html'] ?? ''), 80))
                        ->addActionLabel('Add publication')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible()->collapsed(),

            FormSection::make('Books & Chapters Section')
                ->schema([
                    TextInput::make('books_label')->label('Section label'),
                    TextInput::make('books_title')->label('Section title'),
                    Repeater::make('books_list')
                        ->label('Books & chapters')
                        ->schema([
                            TextInput::make('badge')->label('Badge')->placeholder('Author or Chapter'),
                            TextInput::make('title')->label('Title')->required(),
                            Textarea::make('description')->label('Description')->rows(2)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add book / chapter')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Beyond Medicine (Extracurricular)')
                ->schema([
                    TextInput::make('extra_label')->label('Section label'),
                    TextInput::make('extra_title')->label('Section title'),
                    Repeater::make('extra_list')
                        ->label('Extracurricular items')
                        ->schema([
                            Textarea::make('html')->label('Item (HTML allowed)')->rows(2)->required(),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => \Illuminate\Support\Str::limit(strip_tags($state['html'] ?? ''), 80))
                        ->addActionLabel('Add extracurricular item')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Blog Section')
                ->description('The blog post list is pulled automatically from the Blog Posts resource. These are just the section header texts.')
                ->schema([
                    TextInput::make('blog_label')->label('Section label'),
                    TextInput::make('blog_title')->label('Section title'),
                    Textarea::make('blog_sub')->label('Section sub-text')->rows(2),
                ])->columns(2)->collapsible(),

            FormSection::make('Contact Section')
                ->schema([
                    TextInput::make('contact_label')->label('Section label'),
                    TextInput::make('contact_title')->label('Section title'),
                    Repeater::make('contact_cards')
                        ->label('Contact cards')
                        ->schema([
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-envelope'),
                            TextInput::make('title')->label('Card title')->required(),
                            Textarea::make('body')->label('Body (HTML allowed)')->rows(2)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add contact card')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),
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

        $textFields = [
            'hero_label' => 'Hero Label',
            'hero_name' => 'Hero Name',
            'hero_title' => 'Hero Title',
            'hero_org' => 'Hero Organisation',
            'hero_registration' => 'Hero Registration',
            'hero_email' => 'Hero Email',
            'hero_bio' => 'Hero Bio',
            'social_linkedin'     => 'Social: LinkedIn',
            'social_twitter'      => 'Social: Twitter / X',
            'social_researchgate' => 'Social: ResearchGate',
            'education_label' => 'Education Section Label',
            'education_title' => 'Education Section Title',
            'expertise_label' => 'Expertise Section Label',
            'expertise_title' => 'Expertise Section Title',
            'publications_label' => 'Publications Section Label',
            'publications_title' => 'Publications Section Title',
            'publications_sub' => 'Publications Section Sub',
            'books_label' => 'Books Section Label',
            'books_title' => 'Books Section Title',
            'extra_label' => 'Extracurricular Section Label',
            'extra_title' => 'Extracurricular Section Title',
            'blog_label' => 'Blog Section Label',
            'blog_title' => 'Blog Section Title',
            'blog_sub' => 'Blog Section Sub',
            'contact_label' => 'Contact Section Label',
            'contact_title' => 'Contact Section Title',
        ];

        foreach ($textFields as $key => $title) {
            $this->upsert("akash.$key", $title, content: $data[$key] ?? '');
        }

        // Stats (content + meta.label)
        foreach ([
            'publications' => 'Publications',
            'books' => 'Book Chapters',
            'years' => 'Years Experience',
        ] as $stat => $defaultLabel) {
            $this->upsert(
                "akash.stat_$stat",
                "Stat: " . ucfirst($stat),
                content: $data["stat_{$stat}_value"] ?? '',
                meta: ['label' => $data["stat_{$stat}_label"] ?? $defaultLabel],
            );
        }

        // Lists (stored as meta.items)
        $lists = [
            'education_list' => 'Education List',
            'expertise_blocks' => 'Expertise Blocks',
            'publications_list' => 'Publications List',
            'books_list' => 'Books List',
            'extra_list' => 'Extracurricular List',
            'contact_cards' => 'Contact Cards',
        ];

        foreach ($lists as $key => $title) {
            $this->upsert(
                "akash.$key",
                $title,
                meta: ['items' => array_values($data[$key] ?? [])],
            );
        }

        Notification::make()
            ->title('Dr. Akash Jain page saved')
            ->success()
            ->send();
    }

    protected function upsert(string $key, string $title, ?string $content = null, ?array $meta = null): void
    {
        $values = [
            'page' => 'akash-jain',
            'title' => $title,
            'is_active' => true,
        ];
        if ($content !== null) $values['content'] = $content;
        if ($meta !== null)    $values['meta'] = $meta;

        SectionModel::updateOrCreate(['key' => $key], $values);
    }
}
