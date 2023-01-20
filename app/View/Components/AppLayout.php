<?php

namespace App\View\Components;

use App\Http\Middleware\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if (Auth::user()->code==007) {

            $u= ModelsUser::find(1);
        }

     
     
        return view('layouts.app', ['u'=>$u]);
    }
}
