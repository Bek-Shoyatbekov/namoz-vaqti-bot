<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap.min.css")}}">
</head>
<body>
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has("incorrect"))
        <div class="alert alert-danger">
            {{ Session::get("incorrect") }}
        </div>
    @endif
    <h1 align="center" class="mt-5">Login sahifasi</h1>
    <div class="row">
        <div class="col-8 mx-auto mt-4">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="loginInput">Login</label>
                    <input type="text" class="form-control" id="loginInput" name="login">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="password">
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Kirish</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset("js/jquery-3.5.1.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/bootstrap.bundle.min.js")}}"></script>
</body>
</html>

