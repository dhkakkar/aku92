<?php

return [
    'name' => 'AKU 92',
    'phone' => '+919416987250',
    'phone_display' => '+91 94169 87250',
    'email' => 'aku92delhi@gmail.com',
    'address' => 'Shivaji Park Chowk, Yamunanagar, Haryana - India',

    // Aku92 Medical Industries
    'factory' => [
        'name' => 'Aku92 Medical Industries',
        'address' => '29, HSIIDC Phase-2 Jagadhri, Manakpur - 135003, District Yamunanagar, Haryana',
        'phone' => '01735-297929, 7056-297929',
        'email' => 'aku92delhi@gmail.com',
        'products' => ['Aku Review (Medico-Legal)', 'Astrwch (Medical Masks)', 'MNKPRR (Medical Paper Bags)'],
    ],

    // Aku92 Medical Industries Pvt. Ltd.
    'company' => [
        'name' => 'Aku92 Medical Industries Pvt. Ltd.',
        'address' => 'Shivaji Park Chowk, Yamunanagar',
        'phone' => '94167-90522',
        'products' => ['Aku92 Clinics', 'MCQs in Cardiology (Book)'],
    ],

    'firms' => [
        [
            'name' => 'Aku Review',
            'image' => 'firms/aku-review.jpg',
            'address' => '29, HSIIDC Phase-2 Jagadhri, Manakpur, Yamunanagar',
            'description' => 'Medico-Legal English annual publication.',
            'phone' => '01735-297929',
        ],
        [
            'name' => 'MCQs in Cardiology',
            'image' => 'products/mcq-cardiology.jpg',
            'address' => 'Shivaji Park Chowk, Yamunanagar',
            'description' => 'MCQs in Cardiology for MD and DM Students. Also available on Amazon.',
        ],
        [
            'name' => 'Aku92 Clinics',
            'image' => 'firms/aku92-clinics.jpg',
            'address' => 'Shivaji Park Chowk, Yamunanagar',
            'description' => 'Cardiology care & consultation.',
        ],
        [
            'name' => 'Aku Physiotherapy',
            'image' => 'firms/aku-physiotherapy.jpg',
            'address' => 'Shivaji Park Chowk, Yamunanagar',
            'description' => 'Expert physiotherapy services for pain relief and rehabilitation.',
        ],
        [
            'name' => 'Jain Medical Store',
            'image' => 'firms/jain-medical-store.jpg',
            'address' => 'D.A.V. Market, Holkar Chowk, Yamunanagar',
            'description' => 'Medical supplies and equipment store.',
            'phone' => '01732-261250',
        ],
        [
            'name' => 'Jain Medicines',
            'image' => 'firms/jain-medicines.jpg',
            'address' => 'Santosh Hospital, Yamunanagar',
            'description' => 'Pharmacy, Aku Physiotherapy & Ambulance Services.',
            'phone' => '01732-269016, 94169-87250',
        ],
    ],

    'testimonials' => [
        ['name' => 'Subham Sharma', 'role' => 'Doctor', 'text' => 'Incredible results! No side effects. So grateful I found it!', 'rating' => 5],
        ['name' => 'Manish Gupta', 'role' => 'Manager', 'text' => "It's been a game-changer for me. Fast relief, no side effects, and I feel better every day.", 'rating' => 5],
        ['name' => 'Ravi Parshad', 'role' => 'Designer', 'text' => 'Fast relief, no side effects, and I feel like a new person. Highly recommended!', 'rating' => 5],
    ],

    'products' => [
        ['id' => 1, 'name' => 'MCQs in Cardiology for MD & DM', 'image' => 'products/mcq-cardiology.jpg', 'original_price' => 995, 'sale_price' => 796],
        ['id' => 2, 'name' => 'Aku Review (Medico-Legal)', 'image' => 'products/aku-review.jpg', 'original_price' => 500, 'sale_price' => 450],
        ['id' => 3, 'name' => 'Astrwch Surgical Mask', 'image' => 'products/surgical-mask.jpg', 'original_price' => 10, 'sale_price' => 4],
        ['id' => 4, 'name' => 'MNKPRR Medical Paper Bags', 'image' => 'products/paper-carry-bags.jpg', 'original_price' => 100, 'sale_price' => 80],
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
