<?php

use Illuminate\Support\Facades\Schema as FacadesSchema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/*
function getRegions(){
    $get_region = DB::table('lib_regions')
    ->get([
        'lib_regions.region',
        'lib_regions.psgc_rcode'
    ]);
    return $get_region;
}

function getProvinces(){
    $get_province = DB::table('lib_provinces')
    ->get([
        'lib_provinces.province',
        'lib_provinces.psgc_rcode'
    ]);
    return $get_province;
}

function getMuncities(){
    $get_muncity = DB::table('lib_muncities')
    ->get([
        'lib_muncities.muncity',
        'lib_muncities.psgc_pcode',
        'lib_muncities.psgc_mcode'
    ]);
    return $get_muncity;
}
*/

function getBrgys(){
    $get_brgy = DB::table('lib_brgy')
    ->get([
        'lib_brgy.brgy',
        'lib_brgy.muncity',
        'lib_brgy.province',
        'lib_brgy.region',
    ]);
    return $get_brgy;
}
?>