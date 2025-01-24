<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    protected $table = 'master_country';
    protected $fillable = [
        'uuid',
        'name',
    ];

    public function scopeGetCountryLists($query)
    {
        $query = DB::table("master_country as country")
            ->select('country.uuid', 'country.name')
            ->orderBy('country.name','ASC')
            ->get();

        return $query;
    }
}
