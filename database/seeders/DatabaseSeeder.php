<?php

namespace Database\Seeders;

use App\Models\Firm;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(['email' => 'admin@aku92.com'], [
            'name' => 'Admin',
            'password' => Hash::make('Aku92@admin'),
        ]);

        // Site Settings
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'label' => 'Site Name', 'value' => 'AKU 92'],
            ['group' => 'general', 'key' => 'tagline', 'label' => 'Tagline', 'value' => 'Media & Healthcare Group'],
            ['group' => 'general', 'key' => 'phone', 'label' => 'Phone', 'value' => '+919416987250'],
            ['group' => 'general', 'key' => 'phone_display', 'label' => 'Phone Display', 'value' => '+91 94169 87250'],
            ['group' => 'general', 'key' => 'email', 'label' => 'Email', 'value' => 'aku92delhi@gmail.com'],
            ['group' => 'general', 'key' => 'address', 'label' => 'Address', 'value' => 'Shivaji Park Chowk, Yamunanagar, Haryana - India'],
            ['group' => 'general', 'key' => 'footer_text', 'label' => 'Footer Text', 'value' => 'AKU 92 is dedicated to excellence in medical care, providing quality medicines and healthcare services across India.'],
            ['group' => 'social', 'key' => 'facebook', 'label' => 'Facebook URL', 'value' => '#'],
            ['group' => 'social', 'key' => 'instagram', 'label' => 'Instagram URL', 'value' => '#'],
            ['group' => 'social', 'key' => 'youtube', 'label' => 'YouTube URL', 'value' => 'https://youtube.com/@aku92cardio'],
            ['group' => 'factory', 'key' => 'factory_name', 'label' => 'Factory Name', 'value' => 'Aku92 Medical Industries'],
            ['group' => 'factory', 'key' => 'factory_address', 'label' => 'Factory Address', 'value' => '29, HSIIDC Phase-2 Jagadhri, Manakpur - 135003, District Yamunanagar, Haryana'],
            ['group' => 'factory', 'key' => 'factory_phone', 'label' => 'Factory Phone', 'value' => '01735-297929, 7056-297929'],
            ['group' => 'company', 'key' => 'company_name', 'label' => 'Company Name', 'value' => 'Aku92 Medical Industries Pvt. Ltd.'],
            ['group' => 'company', 'key' => 'company_address', 'label' => 'Company Address', 'value' => 'Shivaji Park Chowk, Yamunanagar'],
            ['group' => 'company', 'key' => 'company_phone', 'label' => 'Company Phone', 'value' => '94167-90522'],
        ];

        foreach ($settings as $i => $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], array_merge($s, ['sort_order' => $i]));
        }

        // Firms (in the correct order from client)
        $firms = [
            ['name' => 'Aku Review', 'icon' => 'fas fa-book-medical', 'badge' => 'Medico-Legal Publication', 'image' => 'firms/aku-review.jpg', 'address' => '29, HSIIDC Phase-2 Jagadhri, Manakpur, Yamunanagar', 'phone' => '01735-297929', 'description' => 'An English annual — Medico-Legal Special publication.'],
            ['name' => 'MCQs in Cardiology', 'icon' => 'fas fa-heart-pulse', 'badge' => 'Book — Available on Amazon', 'image' => 'products/mcq-cardiology.jpg', 'address' => 'Shivaji Park Chowk, Yamunanagar', 'description' => 'For MD and DM Students. By Akash Jain & Prashuka Jain.'],
            ['name' => 'Aku92cardio YouTube', 'icon' => 'fab fa-youtube', 'badge' => 'YouTube Channel', 'description' => 'Cardiology education, case discussions & healthcare videos.', 'link' => 'https://youtube.com/@aku92cardio'],
            ['name' => 'Aku92 Clinics', 'icon' => 'fas fa-clinic-medical', 'badge' => 'Cardiology Care', 'image' => 'firms/aku92-clinics.jpg', 'address' => 'Shivaji Park Chowk, Yamunanagar', 'description' => 'Consultation in Cardiology.'],
            ['name' => 'Aku Physiotherapy', 'icon' => 'fas fa-hand-holding-medical', 'badge' => 'Rehabilitation', 'image' => 'firms/aku-physiotherapy.jpg', 'address' => 'Shivaji Park Chowk, Yamunanagar', 'description' => 'Expert pain relief & rehabilitation.'],
            ['name' => 'Jain Medical Store', 'icon' => 'fas fa-store', 'badge' => 'Medical Supplies', 'image' => 'firms/jain-medical-store.jpg', 'address' => 'D.A.V. Market, Holkar Chowk, Yamunanagar', 'phone' => '01732-261250', 'description' => 'Medical supplies and equipment store.'],
            ['name' => 'Jain Medicines', 'icon' => 'fas fa-pills', 'badge' => 'Pharmacy & Ambulance', 'image' => 'firms/jain-medicines.jpg', 'address' => 'Santosh Hospital, Yamunanagar', 'phone' => '01732-269016, 94169-87250', 'description' => 'Pharmacy, Aku Physiotherapy & Ambulance Services.'],
        ];

        foreach ($firms as $i => $f) {
            Firm::updateOrCreate(['name' => $f['name']], array_merge($f, ['sort_order' => $i, 'slug' => \Illuminate\Support\Str::slug($f['name'])]));
        }

        // Products
        $products = [
            ['name' => 'MCQs in Cardiology for MD & DM', 'image' => 'products/mcq-cardiology.jpg', 'original_price' => 995, 'sale_price' => 796, 'category' => 'Books', 'stock' => 100, 'description' => 'Comprehensive MCQs covering cardiology for competitive exam preparation. By Akash Jain & Prashuka Jain. Also available on Amazon.'],
            ['name' => 'Aku Review (Medico-Legal)', 'image' => 'products/aku-review.jpg', 'original_price' => 500, 'sale_price' => 450, 'category' => 'Publications', 'stock' => 50, 'description' => 'An English annual — Medico-Legal Special publication.'],
            ['name' => 'Astrwch Surgical Mask', 'image' => 'products/surgical-mask.jpg', 'original_price' => 10, 'sale_price' => 4, 'category' => 'Medical Supplies', 'stock' => 10000, 'description' => 'Medical mask, total weight 3 grams. Manufactured by Aku92 Medical Industries.'],
            ['name' => 'MNKPRR Medical Paper Bags', 'image' => 'products/paper-carry-bags.jpg', 'original_price' => 100, 'sale_price' => 80, 'category' => 'Medical Supplies', 'stock' => 5000, 'description' => 'Medical paper bags manufactured by Aku92 Medical Industries.'],
            ['name' => 'Ahypr-650 Tablet', 'image' => 'products/ahypr-tablet.jpg', 'original_price' => 30, 'sale_price' => 27, 'category' => 'Medicines', 'stock' => 200, 'description' => 'Ahypr-650 tablet for medical use.'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['name' => $p['name']], array_merge($p, ['is_active' => true]));
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Subham Sharma', 'role' => 'Doctor', 'text' => 'Incredible results! No side effects. So grateful I found it!', 'rating' => 5],
            ['name' => 'Manish Gupta', 'role' => 'Manager', 'text' => "It's been a game-changer for me. Fast relief, no side effects, and I feel better every day.", 'rating' => 5],
            ['name' => 'Ravi Parshad', 'role' => 'Designer', 'text' => 'Fast relief, no side effects, and I feel like a new person. Highly recommended!', 'rating' => 5],
        ];

        foreach ($testimonials as $i => $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], array_merge($t, ['is_active' => true, 'sort_order' => $i]));
        }

        // Gallery images
        for ($i = 1; $i <= 12; $i++) {
            GalleryImage::updateOrCreate(['image' => "gallery/g{$i}.jpg"], [
                'title' => "Gallery Image {$i}",
                'section' => 'general',
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }

        // Page sections (all editable text content)
        $this->call(SectionSeeder::class);
    }
}
