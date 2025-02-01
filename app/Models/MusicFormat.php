<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MusicFormat extends Model
{
    protected $table = 'master_musicformat';
    protected $fillable = [
        'uuid',
        'name',
    ];

    public function scopeGetMusicFormatLists($query)
    {
        $query = DB::table("master_musicformat as musicformat")
            ->select('musicformat.uuid', 'musicformat.name')
            ->orderBy('musicformat.name','ASC')
            ->get();

        return $query;
    }
}
