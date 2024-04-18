<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('employees')->paginate(10);
        return CompanyResource::collection($companies);
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
    public function store(CompanyStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logo');
            $data['logo'] = Storage::url($logoPath);
        }
        $company = Company::create($data);
        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return new CompanyResource($company);
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
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $company = Company::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logo');
            $data['logo'] = Storage::url($logoPath);
        }

        $company->update($data);
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully'], 200);
    }
}
