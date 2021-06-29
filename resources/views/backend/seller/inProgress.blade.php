@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />
    <style>
    @media print
    {
        .confirm_assign_order_btn , .print_debrief_btn{
            display: none;
        }
        .display_on_print
        {
            display: block !important;
        }

    }

    </style>

@endsection

@section('content')

    @include('layouts.toaster')


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">

                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div  style="display: none" class="col-xs-12 display_on_print">
                                        <img width="125px" height="50px" src="{{asset('backend/assets/layouts/layout4/img/logo-light.png')}}">
                                    <h4 style="display: inline-block;float: right">{{date('l , d F Y ' , strtotime(now()))}}</h4>
                                </div>

                                <div class="portlet box green">


                                    <div class="portlet-title">


                                        <div class="caption">
                                            <i class="fa fa-gift"></i> In Progress </div>
                                    </div>


                                    <div class="portlet-body form assign_to_courier_data">
                                        <!-- BEGIN FORM-->

                                        <div class="form_data_for_debrief"  >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >

                                                <thead>

                                                <tr>


                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Area </th>
                                                    <th class="text-center"> No </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Price </th>
                                                    <th class="text-center"> Shipping Price </th>
                                                    <th class="text-center"> Details </th>
{{--                                                    <th class="text-center"> Payment Method </th>--}}
                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products_assign">


                                                <?php $order = 1   ?>
                                                @forelse($debriefs as $area=>$collect)

                                                    @foreach($collect->groupBy(function($barcode){
                                                        return $barcode->status ;
                                                    })  as $status=>$coll )
                                                        <tr class="text-center form_data_here"
                                                            data-sum_price="{{$mainPrice}}">
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
                                                            <td >

                                                                    {{$coll->sum('price')}} EGP

                                                            </td>
                                                            <td class="shipping_status" data-shipping_price="{{  $coll->sum('shipping_price')}}">
                                                                {{  $coll->sum('shipping_price') }} EGP
                                                            </td>
{{--                                                            @if($coll->contains('status','RTO') || $coll->contains('status','Return to seller') ||  $coll->contains('status','canceled')  ||  $coll->contains('previous_status','RTO') ||  $coll->contains('previous_status','Return to seller')  )--}}
{{--                                                                <td class="shipping_status" data-shipping_price="{{  $coll->sum(function($item){return $item->sub_area->return_price;})}}">--}}
{{--                                                                     {{  $coll->sum(function($item){return $item->sub_area->return_price;})}} EGP--}}
{{--                                                                </td>--}}
{{--                                                            @else--}}
{{--                                                                <td class="shipping_status" data-shipping_price="{{$coll->sum('shipping_price')}}">--}}
{{--                                                                     {{$coll->sum('shipping_price')}} EGP--}}
{{--                                                                </td>--}}
{{--                                                            @endif--}}
                                                            <td class="text-center">
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
                                                                                        <th class="text-center">Previous Status</th>
                                                                                        <th class="text-center">Status</th>
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
                                                                                                {{$item->previous_status}}
                                                                                            </td>
                                                                                            <td class="text-center">{{$item->status}}</td>

                                                                                            <td class="text-center">
                                                                                             {{intval($item->price)}}


                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{$item->shipping_price}} EGP
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

{{--                                                            <td>--}}
{{--                                                                {{$coll->first()->paymentMethod}}--}}
{{--                                                            </td>--}}

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






                                                </tbody>
                                            </table>

                                        </div>
{{--                                     Courier data here--}}
                                    <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection

@section('js')
    <script>

        if($('tr').hasClass('no_data_available_row'))
        {
            $('.sub_row').remove();
        }
        else{
            $('.body_for_products_assign').append(`
            <tr class="sub_row"> <td class="text-center" colspan="3">Sum</td>  <td class="text-center total_here" colspan="3">  0 EGP </td> <td class="text-center shipping_price_here"></td> </tr>

            `)

        }

    </script>
    <script>
        $(function(){
            let shipping_price = 0 ;
            const main_price = $('.form_data_here').data('sum_price');
            $('.shipping_status').each(function(){
                shipping_price += $(this).data('shipping_price') ;
            })
            $('.total_here').html((main_price - shipping_price) + ' EGP');
        })
    </script>

@endsection


















































































{{--@extends('layouts.admin')--}}
{{--@section('css')--}}
{{--    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <style>--}}
{{--    @media print--}}
{{--    {--}}
{{--        .confirm_assign_order_btn , .print_debrief_btn{--}}
{{--            display: none;--}}
{{--        }--}}
{{--        .display_on_print--}}
{{--        {--}}
{{--            display: block !important;--}}
{{--        }--}}

{{--    }--}}

{{--    </style>--}}

