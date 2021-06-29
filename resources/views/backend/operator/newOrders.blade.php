@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
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
                                            <i class="fa fa-gift"></i>New Orders </div>
                                    </div>
                                    <div class="portlet-body form courier_form_data">
                                        <!-- BEGIN FORM-->
                                        <form  class="form-horizontal">

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
{{--                                                        <div class="col-md-3">--}}
{{--                                                            <select class="seller_select form-control input-circle" name="courier_id" disabled>--}}

{{--                                                                <option value="0">Seller Name </option>--}}

{{--                                                                --}}{{-- Ajax Here --}}

{{--                                                            </select>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-1">--}}
{{--                                                            <input type="number" class="number_of_products_in_this_area_to_this_seller form-control" value="0" readonly>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-3">--}}
{{--                                                            <button class="button blue btn pull-right show_products_btn" disabled> Details </button>--}}
{{--                                                        </div>--}}




                                                    </div>
{{--                                                    <table class="table table-striped table-bordered table-hover table-header-fixed table_for_seller_data" style="display: none">--}}
{{--                                                        <thead>--}}
{{--                                                        <tr>--}}

{{--                                                            <th class="text-center"> Address </th>--}}
{{--                                                            <th class="text-center"> Phone </th>--}}



{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody class="body_for_seller_info text-center" >--}}

{{--                                                        </tbody>--}}
{{--                                                    </table>--}}



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
                                        <div class="form_data" style="display: none" >


                                            <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> Seller Name </th>
                                                    <th class="text-center"> Address </th>
                                                    <th class="text-center"> Phone </th>
                                                    <th class="text-center"> No </th>
                                                    <th class="text-center"> Details </th>



                                                </tr>
                                                </thead>
                                                <tbody class="body_for_products">



                                                </tbody>
                                            </table>



                                        </div>

                                       <div class="">
                                           <h3 class="text-center" style="display: none;margin-bottom: 10px" id="no_shipments_id">
                                               No Created Shipments In This Area
                                           </h3>

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

        $(document).on('change','.area_changed',function(){
            var table = $('#sample_2').DataTable();

            table.clear().draw();
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products').empty() ;
            $.ajax({
                type: 'POST',
                url: "/admin/getAllCreatedShipmentsForThisArea/"+areaId,
                data: {
                    '_token':"{{csrf_token()}}",
                },
                success: function (data) {
                    $('.body_for_products').slideDown();
                    if(data.NoProductsInThisArea)
                    {
                        $('.body_for_products').empty() ;
                        let order = 0 ;
                        for (var key in data.productsInThisArea)
                        {
                      //   console.log(data.productsInThisArea[key]);
                            let sellerName = key.split(',')[0] ;
                            let phone = key.split(',')[1];
                            let address = key.split(',')[2];
                            let noProducts = data.productsInThisArea[key].length ;
                            var table = $('#sample_2').DataTable();
                            let start = `<div class="modal fade" id="details_model${phone+sellerName+noProducts}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <table class="table table-bordered">

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
                                    ` ;
                            let single  = '';
                         //   console.log( data.productsInThisArea)
for(let ind in data.productsInThisArea[key])
{

    single +=                             `<tr>
        <td class="text-center " >${data.productsInThisArea[key][ind].barcode_number}</td>
        <td class="text-center">${data.productsInThisArea[key][ind].client_name}</td>
        <td class="text-center">${data.productsInThisArea[key][ind].address}</td>
        <td class="text-center">${data.productsInThisArea[key][ind].sub_area_name}</td>
        <td class="text-center">

        ${data.productsInThisArea[key][ind].price} EGP

        </td>
        <td class="text-center">
          ${data.productsInThisArea[key][ind].shipping_price} EGP

        </td>
    </tr>`



}
let reset = `
</tbody>
</table>
</div>
<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>`;
let fullModel = '';
 fullModel = start + single + reset ;


                            table.row.add([
                                `${++order}`,
                                `${sellerName}`,
                                `${address}`,
                                `${phone} `,
                                `${noProducts}`,
                                `
${fullModel}

<button  data-toggle="modal" data-target="#details_model${phone+sellerName+noProducts}" class="btn btn-primary btn-circle"> Details </button>
`,
                            ]).draw(false);
                        }
                     //   console.log('show');
                        $('.form_data').slideDown();
                        $('#no_shipments_id').hide();

                    //    $('.number_of_products_in_this_area_to_this_seller').val(data.NoProductsInThisArea)

                    }
                    else
                    {
                       // console.log('hide');
                        $('.form_data').slideUp();
                        $('#no_shipments_id').slideDown();




                    //    $('.show_products_btn').attr('disabled','disabled');
                   //     $('.number_of_products_in_this_area_to_this_seller').val(0)
                    }


                }, error: function (reject) {


                }
            });
            // if(parseInt())
            // {
            //
            //
            //
            //
            // }
            // else{
            //     $('.form_data').slideUp();
            //     $('.table_for_seller_data').slideUp();
            //     $('.number_of_products_in_this_area_to_this_seller').val(0)
            //     $('.show_products_btn').attr('disabled','disabled');
            // }
        });
        $(document).on('click','.show_products_btn',function(e){
            e.preventDefault();
            $('.form_data').slideDown();
        })

    </script>
    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
















































































































{{-- Old One --}}
{{--@extends('layouts.admin')--}}

{{--@section('css')--}}
{{--    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />--}}

{{--    @endsection--}}
{{--@section('content')--}}
{{--            <!-- BEGIN CONTENT -->--}}
{{--            <div class="page-content-wrapper">--}}
{{--                <!-- BEGIN CONTENT BODY -->--}}
{{--                <div class="page-content">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="tabbable-line boxless tabbable-reversed">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" id="tab_0">--}}
{{--                                        <div class="portlet box green">--}}
{{--                                            <div class="portlet-title">--}}
{{--                                                <div class="caption">--}}
{{--                                                    <i class="fa fa-gift"></i>New Orders </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="portlet-body form courier_form_data">--}}
{{--                                                <!-- BEGIN FORM-->--}}
{{--                                                <form  class="form-horizontal">--}}

{{--                                                    <div class="form-body">--}}
{{--                                                        <!--country_id-->--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="form-group ">--}}
{{--                                                                <div class="col-md-3">--}}
{{--                                                                    <select class="area_changed form-control input-circle" name="status">--}}
{{--                                                                        <option value="0"> Select Area </option>--}}
{{--                                                                        @foreach($areas as $area)--}}
{{--                                                                            <option  value="{{$area->id}}">{{$area->name}}</option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-3">--}}
{{--                                                                    <select class="seller_select form-control input-circle" name="courier_id" disabled>--}}

{{--                                                                        <option value="0">Seller Name </option>--}}

{{--                                                                       --}}{{-- Ajax Here --}}

{{--                                                                    </select>--}}
{{--                                                                </div>--}}

{{--                                                                <div class="col-md-1">--}}
{{--                                                                    <input type="number" class="number_of_products_in_this_area_to_this_seller form-control" value="0" readonly>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="col-md-3">--}}
{{--                                                                   <button class="button blue btn pull-right show_products_btn" disabled> Show </button>--}}
{{--                                                                </div>--}}




{{--                                                            </div>--}}
{{--                                                            <table class="table table-striped table-bordered table-hover table-header-fixed table_for_seller_data" style="display: none">--}}
{{--                                                                <thead>--}}
{{--                                                                <tr>--}}

{{--                                                                    <th class="text-center"> Address </th>--}}
{{--                                                                    <th class="text-center"> Phone </th>--}}



{{--                                                                </tr>--}}
{{--                                                                </thead>--}}
{{--                                                                <tbody class="body_for_seller_info text-center" >--}}

{{--                                                                </tbody>--}}
{{--                                                            </table>--}}



{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                    <!--button-->--}}
{{--                                                    <div class="form-actions" style="display: none">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-offset-3 col-md-9">--}}
{{--                                                                <button type="submit" class="btn btn-circle green">Add</button>--}}
{{--                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                                <div class="form_data" style="display: none" >--}}


{{--                                                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">--}}
{{--                                                        <thead>--}}
{{--                                                        <tr>--}}
{{--                                                            <th class="text-center">#</th>--}}
{{--                                                            <th class="text-center"> Client Name </th>--}}
{{--                                                            <th class="text-center"> Tracking Number </th>--}}
{{--                                                            <th class="text-center"> Price </th>--}}
{{--                                                            <th class="text-center"> Address </th>--}}


{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody class="body_for_products">--}}



{{--                                                        </tbody>--}}
{{--                                                    </table>--}}



{{--                                                </div>--}}

{{--                                                --}}{{-- Courier data here --}}

{{--                                                <!-- END FORM-->--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- END CONTENT BODY -->--}}
{{--            </div>--}}
{{--            <!-- END CONTENT -->--}}
{{--@endsection--}}

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).on('change','.area_changed',function(){--}}
{{--           var areaId = document.querySelector('.area_changed').value ;--}}

{{--           if(parseInt(areaId))--}}
{{--           {--}}
{{--               $('.seller_select').removeAttr('disabled');--}}
{{--               $.ajax({--}}
{{--                   type: 'POST',--}}
{{--                   url: "/admin/getSellerForThisArea/"+areaId,--}}
{{--                   data: {--}}
{{--                       '_token':"{{csrf_token()}}",--}}
{{--                   },--}}
{{--                   success: function (data) {--}}
{{--                          if(data.NoSellers)--}}
{{--                          {--}}
{{--                              $('.seller_select').empty().prepend(` <option value="0">Seller Name </option>`)--}}
{{--                              for (var key in data.sellers)--}}
{{--                              {--}}
{{--                                  $('.seller_select').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name}</option>`)--}}
{{--                              }--}}
{{--                              $('.seller_select').removeAttr('disabled');--}}
{{--                              $('.seller_select option[value="-1"]').remove();--}}
{{--                          }--}}
{{--                          else--}}
{{--                              {--}}
{{--                                  $('.form_data').slideUp();--}}
{{--                                  $('.table_for_seller_data').slideUp();--}}
{{--                              $('.seller_select').attr('disabled','disabled').prepend('<option value="-1" selected>No Sellers In This Area</option>');--}}
{{--                          }--}}

{{--                   }, error: function (reject) {--}}


{{--                   }--}}
{{--               });--}}


{{--           }--}}
{{--           else{--}}
{{--               $('.form_data').slideUp();--}}
{{--               $('.table_for_seller_data').slideUp();--}}

{{--               $('.seller_select option[value="0"]').attr('selected','selected');--}}
{{--               $('.seller_select option[value="-1"]').remove();--}}
{{--               $('.seller_select').attr('disabled','disabled');--}}
{{--           }$('.show_products_btn').attr('disabled','disabled');--}}
{{--            $('.number_of_products_in_this_area_to_this_seller').val(0)--}}
{{--        });--}}
{{--        $(document).on('change','.seller_select',function(){--}}
{{--            var table = $('#sample_2').DataTable();--}}

{{--//clear datatable--}}
{{--            table.clear().draw();--}}
{{--            // $('.form_data').slideUp();--}}
{{--            var seller_id = document.querySelector('.seller_select').value ;--}}
{{--            var areaId = document.querySelector('.area_changed').value--}}
{{--            $('.body_for_products').empty() ;--}}

{{--            if(parseInt(seller_id))--}}
{{--            {--}}


{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: "/admin/getProductsForSellerInThisArea/"+areaId+"/"+seller_id,--}}
{{--                    data: {--}}
{{--                        '_token':"{{csrf_token()}}",--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        $('.body_for_seller_info').empty().prepend(`<tr> <td> ${data.seller.address} </td> <td>${data.seller.phone}</td> </tr>`);--}}
{{--                        $('.table_for_seller_data').slideDown();--}}
{{--                        if(data.NoProductsInThisArea)--}}
{{--                            {--}}
{{--                                $('.body_for_products').empty() ;--}}
{{--                                for (var key in data.productsInThisArea)--}}
{{--                                {--}}
{{--                                    var table = $('#sample_2').DataTable();--}}
{{--                                    table.row.add([--}}
{{--                                        `${parseInt(key)+1}`,--}}
{{--                                        `${data.productsInThisArea[key].client_name}`,--}}
{{--                                        `${data.productsInThisArea[key].barcode_number}`,--}}
{{--                                        `${data.productsInThisArea[key].price} EGP`,--}}
{{--                                       `${data.productsInThisArea[key].address}`,--}}
{{--                                    ]).draw(false);--}}
{{--                                }--}}

{{--                                $('.number_of_products_in_this_area_to_this_seller').val(data.NoProductsInThisArea)--}}
{{--                                $('.show_products_btn').removeAttr('disabled');--}}
{{--                            }--}}
{{--                            else--}}
{{--                            {--}}
{{--                                $('.form_data').slideUp();--}}
{{--                                $('.show_products_btn').attr('disabled','disabled');--}}
{{--                                $('.number_of_products_in_this_area_to_this_seller').val(0)--}}
{{--                            }--}}


{{--                    }, error: function (reject) {--}}


{{--                    }--}}
{{--                });--}}

{{--            }--}}
{{--            else{--}}
{{--                $('.form_data').slideUp();--}}
{{--                $('.table_for_seller_data').slideUp();--}}
{{--                $('.number_of_products_in_this_area_to_this_seller').val(0)--}}
{{--                $('.show_products_btn').attr('disabled','disabled');--}}
{{--            }--}}
{{--        });--}}
{{--        $(document).on('click','.show_products_btn',function(e){--}}
{{--            e.preventDefault();--}}
{{--            $('.form_data').slideDown();--}}
{{--        })--}}

{{--    </script>--}}
{{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
{{--@endsection--}}
