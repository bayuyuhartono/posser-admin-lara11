<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\Country;

class CityController extends Controller
{
    public function listsMasterCity()
    {
        $data['title'] = 'City';
        $data['lists'] = City::getCityLists();

        return view('masterdata::city.lists', $data);
    }

    public function addMasterCity()
    {
        $data['title'] = 'Add Master City';
        $data['country'] = Country::getCountryLists();

        return view('masterdata::city.add', $data);
    }

    public function storeMasterCity(Request $request)
    {
        $validation = $request->validate([
            'country'      => ['required', 'string'],
            'city_name'      => ['required', 'string'],
        ]);
        
        $saveData = [
            'uuid' => generateUuid(),
            'country_uuid' => $request->country,
            'name' => $request->city_name,
        ];

        $saved = City::create($saveData);

        if ($saved) {
            return back()->with('success', 'Master City saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editMasterCity($uuid)
    {
        $data['title'] = 'Edit Mater City';
        $data['country'] = Country::getCountryLists();
        $data['current'] = City::where('uuid',$uuid)->first();

        return view('masterdata::city.edit', $data);
    }

    public function updateMasterCity(Request $request, $uuid)
    {
        $validation = $request->validate([
            'country'      => ['required', 'string'],
            'city_name'      => ['required', 'string'],
        ]);
        
        $updateData = [
            'country_uuid' => $request->country,
            'name' => $request->city_name,
        ];

        $updated = City::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Master City updated!');
    }

    public function destroyMasterCity($uuid): RedirectResponse
    {
        $deleted = City::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Master City deleted!');
    }
}