{{--@endsection--}}

{{--@section('content')--}}

{{--    @include('layouts.toaster')--}}


{{--    <!-- BEGIN CONTENT -->--}}
{{--    <div class="page-content-wrapper">--}}
{{--        <!-- BEGIN CONTENT BODY -->--}}
{{--        <div class="page-content">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}

{{--                    <div class="tabbable-line boxless tabbable-reversed">--}}
{{--                        <div class="tab-content">--}}
{{--                            <div class="tab-pane active" id="tab_0">--}}
{{--                                <div  style="display: none" class="col-xs-12 display_on_print">--}}
{{--                                        <img width="125px" height="50px" src="{{asset('backend/assets/layouts/layout4/img/logo-light.png')}}">--}}
{{--                                    <h4 style="display: inline-block;float: right">{{date('l , d F Y ' , strtotime(now()))}}</h4>--}}
{{--                                </div>--}}

{{--                                <div class="portlet box green">--}}


{{--                                    <div class="portlet-title">--}}


{{--                                        <div class="caption">--}}
{{--                                            <i class="fa fa-gift"></i> In Progress </div>--}}
{{--                                    </div>--}}


{{--                                    <div class="portlet-body form assign_to_courier_data">--}}
{{--                                        <!-- BEGIN FORM-->--}}

{{--                                        <div class="form_data_for_debrief"  >--}}
{{--                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >--}}

{{--                                                <thead>--}}

{{--                                                <tr>--}}


{{--                                                    <th class="text-center">#</th>--}}
{{--                                                    <th class="text-center"> Area </th>--}}
{{--                                                    <th class="text-center"> Status </th>--}}
{{--                                                    <th class="text-center"> Price </th>--}}
{{--                                                    <th class="text-center"> Shipping Price </th>--}}

{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody class="body_for_products_assign">--}}


{{--                                                <?php $order = 1   ?>--}}
{{--                                                @forelse($debriefs as $key=>$collect)--}}

{{--                                                        <tr class="text-center form_data_here"--}}
{{--                                                            data-sum_price="{{$debriefs->sum('price')}}">--}}
{{--                                                            <td>--}}
{{--                                                                {{$order++}}--}}
{{--                                                            </td>--}}
{{--                                                            <td>--}}
{{--                                                                {{$collect->sub_area->name}}--}}
{{--                                                            </td>--}}

{{--                                                            <td>--}}
{{--                                                                {{$collect->status}}--}}
{{--                                                            </td>--}}
{{--                                                            <td>--}}
{{--                                                                {{$collect->price}} EGP--}}
{{--                                                            </td>--}}

{{--                                                            @if($collect->status =='Returned')--}}
{{--                                                                <td class="shipping_status" data-shipping_price="{{  $coll->first()->sub_area->return_price }}">--}}
{{--                                                                    - {{  $collect->sub_area->return_price }} EGP--}}
{{--                                                                </td>--}}
{{--                                                            @elseif($collect->status == 'delivered')--}}
{{--                                                                <td class="shipping_status" data-shipping_price="{{$collect->price}}">--}}
{{--                                                                    - {{$collect->shipping_price}} EGP--}}
{{--                                                                </td>--}}
{{--                                                            @else--}}
{{--                                                                <td class="">--}}
{{--                                                                    //--}}

{{--                                                                </td>--}}
{{--                                                            @endif--}}

{{--                                                        </tr>--}}


{{--                                                @empty--}}
{{--                                                    <tr class="no_data_available_row">--}}
{{--                                                        <td colspan="6">--}}
{{--                                                            <h3 class="text-center">--}}
{{--                                                                No Data Available--}}
{{--                                                            </h3>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforelse--}}






{{--                                                </tbody>--}}
{{--                                            </table>--}}

{{--                                        </div>--}}
{{--                                     Courier data here--}}
{{--                                    <!-- END FORM-->--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- END CONTENT BODY -->--}}
{{--    </div>--}}
{{--    <!-- END CONTENT -->--}}
{{--@endsection--}}

{{--@section('js')--}}
{{--    <script>--}}

{{--        if($('tr').hasClass('no_data_available_row'))--}}
{{--        {--}}
{{--            $('.sub_row').remove();--}}
{{--        }--}}
{{--        else{--}}
{{--            $('.body_for_products_assign').append(`--}}
{{--            <tr class="sub_row"> <td class="text-center" colspan="3">Sum</td>  <td class="text-center total_here" colspan="3">  ${parseFloat($('.form_data_here').data('sum_price'))} EGP </td> <td class="text-center shipping_price_here"></td> </tr>--}}

{{--            `)--}}

{{--        }--}}

{{--    </script>--}}
{{--@endsection--}}
