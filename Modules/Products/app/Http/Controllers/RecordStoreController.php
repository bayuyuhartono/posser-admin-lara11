<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use App\Models\RecordStore;
use App\Models\City;
use App\Models\Genre;
use App\Models\MusicFormat;

class RecordStoreController extends Controller
{
    public function listsProductsRecordStore()
    {
        $data['title'] = 'Record Store';
        $data['lists'] = RecordStore::getRecordStoreLists();

        return view('products::record_store.lists', $data);
    }

    public function addProductsRecordStore()
    {
        $data['title'] = 'Add Record Store';
        $data['city'] = City::getCityLists();
        $data['genre'] = Genre::getGenreLists();
        $data['musicformat'] = MusicFormat::getMusicFormatLists();

        return view('products::record_store.add', $data);
    }

    public function storeProductsRecordStore(Request $request)
    {
        $validation = $request->validate([
            'recordstore_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'musicformat'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
            'display_pict'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
          
        $imageName = Str::slug($request->recordstore_name).time().'-rclb.'.$request->display_pict->extension();
        $path = 'images/products/recordstore';
        $imagePath = $path.'/'.$imageName;
        $request->display_pict->move(public_path($path), $imageName);

        $uuid = generateUuid();
        
        $saveData = [
            'uuid' => $uuid,
            'name' => $request->recordstore_name,
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
                'record_store' => $uuid,
                'genre' => $value,
            ];
        }

        $musicformatPicked = [];
        foreach ($request->musicformat as $key => $value) {
            $musicformatPicked[] = [
                'record_store' => $uuid,
                'musicformat' => $value,
            ];
        }

        $saved = RecordStore::create($saveData);
        $saved = RecordStore::saveRecordStoreGenre($genrePicked);
        $saved = RecordStore::saveRecordStoreMusicFormat($musicformatPicked);

        if ($saved) {
            return back()->with('success', 'Record Store saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editProductsRecordStore($uuid)
    {
        $data['title'] = 'Edit Record Store';
        $data['current'] = RecordStore::where('uuid',$uuid)->first();
        $data['city'] = City::getCityLists();
        $data['genre'] = Genre::getGenreLists();
        $data['musicformat'] = MusicFormat::getMusicFormatLists();

        $rclbgenre = RecordStore::getRecordStoreGenre($uuid);
        $rclbgenreSelected = [];
        foreach ($rclbgenre as $key => $value) {
            $rclbgenreSelected[] = $value->genre;
        }
        $data['rclbgenreSelected'] = $rclbgenreSelected;

        $rclbmusicformat = RecordStore::getRecordStoreMusicFormat($uuid);
        $rclbmusicformatSelected = [];
        foreach ($rclbmusicformat as $key => $value) {
            $rclbmusicformatSelected[] = $value->musicformat;
        }
        $data['rclbmusicformatSelected'] = $rclbmusicformatSelected;

        return view('products::record_store.edit', $data);
    }

    public function updateProductsRecordStore(Request $request, $uuid)
    {
        $validation = $request->validate([
            'recordstore_name'      => ['required', 'string'],
            'description'           => ['required', 'string'],
            'genre'                 => 'required|array',
            'city'                  => ['required', 'string'],
            'address'              => ['required', 'string'],
            'phone'              => ['required', 'string'],
            'email'              => ['required', 'string', 'email'],
            'web_link'              => ['required', 'string'],
        ]);

        $updateData = [
            'name' => $request->recordstore_name,
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

            $imageName = Str::slug($request->recordstore_name).time().'-rclb.'.$request->display_pict->extension();
            $path = 'images/products/recordstore';
            $imagePath = $path.'/'.$imageName;
            $request->display_pict->move(public_path($path), $imageName);
            $updateData['display_pict'] = $imagePath;
        }

        $genrePicked = [];
        foreach ($request->genre as $key => $value) {
            $genrePicked[] = [
                'record_store' => $uuid,
                'genre' => $value,
            ];
        }

        $musicformatPicked = [];
        foreach ($request->musicformat as $key => $value) {
            $musicformatPicked[] = [
                'record_store' => $uuid,
                'musicformat' => $value,
            ];
        }

        $updated = RecordStore::where('uuid', $uuid);
        $updated->update($updateData);

        $deleted = RecordStore::deleteRecordStoreGenre($uuid);
        $deleted = RecordStore::deleteRecordStoreMusicFormat($uuid);
        $saved = RecordStore::saveRecordStoreGenre($genrePicked);
        $saved = RecordStore::saveRecordStoreMusicFormat($musicformatPicked);

        return back()->with('success', 'Record Store updated!');
    }

    public function destroyProductsRecordStore($uuid): RedirectResponse
    {
        $deleted = RecordStore::deleteRecordStoreGenre($uuid);
        $deleted = RecordStore::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Record Store deleted!');
    }
}
