<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\User;

class CompanyController extends Controller
{

    public function index()
    {
        return Company::all();
    }

    public function createCompany(Request $request)
    {
        $field = $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'prof_pic' => 'required',
            'cover_pic' => 'required',
        ]);

        // $request->request->add([
        //     'owner' => auth()->user()->id,
        //     'prof_pic' => '-',
        //     'cover_pic' => '-',
        //     'rating' => '1',
        // ]);

        $profile_pic_path = $request->file('prof_pic')->store('image', 'public');
        $cover_pic_path = $request->file('prof_pic')->store('image', 'public');

        return Company::create([
            'owner' => auth()->user()->id,
            'name' => $field['name'],
            'bio' => $field['bio'],
            'rating' => '1',
            'prof_pic' => $profile_pic_path,
            'cover_pic' => $cover_pic_path
        ]);
        // return $request->all();
    }

    public function editCompany(Request $request, $company_id)
    {
        $field = $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'prof_pic' => 'required',
            'cover_pic' => 'required',
        ]);

        $profile_pic_path = $request->file('prof_pic')->store('image', 'public');
        $cover_pic_path = $request->file('prof_pic')->store('image', 'public');

        $current_company = Company::findOrFail($company_id);
        $current_company->update([
            'name' => $field['name'],
            'bio' => $field['bio'],
            'rating' => '1',
            'prof_pic' => $profile_pic_path,
            'cover_pic' => $cover_pic_path
        ]);
        return $current_company;
    }

    public function deleteCompany(Request $request, $company_id)
    {
        $curr_company = Company::find($company_id);
        if ($curr_company != null) {
            if ($curr_company->owner == auth()->user()->id) {
                $curr_company->delete();
                return "Company deleted successfully !";
            } else {
                return "You are not authorized to do that !";
            }
        } else {
            return "A company with that info is not found !";
        }
    }

    public function search($key)
    {
        return Company::where('name', 'like', '%' . $key . '%')
            ->orwhere('bio', 'like', '%' . $key . '%')
            ->get();
    }

    public function singleCompany(Request $request, $company_id)
    {
        $comp = Company::find($company_id);
        if ($comp != null) {
            return $comp;
        } else {
            return [];
        }
    }



























    // 
}
