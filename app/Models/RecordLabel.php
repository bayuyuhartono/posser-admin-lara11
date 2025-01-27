<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecordLabel extends Model
{
    protected $table = 'record_label';
    protected $guarded = ['id'];

    public function scopegetRecordLabelLists($query)
    {
        $query = DB::table("record_label as rclb")
            ->select('rclb.*','city.name as city_name')
            ->join("master_city as city", "city.uuid", "=", "rclb.city")
            ->orderBy('rclb.name','ASC')
            ->get();

        return $query;
    }

    public function scopeGetRecordLabelGenre($query, $rclbuuid)
    {
        $query = DB::table("record_label_genre")
            ->where("record_label", $rclbuuid)
            ->get();

        return $query;
    }

    public function scopeSaveRecordLabelGenre($query, $data)
    {
        $query = DB::table("record_label_genre")->insert($data);

        return $query;
    }

    public function scopeDeleteRecordLabelGenre($query, $uuid)
    {
        $query = DB::table("record_label_genre")
            ->where('record_label',$uuid)
            ->delete();

        return $query;
    }
}
