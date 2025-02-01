<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use App\Models\StudioRecording;
use App\Models\City;

class StudioRecordingController extends Controller
{
    public function listsProductsStudioRecording()
    {
        $data['title'] = 'Studio Recording';
        $data['lists'] = StudioRecording::getStudioRecordingLists();

        return view('products::studio_recording.lists', $data);
    }

    public function addProductsStudioRecording()
    {
        $data['title'] = 'Add Studio Recording';
        $data['city'] = City::getCityLists();

        return view('products::studio_recording.add', $data);
    }

    public function storeProductsStudioRecording(Request $request)
    {
        $validation = $request->validate([
            'studiorecording_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
            'display_pict'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          
        $imageName = Str::slug($request->studiorecording_name).time().'-rclb.'.$request->display_pict->extension();
        $path = 'images/products/studiorecording';
        $imagePath = $path.'/'.$imageName;
        $request->display_pict->move(public_path($path), $imageName);

        $uuid = generateUuid();
        
        $saveData = [
            'uuid' => $uuid,
            'name' => $request->studiorecording_name,
            'description' => $request->description,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'web_link' => $request->web_link,
            'display_pict' => $imagePath,
        ];

        $saved = StudioRecording::create($saveData);

        if ($saved) {
            return back()->with('success', 'Studio Recording saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editProductsStudioRecording($uuid)
    {
        $data['title'] = 'Edit Studio Recording';
        $data['current'] = StudioRecording::where('uuid',$uuid)->first();
        $data['city'] = City::getCityLists();

        return view('products::studio_recording.edit', $data);
    }

    public function updateProductsStudioRecording(Request $request, $uuid)
    {
        $validation = $request->validate([
            'studiorecording_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
        ]);

        $updateData = [
            'name' => $request->studiorecording_name,
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

            $imageName = Str::slug($request->studiorecording_name).time().'-rclb.'.$request->display_pict->extension();
            $path = 'images/products/studiorecording';
            $imagePath = $path.'/'.$imageName;
            $request->display_pict->move(public_path($path), $imageName);
            $updateData['display_pict'] = $imagePath;
        }

        $updated = StudioRecording::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Studio Recording updated!');
    }

    public function destroyProductsStudioRecording($uuid): RedirectResponse
    {
        $deleted = StudioRecording::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Studio Recording deleted!');
    }
}
