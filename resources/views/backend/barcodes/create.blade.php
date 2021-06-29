@extends('layouts.admin')
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
                                                    <i class="fa fa-gift"></i>Add barcodes </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('barcodes.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--country_id-->
{{--                                                        <div class="form-group  ">--}}
{{--                                                            <label class="col-md-3 control-label">Your Hub Name</label>--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <select class="form-control input-circle" name="country_id" disabled>--}}
{{--                                                                        <option value="{{Auth()->user()->area_id}}" selected >{{Auth()->user()->area->name}}</option>--}}

{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                                @if(Auth()->user()->isAdmin())

                                                            <div class="form-group  ">
                                                                <label class="col-md-3 control-label">Seller Name</label>
                                                                <div class="col-md-6">
                                                                    <select id="seller_select" class="form-control input-circle" name="seller_id">
                                                                        <option @if($errors) selected @endif id="select_seller_option" value="0">Select Seller Name </option>
                                                                        @foreach ($sellers as $seller)
                                                                            <option value="{{$seller->id}}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>{{$seller->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                                    @endif
                                                            <div class="form-group  ">
                                                                <label class="col-md-3 control-label">Area Name :</label>
                                                                <div class="col-md-6">
                                                                    <select id="area_select_id" class="form-control input-circle" name="sub_area_id">
                                                                        <option @if($errors) selected @endif  id="area_default_option" value="0">Area Name </option>
                                                                        @foreach ($subAreas as $sub)

                                                                            <option value="{{$sub->id}}" {{ old('sub_area_id') == $sub->id ? 'selected' : '' }}>{{$sub->name . ' ( Shipping Price ' . $sub->deliver_price . ' EGP ) '}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>



                                                        <!--client_Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Client Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("client_name")}}' type="text" class="form-control input-circle" placeholder="Name" name="client_name">
                                                                    @error('client_name')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--address-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Address:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("address")}}' type="text" class="form-control input-circle" placeholder="address" name="address">
                                                                    @error('address')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--content-->
                                                        <!--Phone-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Phone:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("phone")}}' type="number" class="form-control input-circle" placeholder="Phone" name="phone">
                                                                    @error('phone')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Price-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Price:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("price")}}' type="number" class="form-control input-circle" placeholder="Price" name="price">
                                                                    @error('price')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Note :</label>
                                                            <div class="col-md-6">
                                                                <textarea  name="content" class="form-control" >{{old("content")}}</textarea>

                                                                @error('content')
                                                                <div >
                                                                    <span class="text-danger my-2">{{ $message }}</span>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        @if(auth()->check() == true && auth()->user()->type == 'admin')
                                                        <!--status-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">Status :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="status">
                                                                    <option value="" @if (old('status') == '') selected="selected" @endif>Select Type</option>
                                                                    <option value="created" @if (old('status') == 'created') selected="selected" @endif>Created</option>
                                                                    <option value="pending" @if (old('status') == 'pending') selected="selected" @endif>Pending</option>
                                                                    <option value="recieved hub" @if (old('status') == 'recieved hub') selected="selected" @endif>Recieved Hub</option>
                                                                    <option value="out to deliver" @if (old('status') == 'out to deliver') selected="selected" @endif>Out to Deliver</option>
                                                                    <option value="delivered" @if (old('status') == 'delivered') selected="selected" @endif>Delivered</option>
                                                                    <option value="canceled" @if (old('status') == 'canceled') selected="selected" @endif>Canceled</option>
                                                                    <option value="reschedule" @if (old('status') == 'reschedule') selected="selected" @endif>Reschedule</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">Create</button>
                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>




                                                @if(count($barcodes))

                                                <form method="GET" action="{{route('products.checkbox')}}">
                                                    @csrf
                                                    <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                        <thead>
                                                        <tr>
{{--                                                            <th class="text-center"> collect </th>--}}
                                                            <th class="text-center"> Client Name </th>
                                                            <th class="text-center"> Price </th>
                                                            <th class="text-center"> Barcode </th>
                                                            <th class="text-center"> Hub </th>
                                                            <th class="text-center"> Area </th>
                                                            <th class="text-center"> Address </th>
                                                            <th class="text-center"> Status </th>

                                                            @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')
                                                                <th class="text-center"> Action </th>
                                                            @endif
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($barcodes as $barcode)
                                                            <tr class="delete_feather_row{{$barcode->id}}">
{{--                                                                <td class="text-center">--}}
{{--                                                                    <input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input checkbox_class" id="exampleCheck1">--}}
{{--                                                                </td>--}}

{{--                                                                <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input checkbox_class" id="exampleCheck1"></td>--}}
                                                                <td class="text-center">{{$barcode->client_name}}
                                                                    <input  type="hidden" value="{{$barcode->id}}" name="barcodes_id[]" class="form-check-input checkbox_class" >

                                                                </td>
                                                                <td class="text-center">{{number_format($barcode->price)}}</td>
                                                                <td class="text-center">
                                                                    <div class="barcode">
                                                                        {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}
                                                                        <p class="pid">{{$barcode->barcode_number}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{$barcode->area->name}}</td>
                                                                <td class="text-center">{{$barcode->sub_area->name}}</td>
                                                                <td class="text-center">{{$barcode->address}}</td>
                                                                <td class="text-center">{{$barcode->status}}</td>
                                                                @if(auth()->check() == true && auth()->user()->type == 'admin')
                                                                    <td class="text-center">
                                                                        <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>
                                                                        <a id="{{$barcode->id}}" href="" data-id="{{ $barcode->id }}" class="btn btn-circle btn-danger delete_feature_class">Delete</a>
                                                                    </td>
                                                                @elseif(auth()->check()  && auth()->user()->type == 'seller' && ($barcode->status == 'pending' ) )
                                                                    <td class="text-center">
                                                                        <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>
                                                                        <a data-barcode_id="{{$barcode->id}}" class="btn btn-circle btn-danger delete_barcode">Delete</a>


                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                    <div class="" style="width: 50%;margin: auto;text-align: center;padding-bottom: 4px">
                                                        <button type="submit" class="btn btn-circle btn-danger">Confirm</button>
                                                    </div>

{{--                                                    <button id="select-all"  class="btn btn-circle btn-success">Select All</button>--}}
                                                </form>

                                            @endif

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
{{--    <script>--}}
{{--        $('.checkbox_class').on('click',function (){--}}
{{--            if($(this).prop('checked','checked')) {--}}
{{--                $(this).prop('checked',false);--}}
{{--            }--}}
{{--            else{--}}
{{--                $(this).prop('checked','checked');--}}

{{--            }--}}

{{--        });--}}
{{--    </script>--}}

    <script>
        $('.delete_barcode').on('click',function(event){
            $.ajax({
                type:"delete",
                url:"/admin/barcodes/"+$(event.target).data('barcode_id') ,
                data:{
                    "_token":"{{csrf_token()}}",
                },
                success:function(data){
                    window.location.reload();

                }
            })
        });


    </script>

@if(auth()->user()->isAdmin())
    <script>
        window.onpageshow = function()
        {
            const seller_id = parseInt(document.getElementById('seller_select').value) ;
            const defaultSubAreaOption=document.querySelector('#area_default_option');
            const sellerSelector = document.getElementById('seller_select');
            const subAreaSelect = document.getElementById('area_select_id');
        //    console.log(document.querySelector('#area_default_option'));



            if(seller_id === 0)
            {
                subAreaSelect.setAttribute('disabled','disabled') ;
                defaultSubAreaOption.setAttribute('selected','selected');
            }
            else
            {
                sellerSelector.removeAttribute('disabled');
                $.ajax({
                    'type':"post",
                    "url":"/admin/getSellerSubAreas/"+seller_id  ,
                    "data":{
                        "_token":"{{csrf_token()}}"
                    },
                    success: function (data) {

                        if(data.NoSellers)
                        {
                            $('#area_select_id').empty().prepend(` <option value="0">Area Name </option>`)
                            for (var key in data.sellers)
                            {
                                $('#area_select_id').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name + ' ( Shipping Price ' + data.sellers[key].deliver_price + ' EGP ) '}</option>`)

                            }

                            $('#area_select_id').removeAttr('disabled');
                            $('#area_select_id option[value="-1"]').remove();


                        }
                        // else
                        // {
                        //
                        //     $('#area_select_id').attr('disabled','disabled').prepend('<option value="-1" selected>No Sellers In This Area</option>');
                        // }

                    }, error: function (reject) {


                    }
                });
            }
        }
        document.getElementById('seller_select').addEventListener('change',function(){
            const seller_id = parseInt(this.value) ;
            const defaultSubAreaOption=document.querySelector('#area_default_option');
            const sellerSelector = document.getElementById('seller_select');
            const subAreaSelect = document.getElementById('area_select_id');

            if(seller_id === 0)
            {
                subAreaSelect.setAttribute('disabled','disabled') ;
                defaultSubAreaOption.setAttribute('selected','selected');
            }
            else
            {
                sellerSelector.removeAttribute('disabled');
                $.ajax({
                    'type':"post",
                    "url":"/admin/getSellerSubAreas/"+seller_id  ,
                    "data":{
                        "_token":"{{csrf_token()}}"
                    },
                    success: function (data) {

                        if(data.NoSellers)
                        {
                            $('#area_select_id').empty().prepend(` <option value="0">Area Name </option>`)
                            for (var key in data.sellers)
                            {
                                $('#area_select_id').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name + ' ( Shipping Price ' + data.sellers[key].deliver_price + ' EGP ) '}</option>`)

                            }

                            $('#area_select_id').removeAttr('disabled');
                            $('#area_select_id option[value="-1"]').remove();


                        }
                        // else
                        // {
                        //
                        //     $('#area_select_id').attr('disabled','disabled').prepend('<option value="-1" selected>No Sellers In This Area</option>');
                        // }

                    }, error: function (reject) {


                    }
                });
            }
        });

    </script>

    @endif
{{--    <script>--}}
{{--        document.getElementById('select-all').onclick = function(event) {--}}
{{--            event.preventDefault();--}}
{{--            $('.checkbox_class').each(function(index,item){--}}
{{--                if ($(this).attr('checked'))--}}
{{--                {--}}
{{--                    console.log($(this).prop('checked','checked'))--}}
{{--                    $(this).prop('checked',false);--}}
{{--                }--}}
{{--                else{--}}
{{--                    console.log('add');--}}

{{--                    $(this).prop('checked','checked');--}}

{{--                }--}}
{{--            })--}}
{{--            var checkboxes = document.getElementsByClassName('checkbox_class');--}}
{{--            for (const checkbox of checkboxes) {--}}
{{--                $(checkbox).attr('checked','checked');--}}

{{--          //     checkbox.checked = this.checked;--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}

@endsection
