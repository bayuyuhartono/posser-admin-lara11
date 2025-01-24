<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;

class CountryController extends Controller
{
    public function listsMasterCountry()
    {
        $data['title'] = 'Country';
        $data['lists'] = Country::getCountryLists();

        return view('masterdata::country.lists', $data);
    }

    public function addMasterCountry()
    {
        $data['title'] = 'Add Master Country';

        return view('masterdata::country.add', $data);
    }

    public function storeMasterCountry(Request $request)
    {
        $validation = $request->validate([
            'country_name'      => ['required', 'string'],
        ]);
        
        $saveData = [
            'uuid' => generateUuid(),
            'name' => $request->country_name,
        ];

        $saved = Country::create($saveData);

        if ($saved) {
            return back()->with('success', 'Master Country saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editMasterCountry($uuid)
    {
        $data['title'] = 'Edit Mater Country';
        $data['current'] = Country::where('uuid',$uuid)->first();

        return view('masterdata::country.edit', $data);
    }

    public function updateMasterCountry(Request $request, $uuid)
    {
        $validation = $request->validate([
            'country_name'      => ['required', 'string'],
        ]);
        
        $updateData = [
            'name' => $request->country_name,
        ];

        $updated = Country::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Master Country updated!');
    }

    public function destroyMasterCountry($uuid): RedirectResponse
    {
        $deleted = Country::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Master Country deleted!');
    }
}
