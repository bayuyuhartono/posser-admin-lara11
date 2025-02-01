<?php

namespace Modules\MasterData\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\MusicFormat;

class MusicFormatController extends Controller
{
    public function listsMasterMusicFormat()
    {
        $data['title'] = 'MusicFormat';
        $data['lists'] = MusicFormat::getMusicFormatLists();

        return view('masterdata::musicformat.lists', $data);
    }

    public function addMasterMusicFormat()
    {
        $data['title'] = 'Add Master Music Format';

        return view('masterdata::musicformat.add', $data);
    }

    public function storeMasterMusicFormat(Request $request)
    {
        $validation = $request->validate([
            'musicformat_name'      => ['required', 'string'],
        ]);
        
        $saveData = [
            'uuid' => generateUuid(),
            'name' => $request->musicformat_name,
        ];

        $saved = MusicFormat::create($saveData);

        if ($saved) {
            return back()->with('success', 'Master Music Format saved!');
        }

        return back()->with('failed', 'Failed!');   
    }

    public function editMasterMusicFormat($uuid)
    {
        $data['title'] = 'Edit Master Music Format';
        $data['current'] = MusicFormat::where('uuid',$uuid)->first();

        return view('masterdata::musicformat.edit', $data);
    }

    public function updateMasterMusicFormat(Request $request, $uuid)
    {
        $validation = $request->validate([
            'musicformat_name'      => ['required', 'string'],
        ]);
        
        $updateData = [
            'name' => $request->musicformat_name,
        ];

        $updated = MusicFormat::where('uuid', $uuid);
        $updated->update($updateData);

        return back()->with('success', 'Master Music Format updated!');
    }

    public function destroyMasterMusicFormat($uuid): RedirectResponse
    {
        $deleted = MusicFormat::where('uuid',$uuid);
        $deleted->delete();

        return back()->with('success', 'Master Music Format deleted!');
    }
}
