<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use App\Models\RecordLabel;
use App\Models\Genre;
use App\Models\City;

class RecordLabelController extends Controller
{
    public function listsProductsRecordLabel()
    {
        $data['title'] = 'Record Label';
        $data['lists'] = RecordLabel::getRecordLabelLists();

        return view('products::recordlabel.lists', $data);
    }

    public function addProductsRecordLabel()
    {
        $data['title'] = 'Add Record Label';
        $data['genre'] = Genre::getGenreLists();
        $data['city'] = City::getCityLists();

        return view('products::recordlabel.add', $data);
    }

    public function storeProductsRecordLabel(Request $request)
    {
        $validation = $request->validate([
            'recordlabel_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
            'display_pict'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          
        $imageName = Str::slug($request->recordlabel_name).time().'-rclb.'.$request->display_pict->extension();
        $path = 'images/products/recordlabel';
        $imagePath = $path.'/'.$imageName;
        $request->display_pict->move(public_path($path), $imageName);

        $uuid = generateUuid();
        
        $saveData = [
            'uuid' => $uuid,
            'name' => $request->recordlabel_name,
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
                'record_label' => $uuid,
                'genre' => $value,
            ];
        }

        $saved = RecordLabel::create($saveData);
        $saved = RecordLabel::saveRecordLabelGenre($genrePicked);

        if ($saved) {
            return back()->with('success', 'Record Label saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editProductsRecordLabel($uuid)
    {
        $data['title'] = 'Edit Record Label';
        $data['current'] = RecordLabel::where('uuid',$uuid)->first();
        $data['genre'] = Genre::getGenreLists();
        $data['city'] = City::getCityLists();

        $rclb = RecordLabel::getRecordLabelGenre($uuid);
        $rclbSelected = [];
        foreach ($rclb as $key => $value) {
            $rclbSelected[] = $value->genre;
        }
        $data['rclbSelected'] = $rclbSelected;

        return view('products::recordlabel.edit', $data);
    }

    public function updateProductsRecordLabel(Request $request, $uuid)
    {
        $validation = $request->validate([
            'recordlabel_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
        ]);

        $updateData = [
            'name' => $request->recordlabel_name,
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

            $imageName = Str::slug($request->recordlabel_name).time().'-rclb.'.$request->display_pict->extension();
            $path = 'images/products/recordlabel';
            $imagePath = $path.'/'.$imageName;
            $request->display_pict->move(public_path($path), $imageName);
            $updateData['display_pict'] = $imagePath;
        }

        $genrePicked = [];
        foreach ($request->genre as $key => $value) {
            $genrePicked[] = [
                'record_label' => $uuid,
                'genre' => $value,
            ];
        }

        $updated = RecordLabel::where('uuid', $uuid);
        $updated->update($updateData);

        $deleted = RecordLabel::deleteRecordLabelGenre($uuid);
        $saved = RecordLabel::saveRecordLabelGenre($genrePicked);

        return back()->with('success', 'Record Label updated!');
    }

    public function destroyProductsRecordLabel($uuid): RedirectResponse
    {
        $deleted = RecordLabel::deleteRecordLabelGenre($uuid);
        $deleted = RecordLabel::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Record Label deleted!');
    }
}
