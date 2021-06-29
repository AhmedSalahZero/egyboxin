@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    @include('layouts.toaster')


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
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Return To Seller</div>
                                    </div>
                                    <div class="portlet-body form assign_to_courier_data">
                                        <!-- BEGIN FORM-->
                                        <form class="form-horizontal" onsubmit="return false;">
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
                                                        <div class="col-xs-4 receive_barcode_input_assign_div" style="display: none">
                                                            <input id="receive_barcode_input_assign" type="text" class="receive_barcode_input_assign form-control" placeholder="Tracking Number">
                                                        </div>
                                                    </div>
                                                    <table class="table table-striped table-bordered table-hover table-header-fixed table_for_courier_data" style="display: none">
                                                        <thead>
                                                        <tr>

                                                            <th class="text-center"> Address </th>
                                                            <th class="text-center"> Phone </th>



                                                        </tr>
                                                        </thead>
                                                        <tbody class="body_for_courier_info text-center" >

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--button-->
                                            <div class="form-actions" style="display: none">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-circle green">Add</button>
                                                        {{--                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form_data_assign" style="display: none" >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Tracking Number </th>
                                                    <th class="text-center"> Previous Status </th>
                                                    <th class="text-center"> Current Status </th>
                                                    <th class="text-center"> Client Name </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> Phone </th>
                                                    <th class="text-center"> Price </th>
                                                    <th class="text-center"> Area </th>

                                                    <th class="text-center"> Seller </th>
                                                    <th class="text-center"> Remove </th>
                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products_assign">



                                                </tbody>
                                            </table>

                                            <div class="confirm_assign_order_div">
                                                <button class="btn blue confirm_assign_order_btn"> Return </button>

                                            </div>

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
                            $('.form_data_assign').slideUp();
                            $('.table_for_courier_data').slideUp();
                            $('.courier_select').attr('disabled','disabled').prepend('<option value="-1" selected>No couriers In This Area</option>');
                        }

                    }, error: function (reject) {


                    }
                });
            }
            else{
                $('.form_data_assign').slideUp();
                $('.table_for_courier_data').slideUp();

                $('.courier_select option[value="0"]').attr('selected','selected');
                $('.courier_select option[value="-1"]').remove();
                $('.courier_select').attr('disabled','disabled');
            }
            $('.receive_barcode_input_assign_div').hide()
        });
        $(document).on('change','.courier_select',function(){
            var table = $('#sample_2').DataTable();

//clear datatable
            table.clear().draw();
            // $('.form_data_assign').slideUp();
            var courier_id = document.querySelector('.courier_select').value ;
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products_assign').empty() ;
            $('.receive_barcode_input_assign').val('') ;
            if(parseInt(courier_id))
            {


                $('.receive_barcode_input_assign_div').show()
            }
            else{
                $('.receive_barcode_input_assign_div').hide();
                $('.form_data_assign').slideUp();
                $('.table_for_courier_data').slideUp();
            }
        });
        $(document).on('change','#receive_barcode_input_assign',function(){
            var trackingNo = $(this).val();
            var order = 0 ;

            $.ajax({
                // item for receive may be [created - scheduling - canceled]
                type: 'POST',
                url: "/admin/CheckItemTrackingNumberForReturnToSeller/"+trackingNo,
                data: {
                    '_token':"{{csrf_token()}}",
                },
                success: function (data) {
                    if(data.status)
                    {
                        $('.form_data_assign').slideDown();
                        if(! $('.body_for_products_assign tr').hasClass(`delete_assign_row_${data.items[0].barcode_number}`))
                        {

                            $('.body_for_products_assign').append(
                                `<tr style="text-align: center" class="row_for_receive_order delete_assign_row_${data.items[0].barcode_number}" data-barcodeNo="${data.items[0].barcode_number}">
<td class="td_for_receive_order" > ${++order} </td>
<td> ${data.items[0].barcode_number} </td>
<td>

${  data.items[0].previous_status }

</td>
<td> ${data.items[0].status} </td>
<td> ${data.items[0].client_name} </td>
<td> ${data.items[0].address}  </td>
<td> ${data.items[0].phone}  </td>
<td> ${data.items[0].price} EGP </td>
<td> ${data.items[0].country_id}  </td>

<td> ${data.items[0].seller_id}  </td>
<td >
<i style="cursor: pointer;color: red" class="fa fa-remove red fa-lg delete_assign" data-barcode_number="${data.items[0].barcode_number}">

</td>

</tr>`
                            );
                        }
                        else{
                            alert('This Shipping Already Assigned To This Courier');

                        }
                        $('#receive_barcode_input_assign').val('');


                    }

                    else{

                        $('#exampleModal2').modal('show')
                    }
                }, error: function (reject) {
                }
            })

        })
        $(document).on('click','.delete_assign',function(event){
            event.preventDefault();
            var barcode_number = $(event.target).data('barcode_number') ;
            var delete_assign_row_ = $(`.delete_assign_row_${barcode_number}`).remove();
            if(! $('.row_for_receive_order').length)
            {
                $('.form_data_assign').slideUp();
                $('.table_for_courier_data').slideUp();
                $('.receive_barcode_input_assign').val('');
            }
        });
        $(document).on('click','.confirm_assign_order_btn',function(){
            var courier_id = document.querySelector('.courier_select').value ;
            var elements = [];
            $('.row_for_receive_order').each(function(index , value ){
                elements.push(value.getAttribute('data-barcodeNo'));
            });
            $.ajax({
                url:"/admin/assignToUserToReturn/"+elements+'/'+courier_id ,
                type:"post",
                data:{
                    '_token':"{{csrf_token()}}",
                },
                success:function(data){
                    window.location.reload();
                },
            })
        });
    </script>

    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
