<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public $withinTransaction = false;

    public function up(): void
    {
        $now = now();

        $text = [
            // ── Hub (aku92-hub page) ──
            'aku92.sidebar_brand'   => ['page' => 'aku92-hub', 'title' => 'Hub Sidebar Brand', 'content' => 'AKU92'],
            'aku92.sidebar_tagline' => ['page' => 'aku92-hub', 'title' => 'Hub Sidebar Tagline', 'content' => 'Media & Healthcare Group'],
            'aku92.sidebar_footer'  => ['page' => 'aku92-hub', 'title' => 'Hub Sidebar Footer', 'content' => '&copy; ' . date('Y') . ' AKU 92 &bull; Yamunanagar, Haryana'],

            // ── Clinics ──
            'clinics.hero_title'        => ['page' => 'aku92-clinics', 'title' => 'Hero Title', 'content' => 'Aku92 Clinics'],
            'clinics.hero_sub'          => ['page' => 'aku92-clinics', 'title' => 'Hero Sub', 'content' => 'Consultation in Cardiology at Shivaji Park Chowk, Yamunanagar'],
            'clinics.about_title'       => ['page' => 'aku92-clinics', 'title' => 'About Title', 'content' => 'About Our Clinics'],
            'clinics.about_content'     => ['page' => 'aku92-clinics', 'title' => 'About Body', 'content' => '<p>Aku92 Clinics, located at Shivaji Park Chowk, Yamunanagar, brings expert clinical cardiology care to the community. Under the directorship of Dr. Prashuka Jain (Clinical Cardiology Physician) and Dr. Akash Jain (Interventional Cardiologist), the clinic offers consultation, follow-up and structured outpatient care.</p>'],
            'clinics.doctors_title'     => ['page' => 'aku92-clinics', 'title' => 'Doctors Title', 'content' => 'Our Doctors'],
            'clinics.doctors_sub'       => ['page' => 'aku92-clinics', 'title' => 'Doctors Sub', 'content' => 'Experienced medical professionals at your service'],
            'clinics.timings_title'     => ['page' => 'aku92-clinics', 'title' => 'OPD Timings Title', 'content' => 'OPD Timings'],
            'clinics.location_title'    => ['page' => 'aku92-clinics', 'title' => 'Location Title', 'content' => 'Our Location'],
            'clinics.location_address'  => ['page' => 'aku92-clinics', 'title' => 'Address', 'content' => 'Shivaji Park Chowk, Yamunanagar, Haryana'],

            // ── Jain Medicines ──
            'jain.hero_title'    => ['page' => 'aku92-jain-medicines', 'title' => 'Hero Title', 'content' => 'Jain Medicines'],
            'jain.hero_sub'      => ['page' => 'aku92-jain-medicines', 'title' => 'Hero Sub', 'content' => 'Quality medicines at affordable prices since 1987'],
            'jain.about_title'   => ['page' => 'aku92-jain-medicines', 'title' => 'About Title', 'content' => 'About Jain Medicines'],
            'jain.about_content' => ['page' => 'aku92-jain-medicines', 'title' => 'About Body', 'content' => '<p>Established in 1987, Jain Medicines has been the cornerstone of the AKU 92 healthcare group. For over 36 years, we have been providing quality medicines at affordable prices to the people of Yamunanagar and surrounding areas.</p><p>Located inside Santosh Hospital at Gobindpuri, we offer a wide range of prescription medicines, OTC drugs, surgical supplies, and healthcare products. Our trained pharmacists ensure accurate dispensing and helpful guidance for every customer.</p>'],
            'jain.services_title'=> ['page' => 'aku92-jain-medicines', 'title' => 'Services Title', 'content' => 'Our Services'],
            'jain.contact_title' => ['page' => 'aku92-jain-medicines', 'title' => 'Contact Title', 'content' => 'Visit Us'],
            'jain.contact_address'=> ['page' => 'aku92-jain-medicines', 'title' => 'Address', 'content' => 'Inside Santosh Hospital, Gobindpuri, Kanhaya Chowk, Yamunanagar'],
            'jain.contact_phone' => ['page' => 'aku92-jain-medicines', 'title' => 'Phone', 'content' => '0173 2269016'],

            // ── Physiotherapy ──
            'physio.hero_title'    => ['page' => 'aku92-physiotherapy', 'title' => 'Hero Title', 'content' => 'Aku Physiotherapy'],
            'physio.hero_sub'      => ['page' => 'aku92-physiotherapy', 'title' => 'Hero Sub', 'content' => 'Expert physiotherapy for pain relief & rehabilitation'],
            'physio.about_title'   => ['page' => 'aku92-physiotherapy', 'title' => 'About Title', 'content' => 'About Aku Physiotherapy'],
            'physio.about_content' => ['page' => 'aku92-physiotherapy', 'title' => 'About Body', 'content' => '<p>Located at 62, Shivaji Park Chowk, Yamunanagar, Aku Physiotherapy provides expert rehabilitation and pain management services. Our team of qualified physiotherapists uses modern equipment and evidence-based techniques to help patients recover faster and live pain-free.</p><p>Whether you\'re recovering from surgery, managing chronic pain, or rehabilitating from a sports injury, we create personalized treatment plans tailored to your needs.</p>'],
            'physio.treatments_title'=> ['page' => 'aku92-physiotherapy', 'title' => 'Treatments Title', 'content' => 'Our Treatments'],
            'physio.contact_title' => ['page' => 'aku92-physiotherapy', 'title' => 'Contact Title', 'content' => 'Book a Session'],
            'physio.contact_address'=> ['page' => 'aku92-physiotherapy', 'title' => 'Address', 'content' => '62, Shivaji Park Chowk, Yamunanagar'],
            'physio.contact_phone' => ['page' => 'aku92-physiotherapy', 'title' => 'Phone', 'content' => '0173 220062'],

            // ── Aku Review ──
            'review.hero_title'    => ['page' => 'aku92-review', 'title' => 'Hero Title', 'content' => 'Aku Review'],
            'review.hero_sub'      => ['page' => 'aku92-review', 'title' => 'Hero Sub', 'content' => 'Medical publications & educational resources'],
            'review.about_title'   => ['page' => 'aku92-review', 'title' => 'About Title', 'content' => 'About Aku Review'],
            'review.about_content' => ['page' => 'aku92-review', 'title' => 'About Body', 'content' => '<p>Aku Review is the publishing arm of AKU 92, dedicated to creating high-quality medical review materials and educational publications for healthcare professionals and students.</p><p>Our publications include MCQ books for competitive medical exams, clinical review journals, and educational material covering a wide range of medical specializations. Based at 196, Shastri Colony, Yamunanagar, we continue to contribute to medical education across India.</p>'],
            'review.publications_title'=> ['page' => 'aku92-review', 'title' => 'Publications Title', 'content' => 'Our Publications'],
            'review.contact_title' => ['page' => 'aku92-review', 'title' => 'Contact Title', 'content' => 'Contact Us'],
            'review.contact_address'=> ['page' => 'aku92-review', 'title' => 'Address', 'content' => '196, Shastri Colony, Yamunanagar'],
            'review.contact_phone' => ['page' => 'aku92-review', 'title' => 'Phone', 'content' => '0173 230196'],

            // ── OPD Form page ──
            'opd.page_title' => ['page' => 'aku92-opd-form', 'title' => 'Form Heading', 'content' => 'Patient Registration — OPD'],
            'opd.page_sub'   => ['page' => 'aku92-opd-form', 'title' => 'Form Sub-text', 'content' => 'Fill in the details below to register for outpatient services.'],
        ];

        foreach ($text as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => $data['page'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'is_active' => true,
                    'sort_order' => 0,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }

        $lists = [
            // ── Hub ──
            'aku92.hub_sidebar_links' => ['page' => 'aku92-hub', 'title' => 'Hub Sidebar Links', 'items' => [
                ['icon' => 'fas fa-book-medical',          'title' => 'Aku Review',           'sub' => 'Medico-Legal Publication',     'url' => '/healthcare/review',         'target' => '_self'],
                ['icon' => 'fas fa-heart-pulse',           'title' => 'MCQs in Cardiology',   'sub' => 'Book for MD & DM Students',    'url' => '/shop/product/1',            'target' => '_self'],
                ['icon' => 'fab fa-youtube',               'title' => 'Aku92cardio',          'sub' => 'YouTube Channel',              'url' => 'https://youtube.com/@aku92cardio', 'target' => '_blank'],
                ['icon' => 'fas fa-clinic-medical',        'title' => 'Aku92 Clinics',        'sub' => 'Cardiology, Shivaji Park',     'url' => '/healthcare/clinics',        'target' => '_self'],
                ['icon' => 'fas fa-hand-holding-medical',  'title' => 'Aku Physiotherapy',    'sub' => 'Pain relief & rehab',          'url' => '/healthcare/physiotherapy',  'target' => '_self'],
                ['icon' => 'fas fa-store',                 'title' => 'Jain Medical Store',   'sub' => 'D.A.V. Market',                'url' => '/healthcare/jain-medicines', 'target' => '_self'],
                ['icon' => 'fas fa-pills',                 'title' => 'Jain Medicines',       'sub' => 'Santosh Hospital',             'url' => '/healthcare/jain-medicines', 'target' => '_self'],
                ['icon' => 'fas fa-calendar-check',        'title' => 'Book Appointment',     'sub' => 'OPD Registration',             'url' => '/healthcare/opd-form',       'target' => '_self'],
                ['icon' => 'fas fa-arrow-left',            'title' => 'Back to Home',         'sub' => '',                             'url' => '/',                          'target' => '_self'],
            ]],
            'aku92.hub_cards' => ['page' => 'aku92-hub', 'title' => 'Hub Main Grid Cards', 'items' => [
                ['variant' => 'image', 'image' => 'images/firms/aku-review.jpg',       'icon' => 'fas fa-book-medical',           'badge' => 'Medico-Legal Publication',    'title' => 'Aku Review',         'description' => 'An English annual — Medico-Legal Special publication.', 'url' => '/healthcare/review', 'target' => '_self'],
                ['variant' => 'image', 'image' => 'images/products/mcq-cardiology.jpg','icon' => 'fas fa-heart-pulse',            'badge' => 'Book &bull; Available on Amazon', 'title' => 'MCQs in Cardiology', 'description' => 'For MD and DM Students. By Akash Jain & Prashuka Jain.', 'url' => '/shop/product/1', 'target' => '_self'],
                ['variant' => 'youtube','image' => '',                                  'icon' => 'fab fa-youtube',                'badge' => 'YouTube Channel',             'title' => 'Aku92cardio',        'description' => 'Cardiology education, case discussions & healthcare videos.', 'url' => 'https://youtube.com/@aku92cardio', 'target' => '_blank'],
                ['variant' => 'image', 'image' => 'images/firms/aku92-clinics.jpg',    'icon' => 'fas fa-clinic-medical',         'badge' => 'Cardiology Care',             'title' => 'Aku92 Clinics',      'description' => 'Consultation in Cardiology at Shivaji Park Chowk, Yamunanagar.', 'url' => '/healthcare/clinics', 'target' => '_self'],
                ['variant' => 'image', 'image' => 'images/firms/aku-physiotherapy.jpg','icon' => 'fas fa-hand-holding-medical',   'badge' => 'Rehabilitation',              'title' => 'Aku Physiotherapy',  'description' => 'Expert pain relief & rehabilitation at Shivaji Park Chowk.', 'url' => '/healthcare/physiotherapy', 'target' => '_self'],
                ['variant' => 'image', 'image' => 'images/firms/jain-medical-store.jpg','icon'=> 'fas fa-store',                   'badge' => 'Medical Supplies',            'title' => 'Jain Medical Store', 'description' => 'D.A.V. Market, Holkar Chowk, Yamunanagar.', 'url' => '/shop', 'target' => '_self'],
                ['variant' => 'image', 'image' => 'images/firms/jain-medicines.jpg',   'icon' => 'fas fa-pills',                  'badge' => 'Pharmacy &bull; Ambulance',   'title' => 'Jain Medicines',     'description' => 'Pharmacy, Aku Physiotherapy & Ambulance at Santosh Hospital.', 'url' => '/healthcare/jain-medicines', 'target' => '_self'],
                ['variant' => 'cta',   'image' => '',                                  'icon' => 'fas fa-calendar-check',         'badge' => 'Book Appointment',            'title' => 'OPD Form',           'description' => 'Register for outpatient services online.', 'url' => '/healthcare/opd-form', 'target' => '_self'],
            ]],

            // ── Clinics ──
            'clinics.doctors_list' => ['page' => 'aku92-clinics', 'title' => 'Doctors List', 'items' => [
                ['name' => 'Dr. Prashuka Jain',         'role' => 'Clinical Cardiology Physician', 'bio' => 'Director, Aku92 Medical Industries Pvt. Ltd. with 8+ years of experience.'],
                ['name' => 'Consulting Specialists',    'role' => 'Cardiology',                    'bio' => 'Visiting specialists in cardiology and related specializations.'],
            ]],
            'clinics.timings_list' => ['page' => 'aku92-clinics', 'title' => 'OPD Timings', 'items' => [
                ['day' => 'Monday – Saturday', 'morning' => '9:00 AM – 1:00 PM',  'evening' => '5:00 PM – 8:00 PM'],
                ['day' => 'Sunday',            'morning' => '10:00 AM – 12:00 PM','evening' => 'Closed'],
            ]],

            // ── Jain Medicines ──
            'jain.services_list' => ['page' => 'aku92-jain-medicines', 'title' => 'Services List', 'items' => [
                ['icon' => 'fas fa-prescription', 'title' => 'Prescription Filling', 'description' => 'Accurate and timely prescription dispensing by trained pharmacists.'],
                ['icon' => 'fas fa-tablets',      'title' => 'OTC Medicines',        'description' => 'Wide range of over-the-counter medicines for common ailments.'],
                ['icon' => 'fas fa-syringe',      'title' => 'Surgical Supplies',    'description' => 'Medical equipment, surgical items, and healthcare accessories.'],
                ['icon' => 'fas fa-truck',        'title' => 'Home Delivery',        'description' => 'Medicine delivery to your doorstep within Yamunanagar.'],
                ['icon' => 'fas fa-user-nurse',   'title' => 'Expert Guidance',      'description' => 'Professional pharmacist advice on medication and dosage.'],
                ['icon' => 'fas fa-tags',         'title' => 'Affordable Pricing',   'description' => 'Competitive prices and discounts on a wide range of medicines.'],
            ]],

            // ── Physiotherapy ──
            'physio.treatments_list' => ['page' => 'aku92-physiotherapy', 'title' => 'Treatments List', 'items' => [
                ['icon' => 'fas fa-bone',       'title' => 'Joint Pain Relief',   'description' => 'Treatment for knee, shoulder, back, and neck pain using advanced techniques.'],
                ['icon' => 'fas fa-walking',    'title' => 'Post-Surgery Rehab',  'description' => 'Rehabilitation programs after orthopedic and neurological surgeries.'],
                ['icon' => 'fas fa-running',    'title' => 'Sports Injury',       'description' => 'Specialized treatment for sports-related injuries and performance recovery.'],
                ['icon' => 'fas fa-wheelchair', 'title' => 'Neuro Rehab',         'description' => 'Physiotherapy for stroke, paralysis, and neurological conditions.'],
                ['icon' => 'fas fa-spa',        'title' => 'Pain Management',     'description' => 'Electrotherapy, ultrasound, and manual therapy for chronic pain conditions.'],
                ['icon' => 'fas fa-child',      'title' => 'Pediatric Physio',    'description' => 'Physiotherapy for children with developmental and movement disorders.'],
            ]],

            // ── Aku Review ──
            'review.publications_list' => ['page' => 'aku92-review', 'title' => 'Publications List', 'items' => [
                ['image' => 'images/products/mcq-cardiology.jpg', 'title' => "MCQ's in Cardiology", 'description' => 'Comprehensive multiple-choice questions covering cardiology for competitive exam preparation.', 'price' => '796', 'original_price' => '995'],
                ['image' => 'images/products/aku-review.jpg',     'title' => 'Aku Review Journal',  'description' => 'Medical review journal with clinical insights and case studies for healthcare professionals.', 'price' => '450', 'original_price' => '500'],
            ]],
        ];

        foreach ($lists as $key => $data) {
            DB::table('sections')->updateOrInsert(
                ['key' => $key],
                [
                    'page' => $data['page'],
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
        DB::table('sections')->where('page', 'like', 'aku92-%')->delete();
    }
};
