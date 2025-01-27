<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudioMusic extends Model
{
    protected $table = 'studio_music';
    protected $guarded = ['id'];

    public function scopegetStudioMusicLists($query)
    {
        $query = DB::table("studio_music as studio")
            ->select('studio.*','city.name as city_name')
            ->join("master_city as city", "city.uuid", "=", "studio.city")
            ->orderBy('studio.name','ASC')
            ->get();

        return $query;
    }
}
