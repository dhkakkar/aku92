<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::active()->ordered()->orderBy('id', 'desc')->get();

        $categories = $images
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->all();

        return view('gallery', compact('images', 'categories'));
    }
}
