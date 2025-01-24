<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Genre;

class GenreController extends Controller
{
    public function listsMasterGenre()
    {
        $data['title'] = 'Genre';
        $data['lists'] = Genre::getGenreLists();

        return view('masterdata::genre.lists', $data);
    }

    public function addMasterGenre()
    {
        $data['title'] = 'Add Master Genre';

        return view('masterdata::genre.add', $data);
    }

    public function storeMasterGenre(Request $request)
    {
        $validation = $request->validate([
            'genre_name'      => ['required', 'string'],
        ]);
        
        $saveData = [
            'uuid' => generateUuid(),
            'name' => $request->genre_name,
        ];

        $saved = Genre::create($saveData);

        if ($saved) {
            return back()->with('success', 'Master genre saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editMasterGenre($uuid)
    {
        $data['title'] = 'Edit Mater Genre';
        $data['current'] = Genre::where('uuid',$uuid)->first();

        return view('masterdata::genre.edit', $data);
    }

    public function updateMasterGenre(Request $request, $uuid)
    {
        $validation = $request->validate([
            'genre_name'      => ['required', 'string'],
        ]);
        
        $updateData = [
            'name' => $request->genre_name,
        ];

        $updated = Genre::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Master genre updated!');
    }

    public function destroyMasterGenre($uuid): RedirectResponse
    {
        $deleted = Genre::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Master genre deleted!');
    }
}
