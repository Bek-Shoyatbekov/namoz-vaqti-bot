<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield("additional_assets")
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background: #eee
        }

        .navigation {
            background: transparent
        }

        .content {
            min-height: 20px;
            background: white;
            border-radius: 5px;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-2 navigation">
                @include('admin.layouts.navigation')
            </div>
            
            <div class="col-8 mx-1 content py-3">
                            
                @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('warning_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('danger_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('danger_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h1>@yield('title')</h1>
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
