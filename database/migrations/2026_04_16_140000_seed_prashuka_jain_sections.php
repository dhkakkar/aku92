<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        // ── Plain text sections ──
        $text = [
            'prashuka.about_label' => ['title' => 'About Section Label', 'content' => 'About'],
            'prashuka.about_title' => ['title' => 'About Section Title', 'content' => 'About Dr. Prashuka Jain'],
            'prashuka.about_text'  => ['title' => 'About Body', 'content' => "Dr. Prashuka Jain is a clinical cardiologist and a Director at Aku92 Clinics. After completing her MBBS from Shri Guru Ram Rai Institute of Medical Sciences and Research, Dehradun, she pursued a 2-year clinical cardiology fellowship at St John's Medical College Hospital, Bangalore. Her training spans inpatient and outpatient cardiac care across leading Indian hospitals, and she has co-authored cardiology textbook chapters published by Jaypee Brothers Medical Publishers. At Aku92, she combines her clinical expertise with the family legacy of accessible, patient-first healthcare in Yamunanagar."],
            'prashuka.publications_label' => ['title' => 'Publications Section Label', 'content' => 'Author'],
            'prashuka.publications_title' => ['title' => 'Publications Section Title', 'content' => 'Books & Publications'],
            'prashuka.publications_sub'   => ['title' => 'Publications Section Sub', 'content' => 'Co-authored cardiology titles published by Jaypee Brothers Medical Publishers.'],
            'prashuka.journey_label'      => ['title' => 'Journey Section Label', 'content' => 'Journey'],
            'prashuka.journey_title'      => ['title' => 'Journey Section Title', 'content' => 'Key Milestones'],
        ];

        foreach ($text as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => 'prashuka-jain',
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'is_active' => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }

        // ── Lists stored in meta.items ──
        $lists = [
            'prashuka.education_list' => [
                'title' => 'Education List',
                'items' => [
                    ['title' => 'Fellowship in Clinical Cardiology (2 years)', 'institution' => "St John's Medical College Hospital", 'location' => 'Bangalore, India', 'icon' => 'fas fa-heart-pulse'],
                    ['title' => 'MBBS', 'institution' => 'Shri Guru Ram Rai Institute of Medical Sciences and Research', 'location' => 'Dehradun, India', 'icon' => 'fas fa-user-graduate'],
                ],
            ],
            'prashuka.experience_list' => [
                'title' => 'Experience List',
                'items' => [
                    ['title' => 'Consultant', 'institution' => 'K.M Jain Hospital, Uttar Pradesh, India', 'location' => 'Worked 60 hours a week, with primary responsibility for management of in-patients and OPD services.', 'icon' => 'fas fa-stethoscope'],
                    ['title' => 'Junior Resident', 'institution' => 'Vardhman Mahavir Medical College & Safdarjung Hospital', 'location' => 'Delhi, India', 'icon' => 'fas fa-hospital-user'],
                    ['title' => 'Internship', 'institution' => 'Babu Banarsi Das Civil Hospital', 'location' => 'Bulandshahr, Uttar Pradesh, India', 'icon' => 'fas fa-user-doctor'],
                ],
            ],
            'prashuka.expertise_cards' => [
                'title' => 'Expertise Cards',
                'items' => [
                    ['icon' => 'fas fa-heart-pulse', 'title' => 'Clinical Cardiology', 'description' => "Outpatient and inpatient cardiac care, drawing on a 2-year fellowship at St John's Medical College Hospital, Bangalore."],
                    ['icon' => 'fas fa-wave-square', 'title' => 'Echocardiography', 'description' => 'Echo-based evaluation of cardiac structure and function, with co-authored textbook contributions on right ventricle thrombosis assessment.'],
                    ['icon' => 'fas fa-notes-medical', 'title' => 'OPD & Inpatient Care', 'description' => 'Hands-on hospital experience as Consultant and Junior Resident managing both OPD and in-patient services.'],
                    ['icon' => 'fas fa-book-medical', 'title' => 'Medical Education', 'description' => 'Co-author of an MCQ book in cardiology used by MD and DM students, plus textbook chapters on advanced cardiac topics.'],
                    ['icon' => 'fas fa-users', 'title' => 'Patient Counseling', 'description' => 'Guiding patients and families on cardiac risk factors, lifestyle, and long-term care planning.'],
                    ['icon' => 'fas fa-newspaper', 'title' => 'Health Writing', 'description' => 'Writes articles regularly in Indian newspapers on healthcare topics for the general public.'],
                ],
            ],
            'prashuka.publications_list' => [
                'title' => 'Publications List',
                'items' => [
                    ['badge' => 'Co-Author', 'title' => 'MCQs in Cardiology', 'body' => 'Akash Jain, Prashuka Jain. Jaypee Brothers Medical Publishers, 2023. A question-bank reference for MD and DM students preparing for cardiology examinations.'],
                    ['badge' => 'Chapter', 'title' => 'Echocardiographic Evaluation of Thrombosis in Right Ventricle', 'body' => 'Sunil S Bohra, Akash Jain, Prashuka Jain. Chapter 39 in <em>Advances in CLOT Treatment (ACT) — A Textbook of Cardiology</em>. Jaypee Brothers Medical Publishers, 2023, pp. 210–213.'],
                ],
            ],
            'prashuka.journey_list' => [
                'title' => 'Journey Timeline',
                'items' => [
                    ['year' => '2015', 'text' => 'Joined the AKU 92 family — bringing fresh energy and modern perspective to the healthcare mission.'],
                    ['year' => '2018', 'text' => 'Streamlined pharmacy operations at Jain Medicines, improving patient service speed and medicine availability.'],
                    ['year' => '2020', 'text' => 'Played key role in launching Jan Aushadhi generic medicine store — making healthcare affordable for all.'],
                    ['year' => '2021', 'text' => 'Led the digital transformation — launched online medicine ordering platform and OPD booking system.'],
                    ['year' => '2023', 'text' => 'Initiated community health camps across Yamunanagar district, serving thousands of patients.'],
                    ['year' => '2025', 'text' => 'Expanded patient care services at newly opened Aku92 Clinics inside Santosh Hospital.'],
                ],
            ],
            'prashuka.contact_cards' => [
                'title' => 'Contact Cards',
                'items' => [
                    ['icon' => 'fas fa-envelope', 'title' => 'Email', 'body' => '<a href="mailto:jainprashuka@gmail.com">jainprashuka@gmail.com</a>'],
                    ['icon' => 'fas fa-map-marker-alt', 'title' => 'Clinic', 'body' => 'Aku92 Clinics, Shivaji Park Chowk, Yamunanagar, Haryana'],
                    ['icon' => 'fas fa-id-badge', 'title' => 'Registration', 'body' => 'HN 28044<br>Haryana Medical Council'],
                ],
            ],
        ];

        foreach ($lists as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => 'prashuka-jain',
                    'title' => $data['title'],
                    'meta' => json_encode(['items' => $data['items']]),
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
            'prashuka.about_label',
            'prashuka.about_title',
            'prashuka.about_text',
            'prashuka.publications_label',
            'prashuka.publications_title',
            'prashuka.publications_sub',
            'prashuka.journey_label',
            'prashuka.journey_title',
            'prashuka.education_list',
            'prashuka.experience_list',
            'prashuka.expertise_cards',
            'prashuka.publications_list',
            'prashuka.journey_list',
            'prashuka.contact_cards',
        ])->delete();
    }
};
