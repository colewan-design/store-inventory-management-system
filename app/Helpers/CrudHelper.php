<?php

use Illuminate\Support\Facades\Schema as FacadesSchema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


function columnSetter($model, $request)
{
    $columns = FacadesSchema::getColumnListing($model->getTable());
    foreach ($columns as $column) {
        if (!isset($request[$column])) {
            continue;
        }
        if (is_array($request[$column])) {
            if (array_filter($request[$column])) {
                $model->{$column} = json_encode(
                    $request[$column]
                );
            }
            continue;
        }
        $model->{$column} = $request[$column];
    }
    unset($column);
}

function arraySetter($model, $unfilteredArray,$id = null)
{
    $arrays_object = [];
    $excluded = ['employment_id','relationship_id','coop_membership_id','member_id'];
    $columns = FacadesSchema::getColumnListing($model->getTable());

    $filteredArray = array_filter($unfilteredArray,function($var){
            return $var ? $var : null;
        }
    );
    if(!is_multi($filteredArray)){
        $arr_object = ['member_id'=>$id];
        foreach ($columns as $column) {
            if(in_array($column,$excluded)){
                continue;
            }
            if (!isset($filteredArray[$column])) {
                continue;
            }
            $arr_object[$column] = $filteredArray[$column] ? $filteredArray[$column]: null;
        }
        unset($column);
        array_push($arrays_object,$arr_object);
    }else{
        foreach ($filteredArray as $array) {
            $arr_object = ['member_id'=>$id];
            foreach ($columns as $column) {

                if(in_array($column,$excluded)){
                    continue;
                }

                if (!isset($array[$column]) ) {
                    $arr_object[$column] = null;
                    continue;
                }
                $arr_object[$column] = $array[$column] ? $array[$column]: null;
            }
            unset($column);
            array_push($arrays_object,$arr_object);
        }
        unset($array);
    }
    return $arrays_object;

}
?>