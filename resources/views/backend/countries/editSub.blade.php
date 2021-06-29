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
                                                    <i class="fa fa-gift"></i>Edit Sub Area {{$sub->name}} </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('update.sub_area' , $sub->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ method_field('PUT') }}
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input required  value="{{$sub->name}}" type="text" class="form-control input-circle" placeholder="Name" name="name" >
                                                                    @error('name')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Price-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Deliver Price:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input required value="{{$sub->deliver_price}}" type="number" class="form-control input-circle" placeholder="" name="deliver_price">
                                                                    @error('deliver_price')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Return Price:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input required value="{{$sub->return_price}}" type="number" class="form-control input-circle" placeholder="Price" name="return_price">
                                                                    @error('return_price')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9">
                                                                    <button type="submit" class="btn btn-circle green">Edit</button>
                                                                    <a href="{{route('countries.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                            </div>

                                                    <!--button-->

                                                </form>
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
