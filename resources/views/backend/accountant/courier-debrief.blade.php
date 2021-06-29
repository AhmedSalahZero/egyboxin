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
    <div style="display: none" id="excel_ids_form_here">

    </div>

    <div class="modal fade" id="flashMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Courier Debrief Has Been Ended Successfully
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Invalid Tracking Number
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <span id="our_token" style="display: none" value="{{csrf_token()}}"></span>
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
                                            <i class="fa fa-gift"></i> Courier Debrief</div>
                                    </div>


                                    <div class="portlet-body form assign_to_courier_data">
                                        <!-- BEGIN FORM-->
                                        <form class="form-horizontal">
                                            @csrf
                                            <div class="form-body">
                                                <!--country_id-->
                                                <div class="row">
                                                    <div class="form-group ">
                                                        <div class="col-md-3">
                                                            <select class="area_changed form-control input-circle" name="status">
                                                                <option value="0"> Select Area </option>
                                                                @foreach($areas as $area)
                                                                    <option  value="{{$area->id}}">{{$area->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="courier_select form-control input-circle" name="courier_id" disabled>

                                                                <option value="0">Courier Name </option>

                                                                {{-- Ajax Here --}}

                                                            </select>
                                                        </div>
{{--                                                        <div class="col-xs-4 receive_barcode_input_assign_div" style="display: none">--}}
{{--                                                            <input id="receive_barcode_input_assign" type="text" class="receive_barcode_input_assign form-control" placeholder="Tracking Number">--}}
{{--                                                        </div>--}}
                                                    </div>
{{--                                                    <table class="table table-striped table-bordered table-hover table-header-fixed table_for_courier_data" style="display: none">--}}
{{--                                                        <thead>--}}
{{--                                                        <tr>--}}

{{--                                                            <th class="text-center"> Address </th>--}}
{{--                                                            <th class="text-center"> Phone </th>--}}



{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody class="body_for_courier_info text-center" >--}}

{{--                                                        </tbody>--}}
{{--                                                    </table>--}}
                                                </div>
                                            </div>
                                            <!--button-->
{{--                                            <div class="form-actions" style="display: none">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-offset-3 col-md-9">--}}
{{--                                                        <button type="submit" class="btn btn-circle green">Add</button>--}}
{{--                                                        --}}{{--                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </form>
                                        <div class="form_data_for_debrief" style="display: none" >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >

                                                <thead>

                                                <tr>
                                                    <th class="text-center">#</th>

                                                    <th class="text-center"> Tracking Number </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Area </th>
                                                    <th class="text-center"> Client </th>
                                                    <th class="text-center"> Seller </th>
                                                    <th class="text-center"> Price </th>
                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products_assign">
                                                </tbody>
                                            </table>

                                           @if(auth()->user()->type=='accountant' || auth()->user()->type =='admin' || auth()->user()->type =='operator' )
                                                <div class="confirm_assign_order_div">
                                                    <button class="btn blue confirm_assign_order_btn"> End Debrief </button>
                                                    <button class="btn btn-small btn-file" id="excel_form_btn"> Export As Excel </button>

{{--                                                    <button class="btn blue print_debrief_btn"> print </button>--}}
                                                </div>
                                               @endif
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
        window.onpageshow = function()
        {
            $('.courier_select option[value="0"]').attr('selected','selected');

            $('.area_changed option[value="0"]').attr('selected','selected');
        }
        $(document).on('change','.area_changed',function(){
            var areaId = document.querySelector('.area_changed').value ;

            if(parseInt(areaId))
            {
                $('.courier_select').removeAttr('disabled');
                $.ajax({
                    type: 'POST',
                    url: "/admin/getCouriersForThisArea/"+areaId,
                    data: {
                        '_token':"{{csrf_token()}}",
                    },
                    success: function (data) {
                        if(data.NoCouriers)
                        {
                            $('.courier_select').empty().prepend(` <option value="0">Courier Name </option>`)

                            for (var key in data.couriers)
                            {
                                $('.courier_select').append(`<option  value="${data.couriers[key].id}">${data.couriers[key].name}</option>`)
                            }
                            $('.courier_select').removeAttr('disabled');
                            $('.courier_select option[value="-1"]').remove();
                        }
                        else
                        {
                            $('.form_data_for_debrief').slideUp();
                            $('.table_for_courier_data').slideUp();
                            $('.courier_select').attr('disabled','disabled').prepend('<option value="-1" selected>No couriers In This Area</option>');
                        }

                    }, error: function (reject) {


                    }
                });
            }
            else{
                $('.form_data_for_debrief').slideUp();
                $('.table_for_courier_data').slideUp();
                $('.courier_select option[value="0"]').attr('selected','selected');
                $('.courier_select option[value="-1"]').remove();
                $('.courier_select').attr('disabled','disabled');
            }

        });
        $(document).on('change','.courier_select',function(){
     //       var table = $('#sample_2').DataTable();
//clear datatable
       //     table.clear().draw();
            // $('.form_data_assign').slideUp();
            var courier_id = document.querySelector('.courier_select').value ;
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products_assign').empty() ;
            if(parseInt(courier_id))
            {
                // get all products for this courier in this area
                $.ajax({
                    type:"post",
                    url:"/admin/courier-debrief/"+courier_id,
                    data:{
                        "_token":"{{csrf_token()}}",

                    },
                    success:function(data)
                    {
                        $('.body_for_products_assign').empty().html(data).

                        append(`<tr class="sub_row"> <td class="text-center" colspan="3">Sum</td>  <td class="text-center total_here" colspan="3">  ${parseFloat($('.form_data_here').data('sum_price'))} EGP </td> <td class="text-center shipping_price_here"></td> </tr>`);
                        $('.confirm_assign_order_btn').css('display','inline-block');
                        $('#excel_form_btn').css('display','inline-block');
                       const excel_ids = $('.form_data_here').last().data('barcodes_id');
                     //  console.log(excel_ids)
                       const courier_name = $('.courier_select option:selected').text();
                        $('#excel_ids_form_here').html(`<form style="display:none" method="post" id="excel_form_form" action="{{Route('courier.debrief.excel')}}">
<input value="${excel_ids}" name="barcodes_ids" >
<input value="${courier_name}" name="courier_name" >
<input type="hidden" name="_token" value="${$('#our_token').attr('value')}">
</form>
`)
                        if($('tr').hasClass('no_data_available_row'))
                        {
                            $('.sub_row').remove();
                            $('.confirm_assign_order_btn').css('display','none');
                            $('#excel_form_btn').css('display','none');
                        }
                        $('.form_data_for_debrief').slideDown();
                        if ($('.form_data_here').data('end_debrief'))
                        {
                            $('.confirm_assign_order_btn').removeAttr('disabled');
                        }
                        else{
                            $('.confirm_assign_order_btn').attr('disabled','disabled');
                        }
                    },
                });
            }
            else{
                $('.form_data_for_debrief').slideUp();
                $('.table_for_courier_data').slideUp();
                $('.sub_row').remove();

            }
        });
        // $('.print_debrief_btn').on('click',function(event){
        //
        //
        //     window.print();
        // });

        window.onafterprint = function(){
          //  console.log("Printing completed...");
            $.ajax({
                type:"post",
                url:"/admin/end_courier_debrief/"+$('.courier_select').val() ,
                data:{
                    "_token":"{{csrf_token()}}"
                },
                success:function(data){
                   $('#flashMessageModal').modal('show');


                }
            })

        }
        $('.confirm_assign_order_btn').on('click',function(){
            window.print();
        });
        $('#flashMessageModal').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
        $(document).on('click','#excel_form_btn',function(){
            $('#excel_form_form').submit();
            //   console.log('good');

        });



    </script>
@endsection
