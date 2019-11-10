<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle extends Model
{
    protected $fillable = [
        'id',
        'brand',
        'model',
        'body_type',
        'type',
        'price',
        'year',
        'mileage',
        'transmission',
        'doors',
        'fuel',
        'color',
        'plate',
        'is_change',
        'observation',
        'accessories'
    ];

    public $timestamps = false;

    public static function filter($f)
    {
        $f = $f['filter'];
        $db = DB::table('vehicles');

        if(isset($f['brand']))
            $db->where('brand','=',$f['brand']);

        if(isset($f['model']))
            $db->where('model','=',$f['model']);

        if(isset($f['yearFrom']))
            $db->where('year','>=',$f['yearFrom']);

        if(isset($f['yearTo']))
            $db->where('year','<=',$f['yearTo']);

        if(isset($f['priceFrom']))
            $db->where('price','>=',$f['priceFrom']);

        if(isset($f['priceTo']))
            $db->where('price','<=',$f['priceTo']);

        if(isset($f['mileageFrom']))
            $db->where('mileage','>=',$f['mileageFrom']);

        if(isset($f['mileageTo']))
            $db->where('mileage','<=',$f['mileageTo']);

        return $db->paginate(10);
    }
}
