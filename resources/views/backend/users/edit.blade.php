@extends('layouts.admin')
@section('content')
    <div style="display: none" id="our_token" value="{{csrf_token()}}"></div>
    <div style="display: none" id="user_type" value="{{$user->type}}"></div>
    <div style="display: none" id="user_id" value="{{$user->id}}"></div>
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
                                                    <i class="fa fa-gift"></i>Edit Users </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="{{route('users.update' ,$user->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    {{ method_field('PUT') }}
                                                    @csrf
                                                    <div class="form-body">
                                                        <!--Name-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Name:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$user->name}}" type="text" class="form-control input-circle" placeholder="Name" name="name">
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
                                                                    <input  value="{{$user->email}}" type="email" class="form-control input-circle" placeholder="Email" name="email">
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
                                                                        <option value="{{$country->id}}" {{$user->area_id == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <!--Address-->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Address:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$user->address}}" type="text" class="form-control input-circle" placeholder="Address" name="address">
                                                                    @error('address')
                                                                    <div>
                                                                        <span class="text-danger my-3">{{ $message }}</span>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Phone:</label>
                                                            <div class="col-md-6">
                                                                <div class="input-icon">
                                                                    <input  value="{{$user->phone}}" type="number" class="form-control input-circle" placeholder="Phone" name="phone">
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
{{--                                                                    <input  type="password" class="form-control input-circle" placeholder="Password" name="password">--}}
{{--                                                                    @error('password')--}}
{{--                                                                    <div>--}}
{{--                                                                        <span class="text-danger my-3">{{ $message }}</span>--}}
{{--                                                                    </div>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <!--type-->
                                                        <div class="form-group  ">
                                                            <label class="col-md-3 control-label">Type :</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control input-circle"name="type">
                                                                    <option value="">Select Type</option>
                                                                    <option value="user"{{old('type' , $user->type == 'user' ? 'selected' : '')}}>User</option>
                                                                    <option value="admin"{{old('type' , $user->type == 'admin' ? 'selected' : '')}}>Admin</option>
                                                                    <option value="seller"{{old('type' , $user->type == 'seller' ? 'selected' : '')}}>Seller</option>
                                                                    <option value="operator"{{old('type' , $user->type == 'operator' ? 'selected' : '')}}>Operator</option>
                                                                    <option value="courier"{{old('type' , $user->type == 'courier' ? 'selected' : '')}}>Courier</option>
                                                                    <option value="accountant"{{old('type' , $user->type == 'accountant' ? 'selected' : '')}}>Accountant</option>
                                                                </select>
                                                            </div>
                                                        </div>




                                                            <div class="form-group " id="id_number_div" style="display: none">
                                                                <label class="col-md-3 control-label" >ID Number: (Optional)</label>
                                                                <div class="col-md-6">
                                                                    <div class="input-icon">
                                                                        <input id="id_number_input"  value='{{old("id_number")}}' type="text" class="form-control input-circle" placeholder="Enter Seller Identification Number" name="id_number" >
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
    const user_id  = $('#user_id').attr('value') ;
    function getSellerAccountData(user_id)
    {

            $.ajax({
                type:'post',
                url:'/admin/getSellerBackAccount/'+user_id ,
                data:{
                    '_token':$('#our_token').attr('value')
                } ,
                success:function(data){
                    if(data.bank_account)
                    {
                        $('#bank_account_input').val(data.bank_account)
                    }
                    else{
                        $('#bank_account_input').val('')
                    }
                    if(data.id_number){
                        $('#id_number_input').val(data.id_number);
                    }
                    else{
                        $('#id_number_input').val('')
                    }
                }
            });

    }
     onpageshow= function()
    {
        if($('#user_type').attr('value') =='seller')
        {
            $('#bank_account_div , #id_number_div').slideDown(400);
            getSellerAccountData(user_id);
        }
        else{
            $('#bank_account_div , #id_number_div').slideUp(400);
        }
    }
    $(function(){
        $('select[name="type"] ').on('change',function(){
            const user_type = $(this).val();
            $('#bank_account_input,#id_number_input').val('')
            if(user_type == 'seller')
            {
              getSellerAccountData(user_id);
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
