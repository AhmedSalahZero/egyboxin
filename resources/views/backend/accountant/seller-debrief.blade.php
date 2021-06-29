@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />
    <style>
    @media print
    {
        .confirm_assign_order_btn , .print_debrief_btn,.courier_select,.area_changed,.details_hidden
        {
            display: none;
        }
        .caption_hide ,.discount_class
        {
            display: none;
        }

        .display_on_print
        {
            display: block !important;
        }
        .confirm_assign_order_div
        {
            display: none;

        }

    }

    </style>

@endsection

@section('content')

    @include('layouts.toaster')
    <div style="display: none" id="excel_ids_form_here">

    </div>
    <div class="modal fade" id="paymentMethodMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please Select Payment Method
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
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
                    Seller Debrief Has Been Ended Successfully
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
                                    <table class="table table-bordered">
                                        <thead>
                                       <tr>
                                           <th class="text-center"> Hub </th>
                                           <th class="text-center">Seller Name</th>
                                           <th class="text-center">Date</th>
                                           <th class="text-center"> Discount </th>

                                       </tr>
                                        </thead>
                                        <tbody>
                                      <tr>
                                          <td class="text-center seller_area_td"></td>
                                          <td class="seller_name_td text-center"></td>
                                          <td class="text-center">{{date('l , d F Y ' , strtotime(now()))}}</td>
                                          <td class="text-center discount_td">0 </td>

                                      </tr>
                                        </tbody>
                                    </table>
                                    <h4 style="display: inline-block;float: right"></h4>

                                </div>

                                <div class="portlet box green">


                                    <div class="portlet-title">


                                        <div class="caption caption_hide">
                                            <i class="fa fa-gift"></i> Seller Debrief</div>
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

                                                                <option value="0">Seller Name </option>

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
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" id="xyzs">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Area </th>
                                                    <th class="text-center"> No </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Price </th>
                                                    <th class="text-center"> Shipping Price </th>
                                                    <th class="text-center details_hidden"> Details </th>

                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products_assign">
                                                </tbody>
                                            </table>

                                           @if(auth()->user()->type=='accountant' || auth()->user()->type =='admin'  )
{{--                                                <button onclick="exportTableToExcel('xyzs', 'members-data')">Export Table Data To Excel File</button>--}}

                                                <div class="confirm_assign_order_div">
                                                    <button class="btn btn-small blue confirm_assign_order_btn"> End Debrief </button>
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
                    url: "/admin/getSellerForThisArea/"+areaId,
                    data: {
                        '_token':"{{csrf_token()}}",
                    },
                    success: function (data) {

                        if(data.NoSellers)
                        {
                            $('.courier_select').empty().prepend(` <option value="0">Seller Name </option>`)

                            for (var key in data.sellers)
                            {
                                $('.courier_select').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name}</option>`)
                            }
                            $('.courier_select').removeAttr('disabled');
                            $('.courier_select option[value="-1"]').remove();
                        }
                        else
                        {
                            $('.form_data_for_debrief').slideUp();
                            $('.table_for_courier_data').slideUp();
                            $('.courier_select').attr('disabled','disabled').prepend('<option value="-1" selected>No sellers In This Area</option>');
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
            var Seller_id = document.querySelector('.courier_select').value ;
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products_assign').empty() ;
            if(parseInt(Seller_id))
            {
                // get all products for this courier in this area
                $.ajax({
                    type:"post",
                    url:"/admin/seller-debrief/"+Seller_id,
                    data:{
                        "_token":"{{csrf_token()}}",

                    },
                    success:function(data)
                    {



                        $('.body_for_products_assign').empty().html(data).
                        append(`<tr class="sub_row"> <td class="text-center" colspan="4">Sum</td>  <td class="text-center total_here">  ${parseFloat($('.form_data_here').data('sum_price'))} EGP </td> <td class="text-center shipping_price_here"></td> </tr>`);


                        $('.form_data_for_debrief').slideDown();
                        let totalShippingPrice =0 ;
                        $('.shipping_status').each(function(key , shippingPriceRow){
                            totalShippingPrice += parseFloat($(shippingPriceRow).data('shipping_price'));

                        })
                       $('.shipping_price_here').text(totalShippingPrice + ' EGP');
                        $('.body_for_products_assign').append(`
                        <tr class="total_amount_class">

<td class="text-center " colspan="4"> Total  </td>  <td  class="text-center " data-total="${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   }" data-original_total="${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   }" colspan="2">
${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   } EGP

</td>
<td > </td>
</tr>

<tr class="discount_class">
<td class="text-center" colspan="4"> Discount </td>

<td colspan="2" class="text-center">
<input id="discount_input" type="number" class="form-control" >
</td>


</tr>
           <tr class="total_amount_class">

<td class="text-center " colspan="4"> Total Amount </td>  <td  class="text-center total_price_x" data-total="${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   }" data-original_total="${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   }" colspan="2">
${  parseFloat($('.form_data_here').data('sum_price')) - totalShippingPrice   } EGP

</td>
<td > </td>
</tr>

<tr class="payment_method_class">
<td class="text-center" colspan="4"> PaymentMethod </td>

<td id="payment_method_id" colspan="2" class="text-center">
<select class="form-control payment_method" name="payment_method">
<option  value="0" selected>Select Payment Method</option>
<option  value="cash">Cash</option>
<option value="fawry">Fawry</option>
<option value="visa">Visa</option>
</select>

</td>
</tr>

                        `);
                        let seller_name = $('.form_data_here').data('seller_name') ;
                        let seller_hub = $('.form_data_here').data('country_name') ;
                        const excel_ids = $('.excel_ids').last().data('ids_value') ;
                        // console.log('ids '+excel_ids);
                        // console.log('seller '+seller_name);


                        $('#excel_ids_form_here').html(`<form style="display:none" method="post" id="excel_form_form" action="{{Route('seller.debrief.excel')}}">
<input value="${excel_ids}" name="barcodes_ids" >
<input value="${seller_name}" name="seller_name" >
<input type="hidden" name="_token" value="${$('#our_token').attr('value')}">
</form>`)
                    //    console.log(excel_ids)

                     $('.seller_name_td').html(seller_name);
                        $('.seller_area_td').html(seller_hub);
                        $('.confirm_assign_order_btn').css('display','inline-block');
                        $('#excel_form_btn').css('display','inline-block');

                        if($('tr').hasClass('no_data_available_row'))
                        {
                            $('.sub_row,.total_amount_class,.discount_class,.payment_method_class').remove();
                            $('.confirm_assign_order_btn').css('display','none');
                            $('#excel_form_btn').css('display','none');

                        }
                   //     console.log(parseFloat($('.form_data_here').data('sum_price')))
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
            }
        });
        window.onafterprint = function(){
            // console.log("Printing completed...");
            let paymentMethod = $('.payment_method').val();
            let discount = 0;
            let mainPrice =  $('.total_price_x').data('original_total') ;
          //  console.log(mainPrice);
          //  alert('x');

             if($('#discount_input').val())
             {
                  discount = $('#discount_input').val() ;
             }
           //  console.log(discount);

//            alert('gppd');

            $.ajax({
                type:"post",
                url:"/admin/end_seller_debrief/"+$('.courier_select').val() ,
                data:{
                    "_token":"{{csrf_token()}}",
                    'paymentMethod':paymentMethod,
                    'discount':discount,
                    'mainPrice':mainPrice

                },
                success:function(data){
                    $('#flashMessageModal').modal('show');
                }
            })
        }
        $('.confirm_assign_order_btn').on('click',function(){
            let paymentMethod = $('.payment_method').val();
            if(paymentMethod != 0)
            {

                     window.print();
            }
            else{
                $('#paymentMethodMessage').modal('show');
            }
        })
        $(document).on('keyup','#discount_input',function(){
            // console.log(typeof ($('.total_price_x').data('original_total')));
           let priceAfterDiscount = $('.total_price_x').data('original_total') + parseInt($(this).val()) ;
          // console.log(priceAfterDiscount);
             $('.total_price_x').data('total',priceAfterDiscount).text(priceAfterDiscount + ' EGP')
            if($(this).val() != 0)
            {
                $('.discount_td').html($(this).val()+' EGP');
            }
                else{
                $('.discount_td').html(+'0');
            }



        })
        $('#flashMessageModal').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
        $(document).on('click','#excel_form_btn',function(){
           $('#excel_form_form').submit();
        //   console.log('good');

        });
        window.onbeforeprint = function()
        {
            const payment = $('.payment_method').val()
            $('#payment_method_id').empty().append(`${payment}`);
        }
    </script>
    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
