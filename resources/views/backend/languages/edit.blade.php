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
                                                    <i class="fa fa-gift"></i>Edit Languages </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('languages.update' , $language->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ method_field('PUT') }}
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--Name--> 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$language->name}}" type="text" class="form-control input-circle" placeholder="Name" name="name"> 
                                                                    @error('name')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Code--> 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Code:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$language->code}}" type="text" class="form-control input-circle" placeholder="Code" name="code">
                                                                    @error('code')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Image--> 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Image:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon right">
                                                                    <input id="imgInp" type="file" class="form-control input-circle" name="image"> 
                                                                    <br>
                                                                    <img id="blah" src="#" height="50px" width="80px" alt="your image" />
                                                                    @error('image')
                                                                    <div><span class="text-danger my-2">{{ $message }}</span></div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">Edit</button>
                                                                <a href="{{route('languages.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>
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
@section('js')
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>

@endsection
