<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileImageRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function changeProfilePassword(Request $request , User $user)
    {


        $result = $user->changeProfilePassword($request);
        if (array_key_exists('fail' , $result))
            return redirect()->route('my.profile','#tab_1_3')->with('fail',$result['fail']);
        return redirect()->route('my.profile',['#tab_1_3'])->with('success',$result['success']);
    }
    public function changeProfileImage(StoreProfileImageRequest  $request,User $user):RedirectResponse
    {
        $user->ChangeProfileImage($request);
        return redirect()->route('my.profile','#tab_1_2');
    }
    public function saveAccountInfo(Request $request , User $user )
    {
        $user->EditAccount($request);
        return redirect()->back();
    }

}
