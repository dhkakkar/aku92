<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class PersonController extends Controller
{
    public function akashJain()
    {
        $blogPosts = BlogPost::published()
            ->forOwner('dr-akash-jain')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('persons.akash-jain', compact('blogPosts'));
    }

    public function prashukaJain()
    {
        $blogPosts = BlogPost::published()
            ->forOwner('dr-prashuka-jain')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('persons.prashuka-jain', compact('blogPosts'));
    }
}
