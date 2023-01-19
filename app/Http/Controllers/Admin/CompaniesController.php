<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_email' => 'email',
            'company_logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:width=100,height=100',
        ]);

        if ($request->hasFile('company_logo')) {
            $companyLogo = time() . '-' . $request->company_logo->getClientOriginalName();
            $request->company_logo->storage_path('app/public/', $companyLogo);
        }

        Company::create([
            'company_name' => $request->input('company_name'),
            'company_email' => $request->input('company_email'),
            'company_website' => $request->input('company_website'),
            'company_logo' => $request->hasFile('company_logo') ? $companyLogo : '',
        ]);

        return redirect('dashboard/companies')->with('message', 'Data has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::where('id', $id)->first();

        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::where('id', $id)->first();

        $request->validate([
            'company_name' => 'required',
            'company_email' => 'email',
            'company_logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:width=100,height=100',
        ]);

        if ($request->hasFile('company_logo')) {
            $companyLogo = time() . '-' . $request->company_logo->getClientOriginalName();
            $request->company_logo->storage_path('app/public/', $companyLogo);
        }

        $company->update([
            'company_name' => $request->input('company_name'),
            'company_email' => $request->input('company_email'),
            'company_website' => $request->input('company_website'),
            'company_logo' => $request->hasFile('company_logo') ? $companyLogo : $company->company_logo,
        ]);

        return redirect('dashboard/companies')->with('message', 'Data has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id)->first();
        $company->delete();
        return redirect('dashboard/companies')->with('message', 'Data has been deleted!');
    }
}
