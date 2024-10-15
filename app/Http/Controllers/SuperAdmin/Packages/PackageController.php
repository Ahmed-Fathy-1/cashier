<?php

namespace App\Http\Controllers\SuperAdmin\Packages;

use Illuminate\Http\Request;
use App\Models\SuperAdmin\Package;
use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Http\Requests\SuperAdmin\Packages\PackageRequest;

class PackageController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/packages';

    function __construct()
    {
        // $this->middleware(['can:Package-list'], ['only' => ['index', 'show']]);
        // $this->middleware(['can:Package-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['can:Package-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['can:Package-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $packages = Package::latest()->paginate(5);
        return view('dashboard.packages.index',compact('packages'));
    }

    public function create()
    {
        return view('dashboard.packages.create');
    }

    public function store(PackageRequest $request)
    {
        Package::create($request->validated());
        return redirect()->route('packages.index')->with('success','Package created successfully');
    }

    public function show($id)
    {
        $packages = Package::find($id);
        return view('dashboard.packages.show',compact('packages'));
    }


    public function edit($id)
    {
        $packages = Package::find($id);
        return view('dashboard.packages.edit',compact('packages'));
    }

    public function update(PackageRequest $request, $id)
    {
        $Package = Package::find($id);
        $Package->update($request->validated());
        return redirect()->route('packages.index')->with('success','Package updated successfully');
    }

    
    public function destroy($id)
    {
        Package::find($id)->delete();
        return redirect()->route('packages.index') ->with('success','Package deleted successfully');
    }


}
