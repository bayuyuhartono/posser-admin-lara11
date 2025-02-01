<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudioRecording extends Model
{
    protected $table = 'studio_recording';
    protected $guarded = ['id'];

    public function scopegetStudioRecordingLists($query)
    {
        $query = DB::table("studio_recording as studio")
            ->select('studio.*','city.name as city_name')
            ->join("master_city as city", "city.uuid", "=", "studio.city")
            ->orderBy('studio.name','ASC')
            ->get();

        return $query;
    }
}
