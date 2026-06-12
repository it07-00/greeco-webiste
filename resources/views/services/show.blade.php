@php
    $seoTitle = $service->meta_title ?: $service->name . ' | ' . config('app.name');
    $seoDescription = $service->meta_description ?: $service->short_description;
    $canonical = $service->canonical_url ?: route('services.show', $service);
    $ogImage = $service->og_image
        ? asset('storage/' . $service->og_image)
        : asset('assets/images/og-default.jpg');
    $indexable = $service->is_indexable;

    $breadcrumbs = [
        ['name' => 'Trang chủ', 'url' => route('home')],
        ['name' => 'Lĩnh vực', 'url' => route('services.index')],
        ['name' => $service->name, 'url' => route('services.show', $service)]
    ];
@endphp

@extends('layouts.app')


@section('content')
    <x-schema.breadcrumb :items="$breadcrumbs" />
    <x-schema.service 
        :name="$service->name" 
        :description="$service->short_description" 
        :url="$canonical" 
    />

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="relative">
            <div class="container relative z-index-1000">
                <div class="row">
                    <div class="col-lg-8">
                        <ul class="crumb">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="{{ route('services.index') }}">Lĩnh vực</a></li>
                            <li class="active">{{ $service->name }}</li>
                        </ul>
                        <h1 class="text-uppercase">{{ $service->name }}</h1>
                        <p class="col-lg-10">{{ $service->short_description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row g-4 gx-5">
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="me-lg-3">
                            <div class="bg-color text-light p-3 px-4 rounded-10px mb-3">
                                <h4 class="mb-0 text-white">Dịch vụ liên quan</h4>
                            </div>
                            @if($relatedServices->isNotEmpty())
                                @foreach($relatedServices as $relService)
                                    <a href="{{ route('services.show', $relService) }}" class="bg-light d-block p-3 px-4 rounded-10px mb-3 service-sidebar-link text-dark">
                                        <h4 class="mb-0 fs-16">{{ $relService->name }}</h4>
                                    </a>
                                @endforeach
                            @else
                                <p class="text-muted ps-3">Không có dịch vụ liên quan khác.</p>
                            @endif
                            
                            <a href="{{ route('services.index') }}" class="btn-main d-block text-center mt-4">
                                <i class="fa fa-arrow-left me-2"></i>Tất cả dịch vụ
                            </a>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9">
                        <div class="service-content">
                            {!! $service->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
