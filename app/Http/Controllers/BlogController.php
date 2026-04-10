<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        $related = BlogPost::published()
            ->forOwner($post->owner)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }

    public function ownerIndex(string $owner)
    {
        abort_unless(array_key_exists($owner, BlogPost::ownerOptions()), 404);

        $posts = BlogPost::published()
            ->forOwner($owner)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $ownerLabel = BlogPost::ownerOptions()[$owner];

        return view('blog.owner-index', compact('posts', 'owner', 'ownerLabel'));
    }
}
