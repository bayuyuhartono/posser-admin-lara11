<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use App\Models\StudioMusic;

use App\Models\City;

class StudioMusicController extends Controller
{
    public function listsProductsStudioMusic()
    {
        $data['title'] = 'Studio Music';
        $data['lists'] = StudioMusic::getStudioMusicLists();

        return view('products::studio_music.lists', $data);
    }

    public function addProductsStudioMusic()
    {
        $data['title'] = 'Add Studio Music';
        $data['city'] = City::getCityLists();

        return view('products::studio_music.add', $data);
    }

    public function storeProductsStudioMusic(Request $request)
    {
        $validation = $request->validate([
            'studiomusic_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
            'display_pict'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          
        $imageName = Str::slug($request->studiomusic_name).time().'-rclb.'.$request->display_pict->extension();
        $path = 'images/products/studiomusic';
        $imagePath = $path.'/'.$imageName;
        $request->display_pict->move(public_path($path), $imageName);

        $uuid = generateUuid();
        
        $saveData = [
            'uuid' => $uuid,
            'name' => $request->studiomusic_name,
            'description' => $request->description,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web_link' => $request->web_link,
            'display_pict' => $imagePath,
        ];

        $saved = StudioMusic::create($saveData);

        if ($saved) {
            return back()->with('success', 'Studio Music saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editProductsStudioMusic($uuid)
    {
        $data['title'] = 'Edit Studio Music';
        $data['current'] = StudioMusic::where('uuid',$uuid)->first();
        $data['city'] = City::getCityLists();

        return view('products::studio_music.edit', $data);
    }

    public function updateProductsStudioMusic(Request $request, $uuid)
    {
        $validation = $request->validate([
            'studiomusic_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
        ]);

        $updateData = [
            'name' => $request->studiomusic_name,
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

            $imageName = Str::slug($request->studiomusic_name).time().'-rclb.'.$request->display_pict->extension();
            $path = 'images/products/studiomusic';
            $imagePath = $path.'/'.$imageName;
            $request->display_pict->move(public_path($path), $imageName);
            $updateData['display_pict'] = $imagePath;
        }

        $updated = StudioMusic::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Studio Music updated!');
    }

    public function destroyProductsStudioMusic($uuid): RedirectResponse
    {
        $deleted = StudioMusic::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Studio Music deleted!');
    }
}
