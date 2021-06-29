@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <i class="fa fa-gift"></i>Receive Orders</div>
                                    </div>
                                    <div class="portlet-body form courier_form_data">
                                        <!-- BEGIN FORM-->
                                        <form   class="form-horizontal" onsubmit="return false;">
                                            <div class="form-body">
                                                <!--country_id-->
                                                <div class="row ">
                                                    <div class="form-group ">

                                                        <div class="col-xs-9 ">
                                                            <input id="receive_barcode_input" type="text" class="receive_barcode_input form-control" placeholder="Tracking Number">
                                                        </div>
                                                    </div>
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
                                        <div class="form_data_receive_order" style="display: none" >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Tracking Number </th>
                                                    <th class="text-center"> Current Status </th>
                                                    <th class="text-center"> Client Name </th>
                                                    <th class="text-center"> Price </th>
                                                    <th class="text-center"> Hub </th>
                                                    <th class="text-center"> Area </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> Seller </th>
                                                </tr>
                                                </thead>
                                                <tbody class="body_for_valid_tracking_number">
                                                </tbody>


                                            </table>
                                            <div class="confirm_receive_order_div">
                                                <button class="btn blue confirm_receive_order_btn"> Confirm </button>

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
        var order = 0 ;
        $('#receive_barcode_input').on({
                focus:function(){
                    $(this).removeAttr('placeholder');
                },
                blur:function(){
                    $(this).attr('placeholder','Tracking Number');
                },
                change: function(){
                    var trackingNo = $(this).val();

                    $.ajax({
                        // item for receive may be [created - scheduling - canceled]
                        type: 'POST',
                        url: "/admin/CheckItemTrackingNumberForReceiving/"+trackingNo,
                        data: {
                            '_token':"{{csrf_token()}}",
                        },
                        success: function (data) {
                           if(data.status)
                           {

                               $('.form_data_receive_order').slideDown();
                               if(!$('.body_for_valid_tracking_number tr').hasClass(`barcode_no_${data.items[0].barcode_number}`))
                               {
                                   $('.body_for_valid_tracking_number').append(
                                       `<tr style="text-align: center" class="row_for_receive_order barcode_no_${data.items[0].barcode_number}" data-barcodeNo="${data.items[0].barcode_number}">
<td class="td_for_receive_order" > ${++order} </td>
<td> ${data.items[0].barcode_number} </td>
<td> ${data.items[0].status} </td>
<td> ${data.items[0].client_name} </td>
<td> ${data.items[0].price} EGP </td>
<td> ${data.items[0].hub_name}  </td>
<td> ${data.items[0].area_name}  </td>
<td> ${data.items[0].address}  </td>
<td> ${data.items[0].seller_name}  </td>
</tr>`
                                   );
                               }
                               else{
                                   alert('This Shipping Has Been Received Before ');

                               }
                               $('#receive_barcode_input').val('');
                              }



                           else{

                               $('#exampleModal').modal('show')
                               $('#receive_barcode_input').val('');
                           }
                        }, error: function (reject) {
                        }
                    })

                }
            });

        $(document).on('click','.confirm_receive_order_btn',function(){
            var barcodes = [];
            $('.row_for_receive_order').each(function(index,value){
                barcodes.push(value.getAttribute('data-barcodeNo'));
            })
// console.log(barcodes)
            $.ajax({
                // item for receive may be [created - scheduling - canceled]
                type: 'POST',
                url: "/admin/makeAsReceived/"+barcodes,
                data: {
                    '_token':"{{csrf_token()}}",
                },
                success: function (data) {
                    if(data.status)
                    {

                window.location.reload();

                    }

                    else{

                        $('#exampleModal').modal('show')
                    }
                }, error: function (reject) {
                }
            })




        //    console.log($('.row_for_receive_order').eq(0).attr('data-barcodeNo'))
        });

        // on change [???] barcode ?
        {{--$(document).on('change','#receive_barcode_input',function(){--}}
        {{--    var trackingNo = $(this).val();--}}

        {{--    $.ajax({--}}
        {{--        // item for receive may be [created - scheduling - canceled]--}}
        {{--                    type: 'POST',--}}
        {{--                    url: "/admin/getItemData/"+trackingNo,--}}
        {{--                    data: {--}}
        {{--                        '_token':"{{csrf_token()}}",--}}
        {{--                    },--}}
        {{--                    success: function (data) {--}}
        {{--                      //  document.querySelector('.form_data').innerHTML = data ;--}}
        {{--                    }, error: function (reject) {--}}
        {{--                    }--}}
        {{--                });--}}


        {{--})--}}



    </script>



    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
