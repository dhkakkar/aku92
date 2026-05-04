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

class EditPrashukaJainPage extends Page
{
    protected string $view = 'filament.pages.edit-prashuka-jain-page';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $navigationLabel = 'Dr. Prashuka Jain';

    protected static string | \UnitEnum | null $navigationGroup = 'Page Content';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'Edit Dr. Prashuka Jain Page';

    protected static ?string $slug = 'prashuka-jain-page';

    public ?array $data = [];

    public function mount(): void
    {
        $rows = SectionModel::where('page', 'prashuka-jain')->get()->keyBy('key');

        $text = fn (string $k, string $default = '') => $rows->get("prashuka.$k")?->content ?? $default;
        $meta = fn (string $k, string $metaKey, $default = null) => data_get($rows->get("prashuka.$k")?->meta, $metaKey, $default);

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
            'stat_fellowship_value' => $text('stat_fellowship'),
            'stat_fellowship_label' => $meta('stat_fellowship', 'label', 'Cardiology Fellowship'),
            'stat_publications_value' => $text('stat_publications'),
            'stat_publications_label' => $meta('stat_publications', 'label', 'Publications'),
            'stat_years_value' => $text('stat_years'),
            'stat_years_label' => $meta('stat_years', 'label', 'Years Experience'),

            // About
            'about_label' => $text('about_label'),
            'about_title' => $text('about_title'),
            'about_text' => $text('about_text'),

            // Education
            'education_label' => $text('education_label'),
            'education_title' => $text('education_title'),
            'education_list' => $meta('education_list', 'items', []),

            // Experience
            'experience_label' => $text('experience_label'),
            'experience_title' => $text('experience_title'),
            'experience_list' => $meta('experience_list', 'items', []),

            // Expertise
            'expertise_label' => $text('expertise_label'),
            'expertise_title' => $text('expertise_title'),
            'expertise_cards' => $meta('expertise_cards', 'items', []),

            // Publications
            'publications_label' => $text('publications_label'),
            'publications_title' => $text('publications_title'),
            'publications_sub' => $text('publications_sub'),
            'publications_list' => $meta('publications_list', 'items', []),

            // Journey
            'journey_label' => $text('journey_label'),
            'journey_title' => $text('journey_title'),
            'journey_list' => $meta('journey_list', 'items', []),

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
                    TextInput::make('stat_fellowship_value')->label('Stat 1 value'),
                    TextInput::make('stat_fellowship_label')->label('Stat 1 label'),
                    TextInput::make('stat_publications_value')->label('Stat 2 value'),
                    TextInput::make('stat_publications_label')->label('Stat 2 label'),
                    TextInput::make('stat_years_value')->label('Stat 3 value'),
                    TextInput::make('stat_years_label')->label('Stat 3 label'),
                ])->columns(2)->collapsible(),

            FormSection::make('About Section')
                ->schema([
                    TextInput::make('about_label')->label('Section label'),
                    TextInput::make('about_title')->label('Section title'),
                    Textarea::make('about_text')->label('About paragraph')->rows(6)->columnSpanFull(),
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

            FormSection::make('Experience Section')
                ->schema([
                    TextInput::make('experience_label')->label('Section label'),
                    TextInput::make('experience_title')->label('Section title'),
                    Repeater::make('experience_list')
                        ->label('Experience items')
                        ->schema([
                            TextInput::make('title')->label('Role')->required(),
                            TextInput::make('institution')->label('Institution'),
                            Textarea::make('location')->label('Location / description')->rows(2),
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-stethoscope'),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add experience item')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Areas of Practice (Expertise)')
                ->schema([
                    TextInput::make('expertise_label')->label('Section label'),
                    TextInput::make('expertise_title')->label('Section title'),
                    Repeater::make('expertise_cards')
                        ->label('Practice cards')
                        ->schema([
                            TextInput::make('icon')->label('Font Awesome icon')->placeholder('fas fa-heart-pulse'),
                            TextInput::make('title')->label('Card title')->required(),
                            Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add practice card')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Books & Publications Section')
                ->schema([
                    TextInput::make('publications_label')->label('Section label'),
                    TextInput::make('publications_title')->label('Section title'),
                    Textarea::make('publications_sub')->label('Section sub-text')->rows(2),
                    Repeater::make('publications_list')
                        ->label('Publications')
                        ->schema([
                            TextInput::make('badge')->label('Badge')->placeholder('Co-Author or Chapter'),
                            TextInput::make('title')->label('Title')->required(),
                            Textarea::make('body')->label('Body (HTML allowed)')->rows(3)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Add publication')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Journey / Milestones Section')
                ->schema([
                    TextInput::make('journey_label')->label('Section label'),
                    TextInput::make('journey_title')->label('Section title'),
                    Repeater::make('journey_list')
                        ->label('Timeline milestones')
                        ->schema([
                            TextInput::make('year')->label('Year')->required(),
                            Textarea::make('text')->label('Milestone text')->rows(2)->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' — ' . \Illuminate\Support\Str::limit(strip_tags($state['text'] ?? ''), 60))
                        ->addActionLabel('Add milestone')
                        ->columnSpanFull(),
                ])->columns(2)->collapsible(),

            FormSection::make('Blog Section')
                ->description('Blog posts pull automatically from the Blog Posts resource. These are just the section header texts.')
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
            'about_label' => 'About Section Label',
            'about_title' => 'About Section Title',
            'about_text' => 'About Body',
            'education_label' => 'Education Section Label',
            'education_title' => 'Education Section Title',
            'experience_label' => 'Experience Section Label',
            'experience_title' => 'Experience Section Title',
            'expertise_label' => 'Expertise Section Label',
            'expertise_title' => 'Expertise Section Title',
            'publications_label' => 'Publications Section Label',
            'publications_title' => 'Publications Section Title',
            'publications_sub' => 'Publications Section Sub',
            'journey_label' => 'Journey Section Label',
            'journey_title' => 'Journey Section Title',
            'blog_label' => 'Blog Section Label',
            'blog_title' => 'Blog Section Title',
            'blog_sub' => 'Blog Section Sub',
            'contact_label' => 'Contact Section Label',
            'contact_title' => 'Contact Section Title',
        ];

        foreach ($textFields as $key => $title) {
            $this->upsert("prashuka.$key", $title, content: $data[$key] ?? '');
        }

        // Stats
        foreach ([
            'fellowship' => 'Cardiology Fellowship',
            'publications' => 'Publications',
            'years' => 'Years Experience',
        ] as $stat => $defaultLabel) {
            $this->upsert(
                "prashuka.stat_$stat",
                "Stat: " . ucfirst($stat),
                content: $data["stat_{$stat}_value"] ?? '',
                meta: ['label' => $data["stat_{$stat}_label"] ?? $defaultLabel],
            );
        }

        // Lists
        $lists = [
            'education_list' => 'Education List',
            'experience_list' => 'Experience List',
            'expertise_cards' => 'Expertise Cards',
            'publications_list' => 'Publications List',
            'journey_list' => 'Journey Timeline',
            'contact_cards' => 'Contact Cards',
        ];

        foreach ($lists as $key => $title) {
            $this->upsert(
                "prashuka.$key",
                $title,
                meta: ['items' => array_values($data[$key] ?? [])],
            );
        }

        Notification::make()
            ->title('Dr. Prashuka Jain page saved')
            ->success()
            ->send();
    }

    protected function upsert(string $key, string $title, ?string $content = null, ?array $meta = null): void
    {
        $values = [
            'page' => 'prashuka-jain',
            'title' => $title,
            'is_active' => true,
        ];
        if ($content !== null) $values['content'] = $content;
        if ($meta !== null)    $values['meta'] = $meta;

        SectionModel::updateOrCreate(['key' => $key], $values);
    }
}
