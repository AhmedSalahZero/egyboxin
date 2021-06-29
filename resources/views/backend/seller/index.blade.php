{{--@extends('layouts.admin')--}}
{{--@section('content')--}}

{{--    <div class="page-content-wrapper">--}}
{{--        <!-- BEGIN CONTENT BODY -->--}}
{{--        <div class="page-content">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <!-- BEGIN EXAMPLE TABLE PORTLET-->--}}
{{--                    <div class="portlet box green">--}}
{{--                        <div class="portlet-title">--}}
{{--                            <div class="caption">--}}
{{--                                <i class="fa fa-globe"></i>Seller Debrief</div>--}}
{{--                            <div class="actions">--}}
{{--                                <a href="{{route('barcodes.create')}}" class="btn btn-default btn-sm btn-circle">--}}
{{--                                    <i class="fa fa-plus"></i> Add </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portlet-body">--}}
{{--                            <form method="GET" action="admin/barcodes/checkbox">--}}
{{--                                @csrf--}}
{{--                                <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center"> collect </th>--}}
{{--                                        <th class="text-center"> Client Name </th>--}}
{{--                                        <th class="text-center"> Price </th>--}}
{{--                                        <th class="text-center"> Barcode </th>--}}
{{--                                        <th class="text-center"> Address </th>--}}
{{--                                        <th class="text-center"> Status </th>--}}
{{--                                       @if(Auth()->user()->type == 'admin')--}}
{{--                                            <th class="text-center"> Seller </th>--}}
{{--                                           @endif--}}
{{--                                        @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')--}}
{{--                                            <th class="text-center"> Action </th>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach ($barcodes as $barcode)--}}
{{--                                        <tr >--}}
{{--                                            <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input" id="exampleCheck1"></td>--}}
{{--                                            <td class="text-center">{{$barcode->client_name}}</td>--}}
{{--                                            <td class="text-center">{{number_format($barcode->price)}}</td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                <div class="barcode">--}}
{{--                                                    {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}--}}
{{--                                                    <p class="pid">{{$barcode->barcode_number}}</p>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">{{$barcode->address}}</td>--}}
{{--                                            <td class="text-center">{{$barcode->status}}</td>--}}

{{--                                            @if(auth()->user()->type =='admin' )--}}
{{--                                                <td class="text-center">{{$barcode->seller->name}}</td>--}}

{{--                                                @endif--}}
{{--                                            @if(auth()->check() == true && auth()->user()->type == 'admin')--}}
{{--                                                <td class="text-center">--}}
{{--                                                    <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>--}}
{{--                                                    <a id="{{$barcode->id}}" href="" data-id="{{ $barcode->id }}" class="btn btn-circle btn-danger delete_feature_class">Delete</a>--}}
{{--                                                </td>--}}
{{--                                            @elseif(auth()->check()  && auth()->user()->type == 'seller' && ($barcode->status == 'pending' || $barcode->status='created') )--}}
{{--                                                <td class="text-center">--}}
{{--                                                    <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>--}}
{{--                                                    <a id="{{$barcode->id}}" href="" data-id="{{ $barcode->id }}" class="btn btn-circle btn-danger delete_feature_class">Delete</a>--}}


{{--                                                </td>--}}
{{--                                            @endif--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                                <button type="submit" class="btn btn-circle btn-danger">Collect</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- END EXAMPLE TABLE PORTLET-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- END CONTENT BODY -->--}}
{{--    </div>--}}
{{--    <!-- END CONTENT -->--}}

{{--@endsection--}}
{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).on('click', '.delete_feature_class', function (event) {--}}
{{--            event.preventDefault();--}}
{{--            $.ajax({--}}
{{--                type: 'delete',--}}
{{--                url: "{{route('destroy')}}",--}}
{{--                data: {--}}
{{--                    '_token':"{{csrf_token()}}",--}}
{{--                    'feature_id':event.target.id--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    if(data.status===true)--}}
{{--                    {--}}
{{--                        $('.delete_feather_row'+data.id).remove();--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
