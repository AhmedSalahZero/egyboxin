@extends('layouts.admin')
@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Shipments </div>
                        <div class="actions">
                            @if(count($barcodes))
                                <a href="{{route('barcodes.export.excel',$barcodesExcelType)}}" class="btn red btn-default btn-sm btn-circle">
                                    <i class="fa fa-book"></i> Export As Excel </a>
                            @endif

                        </div>
                    </div>
                    <div class="portlet-body">
                        <form method="GET" action="{{Route('products.checkbox')}}">
                            @csrf
                                <table class="table table-striped table-bordered table-hover table-header-fixed display"  id="sample_2">
                                        <thead>
                                            <tr>
{{--                                                @if(!Request()->segment(2)=='shipments')--}}
{{--                                                <th class="text-center"> Check </th>--}}
{{--                                                @endif--}}
                                                <th class="text-center"> Client Name </th>
                                                <th class="text-center"> Price </th>
                                                <th class="text-center"> Tracking Number </th>
                                                <th class="text-center"> Hub </th>
                                                <th class="text-center"> Area </th>
                                                <th class="text-center"> Address </th>
                                                <th class="text-center"> Status </th>
                                               @if(Auth()->user()->type =='admin')
                                                    <th class="text-center"> Seller </th>
                                                   @endif
                                                @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')
                                                <th class="text-center"> Action </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barcodes as $barcode)
                                        <tr class="delete_feather_row{{$barcode->id}}">
{{--                                            @if(!Request()->segment(2)=='shipments')--}}
{{--                                                <td class="text-center">--}}
{{--                                                    @if($barcode->status =='pending' )--}}
{{--                                                    <input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input" id="exampleCheck1">--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                            @endif--}}
                                                <td class="text-center">{{$barcode->client_name}}</td>
                                                <td class="text-center">{{number_format($barcode->price)}}</td>
                                                <td class="text-center">
                                                    <div class="barcode">
                                                        {{$barcode->barcode_number}}
{{--                                                        {!! DNS1D::getBarcodeSVG($barcode->barcode_number, "C128",1.4,22) !!}--}}
{{--                                                        <p class="pid">{{$barcode->barcode_number}}</p>--}}
                                                    </div>
                                                </td>
                                            <td class="text-center">{{$barcode->area->name}}</td>
                                            <td class="text-center">{{$barcode->sub_area->name}}</td>
                                                <td class="text-center">{{$barcode->address}}</td>
                                                <td class="text-center">{{$barcode->status}}</td>
                                            @if(Auth()->user()->type =='admin')
                                            <td class="text-center">{{$barcode->seller->name}}</td>
                                            @endif

                                                @if( auth()->user()->type == 'admin' || auth()->user()->type == 'operator'||Auth()->user()->isSeller() )
                                                <td class="text-center">
                                                    @if($barcodesExcelType != 'pending')
                                                    <div class="modal fade" id="modal_for_logs{{$barcode->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Logs</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table>
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="text-center">Log</th>
                                                                            <th class="text-center">Date</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                       @foreach($barcode->logs as $log)
                                                                           @can('view',$log)
                                                                           <tr>
                                                                               <td class="text-center">{{$log->status}}</td>

                                                                               <td class="text-center">{{date('l , d F Y ' , strtotime($log->created_at))}}</td>
                                                                           </tr>
                                                                           @endcan
                                                                       @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                        @if(auth()->user()->type == 'admin')

                                                        <button data-toggle="modal"  data-target="#modal_for_logs{{$barcode->id}}"  class="btn btn-circle btn-warning btn-md log_btn">Logs</button>
                                                    <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-small">Edit</a>
                                                            <a href="{{route('reset.status', $barcode->id)}}" class="btn btn-circle btn-info btn-small">Reset</a>

                                                            <a href="" data-barcode_id="{{$barcode->id}}" class="btn btn-circle btn-danger btn-small delete_barcode">Delete</a>
                                                        <a href="{{route('barcode.print', $barcode->id)}}" class="btn btn-circle btn-success btn-small">Print</a>
                                                    @else
                                                            @if($barcodesExcelType != 'pending')

                                                        <button data-toggle="modal"  data-target="#modal_for_logs{{$barcode->id}}"  class="btn btn-circle btn-warning btn-small log_btn">Logs</button>
                                                      @endif
                                                                @if(!(Request()->segment(2) === 'in-progress'))
                                                                    @if($barcode->status == 'pending' || $barcode->status =='created')
                                                                        <a data-barcode_id="{{$barcode->id}}" class="btn btn-circle btn-danger delete_barcode">Delete</a>

                                                                        @endif
                                                                    @endif

                                                                <a href="{{route('barcode.print', $barcode->id)}}" class="btn btn-circle btn-success btn-small">Print</a>
                                                    @endif
{{--                                                    <a href="" class="btn btn-circle btn-info btn-md">Export</a>--}}


                                                </td>

                                                @elseif(auth()->user()->type == 'seller' && ($barcode->status == 'pending' || $barcode->status ==='created' ) )

                                                <td class="text-center">
                                                    <a href="{{route('barcodes.edit', $barcode->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>
                                                    <a id="{{$barcode->id}}" href="" data-id="{{ $barcode->id }}" class="btn btn-circle btn-danger delete_feature_class">Delete</a>


                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </table>

                        </form>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

@endsection
@section('js')

{{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>--}}
<script>




    $('.log_btn').on('click',function(event){
        event.preventDefault();
    })

    {{--$(document).on('click', '.delete_feature_class', function (event) {--}}
    {{--    event.preventDefault();--}}
    {{--    $.ajax({--}}
    {{--        type: 'delete',--}}
    {{--        url: "{{route('destroy')}}",--}}
    {{--        data: {--}}
    {{--            '_token':"{{csrf_token()}}",--}}
    {{--            'feature_id':event.target.id--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            if(data.status===true)--}}
    {{--            {--}}
    {{--                $('.delete_feather_row'+data.id).remove();--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

</script>
<script>
    $('.delete_barcode').on('click',function(event){
        event.preventDefault();

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

@endsection
