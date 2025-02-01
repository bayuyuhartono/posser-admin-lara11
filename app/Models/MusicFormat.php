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
        $query = DB::table("master_musicformat as genre")
            ->select('genre.uuid', 'genre.name')
            ->orderBy('genre.name','ASC')
            ->get();

        return $query;
    }
}
