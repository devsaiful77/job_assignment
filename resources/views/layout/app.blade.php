<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('content/css/bootstrap.min.css') }}">
    <script src="{{ asset('content/js/jquery.min.js') }}"></script>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    <script>
        $(document).ready(function() {
            // Login
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        console.log(response);

                        // alert(response.message);
                        // window.location.reload();
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            // Logout
            $('#logoutButton').on('click', function() {
                $.ajax({
                    url: '/api/logout',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        window.location.reload();
                    }
                });
            });
        });
    </script>

</body>
</html>
