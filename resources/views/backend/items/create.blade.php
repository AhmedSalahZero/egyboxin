{{--@extends('layouts.admin')--}}
{{--@section('css')--}}
{{--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />--}}

{{--@endsection   --}}
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
{{--                                                    <i class="fa fa-gift"></i>Add items </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="portlet-body form">--}}
{{--                                                <!-- BEGIN FORM-->--}}
{{--                                                <form action="{{route('items.store')}}" method="POST" class="form-horizontal">--}}
{{--                                                    @csrf--}}
{{--                                                    <div class="form-body">--}}
{{--                                                        <!--country_id-->--}}
{{--                                                        <div class="form-group  ">--}}
{{--                                                            <label class="col-md-3 control-label">Item :</label>--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <select class="js-example-basic-multiple"  data-tags="true" id="tags" name="barcode_id[]" multiple="multiple">--}}
{{--                                                                    <option value="0">Item </option>--}}
{{--                                                                    @foreach ($barcodes as $barcode)--}}
{{--                                                                        <option value="{{$barcode->id}}" {{ old('barcode_id') == $barcode->id ? 'selected' : '' }}>{{$barcode->id}}</option>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </select> --}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!--button-->--}}
{{--                                                    <div class="form-actions">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-offset-3 col-md-9">--}}
{{--                                                                <button type="submit" class="btn btn-circle green">Collect</button>--}}
{{--                                                                <a href="{{route('items.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
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
{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
{{--<script>$(document).ready(function() {--}}
{{--    $('.js-example-basic-multiple').select2();--}}
{{--});</script>    --}}
{{--@endsection--}}
