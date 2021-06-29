<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@if(session()->has('success'))




    <script>
        $(document).ready(function(){

            toastr.success( "{{session()->get('success')}}",'',{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "500",
                "timeOut": "2500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"


            })

        })
    </script>


@endif

@if(session()->has('fail') || session()->has('errors'))
    <script>
        $(document).ready(function(){

            toastr.error("{{session()->has('fail') ? session()->get('fail') : session()->get('errors')->first() }}", ''  ,{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "500",
                "timeOut": "2500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"

            })

        })
    </script>



@endif






