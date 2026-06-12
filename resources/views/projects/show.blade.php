@php
    $seoTitle = $project->meta_title ?: $project->title . ' | ' . config('app.name');
    $seoDescription = $project->meta_description ?: $project->excerpt;
    $canonical = $project->canonical_url ?: route('projects.show', $project);
    $ogImage = $project->og_image
        ? asset('storage/' . $project->og_image)
        : asset('assets/images/og-default.jpg');
    $indexable = $project->is_indexable;
    
    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Dự án & Nghiên cứu', 'url' => route('projects.index')],
        ['name' => $project->title, 'url' => $canonical]
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
                    <div class="col-lg-8">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="{{ route('projects.index') }}">Dự án & Nghiên cứu</a></li>
                            <li class="active">Chi tiết Dự án</li>
                        </ul>
                        <h1 class="text-uppercase">{{ $project->title }}</h1>
                        <p class="col-lg-10 lead">{{ $project->excerpt }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Hero Image -->
        @if($project->thumbnail)
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-100 rounded-10px" alt="{{ $project->title }}">
                    </div>
                </div>
            </div>
        @endif
        
        <section class="pt-0">
            <div class="container">
                <div class="row g-4">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <div class="me-lg-3">
                            <div class="project-intro-box mb-4">
                                <h5 class="text-uppercase mb-3 id-color fw-700"><i class="fa-solid fa-leaf me-2"></i>Tóm tắt dự án</h5>
                                <p>{{ $project->excerpt }}</p>
                            </div>

                            <div class="project-content mt-4">
                                {!! $project->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Details -->
                    <div class="col-lg-4 text-dark">
                        <div class="project-details-box">
                            <h5 class="text-uppercase mb-4 id-color fw-700">
                                <i class="fa-solid fa-circle-info me-2"></i>Chi tiết dự án
                            </h5>
                            @if($project->client_name)
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fa-solid fa-handshake id-color-2"></i> Khách hàng / Đối tác
                                    </div>
                                    <div class="detail-value">{{ $project->client_name }}</div>
                                </div>
                            @endif
                            @if($project->location)
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fa-solid fa-location-dot id-color-2"></i> Địa điểm
                                    </div>
                                    <div class="detail-value">{{ $project->location }}</div>
                                </div>
                            @endif
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa-solid fa-calendar-days id-color-2"></i> Bắt đầu
                                </div>
                                <div class="detail-value">{{ $project->started_at ? \Carbon\Carbon::parse($project->started_at)->format('d/m/Y') : 'Chưa xác định' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fa-solid fa-calendar-check id-color-2"></i> Hoàn thành
                                </div>
                                <div class="detail-value">{{ $project->completed_at ? \Carbon\Carbon::parse($project->completed_at)->format('d/m/Y') : 'Đang triển khai' }}</div>
                            </div>
                        </div>
                        
                        <a href="{{ route('projects.index') }}" class="btn-main w-100 text-center">
                            <i class="fa fa-arrow-left me-2"></i>Xem tất cả dự án
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
