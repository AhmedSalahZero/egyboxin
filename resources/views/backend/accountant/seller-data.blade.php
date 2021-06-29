
<?php $order = 1   ?>
<?php $x = '' ?>
@forelse($debriefs as $area=>$collect)

    @foreach($collect->groupBy(function($barcode){
        return $barcode->status ;
    })  as $status=>$coll )


        <tr class="text-center form_data_here"
            data-sum_price="{{$debriefs->sum(function($col){
    return $col->where('status','delivered')->sum(function($x){
        return $x->price ;

    }) ;
})

}}"
            data-seller_name ="{{$coll->first()->seller->name}}"

            data-country_name ="{{$coll->first()->seller->area->name}}"

            data-end_debrief="{{$endDebrief}}" >
            <td>
                {{$order++}}
            </td>
            <td>
                {{$area}}
            </td>

            <td>
                {{count($coll)}}
            </td>
            <td>
                {{$status}}
            </td>
            <td>
              @foreach($coll as $row)
                    <span class="excel_ids" style="display: none" data-ids_value="{{$x .= $row->id . ','}}"></span>
                @endforeach
                @if($coll->contains('status','Returned'))
                    0
                @else
                    {{$coll->sum('price')}} EGP
                    @endif


            </td>

            @if($coll->contains('status','Returned'))
                <td class="shipping_status" data-shipping_price="{{  count($coll)* $coll->first()->sub_area->return_price }}">
                     {{ count($coll)* $coll->first()->sub_area->return_price }} EGP
                </td>
            @elseif($coll->contains('status','delivered'))
                <td class="shipping_status" data-shipping_price="{{ $coll->sum('shipping_price')}}">
                     {{ $coll->sum('shipping_price')}} EGP
                </td>
            @else
                <td class="">
                    //

                </td>
            @endif
            <td>
                <div class="modal fade" id="exampleModalCenter{{$order}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="printJS-table{{$order}}">
                                <div   class="col-xs-12 display_on_print">
                                    <img width="125px" height="50px" src="{{asset('backend/assets/layouts/layout4/img/logo-light.png')}}">
                                    <h4 style="display: inline-block;float: right">{{date('l , d F Y ' , strtotime(now()))}}</h4> <br>
                                    <h4 style="display: inline-block">{{$coll->first()->seller->name}}</h4>
                                </div>

                                <table class="table table-bordered" id="printJS-table{{$order}}">

                                    <thead>
                                    <tr>
                                        <th class="text-center">Tracking Number</th>
                                        <th class="text-center">Client Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Area</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Shipping Price</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coll as $item)
                                        <tr>
                                            <td class="text-center " >{{$item->barcode_number}}</td>
                                            <td class="text-center">{{$item->client_name}}</td>
                                            <td class="text-center">{{$item->address}}</td>
                                            <td class="text-center">{{$item->sub_area->name}}</td>
                                            <td class="text-center">
                                                @if($item->status =='Returned')
                                              0
                                                @else
                                                    {{intval($item->price)}} EGP
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->status =='Returned')
                                                    {{$item->sub_area->return_price}} EGP
                                                @else
                                                    {{$item->shipping_price}} EGP
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button  type="button" class="btn btn-secondary " onclick="printJS('printJS-table{{$order}}', 'html')">
                                    Print
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

                <button  type="button" class="btn btn-primary details_hidden" data-toggle="modal" data-target="#exampleModalCenter{{$order}}">
                    Details
                </button>



            </td>

        </tr>


    @endforeach
@empty
    <tr class="no_data_available_row">
        <td colspan="7">
            <h3 class="text-center">
                No Data Available
            </h3>
        </td>
    </tr>
@endforelse

