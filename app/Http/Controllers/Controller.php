<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Option;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function globalAySem($key){
        $upcomingAy = Option::where('type','current-ay')->select('id')->first();
        $upcomingSem = Option::where('type','upcoming-sem')->select('id')->first();

        if($key == 'ay'){
            return $upcomingAy->id;
        } 

        return $upcomingSem->id;
    }
    
}
