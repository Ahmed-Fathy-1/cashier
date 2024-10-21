<?php

namespace App\Http\Controllers\Api\SuperAdmin\aboutUs;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\SuperAdmin\AboutUs\AboutUsRequest;
use App\Http\Resources\Api\aboutUs\AboutUsResource;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    /**
     * @var string
     */
    protected $filePath = '/about_us';

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::firstOrFail();
        return ResponseHelper::sendResponseSuccess([
            'aboutUs' => new AboutUsResource($aboutUs),
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutUsRequest  $request, string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $data = $request->validated();

        // Handle images
        $data['workflow_download_image'] = $request->hasFile('workflow_download_image')
            ? $this->updateFile($request->file('workflow_download_image'), $aboutUs->workflow_download_image, $this->filePath)
            : $aboutUs->workflow_download_image;

        $data['workflow_manage_image'] = $request->hasFile('workflow_manage_image')
            ? $this->updateFile($request->file('workflow_manage_image'), $aboutUs->workflow_manage_image, $this->filePath)
            : $aboutUs->workflow_manage_image;

        $data['workflow_edit_image'] = $request->hasFile('workflow_edit_image')
            ? $this->updateFile($request->file('workflow_edit_image'), $aboutUs->workflow_edit_image, $this->filePath)
            : $aboutUs->workflow_edit_image;

        // Update the model with validated data
        $aboutUs->update($data);

        // Return a successful response with the updated resource
        return ResponseHelper::sendResponseSuccess([
            'about_us' => new AboutUsResource($aboutUs),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
