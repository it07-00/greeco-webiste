<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Support\MainServiceCategories;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceCategories = MainServiceCategories::get();

        return view('services.index', compact('serviceCategories'));
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        $relatedServices = Service::query()
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->where('service_category_id', $service->service_category_id)
            ->limit(6)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
