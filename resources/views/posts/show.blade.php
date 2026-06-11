@php
    $seoTitle = $post->meta_title ?: $post->title . ' | ' . config('app.name');
    $seoDescription = $post->meta_description ?: $post->excerpt;
    $canonical = $post->canonical_url ?: route('posts.show', $post);
    $ogImage = $post->og_image
        ? asset('storage/' . $post->og_image)
        : asset('assets/images/og-default.jpg');
    $indexable = $post->is_indexable;
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tin tức', 'url' => route('posts.index')],
        ['name' => $post->title, 'url' => $canonical]
    ];
@endphp

@extends('layouts.app')


@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />
    <x-schema.article 
        :headline="$post->title"
        :description="$seoDescription"
        :image="$post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/images/background/8.webp')"
        :publishDate="$post->published_at ? $post->published_at->toIso8601String() : now()->toIso8601String()"
    />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative jarallax text-light">
            <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/images/background/8.webp') }}" class="jarallax-img" alt="{{ $post->title }}">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="{{ route('posts.index') }}">Tin tức</a></li>
                            <li class="active">Tin tức chi tiết</li>
                        </ul>
                        <h1 class="text-uppercase">{{ $post->title }}</h1>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/images/logo-wm.webp') }}" class="abs end-0 bottom-0 z-2 w-20" alt="GREECO watermark">
            <div class="de-gradient-edge-top dark"></div>
            <div class="de-overlay"></div>
        </section>

        <section>
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-8">
                        <div class="blog-read">
                            <div class="post-text">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="widget widget-post">
                            <h4>Bài viết liên quan</h4>
                            @if($relatedPosts->isNotEmpty())
                                <ul class="de-bloglist-type-1">
                                    @foreach($relatedPosts as $relPost)
                                        <li>
                                            <div class="d-image">
                                                <img src="{{ $relPost->thumbnail ? asset('storage/' . $relPost->thumbnail) : asset('assets/images/blog-thumbnail/2.webp') }}" alt="{{ $relPost->title }}">
                                            </div>
                                            <div class="d-content">
                                                <a href="{{ route('posts.show', $relPost) }}"><h4>{{ $relPost->title }}</h4></a>
                                                <div class="d-date">
                                                    {{ $relPost->published_at ? 'Ngày ' . $relPost->published_at->format('d') . ' tháng ' . $relPost->published_at->format('m') . ' năm ' . $relPost->published_at->format('Y') : '' }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Không có bài viết liên quan khác.</p>
                            @endif
                        </div>
                        
                        <div class="widget widget_tags">
                            <h4>Từ khóa phổ biến</h4>
                            <ul>
                                <li><a href="{{ route('posts.index', ['tag' => 'Kinh tế xanh']) }}">Kinh tế xanh</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'ESG']) }}">ESG</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Net Zero']) }}">Net Zero</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Carbon']) }}">Carbon</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Môi trường']) }}">Môi trường</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Tái chế']) }}">Tái chế</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Bền vững']) }}">Bền vững</a></li>
                                <li><a href="{{ route('posts.index', ['tag' => 'Tuần hoàn']) }}">Tuần hoàn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
