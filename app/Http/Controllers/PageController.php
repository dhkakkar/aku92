<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'firms' => Firm::active()->ordered()->get(),
            'testimonials' => Testimonial::active()->ordered()->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'firms' => Firm::active()->ordered()->get(),
        ]);
    }

    public function product()
    {
        return view('pages.product', [
            'products' => Product::where('is_active', true)->get(),
        ]);
    }

    public function onlineMedicine()
    {
        return view('pages.online-medicine', [
            'products' => Product::where('is_active', true)->get(),
        ]);
    }

    public function opdForm()
    {
        return view('pages.opd-form');
    }

    public function gallery()
    {
        return view('pages.gallery', [
            'images' => GalleryImage::active()->ordered()->get(),
        ]);
    }
}
