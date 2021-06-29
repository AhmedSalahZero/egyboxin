<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\AreaExistRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const DefaultImagePath ='users/default_profile_image.jpg';
    public function index()
    {
        if(auth()->user()->type == 'admin')
        {
            $users = User::all();
            return view('backend.users.index')->with('users' , $users);

        }else
        {
            return redirect()->back();
        }
    }

    public function create()
    {
        if( auth()->user()->type == 'admin')
        {
            return view('backend.users.create');

        }else
        {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if(auth()->check() && auth()->user()->type == 'admin')
            {
            $request->validate([
                'name' => 'string|required|max:100',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'numeric'],
                'area_id' => ['required', new AreaExistRule()],
//                'image' => 'image|mimes:jpeg,png,jpg',
            ]);
//            if($request->has('image'))
//            {
//
//                $image = $request->file('image')->store('users','public');
//            }else
//            {
//                $image = self::DefaultImagePath;
//            };

            User::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'password'=> Hash::make(88888888),
                'type' => $request->type,
                'area_id' => $request->area_id,
//                'image' => $image ,
                'bank_account'=>($request->bank_account ? $request->bank_account  :null ) ,
                'id_number'=> ($request->id_number ?$request->id_number : null)  ,
                ]);

            return redirect()->route('users.index');
            }else
            {
                return redirect()->back();
            }
    }

    public function edit($id)
    {
        if(auth()->check() == true && auth()->user()->type == 'admin')
        {
            $user = User::findorfail($id);
            return view('backend.users.edit')->with('user' , $user);
        }else
        {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if( auth()->user()->type == 'admin')
        {
            $request->validate([
                'name' => 'string|required|max:100',
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'numeric'],
                'area_id' => ['required', new AreaExistRule()],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
//                'image' => 'image|mimes:jpeg,png,jpg',

            ]);
            $user = User::findorfail($id);
//            if($request->has('image'))
//            {
//                Storage::disk('public')->delete($user->image);
//                $image = $request->file('image')->store('users','public');
//            }else
//            {
//                $image = $user->image;
//            };

            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'area_id' => $request->area_id,
                'email' => $request->email,
                'type' => $request->type,
//                'image'=>$image,
                'bank_account'=>$request->bank_account ? $request->bank_account  :null  ,
                'id_number'=> ($request->id_number ?$request->id_number : null)  ,
            ]);
            return redirect()->route('users.index');
        }else
        {
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        if(auth()->check() == true && auth()->user()->type == 'admin')
        {
            $user = User::findorfail($id);
            Storage::disk('public')->delete($user->image);
            $user->delete();
            return redirect()->route('users.index');
        }else
        {
            return redirect()->back();
        }
    }

    public function doLogout($lang)
    {
        auth('client')->logout();
        return redirect()->back();
    }
    public function resetPassword(User $user)
    {
        $user->update([
            'password'=>Hash::make(88888888)
        ]);
        return redirect()->back()->with('success','Password Has Been Reset');
    }
    public function saveAccountInfo(Request $request):RedirectResponse
    {
        $idNumber = ($request->id_number)  ? $request->id_number : $request->user()->id_number  ;
        $bankAccount = ($request->bank_account) ? $request->bank_account : $request->user()->bank_account;
        User::where('id',$request->user()->id)->update([
            'id_number'=>$idNumber,
            'bank_account'=>$bankAccount
        ]);
        return redirect()->back()->with('success','Saved !');

    }
}
