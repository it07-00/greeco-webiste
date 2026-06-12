<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::query()
            ->where('slug', 'gioi-thieu')
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.about', compact('page'));
    }

    public function show(Page $page)
    {
        abort_unless($page->is_active, 404);

        return view('pages.show', compact('page'));
    }

    public function library()
    {
        $documents = \App\Models\Document::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.library', compact('documents'));
    }
}
