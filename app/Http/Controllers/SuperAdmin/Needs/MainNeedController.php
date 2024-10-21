<?php

namespace App\Http\Controllers\SuperAdmin\Needs;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Needes\MainNeed;
use Illuminate\Http\Request;

class MainNeedController extends Controller
{

    use UploadFileTrait;

    protected $filePath = 'images/needs';

    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
    public function show(MainNeed $mainNeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mainNeed = MainNeed::find($id);
        return view('dashboard.Needs.edit', compact('mainNeed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $main_need = MainNeed::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->updateFile($request->file('image'), $main_need->image, $this->filePath);
        }

        $main_need->update($data);

        return back()->with('success', 'Main Need updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainNeed $mainNeed)
    {
        //
    }
}
