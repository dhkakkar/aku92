<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\Product;
use App\Models\Testimonial;

class Aku92Controller extends Controller
{
    public function index()
    {
        return view('aku92.index', [
            'firms' => Firm::active()->ordered()->get(),
        ]);
    }

    public function clinics()
    {
        return view('aku92.clinics', [
            'testimonials' => Testimonial::active()->ordered()->get(),
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
            'products' => Product::where('is_active', true)->get(),
        ]);
    }

    public function opdForm()
    {
        return view('aku92.opd-form');
    }

    public function medicalIndustries()
    {
        return view('aku92.medical-industries');
    }

    public function jainMedicalStore()
    {
        return view('aku92.jain-medical-store');
    }
}
