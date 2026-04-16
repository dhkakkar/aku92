<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $items = [
            'akash.education_list' => [
                'title' => 'Education List',
                'meta' => ['items' => [
                    [
                        'title' => 'Hemodynamics & Interventional Cardiology',
                        'institution' => 'Hospital Clinico Universitario de Valladolid',
                        'location' => 'Valladolid, Spain',
                        'icon' => 'fas fa-heart-pulse',
                    ],
                    [
                        'title' => 'DM (Fellowship), Cardiology',
                        'institution' => 'Sri Jayadeva Institute of Cardiovascular Science and Research',
                        'location' => 'Bangalore, India',
                        'icon' => 'fas fa-award',
                    ],
                    [
                        'title' => 'MD (Residency), Internal Medicine',
                        'institution' => 'Vardhman Mahavir Medical College & Safdarjung Hospital',
                        'location' => 'Delhi, India',
                        'icon' => 'fas fa-stethoscope',
                    ],
                    [
                        'title' => 'MBBS',
                        'institution' => 'Vardhman Mahavir Medical College & Safdarjung Hospital',
                        'location' => 'Delhi, India',
                        'icon' => 'fas fa-user-graduate',
                    ],
                ]],
            ],
            'akash.expertise_blocks' => [
                'title' => 'Expertise Blocks',
                'meta' => ['items' => [
                    [
                        'title' => 'Structural Interventions',
                        'bullets' => "TAVI (Transcatheter Aortic Valve Implantation)\nM-TEER (Mitral Transcatheter Edge to Edge Repair)\nT-TEER (Tricuspid Transcatheter Edge to Edge Repair)\nLAAC (Left Atrial Appendage Closure)",
                    ],
                    [
                        'title' => 'Complex Coronary Interventions',
                        'bullets' => "Rotational Atherectomy\nOrbital Atherectomy\nChronic Total Occlusion (CTO)\nIntravascular Imaging (IVUS/OCT)",
                    ],
                ]],
            ],
            'akash.books_list' => [
                'title' => 'Books & Chapters',
                'meta' => ['items' => [
                    ['badge' => 'Author', 'title' => 'MCQs in Cardiology for MD/DM Students', 'description' => 'Jaypee Brothers, 2023.'],
                    ['badge' => 'Chapter', 'title' => 'RV Deterioration in HFpEF', 'description' => 'Ch. 64, Advances in HFpEF. Jaypee, 2025.'],
                    ['badge' => 'Chapter', 'title' => 'Challenging TAVI Cases', 'description' => 'Russian National Handbook, 2nd Ed. 2024.'],
                    ['badge' => 'Chapter', 'title' => 'Braunwald 11th Ed Update', 'description' => 'Ch. 86, Essential Revision Guide. 2024.'],
                    ['badge' => 'Chapter', 'title' => 'RV Thrombosis Evaluation', 'description' => 'Ch. 39, Advances in CLOT Treatment. 2023.'],
                    ['badge' => 'Chapter', 'title' => 'Acute Febrile Illness', 'description' => 'Ch. 135, Medicine Update Vol 29. 2019.'],
                ]],
            ],
            'akash.extra_list' => [
                'title' => 'Extracurricular List',
                'meta' => ['items' => [
                    ['html' => '<strong>Spokesperson</strong>, Resident Doctor\'s Association, Safdarjung Hospital, Delhi. 2017-18'],
                    ['html' => 'Routinely writing <strong>articles in daily Indian newspapers</strong> on healthcare issues.'],
                    ['html' => '<strong>Medical Editor</strong>: Aku Review (HARENG/2014/61876)'],
                ]],
            ],
            'akash.contact_cards' => [
                'title' => 'Contact Cards',
                'meta' => ['items' => [
                    ['icon' => 'fas fa-envelope', 'title' => 'Email', 'body' => '<a href="mailto:drakashjain92@gmail.com">drakashjain92@gmail.com</a>'],
                    ['icon' => 'fas fa-map-marker-alt', 'title' => 'Clinic', 'body' => 'Aku92 Clinics, Shivaji Park Chowk, Yamunanagar, Haryana'],
                    ['icon' => 'fas fa-id-badge', 'title' => 'Registration', 'body' => 'DMC/R/14483<br>Delhi Medical Council'],
                ]],
            ],
        ];

        $now = now();

        foreach ($items as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => 'akash-jain',
                    'title' => $data['title'],
                    'meta' => json_encode($data['meta']),
                    'is_active' => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }
    }

    public function down(): void
    {
        DB::table('sections')->whereIn('key', [
            'akash.education_list',
            'akash.expertise_blocks',
            'akash.books_list',
            'akash.extra_list',
            'akash.contact_cards',
        ])->delete();
    }
};
