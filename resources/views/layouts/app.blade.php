<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>MB Hỗ trợ tài chính</title>
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('layouts.inc.header')
@yield('content')
@include('layouts.inc.footer')

@if(session('error'))
    <script>
        Swal.fire({
            title: "Không thành công",
            text: "{{session('error')}}",
            icon: "error"
        });
    </script>
@endif
@if(session('success'))
    <script>
        Swal.fire({
            title: "Thành công",
            text: "{{session('success')}}",
            icon: "success"
        });
    </script>
@endif
@if(session('redirect'))
    <script>
        window.addEventListener("load", (event) => {
            window.open('{{url(session('redirect'))}}', "_blank")
        });
    </script>
@endif
</html>

