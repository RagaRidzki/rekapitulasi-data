<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="{{ route('login.auth') }}" method="POST">
                        @csrf
                        @if (Session::get('failed'))
                            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                        @endif
                        @if (Session::get('logout'))
                            <div class="alert alert-primary">{{ Session::get('logout') }}</div>
                        @endif
                        @if (Session::get('canAccess'))
                            <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                        @endif
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email" name="email">Email address</label>
                            <input type="email" id="email" class="form-control form-control-lg" name="email" />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password" name="password">Password</label>
                            <input type="password" id="password" class="form-control form-control-lg"
                                name="password" />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
