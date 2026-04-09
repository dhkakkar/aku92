<?php

return [
    'name' => 'AKU 92',
    'phone' => '+919416987250',
    'phone_display' => '+91 94169 87250',
    'email' => 'jainmedicalstore1987@gmail.com',
    'address' => 'Jain Medicines, Inside Santosh Hospital Gobindpuri, Kanhaya Chowk, Yamunanagar, 135001, Haryana - India',

    'firms' => [
        [
            'name' => 'Aku92 Clinics',
            'image' => 'firms/aku92-clinics.jpg',
            'address' => 'Inside Santosh Hospital Gobindpuri, Kanhaya Chowk, Yamunanagar',
            'description' => 'Multi-specialty clinic providing quality healthcare services.',
        ],
        [
            'name' => 'Jain Medicines',
            'image' => 'firms/jain-medicines.jpg',
            'address' => 'Inside Santosh Hospital Gobindpuri, Kanhaya Chowk, Yamunanagar',
            'description' => 'Pharmacy offering quality medicines at affordable prices since 1987.',
            'phone' => '0173 2269016',
        ],
        [
            'name' => 'Aku Physiotherapy',
            'image' => 'firms/aku-physiotherapy.jpg',
            'address' => '62, Shivaji Park Chowk, Yamunanagar',
            'description' => 'Expert physiotherapy services for pain relief and rehabilitation.',
            'phone' => '0173 220062',
        ],
        [
            'name' => 'Aku Review',
            'image' => 'firms/aku-review.jpg',
            'address' => '196, Shastri Colony, Yamunanagar',
            'description' => 'Medical review and educational publications.',
            'phone' => '0173 230196',
        ],
        [
            'name' => 'Jain Medical Store',
            'image' => 'firms/jain-medical-store.jpg',
            'address' => 'D.A.V. Market, Holkar Chowk, Yamunanagar',
            'description' => 'Medical supplies and equipment store.',
            'phone' => '0173 221676',
        ],
        [
            'name' => 'Jan Aushadhi Store',
            'image' => 'firms/jan-aushadhi.jpg',
            'address' => 'Near Aku Physiotherapy, Yamunanagar',
            'description' => 'Government-subsidized generic medicine store.',
            'phone' => '0173 261092',
        ],
    ],

    'testimonials' => [
        ['name' => 'Subham Sharma', 'role' => 'Doctor', 'text' => 'Incredible results! No side effects. So grateful I found it!', 'rating' => 5],
        ['name' => 'Manish Gupta', 'role' => 'Manager', 'text' => "It's been a game-changer for me. Fast relief, no side effects, and I feel better every day.", 'rating' => 5],
        ['name' => 'Ravi Parshad', 'role' => 'Designer', 'text' => 'Fast relief, no side effects, and I feel like a new person. Highly recommended!', 'rating' => 5],
    ],

    'products' => [
        ['id' => 1, 'name' => 'MNKPRR Paper Carry Bags', 'image' => 'products/paper-carry-bags.jpg', 'original_price' => 100, 'sale_price' => 80],
        ['id' => 2, 'name' => 'Surgical Mask Astrwch', 'image' => 'products/surgical-mask.jpg', 'original_price' => 10, 'sale_price' => 4],
        ['id' => 3, 'name' => "MCQ's in Cardiology", 'image' => 'products/mcq-cardiology.jpg', 'original_price' => 995, 'sale_price' => 796],
        ['id' => 4, 'name' => 'Aku Review', 'image' => 'products/aku-review.jpg', 'original_price' => 500, 'sale_price' => 450],
        ['id' => 5, 'name' => 'Ahypr-650 Tablet', 'image' => 'products/ahypr-tablet.jpg', 'original_price' => 30, 'sale_price' => 27],
    ],

    'nav' => [
        ['title' => 'Home', 'url' => '/'],
        ['title' => 'About', 'url' => '/about'],
        ['title' => 'Product', 'url' => '/product'],
        ['title' => 'Online Medicine', 'url' => '/online-medicine'],
        ['title' => 'OPD Form', 'url' => '/opd-form'],
        ['title' => 'Contact', 'url' => '/contact'],
    ],
];
