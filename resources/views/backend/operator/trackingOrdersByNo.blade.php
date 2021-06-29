@extends('layouts.admin')

@section('css')
    <link href="{{url('backend/assets/new/custom_css.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    @include('layouts.toaster')
    <span id="our_token" style="display: none" value="{{csrf_token()}}"></span>
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
                                            <i class="fa fa-gift"></i>Filter Using Tracking Number </div>
                                    </div>
                                    <div class="portlet-body form assign_to_courier_data">
                                        <!-- BEGIN FORM-->
                                        <div style="width: 50%; margin: auto ; text-align: center;display: none"  id="excel_btn_form">

                                        </div>


                                      <form class="form-horizontal">
                                          @csrf
                                          <div class="form-body">
                                              <!--country_id-->
                                              <div class="row">
                                                  <div class="col-xs-3" style="text-align: center;">

                                                      <div class="form-group ">
                                                          <div class="col-md-12">
                                                              <textarea class="form-control search_field" name="barcode_number" cols="45" rows="25" placeholder="Enter Tracking Number Separated By ,"></textarea>
                                                          </div>

                                                      </div>
                                                      <div class="form-group ">
                                                          <div class="col-md-12">
                                                              <button class="btn green search_btn"> Search </button>
                                                          </div>

                                                      </div>

                                                  </div>
                                                  <div class="col-xs-9">
                                                      <div class="form_search_result" style="display: none">
                                                          <table class="table table-striped table-bordered table-hover table-header-fixed" >
                                                              <thead>
                                                              <tr>
                                                                  <th class="text-center">#</th>
                                                                  <th class="text-center"> Tracking Number </th>
                                                                  <th class="text-center"> Client Name </th>
                                                                  <th class="text-center"> Phone </th>
                                                                  <th class="text-center"> Address </th>
                                                                  <th class="text-center"> Previous Status </th>
                                                                  <th class="text-center"> Current Status </th>



                                                                  <th class="text-center"> Price </th>
                                                                  <th class="text-center"> Hub </th>
                                                                  <th class="text-center"> Area </th>
                                                                  <th class="text-center"> Seller </th>
                                                                  <th class="text-center"> Courier </th>
                                                                  <th class="text-center"> Date </th>
                                                              </tr>
                                                              </thead>
                                                              <tbody class="body_for_search_result">

                                                              </tbody>
                                                          </table>
                                                          <div style="width: 50%; margin: auto ; text-align: center" id="excel_btn_div">

                                                          </div>

                                                      </div>

                                                      <div class="no_result_found alert alert-success" style="display: none;text-align: center;color: #fff">
                                                          <h3 style="text-align: center">No Result Found </h3>
                                                          <img width="500px" height="290px" src="{{asset('backend/assets/new/no_result_image.png')}}">
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!--button-->

                                      </form>



                                    {{-- Courier data here --}}

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
        $('.search_btn').on('click',(event)=>{
            event.preventDefault();
           let search_field = $('.search_field').val() ;
             if(search_field.length)
             {
                 $.ajax({
                     type:'get',
                     url:'/admin/searchByTrackingNumber',
                     data:{
                         '_token':"{{csrf_token()}}" ,
                         'search_field':search_field
                     },
                     success:function(data)
                     {
                         if(data.no_search_result)
                         {
                             var result_table = $('.body_for_search_result');
                             var search_result= data.search_result ;
                             $('.no_result_found').hide();
//                             $(data.search_result)

                             var order = 0 ;
                             result_table.empty();
                             let excel_ids = '';

                             for(const key in search_result )
                             {
                                 result_table.append(`
                                  <tr class="tracking_tr_excel"  data-barcodes_id="${excel_ids += search_result[key].id + ','}  ">
                                     <td> ${++order} </td>
                                     <td>${search_result[key].barcode_number} </td>


                                     <td>${search_result[key].client_name} </td>
                                    <td>${search_result[key].phone} </td>
                                      <td>${search_result[key].address} </td>
  <td>${search_result[key].previous_status} </td>
                                         <td>${search_result[key].status} </td>
                                      <td>${search_result[key].price} EGP</td>
                                     <td>${search_result[key].area_name} </td>
    <td>${search_result[key].sub_area_name} </td>
                                       <td>${search_result[key].barcode_seller_name} </td>
                                      <td>${search_result[key].courier_name}  </td>
                                     <td>${search_result[key].created_at}  </td>
                                 </tr>
                                 `);
                             }
                             $('#excel_btn_form').html(`<form method="post" id="excel_form_form" action="{{Route('filter.all.excel')}}">
                             <input value="${excel_ids}" name="barcodes_ids" >
                             <input type="hidden" name="_token" value="${$('#our_token').attr('value')}">
                             </form>`);
                             $('#excel_btn_div').html(`<button  class="btn green-dark" id="excel_btn"> Export As Excel </button>`)


                             $('.form_search_result').slideDown();

                         }
                         else{
                             $('.form_search_result').hide();
                             $('.no_result_found').slideDown();


                         }
                     }

                 });
             }
             else{
                 $('.form_search_result').slideUp(400 ,()=>{
                     $('.no_result_found').slideUp(400,()=>{
                         alert('Empty Search Field !');

                     });

                 });


             }


        })
    </script>
    <script>
        $(document).on('click','#excel_btn',function(e){
            e.preventDefault();
            $('#excel_form_form').submit();
        });
    </script>

    {{--<script src="{{asset('backend/assets/new/custom_js.js')}}"></script>--}}
@endsection
