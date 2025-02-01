<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use App\Models\Outlet;
use App\Models\Genre;
use App\Models\City;

class OutletController extends Controller
{
    public function listsProductsOutlet()
    {
        $data['title'] = 'Outlet';
        $data['lists'] = Outlet::getOutletLists();

        return view('products::outlet.lists', $data);
    }

    public function addProductsOutlet()
    {
        $data['title'] = 'Add Outlet';
        $data['genre'] = Genre::getGenreLists();
        $data['city'] = City::getCityLists();

        return view('products::outlet.add', $data);
    }

    public function storeProductsOutlet(Request $request)
    {
        $validation = $request->validate([
            'outlet_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
            'display_pict'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          
        $imageName = Str::slug($request->outlet_name).time().'-rclb.'.$request->display_pict->extension();
        $path = 'images/products/outlet';
        $imagePath = $path.'/'.$imageName;
        $request->display_pict->move(public_path($path), $imageName);

        $uuid = generateUuid();
        
        $saveData = [
            'uuid' => $uuid,
            'name' => $request->outlet_name,
            'description' => $request->description,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web_link' => $request->web_link,
            'display_pict' => $imagePath,
        ];

        $genrePicked = [];
        foreach ($request->genre as $key => $value) {
            $genrePicked[] = [
                'outlet' => $uuid,
                'genre' => $value,
            ];
        }

        $saved = Outlet::create($saveData);
        $saved = Outlet::saveOutletGenre($genrePicked);

        if ($saved) {
            return back()->with('success', 'Outlet saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editProductsOutlet($uuid)
    {
        $data['title'] = 'Edit Outlet';
        $data['current'] = Outlet::where('uuid',$uuid)->first();
        $data['genre'] = Genre::getGenreLists();
        $data['city'] = City::getCityLists();

        $rclb = Outlet::getOutletGenre($uuid);
        $rclbSelected = [];
        foreach ($rclb as $key => $value) {
            $rclbSelected[] = $value->genre;
        }
        $data['rclbSelected'] = $rclbSelected;

        return view('products::outlet.edit', $data);
    }

    public function updateProductsOutlet(Request $request, $uuid)
    {
        $validation = $request->validate([
            'outlet_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
        ]);

        $updateData = [
            'name' => $request->outlet_name,
            'description' => $request->description,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web_link' => $request->web_link,
        ];
        
        if (isset($request->display_pict)) {
            if(File::exists(public_path($request->exist_display_pict))){
                File::delete(public_path($request->exist_display_pict));
            }

            $imageName = Str::slug($request->outlet_name).time().'-rclb.'.$request->display_pict->extension();
            $path = 'images/products/outlet';
            $imagePath = $path.'/'.$imageName;
            $request->display_pict->move(public_path($path), $imageName);
            $updateData['display_pict'] = $imagePath;
        }

        $genrePicked = [];
        foreach ($request->genre as $key => $value) {
            $genrePicked[] = [
                'outlet' => $uuid,
                'genre' => $value,
            ];
        }

        $updated = Outlet::where('uuid', $uuid);
        $updated->update($updateData);

        $deleted = Outlet::deleteOutletGenre($uuid);
        $saved = Outlet::saveOutletGenre($genrePicked);

        return back()->with('success', 'Outlet updated!');
    }

    public function destroyProductsOutlet($uuid): RedirectResponse
    {
        $deleted = Outlet::deleteOutletGenre($uuid);
        $deleted = Outlet::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Outlet deleted!');
    }
}
