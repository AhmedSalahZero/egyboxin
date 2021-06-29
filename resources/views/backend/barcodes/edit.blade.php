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
                                                    <i class="fa fa-gift"></i>Edit barcodes </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('barcodes.update' ,$barcode->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ method_field('PUT') }}
                                                    @csrf
                                                    <div class="form-body">


                                                        <!--country_id-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">Area Name :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="sub_area_id">
                                                                    <option value="0">Area Name </option>
                                                                    @foreach ($subAreas as $sub)

                                                                        <option value="{{$sub->id}}" {{$barcode->sub_area->id === $sub->id ? 'selected' : '' }}>{{$sub->name . ' ( Shipping Price ' . $sub->deliver_price . ' EGP ) '}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--client_Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Client Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{$barcode->client_name}}' type="text" class="form-control input-circle" placeholder="Name" name="client_name">
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
                                                                    <input  value='{{$barcode->address}}' type="text" class="form-control input-circle" placeholder="address" name="address">
                                                                    @error('address')
                                                                    <div >
                                                                        <span class="text-danger my-2">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--content-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Note :</label>
                                                            <div class="col-md-6">
                                                                <textarea  name="content" class="form-control">{{$barcode->content}}</textarea>

                                                                @error('content')
                                                                <div >
                                                                    <span class="text-danger my-2">{{ $message }}</span>
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--Phone-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">phone:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$barcode->phone}}" type="number" class="form-control input-circle" placeholder="phone" name="phone">
                                                                    @error('phone')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--price-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">price:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$barcode->price}}" type="number" class="form-control input-circle" placeholder="price" name="price">
                                                                    @error('price')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(auth()->check() == true && auth()->user()->type == 'admin')
                                                        <!--type-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">Status :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle"name="status">
                                                                    <option value=""{{old('status' , $barcode->status == '' ? 'selected' : '')}}>Select Type</option>
                                                                    <option value="created"{{old('status' , $barcode->status == 'created' ? 'selected' : '')}}>Created</option>
                                                                    <option value="pending"{{old('status' , $barcode->status == 'pending' ? 'selected' : '')}}>Pending</option>
                                                                    <option value="recieved hub"{{old('status' , $barcode->status == 'recieved hub' ? 'selected' : '')}}>Recieved Hub</option>
                                                                    <option value="out to deliver"{{old('status' , $barcode->status == 'out to deliver' ? 'selected' : '')}}>Out to Deliver</option>
                                                                    <option value="delivered"{{old('status' , $barcode->status == 'delivered' ? 'selected' : '')}}>Delivered</option>
                                                                    <option value="canceled"{{old('status' , $barcode->status == 'canceled' ? 'selected' : '')}}>Canceled</option>
                                                                    <option value="reschedule"{{old('status' , $barcode->status == 'reschedule' ? 'selected' : '')}}>Reschedule</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">Edit</button>
                                                                <a href="{{route('barcodes.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>
                                                            </div>
                                                        </div>
                                                    </div>
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
