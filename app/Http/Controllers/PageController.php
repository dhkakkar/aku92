<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'firms' => config('site.firms'),
            'testimonials' => config('site.testimonials'),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'firms' => config('site.firms'),
        ]);
    }

    public function product()
    {
        return view('pages.product', [
            'products' => config('site.products'),
        ]);
    }

    public function onlineMedicine()
    {
        return view('pages.online-medicine', [
            'products' => config('site.products'),
        ]);
    }

    public function opdForm()
    {
        return view('pages.opd-form');
    }
}
