<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubAreaRequest;
use App\Models\Country;
use App\Models\SubArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubAreaController extends Controller
{
    public function create()
    {
        //
    }
    public function store(Request $request , Country $area)
    {

        $validator = Validator::make(['area_name'=>$request->area_name] , $this->rules($request->area_id) , $this->messages($request->area_id,$request->area_name));
        if ($validator->fails()){
            return response()->json([
                'status'=>false ,
                'message'=>$validator->errors()->first() ,
                'area_id'=>$request->area_id
            ]);
        }
        $area->subAreas()->create([
            'name'=>$request->area_name ,
            'deliver_price'=>$request->deliver_price ,
            'return_price'=>$request->return_price ,
        ]);
        return response()->json([
            'status'=>true,
            'area_id'=>$request->area_id
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function edit(SubArea $subArea)
    {
      return view('backend.countries.editSub')->with('sub',$subArea);
    }

    public function update(Request $request, SubArea $subArea)
    {

        $validator = Validator::make(['name'=>$request->name] , $this->rules($subArea->area->id) , $this->messages($subArea->area->id,$request->name));
        if($validator->fails())
        return redirect()->back()->with('error',$validator->errors()->first());
        $subArea->update([
            'name'=>$request->name ,
            'deliver_price'=>$request->deliver_price ,
            'return_price'=>$request->return_price ,
        ]);
        return redirect()->route('countries.index')->with('success','Done !');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function rules($area_id)
    {

        return [
            'area_name'=>"unique:sub_areas,name,null,null,area_id,$area_id"
        ];
    }
    protected function messages($area_id , $area_name)
    {
        return [
            'area_name.unique'=> $area_name . ' SubArea Already Exist For ' . Country::where('id',$area_id)->first()->name . ' Area',

        ];
    }

}
