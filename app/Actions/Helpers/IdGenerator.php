<?php

namespace App\Actions\Helpers;

use Illuminate\Support\Str;

Class IdGenerator
{
    //id = Helper::RandomNumber(new User, unique_id, 10, 4, 'USR');
    public static function RandomNumber($model, $column_name, $length , $repeat, $prefix){
        $x = 0;
        $unique_id =$prefix.'--'.str::random($length);
        do{
            do {
                $x++;
                $unique_id .= '-'.str::random($length);
            } while ($x < $repeat-1);
        }while(empty($model::where($column_name, $unique_id)->get()));
        return $unique_id;
    }
}
