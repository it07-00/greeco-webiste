<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $services = Service::query()
            ->where('is_active', true)
            ->where('is_indexable', true)
            ->orderBy('sort_order')
            ->get();

        $posts = Post::query()
            ->where('is_published', true)
            ->where('is_indexable', true)
            ->latest('published_at')
            ->get();

        $projects = Project::query()
            ->where('is_active', true)
            ->where('is_indexable', true)
            ->orderBy('sort_order')
            ->get();

        $pages = Page::query()
            ->where('is_active', true)
            ->where('is_indexable', true)
            ->orderBy('sort_order')
            ->get();

        return response()
            ->view('sitemap.index', compact('services', 'posts', 'projects', 'pages'))
            ->header('Content-Type', 'text/xml');
    }
}
