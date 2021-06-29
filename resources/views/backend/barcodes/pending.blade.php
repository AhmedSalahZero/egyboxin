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

                                            @else
                                                    <h2 style="padding: 10px;text-align: center"> There Is No Pending Shipments </h2>

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
