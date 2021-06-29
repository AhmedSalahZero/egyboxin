<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('backend.languages.index')->with('languages',$languages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:100',
            'code' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if($request->has('image'))
        {
            
            $image = $request->file('image')->store('languages','public');
        }else
        {
            $image = null;
        };
        Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'image' => $image,
            ]);
            
        return redirect()->route('languages.index'); 
    }


    public function edit($id)
    {
        $language = Language::findorfail($id);
        return view('backend.languages.edit')->with('language' , $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|required|max:100',
            'code' => 'required',
        ]);
        
        $language = Language::findorfail($id);

        if($request->has('image'))
        {
            Storage::disk('public')->delete($language->image);
            $image = $request->file('image')->store('languages','public');
        }else
        {
            $image = $language->image;
        };

        $language->update([
            'name'=>$request->name,
            'code'=>$request->code,
            'image'=>$image,
        ]);

        return redirect()->route('languages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findorfail($id);
        Storage::disk('public')->delete($language->image);
        $language->delete();
        return redirect()->route('languages.index');
    }
}
