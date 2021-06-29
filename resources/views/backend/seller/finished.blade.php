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
                                            <i class="fa fa-gift"></i> Finished </div>
                                    </div>


                                    <div class="portlet-body form assign_to_courier_data">
                                        <!-- BEGIN FORM-->

                                        <div class="form_data_for_debrief"  >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >

                                                <thead>

                                                <tr>


                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Tracking Number </th>
                                                    <th class="text-center"> Area </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Price </th>
                                                    <th class="text-center"> Shipping Price </th>

                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products_assign">


                                                <?php $order = 1   ?>

                                                @forelse($debriefs as $key=>$item)

                                                        <tr class="text-center form_data_here"
                                                            data-sum_price="
                                                            {{$total}}
                                                            ">
                                                            <td>
                                                                {{$order++}}
                                                            </td>
                                                            <td>
                                                                {{$item->barcode_number}}
                                                            </td>
                                                            <td>
                                                                {{$item->sub_area->name}}
                                                            </td>
                                                            <td>
                                                                {{$item->status}}
                                                            </td>
                                                            <td>
                                                                @if($item->status == 'Returned')
                                                                {{0}}
                                                                @else
                                                                   {{$item->price }} EGP
                                                                    @endif

                                                            </td>

                                                            @if($item->status =='Returned')
                                                                <td class="shipping_status" data-shipping_price="{{  $item->sub_area->return_price }}">
                                                                    - {{$item->sub_area->return_price}} EGP
                                                                </td>
                                                            @elseif($item->status =='delivered')
                                                                <td class="shipping_status" data-shipping_price="{{$item->shipping_price}}">
                                                                    0
                                                                </td>
                                                            @else
                                                                <td class="">
                                                                    //

                                                                </td>
                                                            @endif


                                                        </tr>


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
                                    {{-- Courier data here --}}
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
            <tr class="sub_row"> <td class="text-center" colspan="3">Sum</td>  <td class="text-center total_here" colspan="3">  ${parseFloat($('.form_data_here').data('sum_price'))} EGP </td> <td class="text-center shipping_price_here"></td> </tr>`)
        }


    </script>
@endsection
