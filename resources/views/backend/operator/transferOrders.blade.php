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
                                            <i class="fa fa-gift"></i>Transfer Orders</div>
                                    </div>
                                    <div class="portlet-body form courier_form_data">
                                        <!-- BEGIN FORM-->
                                        <form class="form-horizontal" onsubmit="return false;">
                                            <div class="form-body">
                                                <!--country_id-->
                                                <div class="row ">
                                                    <div class="form-group ">
                                                        <div class="col-xs-9 ">
                                                            <input id="receive_barcode_input" type="text" class="receive_barcode_input form-control" placeholder="Tracking Number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row areas_div" style="display: none">
                                                    <div class="form-group ">
                                                        <div class="col-xs-4 ">
                                                            <label for="from_area_input"> From </label>
                                                            <input id="from_area_input" class="form-control"  type="text" name="selected_from_area" value="cairo" disabled>
{{--                                                            <select disabled id="from_area_input" class="from_area_input_class form-control" >--}}
{{--                                                                <option value="" name="selected_from_area" disabled selected> from here </option>--}}
{{--                                                            </select>--}}
                                                        </div>
                                                        <div class="col-xs-4 ">
                                                            <label for="to_area_input"> To </label>
                                                            <select  id="to_area_input" class="to_area_input_class form-control" >
                                                                <option value="" name="selected_to_area" > Select Area </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-xs-2 ">
                                                            <label style="visibility: hidden"> asdasd</label>
                                                           <button disabled style="display: inherit;" class="add_transfer_order_btn btn green" >Add </button>
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
                                        <div class="form_data_transfer_order" style="display: none" >
                                            <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                <thead class="add_new_transfer_row">
                                                <tr>

                                                    <th class="text-center"> Tracking Number </th>
                                                    <th class="text-center"> Seller </th>
                                                    <th class="text-center"> From </th>
                                                    <th class="text-center"> To </th>
                                                    <th class="text-center"> Remove </th>

                                                </tr>
                                                </thead>
                                                <tbody class="body_for_valid_tracking_number">
                                                </tbody>


                                            </table>
                                            <div class="confirm_receive_order_div">
                                                <button class="btn blue confirm_transfer_orders_btn"> Transfer </button>

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
               // console.log(trackingNo)
                if(trackingNo.length)
                {  $.ajax({
                    type: 'POST',
                    url: "/admin/CheckItemTrackingNumberForTransfer/"+trackingNo,
                    data: {
                        '_token':"{{csrf_token()}}",
                    },
                    success: function (data) {
                        if(data.status)
                        {
                            $('.add_transfer_order_btn').attr('disabled','disabled');
                          $('#from_area_input').val(`${data.from_area.name}`);

                            $('#to_area_input').empty().append(`
                                <option value="0"  selected> Select Area </option>
                            `);
                        for (const key in data.to_areas)
                        {
                            $('#to_area_input').append(`
                                    <option value="${data.to_areas[key].id}" > ${data.to_areas[key].name} </option>
                               `);
                        }
                            $('.areas_div').slideDown();
                        }
                        else{
                           $('.areas_div').slideUp();
                            $('.add_transfer_order_btn').attr('disabled','disabled');
                            $('#exampleModal').modal('show')
                        }
                    }, error: function (reject) {
                    }
                })



                }



            },
            {{--keyup: function(){--}}
            {{--    var trackingNo = $(this).val();--}}
            {{--    // console.log(trackingNo)--}}
            {{--    if(trackingNo.length)--}}
            {{--    {  $.ajax({--}}
            {{--        type: 'POST',--}}
            {{--        url: "/admin/CheckItemTrackingNumberForTransfer/"+trackingNo,--}}
            {{--        data: {--}}
            {{--            '_token':"{{csrf_token()}}",--}}
            {{--        },--}}
            {{--        success: function (data) {--}}
            {{--            if(data.status)--}}
            {{--            {--}}
            {{--                $('#from_area_input').val(`${data.from_area.name}`);--}}
            {{--                $('#to_area_input').empty().append(`--}}
            {{--                    <option value="0"  selected> Select Area </option>--}}
            {{--                `);--}}
            {{--                for (const key in data.to_areas)--}}
            {{--                {--}}
            {{--                    $('#to_area_input').append(`--}}
            {{--                        <option value="${data.to_areas[key].id}" > ${data.to_areas[key].name} </option>--}}
            {{--                   `);--}}
            {{--                }--}}
            {{--                $('.areas_div').slideDown();--}}
            {{--            }--}}
            {{--            else{--}}
            {{--                $('.areas_div').slideUp();--}}
            {{--                $('.add_transfer_order_btn').attr('disabled','disabled');--}}
            {{--                $('#exampleModal').modal('show')--}}
            {{--            }--}}
            {{--        }, error: function (reject) {--}}
            {{--        }--}}
            {{--    })--}}



            {{--    }--}}



            {{--}--}}
        });
