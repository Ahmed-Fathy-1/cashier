<?php

namespace App\Http\Controllers\SuperAdmin\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AboutUs\AboutUsRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    protected $filePath = '/about_us';

    /**
     * @param string $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('dashboard.about_us.edit', compact('aboutUs'));
    }

    /**
     * @param AboutUsRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AboutUsRequest $request, string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $data = $request->validated();

        $data['workflow_download_image'] = $request->hasFile('workflow_download_image')
            ? $this->updateFile($request->file('workflow_download_image'), $aboutUs->workflow_download_image, $this->filePath)
            : $aboutUs->workflow_download_image;

        $data['workflow_manage_image'] = $request->hasFile('workflow_manage_image')
            ? $this->updateFile($request->file('workflow_manage_image'), $aboutUs->workflow_manage_image, $this->filePath)
            : $aboutUs->workflow_manage_image;

        $data['workflow_edit_image'] = $request->hasFile('workflow_edit_image')
            ? $this->updateFile($request->file('workflow_edit_image'), $aboutUs->workflow_edit_image, $this->filePath)
            : $aboutUs->workflow_edit_image;

        $aboutUs->update($data);

        return redirect()->back()->with('success', 'About Us updated successfully.');

    }
}
