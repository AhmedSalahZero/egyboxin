<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Barcode;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allItems= Item::all();
        $all = collect();
        foreach($allItems as $oneItem)
        {
            $all->push( Barcode::whereIn('id',  $oneItem->barcode_id)->get());
        }


   //     dd($all);
        //$items = Barcode::whereIn('id',  $y->barcode_id)->get();
        //dd($items);

        return view('backend.items.index')->with('items',$all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barcodes = Barcode::get();
        return view('backend.items.create')->with('barcodes' , $barcodes);
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
            'barcode_id.*' => 'required',
        ]);
        $y = Item::create([
            'barcode_id' => $request->barcode_id,
        ]);

        /*if($items->status == 'created' || $items->status == 'pending')
        {
        if($request->status)
        {
            $status =
            [
                'status'=>$request->status
            ] ;
        }
        };*/

        return view('backend.items.index');
    }


    public function show(Item $item)
    {
        //
    }


    public function edit(Item $item)
    {
        //
    }

    public function update(Request $request, Item $item)
    {
        //
    }

    public function destroy(Item $item)
    {
        //
    }
}