/////////////////

        $('#to_area_input').on('change',function(){
            var selectedToAreaId = $(this).val() ;
           if(parseInt(selectedToAreaId))
           {
               $('.add_transfer_order_btn').removeAttr('disabled');
           }
           else{
               $('.add_transfer_order_btn').attr('disabled','disabled');

           }
        });
        //////////

        $(document).on('click','.add_transfer_order_btn',function(event){
            event.preventDefault();
            $.ajax({
                type:'post',
                url:'/admin/getProductInfo/'+$('.receive_barcode_input').val() ,
                data:{
                    '_token':"{{csrf_token()}}",
                },
                success:function(data)
                {
                    if($('.add_new_transfer_row tr').hasClass(`row_for_transfer_order${data.info.barcode_number}`))
                    {
                        alert('this item already exist') ;

                    }
                    else{
                        var selectedOption = $('#to_area_input').val();
                        var ToArea = $(`#to_area_input option[value =${selectedOption}]`).text().trim() ;

                        var FromArea = $('#from_area_input').val();

                        $('.add_new_transfer_row').append(`
                   <tr data-barcode_no="${data.info.barcode_number}" class="row_for_transfer_order${data.info.barcode_number} text-center row_for_transfer_order_class" >  <td> ${data.info.barcode_number} </td>
<td> ${data.info.seller_name} </td>  <td> ${FromArea} </td>  <td class="to_area_class${data.info.barcode_number}" data-area-id="${selectedOption}">  ${ToArea} </td>  <td>
<i style="color: red;cursor: pointer" class="delete_new_transfer_order fa fa-remove fa-lg"  data-barcode_no="${data.info.barcode_number}"></i>
</td> </tr>
                    `);
                        $('.form_data_transfer_order').slideDown();
                    }



                }
            })
            //    console.log($('.row_for_receive_order').eq(0).attr('data-barcodeNo')) ;

        });
        $(document).on('click','.delete_new_transfer_order',function(){
            var barcode = $(this).data('barcode_no');
            $('.row_for_transfer_order'+barcode).remove();
            if(!$('.delete_new_transfer_order').length)
                $('.form_data_transfer_order').slideUp();

        });
        $(document).on('click','.confirm_transfer_orders_btn',function(){
            var barcodes = [];
            $('.add_new_transfer_row tr.row_for_transfer_order_class').each(function(index,val){
                var area_id = $('.to_area_class'+val.getAttribute('data-barcode_no')).data('area-id') ;

                $obj = {
                    area:area_id ,
                    barcode_no:val.getAttribute('data-barcode_no')
                };
             //   console.log($obj);
                barcodes.push($obj);

            })
            // console.log()
            // var obj = barcodes.reduce(function(obj, value) {
            //     obj[value] = value;
            //     return obj
            // }, {});
            // console.log(obj)

            $.ajax({
                type:'post',
                url:'/admin/markAsTransfer/',
                data:{
                    '_token':"{{csrf_token()}}",
                    'data':barcodes
                } ,
                success:function(data){
                    window.location.reload();
                }
            })





            //    console.log($('.row_for_receive_order').eq(0).attr('data-barcodeNo'))
        });





    </script>



    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
