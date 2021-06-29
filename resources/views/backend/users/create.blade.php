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
                                                    <i class="fa fa-gift"></i>Add Users </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("name")}}' type="text" class="form-control input-circle" placeholder="Name" name="name">
                                                                    @error('name')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--email-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Email:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("email")}}' type="email" class="form-control input-circle" placeholder="Email" name="email">
                                                                    @error('email')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Area-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">Area Name :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="area_id">
                                                                    <option value="0">Area Name </option>
                                                                    @foreach (\App\Models\Country::all() as $country)
                                                                        <option value="{{$country->id}}" {{ old('area_id') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--Address-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Address:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("address")}}' type="text" class="form-control input-circle" placeholder="Address" name="address">
                                                                    @error('address')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Phone-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Phone:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value='{{old("phone")}}' type="number" class="form-control input-circle" placeholder="Phone" name="phone">
                                                                    @error('phone')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--password-->
{{--                                                        <div class="form-group">--}}
{{--                                                            <label class="col-md-3 control-label">Password:</label>--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <div class="input-icon">--}}
{{--                                                                    <input  value='{{old("password")}}' type="password" class="form-control input-circle" placeholder="Password" name="password">--}}
{{--                                                                    @error('password')--}}
{{--                                                                    <div>--}}
{{--                                                                        <span class="text-danger my-3">{{ $message }}</span>--}}
{{--                                                                    </div>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <!--type-->
                                                        <div class="form-group  " >
                                                            <label class="col-md-3 control-label">Type :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle" name="type">
                                                                    <option value="" @if (old('type') == '') selected="selected" @endif>Select Type</option>
                                                                    <option value="user" @if (old('type') == 'user') selected="selected" @endif>User</option>
                                                                    <option value="admin" @if (old('type') == 'admin') selected="selected" @endif>Admin</option>
                                                                    <option value="seller" @if (old('type') == 'seller') selected="selected" @endif>Seller</option>
                                                                    <option value="operator" @if (old('type') == 'operator') selected="selected" @endif>Operator</option>
                                                                    <option value="courier" @if (old('type') == 'courier') selected="selected" @endif>Courier</option>
                                                                    <option value="accountant" @if (old('type') == 'accountant') selected="selected" @endif>Accountant</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group " id="id_number_div" style="display: none">
                                                            <label class="col-md-3 control-label" >ID Number: (Optional)</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input id="id_number_input"  value='{{old("id_number")}}' type="text" class="form-control input-circle" placeholder="Enter Seller Identification Number" name="id_number">
                                                                    @error('id_number')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group " id="bank_account_div" style="display: none">
                                                            <label class="col-md-3 control-label">Bank Account: (Optional)</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input id="bank_account_input"  value='{{old("bank_account")}}' type="text" class="form-control input-circle" placeholder="Enter Seller Bank Account" name="bank_account">
                                                                    @error('id_number')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
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
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--button-->
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn btn-circle green">Create</button>
                                                                <a href="{{route('users.index')}}" class="btn btn-circle grey-salsa btn-outline">Back</a>
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
        $(function(){
            $('select[name="type"] ').on('change',function(){
                const user_type = $(this).val();
                $('#bank_account_input,#id_number_input').val('')
                if(user_type == 'seller')
                {
                    $('#bank_account_div , #id_number_div').slideDown(400);
                }
                else{
                    $('#bank_account_div , #id_number_div').slideUp(400);
                }


            });
        })
    </script>
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
