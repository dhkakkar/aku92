<?php

namespace App\Http\Controllers;

class Aku92Controller extends Controller
{
    public function index()
    {
        return view('aku92.index');
    }

    public function clinics()
    {
        return view('aku92.clinics', [
            'testimonials' => config('site.testimonials'),
        ]);
    }

    public function jainMedicines()
    {
        return view('aku92.jain-medicines');
    }

    public function physiotherapy()
    {
        return view('aku92.physiotherapy');
    }

    public function review()
    {
        return view('aku92.review', [
            'products' => config('site.products'),
        ]);
    }

    public function opdForm()
    {
        return view('aku92.opd-form');
    }
}
