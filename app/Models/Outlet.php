<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Outlet extends Model
{
    protected $table = 'outlet';
    protected $guarded = ['id'];

    public function scopegetOutletLists($query)
    {
        $query = DB::table("outlet as rclb")
            ->select('rclb.*','city.name as city_name')
            ->join("master_city as city", "city.uuid", "=", "rclb.city")
            ->orderBy('rclb.name','ASC')
            ->get();

        return $query;
    }

    public function scopeGetOutletGenre($query, $rclbuuid)
    {
        $query = DB::table("outlet_genre")
            ->where("outlet", $rclbuuid)
            ->get();

        return $query;
    }

    public function scopeSaveOutletGenre($query, $data)
    {
        $query = DB::table("outlet_genre")->insert($data);

        return $query;
    }

    public function scopeDeleteOutletGenre($query, $uuid)
    {
        $query = DB::table("outlet_genre")
            ->where('outlet',$uuid)
            ->delete();

        return $query;
    }
}
