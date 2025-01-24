<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    protected $table = 'master_city';
    protected $fillable = [
        'uuid',
        'country_uuid',
        'name',
    ];

    public function scopeGetCityLists($query)
    {
        $query = DB::table("master_city as city")
            ->select('city.uuid', 'city.name')
            ->orderBy('city.name','ASC')
            ->get();

        return $query;
    }
}
