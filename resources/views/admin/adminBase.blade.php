<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>نادي الأندلس العلمي</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/logos/logo-andalus.ico') }}">

    <!-- font-->
    <link rel="stylesheet" href="{{ asset('/font/iconsmind-s/css/iconsminds.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/font/simple-line-icons/css/simple-line-icons.css') }}"/>
    <script src="https://use.fontawesome.com/6ecd46a791.js"></script>
    <script src="https://kit.fontawesome.com/e935d4c6a9.js" crossorigin="anonymous"></script> {{--fontawesome 5--}}


    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap.rtl.only.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/datatables.responsive.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/glide.core.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap-stars.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/nouislider.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/component-custom-switch.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">




</head>

<body id="app-container" class="menu-default show-spinner">

@include('admin.body.header')
@include('admin.body.mainMenu')

<main>

    @yield('admin')

</main>


@include('admin.body.footer')



<!-- Scripts-->
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('/js/vendor/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('js/vendor/jquery.validate/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/vendor/jquery.validate/additional-methods.min.js')}}"></script>
<script src="{{ asset('/js/vendor/datatables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{ asset('js/dore.script.js/js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('/js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('/js/vendor/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{ asset('/js/vendor/moment.min.js')}}"></script>
<script src="{{ asset('/js/vendor/progressbar.min.js')}}"></script>
<script src="{{ asset('/js/vendor/jquery.barrating.min.js')}}"></script>
<script src="{{ asset('/js/vendor/select2.full.js')}}"></script>
<script src="{{ asset('/js/vendor/nouislider.min.js')}}"></script>
<script src="{{ asset('/js/vendor/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('/js/vendor/Sortable.js')}}"></script>
<script src="{{ asset('/js/vendor/mousetrap.min.js')}}"></script>
<script src="{{ asset('/js/vendor/glide.min.js')}}"></script>
<script src="{{ asset('/js/dore.script.js')}}"></script>
<script src="{{ asset('/js/scripts.js')}}"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(function(){
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            var link = $(this).attr("href");


            Swal.fire({
                title: 'هل أنت متأكد من الحذف؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "لا",
                confirmButtonText: 'نعم'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                }
            })


        });

    });


</script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    toastr.options =
        {
            'positionClass': 'toast-top-left'
        }
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>


</body>

</html>
