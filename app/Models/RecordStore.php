<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecordStore extends Model
{
    protected $table = 'record_store';
    protected $guarded = ['id'];

    public function scopegetRecordStoreLists($query)
    {
        $query = DB::table("record_store as rclb")
            ->select('rclb.*','city.name as city_name')
            ->join("master_city as city", "city.uuid", "=", "rclb.city")
            ->orderBy('rclb.name','ASC')
            ->get();

        return $query;
    }

    public function scopeGetRecordStoreGenre($query, $rclbuuid)
    {
        $query = DB::table("record_store_genre")
            ->where("record_store", $rclbuuid)
            ->get();

        return $query;
    }

    public function scopeGetRecordStoreMusicFormat($query, $rclbuuid)
    {
        $query = DB::table("record_store_musicformat")
            ->where("record_store", $rclbuuid)
            ->get();

        return $query;
    }

    public function scopeSaveRecordStoreGenre($query, $data)
    {
        $query = DB::table("record_store_genre")->insert($data);

        return $query;
    }

    public function scopeSaveRecordStoreMusicFormat($query, $data)
    {
        $query = DB::table("record_store_musicformat")->insert($data);

        return $query;
    }

    public function scopeDeleteRecordStoreGenre($query, $uuid)
    {
        $query = DB::table("record_store_genre")
            ->where('record_store',$uuid)
            ->delete();

        return $query;
    }

    public function scopeDeleteRecordStoreMusicFormat($query, $uuid)
    {
        $query = DB::table("record_store_musicformat")
            ->where('record_store',$uuid)
            ->delete();

        return $query;
    }
}
