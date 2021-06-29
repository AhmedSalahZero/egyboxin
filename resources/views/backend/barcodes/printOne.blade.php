@extends('layouts.admin')
@section('css')
    <style>
        @media print
        {
            .confirm_assign_order_btn , .print_debrief_btn,.disable_on_print{
                display: none;
            }
            .display_on_print , .print_class
            {
                display: block !important;
            }
            .print_tr
            {

                text-align: center;

            }
            input[type="search"]
            {
                display: none;
            }
            .print_class
            {
                height: 650px;
                /*height: 100%;*/
            }

        }
    </style>
    @endsection
@section('content')

       <div style="display: none;position: relative" class="print_class" >
           <div class="header">
               <div  style="display: none" class="col-xs-12 display_on_print">
                   <img width="150px" height="50px" src="{{asset('backend/assets/layouts/layout4/img/logo-light.png')}}">
                   <div class="barcode" style="margin-left: 400px">
                     {!! DNS1D::getBarcodeSVG($barcode->barcode_number, "C128",4.0,70) !!}
                       {{--                                                        <p class="pid">{{$barcode->barcode_number}}</p>--}}
                   </div>
                   <h4 style="display: inline-block;float: right">{{date('l , d F Y ' , strtotime(now()))}}</h4>
                   <table class="table">
                   </table>

               </div>
           </div>
           <div class="content_print">
               <table class="table">
                   <thead>
                   <tr>

                       <th class="text-center"> Seller </th>
                       <th class="text-center"> Client Name </th>
                       <th class="text-center"> Phone </th>

                       <th class="text-center"> Address </th>
                       <th class="text-center"> Note </th>
                       <th class="text-center"> Price </th>

                   </tr>
                   </thead>
                   <tbody>

                       <tr  class="delete_feather_row{{$barcode->id}} print_tr">

                           <td class="text-center">{{$barcode->seller->name}}</td>

                           <td class="text-center">{{$barcode->client_name}}</td>
                           <td class="text-center">{{$barcode->phone}}</td>
                           <td class="text-center">{{$barcode->address}}</td>
                           <td class="text-center">{!!  $barcode->content !!}</td>
                           <td class="text-center">{{number_format($barcode->price)}} EGP</td>
                       </tr>
                   </tbody>
               </table>
               <div  class="position-absolute" style="width:100%;position:absolute;top: 300px;left:0;border: 1px solid #333">
                   <h3 style="padding: 10px">Receiver Signature :</h3>
               </div>

           </div>
       </div>




<!-- END CONTENT -->

@endsection

@section('js')
    <script>
        $(function(){
            window.print();


        });
        window.onafterprint=function(){
            // console.log(window.location.hostname)
            window.location.href = (window.location.origin+'/admin/shipments') ;
        }
    </script>
@endsection
