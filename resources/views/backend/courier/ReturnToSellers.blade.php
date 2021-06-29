
@extends('layouts.admin')
@section('css')

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
                                <th class="text-center"> SellerName </th>

                                <th class="text-center"> Phone </th>
                                <th class="text-center"> Total </th>
                                <th class="text-center"> Action </th>
                                {{--                                        @if(auth()->check() == true && auth()->user()->type == 'admin' || auth()->user()->type == 'seller')--}}
                                {{--                                            <th class="text-center"> Action </th>--}}
                                {{--                                        @endif--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($barcodes as $info=>$barcode)

                                <div class="modal fade" id="scheduling_to_seller_{{explode(',',$info)[3]}}_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>--}}
{{--                                                        <input type="text" class="form-control" id="recipient-name">--}}
{{--                                                    </div>--}}
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Note & Scheduling Time:</label>
                                                        <textarea class="form-control" id="message-text_{{explode(',',$info)[3]}}" ></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button data-courier-id="{{Request()->segment(3)}}" data-seller-id="{{explode(',',$info)[3]}}" type="button" class="scheduling_btn btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="returned_to_seller_{{explode(',',$info)[3]}}_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>--}}
                                                    {{--                                                        <input type="text" class="form-control" id="recipient-name">--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Please Leave A Comment </label>
                                                        <textarea class="form-control" id="message-text_returned_{{explode(',',$info)[3]}}" ></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button data-courier-id="{{Request()->segment(3)}}" data-seller-id="{{explode(',',$info)[3]}}" type="button" class="returned_btn btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <tr >
                                    {{--                                            <td class="text-center"><input id="checkbox" type="checkbox" value="{{$barcode->id}}" name="checkbox[]" class="form-check-input" id="exampleCheck1"></td>--}}
                                    <td class="text-center">{{explode(',',$info)[0]}}</td>

                                    <td class="text-center">0{{explode(',',$info)[2]}}</td>
                                    <td class="text-center">{{count($barcode)}}</td>
                                    <td class="text-center">
                                        <div class="modal fade" id="details_to_seller_{{explode(',',$info)[3]}}_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-lg">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">


                                                        <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center"> Tracking Number </th>

                                                                <th class="text-center"> Client Name </th>
                                                                <th class="text-center"> Address </th>
                                                                <th class="text-center"> Phone </th>
                                                                <th class="text-center"> Price </th>
                                                                <th class="text-center"> Area </th>
                                                                <th class="text-center"> Seller </th>

                                                            </tr>
                                                            </thead>
                                                            <tbody class="">
                                                            @foreach($barcode as $key=>$bar)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$bar->barcode_number}}</td>
                                                                    <td>{{$bar->client_name}}</td>
                                                                    <td>{{$bar->address}}</td>
                                                                    <td>{{$bar->phone}}</td>
                                                                    <td>{{$bar->status == 'Return to seller' ? 0 : $bar->price . ' EGP'}} </td>
                                                                    <td>{{$bar->area->name}}</td>
                                                                    <td>{{$bar->seller->name}}</td>

                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>



                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <button  data-toggle="modal" data-target="#returned_to_seller_{{explode(',',$info)[3]}}_modal" class="btn btn-success btn-circle"> Returned </button>
                                        <button  data-toggle="modal" data-target="#scheduling_to_seller_{{explode(',',$info)[3]}}_modal" class="btn btn-info btn-circle"> Scheduling </button>
                                        <button  data-toggle="modal" data-target="#details_to_seller_{{explode(',',$info)[3]}}_modal" class="btn btn-warning btn-circle"> Details </button>

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
        $('.scheduling_btn , .returned_btn').on('click',function(event){
            event.preventDefault();

            let courier_id = $(event.target).data('courier-id');
            let seller_id = $(event.target).data('seller-id') ;
            let message =   $(event.target).parent().parent().find('textArea').val();
            if(message.length)
            {
                if($(event.target).hasClass('returned_btn'))
                    var url = '/admin/return-to-seller/'+courier_id ;
                else if($(event.target).hasClass('scheduling_btn')){
                        var url = '/admin/scheduling-seller/'+courier_id ;

                }
                $.ajax({
                    type:'post',
                    url:url ,
                    data:{
                        '_token':"{{csrf_token()}}",
                        'seller_id':seller_id,
                        'message':message,

                    },
                    success:function(){
                        window.location.reload();
                    }
                });
            }
            else{
                alert('You Have To Insert A Comment ')
            }

        });
    </script>
{{--    <script>--}}
{{--        $(document).on('click','.cancealed_item_class',function(event){--}}

{{--            // if(confirms)--}}
{{--            {--}}
{{--                var barcodeId = $(event.target).data('barcode-id') ;--}}
{{--                var comment = $('.comment_barcode'+barcodeId).val();--}}
{{--              if(comment)--}}
{{--              {--}}
{{--                  $.ajax({--}}
{{--                      type: 'delete',--}}
{{--                      url: "/admin/barcode_canceled/"+barcodeId+'/'+comment,--}}
{{--                      data: {--}}
{{--                          '_token':"{{csrf_token()}}",--}}


{{--                      },--}}
{{--                      success: function (data) {--}}
{{--                          if(data.status)--}}
{{--                          {--}}
{{--                              window.location.reload();--}}
{{--                          }--}}
{{--                      }, error: function (reject) {--}}


{{--                      }--}}
{{--                  });--}}
{{--              }--}}
{{--              else{--}}
{{--                  alert('You Must Enter Comment ') ;--}}

{{--              }--}}


{{--            }--}}



{{--        })--}}
{{--        $(document).on('click','.scheduling_btn',function(event){--}}

{{--            // if(confirms)--}}
{{--            {--}}
{{--                var barcodeId = $(event.target).data('barcode-id') ;--}}
{{--                var sch_time = $('#scheduling_time'+barcodeId).val();--}}
{{--                var sch_date = $('#scheduling_date'+barcodeId).val();--}}
{{--                var note = $('.comment_sch_barcode'+barcodeId).val();--}}
{{--                if(sch_date && sch_time && note)--}}
{{--                {--}}
{{--                    $.ajax({--}}
{{--                        type: 'post',--}}
{{--                        url: "/admin/barcode_schedule/"+barcodeId+'/'+sch_date+'/'+sch_time+'/'+note,--}}
{{--                        data: {--}}
{{--                            '_token':"{{csrf_token()}}",--}}

{{--                        },--}}
{{--                        success: function (data) {--}}
{{--                            if(data.status)--}}
{{--                            {--}}
{{--                                window.location.reload();--}}
{{--                            }--}}
{{--                        }, error: function (reject) {--}}


{{--                        }--}}
{{--                    });--}}

{{--                }--}}
{{--                else{--}}
{{--                    alert('You Have To Insert The Dat&Time And Comment') ;--}}

{{--                }--}}




{{--            }--}}



{{--        })--}}





{{--        $(document).on('click','.delivered_item_class',function(event){--}}

{{--            // if(confirms)--}}
{{--            {--}}
{{--                var barcodeId = $(event.target).data('barcode-id') ;--}}



{{--                    $.ajax({--}}
{{--                        type: 'post',--}}
{{--                        url: "/admin/barcode_delivery/"+barcodeId ,--}}
{{--                        data: {--}}
{{--                            '_token':"{{csrf_token()}}",--}}
{{--                        },--}}
{{--                        success: function (data) {--}}
{{--                            if(data.status)--}}
{{--                            {--}}
{{--                                window.location.reload();--}}
{{--                            }--}}
{{--                        }, error: function (reject) {--}}


{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--        })--}}

{{--    </script>--}}
@endsection


