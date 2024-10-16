<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Packages\PackageRequest;
use App\Http\Traits\Utils\ApiResponseTrait;
use App\Models\SuperAdmin\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{

    use ApiResponseTrait;

    public function index(Request $request)
    {
        $packages = Package::with('packageDetails')->latest()->get();
        return $this->successResponse($packages, 'Package retrieved successfully.');
    }

    public function store(PackageRequest $request)
    {
        DB::transaction(function () use ($request) {
            $package = Package::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active ?? true,

            ]);

            $package->packageDetails()->create([
                'Price_monthly' => $request->Price_monthly,
                'Price_annually' => $request->Price_annually,
                'storage_monthly' => $request->storage_monthly,
                'storage_annually' => $request->storage_annually,
                'interactive_archives' => $request->interactive_archives ?? false,
                'custom_branding' => $request->custom_branding ?? false,
                'messages' => $request->messages ?? false,
                'notifications' => $request->notifications,
                'priority' => $request->priority ?? true,
                'main_show' => $request->main_show,
                'main_search' => $request->main_search,
                'statics' => $request->statics,
            ]);
        });

        return redirect()->route('packages.index')->with('success', 'Package created successfully');
    }

    public function update(PackageRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $package = Package::findOrFail($id);

            $package->update([
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active ?? true,
                'user_id' => auth()->id(),
            ]);

            $package->packageDetails()->update([
                'Price_monthly' => $request->Price_monthly,
                'Price_annually' => $request->Price_annually,
                'storage_monthly' => $request->storage_monthly,
                'storage_annually' => $request->storage_annually,
                'interactive_archives' => $request->interactive_archives ?? false,
                'custom_branding' => $request->custom_branding ?? false,
                'messages' => $request->messages ?? false,
                'notifications' => $request->notifications,
                'priority' => $request->priority ?? true,
                'main_show' => $request->main_show,
                'main_search' => $request->main_search,
                'statics' => $request->statics,
            ]);
        });

        return $this->successResponse(null, 'Package created successfully.');
    }

    public function destroy($id)
    {
        Package::find($id)->delete();
        return $this->successResponse(null, 'Package retrieved successfully.');
    }
}
