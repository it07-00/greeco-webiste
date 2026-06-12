@php
    $seoTitle = 'Tin tức & Sự kiện - Viện Nghiên cứu và Phát triển Kinh tế Xanh - GREECO';
    $seoDescription = 'Cập nhật tin tức, sự kiện mới nhất về kinh tế xanh, biến đổi khí hậu và chuyển đổi phát triển bền vững tại Việt Nam.';
    $canonical = route('posts.index');
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Tin tức', 'url' => route('posts.index')]
    ];
@endphp

@extends('layouts.app')


@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="active">Tin tức</li>
                        </ul>
                        <h1 class="text-uppercase">Tin tức</h1>
                        <p class="col-lg-10 lead">Kiến tạo không gian xanh hướng tới tương lai bền vững!</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row g-4">
                    @if($posts->isNotEmpty())
                        @foreach($posts as $post)
                            @php
                                $day = $post->published_at ? $post->published_at->format('d') : $post->created_at->format('d');
                                $monthNum = $post->published_at ? $post->published_at->format('n') : $post->created_at->format('n');
                                $monthStr = 'Th' . $monthNum;
                                $postImg = $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/images/blog/' . (($loop->index % 6) + 1) . '.webp');
                            @endphp
                            <!-- post -->
                            <div class="col-lg-6">
                                <div class="rounded-1 bg-light overflow-hidden blog-post-card">
                                    <div class="row g-2 h-100">
                                        <div class="col-sm-6">
                                            <div class="blog-post-img-container relative" data-bgimage="url({{ $postImg }})">
                                                <div class="abs start-0 top-0 bg-color-2 text-white p-3 pb-2 m-3 text-center fw-600 rounded-5px">
                                                    <div class="fs-36 mb-0">{{ $day }}</div>
                                                    <span>{{ $monthStr }}</span>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-sm-6 relative">
                                            <div class="p-30 pb-40">
                                                <h4><a class="text-dark" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                                                <p class="mb-0 fs-14 text-muted">{{ Str::limit($post->excerpt, 120) }}</p>
                                            </div>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Đang cập nhật danh sách bài viết...</p>
                        </div>
                    @endif

                    @if($posts->hasPages())
                        <div class="col-lg-12 pt-4 d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
        
    </div>
@endsection
