@extends('layouts.admin')
@section('css')
    <style>
    .form_custom_css
    {
        display: inline-block;
        width: 433px;
        margin-bottom: 10px;

    }

    </style>
    @endsection
@section('content')

    <div class="modal fade" id="flashMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center alert">
                    <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert alert-info text-center">
                    SubArea Has Been Added Successfully
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>


<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Table Area </div>
{{--                        <div class="actions">--}}
{{--                            <button data-toggle="modal" data-target="#xxx" class="btn btn-default btn-sm btn-circle">--}}
{{--                                <i class="fa fa-plus"></i> Add New SubArea </button>--}}
{{--                        </div>--}}
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                            <thead>
                                <tr>
                                    <th class="text-center"> Name </th>
{{--                                    <th class="text-center"> Price </th>--}}
                                    <th class="text-center"> SubAreas </th>
                                    <th class="text-center"> Edit </th>
                                    <th class="text-center"> Delete </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)


                                    <tr>

                                        <td class="text-center">{{$country->name}}</td>
{{--                                    <td class="text-center">{{$country->price}}</td>--}}
                                        <td class="text-center">
                                            <div class="modal fade" id="modal_for_view_sub_areas_of_area{{$country->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">All SubArea of {{$country->name}} </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($country->subAreas->count())
                                                            <table class="table text-center">
                                                                <thead >
                                                                <tr >
                                                                    <th style="text-align: center"> # </th>
                                                                    <th style="text-align: center"> Name </th>
                                                                    <th style="text-align: center"> Deliver Price </th>
                                                                    <th style="text-align: center"> Return Price </th>
                                                                    <th style="text-align: center"> Edit </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($country->subAreas as $key=>$sub)

                                                                    <tr>
                                                                        <td>{{$key + 1 }}</td>
                                                                        <td>{{$sub->name}}</td>
                                                                        <td>{{$sub->deliver_price}} EGP</td>
                                                                        <td>{{$sub->return_price}} EGP</td>

                                                                        <td>
{{--                                                                            <div class="modal fade edit_modal_class"  id="modal_for_edit_sub_areas_of_area{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                                                                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                                                                    <div class="modal-content">--}}
{{--                                                                                        <div class="modal-header">--}}
{{--                                                                                            <h5 class="modal-title" id="exampleModalLongTitle"> Edit {{$sub->name}} Sub Area For {{$country->name }} Area </h5>--}}
{{--                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                                                <span aria-hidden="true">&times;</span>--}}
{{--                                                                                            </button>--}}
{{--                                                                                        </div>--}}
{{--                                                                                        <div class="modal-body">--}}
{{--                                                                                            <form>--}}
{{--                                                                                                <label>Name :    </label>--}}
{{--                                                                                                <input class="form-control form_custom_css" id="edit_sub_area_name_{{$sub->id}}" name="name" placeholder="" style="" value="{{$sub->name}}">--}}

{{--                                                                                                <label>Deliver Price : </label>--}}
{{--                                                                                                <input class="form-control form_custom_css" id="edit_sub_deliver_price_{{$sub->id}}" name="deliver_price" placeholder="" style="" value="{{$sub->deliver_price}}">--}}


{{--                                                                                                <label>Return Price : </label>--}}
{{--                                                                                                <input class="form-control form_custom_css" id="edit_sub_area_return_price_{{$sub->id}}" name="return_price" placeholder="" style="" value="{{$sub->return_price}}">--}}


{{--                                                                                            </form>--}}
{{--                                                                                        </div>--}}
{{--                                                                                        <div class="modal-footer">--}}
{{--                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                                                            <button data-sub_area_id="{{$sub->id}}" type="button" class="btn btn-primary edit_sub_area_icon" data-area-id="{{$country->id}}"> Edit </button>--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}

                                                                            <a href="{{Route('edit.sub_area',$sub->id)}}">
                                                                            <i  class="fa fa-edit fa-lg " style="color: #32c5d2;cursor: pointer"></i>
                                                                            </a>
                                                                        </td>




                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            @else
                                                            <h3 class="text-center">No Data available till now </h3>
                                                            @endif


                                                        </div>
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="modal_for_add_sub_areas_of_area{{$country->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"> Add New Sub Area For {{$country->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <label>Name :    </label>
                                                                <input class="form-control form_custom_css" id="sub_area_name_{{$country->id}}" name="name" placeholder="" style="">

                                                                <label>Deliver Price : </label>
                                                                <input class="form-control form_custom_css" id="sub_deliver_price_{{$country->id}}" name="deliver_price" placeholder="" style="">


                                                                <label>Return Price : </label>
                                                                <input class="form-control form_custom_css" id="sub_area_return_price_{{$country->id}}" name="return_price" placeholder="" style="">


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary add_new_sub_area" data-area-id="{{$country->id}}"> Add </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn green" data-toggle="modal" data-target="#modal_for_add_sub_areas_of_area{{$country->id}}">Add</button>
                                            <button class="btn green" data-toggle="modal" data-target="#modal_for_view_sub_areas_of_area{{$country->id}}">View</button>
                                        </td>
                                    <td class="text-center">
                                        <a href="{{route('countries.edit', $country->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>
                                    </td>
                                    <td class="text-center">
                                    <form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-circle btn-danger">Delete</button>
                                    </form>
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
        $('.add_new_sub_area').on('click',function (event){
            let area_id = $(event.target).data('area-id') ;
            let area_name = $(`#sub_area_name_${area_id}`).val();
            let deliver_price = $(`#sub_deliver_price_${area_id}`).val();
            let return_price = $(`#sub_area_return_price_${area_id}`).val();
            if(area_name.length && deliver_price.length && return_price.length)
            {
                $.ajax({
                    type:"post",
                    url:"/admin/subArea/store/"+area_id,
                    data:{
                        "_token":"{{csrf_token()}}",
                        'area_name':area_name ,
                        'deliver_price':deliver_price ,
                        'return_price':return_price ,
                        'area_id':area_id
                    },
                    success:function(data){
                        if (data.status)
                        {
                            $(`#modal_for_add_sub_areas_of_area`+data.area_id).modal('hide');
                            $('#flashMessageModal').modal('show');
                        }
                        else
                            {

                            }
                    }
                })
            }
        })
        $('#flashMessageModal').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })

        // $('.delete_sub_area').on('click',function(event){
        //     console.log($(event.target).data('sub_area_id'));
        // })
        $('.edit_modal_a').on('click',function(event){
            let mainAreaId =   $(this).attr('data-area_id')
            let subAreaId = $(event.target).data('sub_area_id') ;
        //    $('#modal_for_view_sub_areas_of_area'+mainAreaId).modal('hide');

        })

        $('.edit_sub_area_icon').on('click',function(event){
            console.log($(event.target).data('sub_area_id'));

        })
    </script>
    @endsection
