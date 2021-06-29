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
                            <i class="fa fa-globe"></i>Table Languages </div>
                        <div class="actions">
                            <a href="{{route('languages.create')}}" class="btn btn-default btn-sm btn-circle">
                                <i class="fa fa-plus"></i> Add </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2">
                            <thead>
                                <tr>
                                    <th class="text-center"> Name </th>
                                    <th class="text-center"> Image </th>
                                    <th class="text-center"> Edit </th>
                                    <th class="text-center"> Delete </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($languages as $language)
                                <tr>
                                    <td class="text-center">{{$language->name}}</td>
                                    <td class="text-center"><img src="{{url('storage/'.$language->image)}}" alt="{{$language->name}}" width="30px" height="30px"></td>
                                    <td class="text-center"> 
                                        <a href="{{route('languages.edit', $language->id)}}" class="btn btn-circle btn-info btn-md">Edit</a>
                                    </td>
                                    <td class="text-center">  
                                    <form method="POST" action="{{ route('languages.destroy', $language->id) }}">
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