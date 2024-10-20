<?php

namespace App\Http\Controllers\Api\SuperAdmin\Features;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\SuperAdmin\Features\MainNeedResource;
use App\Http\Resources\Api\Features\MainNeedResource;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Features\Feature;

class FeatureController extends Controller
{

    use UploadFileTrait;

    protected $filePath = 'images/features';
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $features = Feature::get();
        return ResponseHelper::sendResponseSuccess([
            'features' => MainNeedResource::collection($features),
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainNeedResource $request, $id)
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

        return ResponseHelper::sendResponseSuccess([
            'feature' => new MainNeedResource($feature),
        ]);}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $superAdminFeature)
    {
        //
    }
}
