<?php

namespace App\Http\Controllers\SuperAdmin\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Features\FeatureRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{

    use UploadFileTrait;

    protected $filePath = 'images/features';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $superAdminFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $features = Feature::findOrFail($id);
        return view('dashboard.features.edit', compact('features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request, $id)
    {
        $feature = Feature::findOrFail($id);

        $data = $request->validated(); // Validate and get request data

        // Handle feature 1 image update
        $data['feature_1_image'] = isset($data['feature_1_image'])
            ? $this->updateFile($data['feature_1_image'], $feature->feature_1_image, $this->filePath)
            : $feature->feature_1_image;

        // Handle feature 2 image update
        $data['feature_2_image'] = isset($data['feature_2_image'])
            ? $this->updateFile($data['feature_2_image'], $feature->feature_2_image, $this->filePath)
            : $feature->feature_2_image;

        // Handle feature 3 image update
        $data['feature_3_image'] = isset($data['feature_3_image'])
            ? $this->updateFile($data['feature_3_image'], $feature->feature_3_image, $this->filePath)
            : $feature->feature_3_image;

        // Update the feature fields
        $feature->main_title = $request->main_title;
        $feature->main_description = $request->main_description;
        $feature->feature_1_title = $request->feature_1_title;
        $feature->feature_1_image = $data['feature_1_image'];
        $feature->feature_1_description = $request->feature_1_description;
        $feature->feature_2_title = $request->feature_2_title;
        $feature->feature_2_image = $data['feature_2_image'];
        $feature->feature_2_description = $request->feature_2_description;
        $feature->feature_3_title = $request->feature_3_title;
        $feature->feature_3_image = $data['feature_3_image'];
        $feature->feature_3_description = $request->feature_3_description;

        // Save the updated feature
        $feature->save();

        // Redirect back with a success message
        return redirect()->route('features.edit', $id)->with('success', 'Feature updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $superAdminFeature)
    {
        //
    }
}
