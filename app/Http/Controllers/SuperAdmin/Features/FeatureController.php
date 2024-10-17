<?php

namespace App\Http\Controllers\SuperAdmin\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Features\FeatureRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Features\Feature;
use Illuminate\Http\Request;

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
        $data = $request->validated(); // Get validated data
        $feature = Feature::findOrFail($id);

        // Update images or retain existing ones
        foreach (range(1, 3) as $num) {
            $key = "feature_{$num}_image";
            $data[$key] = isset($data[$key])
                ? $this->updateFile($data[$key], $feature->$key, $this->filePath)
                : $feature->$key;
        }

        // Fill and save feature data
        $feature->fill($data)->save();

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
