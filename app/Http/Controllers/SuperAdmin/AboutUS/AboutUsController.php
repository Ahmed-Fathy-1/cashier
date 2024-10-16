<?php

namespace App\Http\Controllers\SuperAdmin\AboutUS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AboutUs\AboutUsRequest;
use App\Http\Requests\SuperAdmin\AboutUs\AbouttRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Flasher\Laravel\Http\Request;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'uploads/about_us';

    public function edit(string $id)
    {

        $aboutUs = AboutUs::findOrFail($id);
        return view('dashboard.about_us.edit', compact('aboutUs'));
    }

    public function update(AboutUsRequest $request, $id)
    {
        //dd($request);
        // return $request->all();
        $aboutUs = AboutUs::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('services_image')) {
            $data['services_image'] = $this->updateFile($data['services_image'], $aboutUs->services_image, $this->filePath);
        }

        $aboutUs->update($data);

        return redirect()->back()->with('success', 'About Us updated successfully.');
    }
}
