
@extends('layouts.admin')
@section('css')
{{--<link href="{{asset('backend/assets/new/custom.css')}}" rel="stylesheet" type="text/css" />--}}

@endsection
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
                            <i class="fa fa-globe"></i>Carriers</div>
{{--                        <div class="actions">--}}
{{--                            <a href="{{route('users.create')}}" class="btn btn-default btn-sm btn-circle">--}}
{{--                                <i class="fa fa-plus"></i> Add </a>--}}
{{--                        </div>--}}
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                            <thead>
                            <tr>
                                {{--                                        <th class="text-center"> collect </th>--}}

                                <th class="text-center"> Tracking Number </th>
                                <th class="text-center"> Client Name </th>
                                <th class="text-center"> Client Phone </th>
                                <th class="text-center"> Price </th>
                                {{--                                                                                <th class="text-center"> Barcode </th>--}}
                                <th class="text-center"> Govern </th>
                                <th class="text-center"> Address </th>

                                <th class="text-center"> Seller </th>
                                <th class="text-center"> Status </th>
                                {{--                                        @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')--}}
                                {{--                                            <th class="text-center"> Action </th>--}}
                                {{--                                        @endif--}}
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($barcodes as $barcode)


                                <tr >
                                    {{--                                            <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input" id="exampleCheck1"></td>--}}

                                    <td class="text-center">
                                        <div class="barcode text-center">
                                            {{$barcode->barcode_number}}
{{--                                            {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}--}}
{{--                                            <p class="pid">{{$barcode->barcode_number}}</p>--}}

                                        </div>
                                    </td>
                                    <td class="text-center">{{$barcode->client_name}}</td>
                                    <td class="text-center">{{$barcode->phone}}</td>
                                    <td class="text-center">{{number_format($barcode->price) . ' EGP'}}</td>
                                    {{--                                                                                    <td class="text-center">--}}
                                    {{--                                                                                        <div class="barcode">--}}
                                    {{--                                                                                            {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}--}}
                                    {{--                                                                                            <p class="pid">{{$barcode->barcode_number}}</p>--}}
                                    {{--                                                                                        </div>--}}
                                    {{--                                                                                    </td>--}}
                                    <td class="text-center">{{$barcode->govern->name}}</td>

                                    <td class="text-center">{{$barcode->address}}</td>

                                    <td class="text-center">{{$barcode->seller->name}}</td>

                                    <td class="text-center">{{$barcode->status}}</td>



                                    <td >


                                        <div class="modal fade " id="exampleModalLong_details{{$barcode->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog custom_modal" role="document" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">


                                                                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                                                                            <thead>
                                                                            <tr>
                                                                                {{--                                        <th class="text-center"> collect </th>--}}
{{--                                                                                <th class="text-center"> Client Name </th>--}}
{{--                                                                                <th class="text-center"> Phone </th>--}}
{{--                                                                                <th class="text-center"> Price </th>--}}
{{--                                                                                <th class="text-center"> Barcode </th>--}}
{{--                                                                                <th class="text-center"> Govern </th>--}}
{{--                                                                                <th class="text-center"> Address </th>--}}

{{--                                                                                <th class="text-center"> Seller </th>--}}
                                                                                <th class="text-center"> Action </th>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
{{--                                                                            @foreach ($barcodes as $barcode)--}}
                                                                                <tr >
                                                                                    {{--                                            <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input" id="exampleCheck1"></td>--}}
{{--                                                                                    <td class="text-center">{{$barcode->client_name}}</td>--}}
{{--                                                                                    <td class="text-center">{{$barcode->phone}}</td>--}}
{{--                                                                                    <td class="text-center">{{number_format($barcode->price) . ' EGP'}}</td>--}}
{{--                                                                                    <td class="text-center">--}}
{{--                                                                                        <div class="barcode">--}}
{{--                                                                                            {!! DNS1D::getBarcodeHTML($barcode->barcode_number, "C128",1.4,22) !!}--}}
{{--                                                                                            <p class="pid">{{$barcode->barcode_number}}</p>--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </td>--}}
{{--                                                                                    <td class="text-center">{{$barcode->govern->name}}</td>--}}

{{--                                                                                    <td class="text-center">{{$barcode->address}}</td>--}}

{{--                                                                                    <td class="text-center">{{$barcode->seller->name}}</td>--}}
                                                                                    <td class="text-center">
                                                                                        <button  data-barcode_id="{{$barcode->id}}"  class="btn btn-circle btn-success delivered_btn_here" data-target="#exampleModalLong_Delivered_modal{{$barcode->id}}" data-toggle="modal">Delivered</button>
                                                                                        <a data-barcode_id="{{$barcode->id}}" href="#form_moda{{$barcode->id}}" data-toggle="modal"  class="btn btn-circle btn-info btn-md schedule_btn_here">Schedule</a>
                                                                                        <button   data-barcode_id="{{$barcode->id}}" class="btn btn-circle btn-danger canceled_btn_here" data-target="#exampleModalLong_canceled_modal{{$barcode->id}}" data-toggle="modal">Canceled</button>

                                                                                    </td>
                                                                                </tr>
{{--                                                                            @endforeach--}}
                                                                            </tbody>
                                                                        </table>




                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="form_moda{{$barcode->id}}" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog custom_modal">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Scheduling Date & Time </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" class="form-horizontal">
{{--                                                           <input name="scheduling_date" type="date" id="scheduling_date{{$barcode->id}}" class="form-control" style="margin-bottom: 10px">--}}
{{--                                                            <input name="scheduling_time" type="time" id="scheduling_time{{$barcode->id}}"  class="form-control">--}}

                                                            <h2>Leave A Comment With Scheduling Date </h2>
                                                            <textarea name="note" class="form-control comment_sch_barcode{{$barcode->id}}" data-barcode-id="{{$barcode->id}}" ></textarea>


                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn grey-salsa btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                                                        <button class="btn green btn-primary scheduling_btn" data-barcode-id="{{$barcode->id}}">Schedule</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade " id="exampleModalLong_canceled_modal{{$barcode->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog custom_modal" role="document" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="portlet light bordered">
                                                                                    <div class="portlet-title text-center">
                                                                                        <h2>Leave A Comment </h2>
                                                                                        <textarea name="note" class="form-control comment_barcode{{$barcode->id}}" data-barcode-id="{{$barcode->id}}" ></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button  data-barcode-id="{{$barcode->id}}"  class="btn btn-circle btn-danger cancealed_item_class">Submit</button>
                                                                        </div>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal fade " id="exampleModalLong_Delivered_modal{{$barcode->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog custom_modal" role="document" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="portlet light bordered">
                                                                                    <div class="portlet-title text-center">
                                                                                        <h2 > Is This Item Delivered ? </h2>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button  data-barcode-id="{{$barcode->id}}"  class="btn btn-circle btn-danger delivered_item_class">Submit</button>
                                                                        </div>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <button data-target="#exampleModalLong_details{{$barcode->id}}" data-toggle="modal" type="button" class="btn btn-circle red btn-sm">Update</button>



                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>


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
    <script>
        $('.delivered_btn_here ,.canceled_btn_here ,.schedule_btn_here').on('click',function(){
           let barcode_id = $(this).data('barcode_id');
            if ($("#exampleModalLong_details"+barcode_id).data('bs.modal').isShown)
            {
                $("#exampleModalLong_details"+barcode_id).modal('hide');

            }
            else{


            }

        })



        $(document).on('click','.cancealed_item_class',function(event){

            // if(confirms)
            {
                var barcodeId = $(event.target).data('barcode-id') ;

                var comment = $('.comment_barcode'+barcodeId).val();
              if(comment)
              {
                  $.ajax({
                      type: 'delete',
                      url: "/admin/barcode_canceled/"+barcodeId+'/'+comment,
                      data: {
                          '_token':"{{csrf_token()}}",


                      },
                      success: function (data) {
                          if(data.status)
                          {
                              window.location.reload();
                          }
                      }, error: function (reject) {


                      }
                  });
              }
              else{
                  alert('You Must Enter Comment ') ;

              }


            }



        })
        $(document).on('click','.scheduling_btn',function(event){

            // if(confirms)
            {
                var barcodeId = $(event.target).data('barcode-id') ;
                // var sch_time = $('#scheduling_time'+barcodeId).val();
                // var sch_date = $('#scheduling_date'+barcodeId).val();
                var note = $('.comment_sch_barcode'+barcodeId).val();
                if( note)
                {
                    $.ajax({
                        type: 'post',
                        url: "/admin/barcode_schedule/"+barcodeId+'/'+note,
                        data: {
                            '_token':"{{csrf_token()}}",
                        },
                        success: function (data) {
                            if(data.status)
                            {
                                window.location.reload();
                            }
                        }, error: function (reject) {
                        }
                    });

                }
                else{
                    alert('You Have To Insert The Dat&Time And Comment') ;
                }
            }
        })
        $(document).on('click','.delivered_item_class',function(event){
            // if(confirms)
            {



                var barcodeId = $(event.target).data('barcode-id') ;




                    $.ajax({
                        type: 'post',
                        url: "/admin/barcode_delivery/"+barcodeId ,
                        data: {
                            '_token':"{{csrf_token()}}",
                        },
                        success: function (data) {
                            if(data.status)
                            {
                                window.location.reload();
                            }
                        }, error: function (reject) {


                        }
                    });
                }
        })

    </script>
@endsection


