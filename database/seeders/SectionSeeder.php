<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            // ───────── Home ─────────
            ['page' => 'home', 'key' => 'home.sidebar_tagline', 'title' => 'Sidebar Tagline', 'content' => 'Media & Healthcare Group'],
            ['page' => 'home', 'key' => 'home.sidebar_footer', 'title' => 'Sidebar Footer', 'content' => '© ' . date('Y') . ' AKU 92 • Yamunanagar, Haryana'],
            ['page' => 'home', 'key' => 'home.akash_badge', 'title' => 'Akash Card Badge', 'content' => 'Interventional Cardiologist'],
            ['page' => 'home', 'key' => 'home.akash_title', 'title' => 'Akash Card Title', 'content' => 'Dr. Akash Jain'],
            ['page' => 'home', 'key' => 'home.akash_desc', 'title' => 'Akash Card Description', 'content' => 'Interventional Cardiologist specializing in structural heart interventions & complex coronary procedures.'],
            ['page' => 'home', 'key' => 'home.akash_sidebar_sub', 'title' => 'Akash Sidebar Subtitle', 'content' => 'Interventional Cardiologist'],
            ['page' => 'home', 'key' => 'home.prashuka_badge', 'title' => 'Prashuka Card Badge', 'content' => 'Director'],
            ['page' => 'home', 'key' => 'home.prashuka_title', 'title' => 'Prashuka Card Title', 'content' => 'Dr. Prashuka Jain'],
            ['page' => 'home', 'key' => 'home.prashuka_desc', 'title' => 'Prashuka Card Description', 'content' => 'Director, Aku92 Medical Industries Pvt. Ltd. Clinical Cardiology Physician.'],
            ['page' => 'home', 'key' => 'home.prashuka_sidebar_sub', 'title' => 'Prashuka Sidebar Subtitle', 'content' => 'Director • Clinical Cardiology Physician'],
            ['page' => 'home', 'key' => 'home.aku92_badge', 'title' => 'AKU92 Card Badge', 'content' => 'Media & Healthcare Group'],
            ['page' => 'home', 'key' => 'home.aku92_title', 'title' => 'AKU92 Card Title', 'content' => 'AKU 92'],
            ['page' => 'home', 'key' => 'home.aku92_desc', 'title' => 'AKU92 Card Description', 'content' => 'Publications, Clinics, Cardiology, Physiotherapy, Medical Supplies & Healthcare.'],
            ['page' => 'home', 'key' => 'home.aku92_sidebar_sub', 'title' => 'AKU92 Sidebar Subtitle', 'content' => 'Media & Healthcare Group'],
            ['page' => 'home', 'key' => 'home.shop_badge', 'title' => 'Shop Card Badge', 'content' => 'Medical Products'],
            ['page' => 'home', 'key' => 'home.shop_title', 'title' => 'Shop Card Title', 'content' => 'Our Products'],
            ['page' => 'home', 'key' => 'home.shop_desc', 'title' => 'Shop Card Description', 'content' => 'Quality medicines, supplies & books at affordable prices.'],
            ['page' => 'home', 'key' => 'home.shop_sidebar_sub', 'title' => 'Shop Sidebar Subtitle', 'content' => 'Medical supplies & books'],

            // ───────── Akash Jain ─────────
            ['page' => 'akash-jain', 'key' => 'akash.hero_label', 'title' => 'Hero Label', 'content' => 'Interventional Cardiologist'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_name', 'title' => 'Hero Name', 'content' => 'Dr. Akash Jain'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_title', 'title' => 'Hero Title', 'content' => 'Director, Aku92 Clinics (unit of Aku92 Medical Industries Pvt Ltd)'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_org', 'title' => 'Hero Organization', 'content' => 'Shivaji Park Chowk, Yamunanagar, Haryana, India'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_registration', 'title' => 'Registration', 'content' => 'DMC/R/14483'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_email', 'title' => 'Email', 'content' => 'drakashjain92@gmail.com'],
            ['page' => 'akash-jain', 'key' => 'akash.hero_bio', 'title' => 'Hero Bio', 'content' => 'Interventional Cardiologist trained in Spain and India. Specializing in structural heart interventions and complex coronary procedures with 35+ international publications in top journals.'],
            ['page' => 'akash-jain', 'key' => 'akash.stat_publications', 'title' => 'Stat: Publications', 'content' => '35+', 'meta' => ['label' => 'Publications']],
            ['page' => 'akash-jain', 'key' => 'akash.stat_books', 'title' => 'Stat: Book Chapters', 'content' => '6', 'meta' => ['label' => 'Book Chapters']],
            ['page' => 'akash-jain', 'key' => 'akash.stat_years', 'title' => 'Stat: Years Experience', 'content' => '10+', 'meta' => ['label' => 'Years Experience']],
            ['page' => 'akash-jain', 'key' => 'akash.education_label', 'title' => 'Education Section Label', 'content' => 'Education'],
            ['page' => 'akash-jain', 'key' => 'akash.education_title', 'title' => 'Education Section Title', 'content' => 'Academic Background'],
            ['page' => 'akash-jain', 'key' => 'akash.expertise_label', 'title' => 'Expertise Section Label', 'content' => 'Specialization'],
            ['page' => 'akash-jain', 'key' => 'akash.expertise_title', 'title' => 'Expertise Section Title', 'content' => 'Areas of Expertise'],
            ['page' => 'akash-jain', 'key' => 'akash.publications_label', 'title' => 'Publications Label', 'content' => 'Research'],
            ['page' => 'akash-jain', 'key' => 'akash.publications_title', 'title' => 'Publications Title', 'content' => 'Publications'],
            ['page' => 'akash-jain', 'key' => 'akash.publications_sub', 'title' => 'Publications Subtitle', 'content' => 'Selected peer-reviewed publications in international cardiology journals.'],
            ['page' => 'akash-jain', 'key' => 'akash.books_label', 'title' => 'Books Label', 'content' => 'Author'],
            ['page' => 'akash-jain', 'key' => 'akash.books_title', 'title' => 'Books Title', 'content' => 'Books & Chapters'],
            ['page' => 'akash-jain', 'key' => 'akash.extra_label', 'title' => 'Extra Label', 'content' => 'Beyond Medicine'],
            ['page' => 'akash-jain', 'key' => 'akash.extra_title', 'title' => 'Extra Title', 'content' => 'Extracurricular'],
            ['page' => 'akash-jain', 'key' => 'akash.blog_label', 'title' => 'Blog Label', 'content' => 'Insights'],
            ['page' => 'akash-jain', 'key' => 'akash.blog_title', 'title' => 'Blog Title', 'content' => 'Latest Articles'],
            ['page' => 'akash-jain', 'key' => 'akash.blog_sub', 'title' => 'Blog Subtitle', 'content' => 'Research notes, clinical insights, and case discussions from Dr. Akash Jain.'],
            ['page' => 'akash-jain', 'key' => 'akash.contact_label', 'title' => 'Contact Label', 'content' => 'Contact'],
            ['page' => 'akash-jain', 'key' => 'akash.contact_title', 'title' => 'Contact Title', 'content' => 'Get in Touch'],

            // ───────── Prashuka Jain ─────────
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_label', 'title' => 'Hero Label', 'content' => 'Clinical Cardiology Physician'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_name', 'title' => 'Hero Name', 'content' => 'Dr. Prashuka Jain'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_title', 'title' => 'Hero Title', 'content' => 'Director, Aku92 Clinics (unit of Aku92 Medical Industries Pvt Ltd)'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_org', 'title' => 'Hero Organization', 'content' => 'Shivaji Park Chowk, Yamunanagar, Haryana, India'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_registration', 'title' => 'Registration', 'content' => 'HN 28044'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_email', 'title' => 'Email', 'content' => 'jainprashuka@gmail.com'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.hero_bio', 'title' => 'Hero Bio', 'content' => "Clinical Cardiology Physician with a fellowship from St John's Medical College Hospital, Bangalore. Trained in patient care across leading Indian hospitals, with co-authored textbook contributions in cardiology."],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.stat_fellowship', 'title' => 'Stat: Fellowship', 'content' => '2yr', 'meta' => ['label' => 'Cardiology Fellowship']],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.stat_publications', 'title' => 'Stat: Publications', 'content' => '2', 'meta' => ['label' => 'Publications']],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.stat_years', 'title' => 'Stat: Years Experience', 'content' => '8+', 'meta' => ['label' => 'Years Experience']],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.education_label', 'title' => 'Education Label', 'content' => 'Education'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.education_title', 'title' => 'Education Title', 'content' => 'Academic Background'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.expertise_label', 'title' => 'Expertise Label', 'content' => 'Areas of Practice'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.expertise_title', 'title' => 'Expertise Title', 'content' => 'Clinical Expertise'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.experience_label', 'title' => 'Experience Label', 'content' => 'Career'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.experience_title', 'title' => 'Experience Title', 'content' => 'Professional Experience'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.blog_label', 'title' => 'Blog Label', 'content' => 'Insights'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.blog_title', 'title' => 'Blog Title', 'content' => 'Latest Articles'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.blog_sub', 'title' => 'Blog Subtitle', 'content' => 'Health tips, community outreach updates, and writings from Dr. Prashuka Jain.'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.contact_label', 'title' => 'Contact Label', 'content' => 'Contact'],
            ['page' => 'prashuka-jain', 'key' => 'prashuka.contact_title', 'title' => 'Contact Title', 'content' => 'Get in Touch'],

            // ───────── AKU92 Hub ─────────
            ['page' => 'aku92-hub', 'key' => 'aku92.sidebar_brand', 'title' => 'Sidebar Brand', 'content' => 'AKU92'],
            ['page' => 'aku92-hub', 'key' => 'aku92.sidebar_tagline', 'title' => 'Sidebar Tagline', 'content' => 'Media & Healthcare Group'],
            ['page' => 'aku92-hub', 'key' => 'aku92.sidebar_footer', 'title' => 'Sidebar Footer', 'content' => '© ' . date('Y') . ' AKU 92 • Yamunanagar, Haryana'],

            // ───────── AKU92 Clinics ─────────
            ['page' => 'aku92-clinics', 'key' => 'clinics.hero_title', 'title' => 'Hero Title', 'content' => 'Aku92 Clinics'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.hero_sub', 'title' => 'Hero Subtitle', 'content' => 'Consultation in Cardiology at Shivaji Park Chowk, Yamunanagar'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.about_title', 'title' => 'About Title', 'content' => 'About Our Clinics'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.about_content', 'title' => 'About Content', 'content' => '<p>Aku92 Clinics, located at Shivaji Park Chowk, Yamunanagar, provides specialized cardiology consultation and outpatient services. Our experienced doctors and modern facilities ensure that every patient receives the best possible care.</p><p>We specialize in cardiology consultations, cardiac diagnostics, physiotherapy referrals, and preventive health checkups. Part of Aku92 Medical Industries Pvt. Ltd.</p>'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctors_title', 'title' => 'Doctors Title', 'content' => 'Our Doctors'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctors_sub', 'title' => 'Doctors Subtitle', 'content' => 'Experienced medical professionals at your service'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor1_name', 'title' => 'Doctor 1 Name', 'content' => 'Dr. Prashuka Jain'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor1_role', 'title' => 'Doctor 1 Role', 'content' => 'Clinical Cardiology Physician'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor1_bio', 'title' => 'Doctor 1 Bio', 'content' => 'Director, Aku92 Medical Industries Pvt. Ltd. with 8+ years of experience.'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor2_name', 'title' => 'Doctor 2 Name', 'content' => 'Consulting Specialists'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor2_role', 'title' => 'Doctor 2 Role', 'content' => 'Cardiology'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.doctor2_bio', 'title' => 'Doctor 2 Bio', 'content' => 'Visiting specialists in cardiology and related specializations.'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.timings_title', 'title' => 'Timings Title', 'content' => 'OPD Timings'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.location_title', 'title' => 'Location Title', 'content' => 'Our Location'],
            ['page' => 'aku92-clinics', 'key' => 'clinics.location_address', 'title' => 'Location Address', 'content' => 'Shivaji Park Chowk, Yamunanagar, Haryana'],

            // ───────── About Page ─────────
            ['page' => 'about', 'key' => 'about.hero_title', 'title' => 'Hero Title', 'content' => 'About AKU 92'],
            ['page' => 'about', 'key' => 'about.lead', 'title' => 'Lead', 'content' => 'Media & Healthcare Group'],
            ['page' => 'about', 'key' => 'about.content', 'title' => 'Main Content', 'content' => '<p>AKU 92 is dedicated to excellence in medical care. Operating across Yamunanagar and beyond, we serve our community through cardiology clinics, pharmacy, physiotherapy, medical publications, and medical supplies manufacturing.</p>'],

            // ───────── Contact Page ─────────
            ['page' => 'contact', 'key' => 'contact.hero_title', 'title' => 'Hero Title', 'content' => 'Contact Us'],
            ['page' => 'contact', 'key' => 'contact.form_title', 'title' => 'Form Title', 'content' => 'Drop Us A Line'],
            ['page' => 'contact', 'key' => 'contact.form_sub', 'title' => 'Form Subtitle', 'content' => 'Keep in touch with us.'],
            ['page' => 'contact', 'key' => 'contact.info_title', 'title' => 'Info Title', 'content' => 'Contact Information'],
            ['page' => 'contact', 'key' => 'contact.firms_title', 'title' => 'Firms Title', 'content' => 'Our Firms'],
            ['page' => 'contact', 'key' => 'contact.firms_sub', 'title' => 'Firms Subtitle', 'content' => 'Contact details for all our branches'],

            // ───────── Shop Page ─────────
            ['page' => 'shop', 'key' => 'shop.hero_title', 'title' => 'Hero Title', 'content' => 'Our Products'],
            ['page' => 'shop', 'key' => 'shop.hero_sub', 'title' => 'Hero Subtitle', 'content' => 'Quality medical products & supplies at affordable prices'],

            // ───────── OPD Form Page ─────────
            ['page' => 'aku92-opd-form', 'key' => 'opd.hero_title', 'title' => 'Hero Title', 'content' => 'OPD Registration Form'],
            ['page' => 'aku92-opd-form', 'key' => 'opd.hero_sub', 'title' => 'Hero Subtitle', 'content' => 'Book an appointment at Aku92 Clinics'],
            ['page' => 'aku92-opd-form', 'key' => 'opd.form_title', 'title' => 'Form Title', 'content' => 'Patient Registration'],
            ['page' => 'aku92-opd-form', 'key' => 'opd.form_sub', 'title' => 'Form Subtitle', 'content' => 'Fill in your details to book an OPD appointment.'],
        ];

        foreach ($sections as $i => $s) {
            Section::updateOrCreate(
                ['key' => $s['key']],
                array_merge($s, [
                    'is_active' => true,
                    'sort_order' => $i,
                ])
            );
        }
    }
}
