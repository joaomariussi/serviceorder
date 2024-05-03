<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
        <body>
            <div class="login-container">

                <div class="container">
                    <h1 class="login-title">
                        <i class="fas fa-user-circle"></i>
                    </h1>
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(auth()->check())
                    <a href="{{ route('logout') }}">Sair</a>
                @else
                    @error('error')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('login') }}" method="post" class="login-form">
                        @csrf

                        <div class="form-group">
                            <input class="input-login-email" type="text" name="email" placeholder="E-mail" value="teste@gmail.com" required>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-login password">
                                <input class="form-input" type="password" name="password" value="1234" placeholder="Senha" required>
                                <button type="button" id="showPassword" class="show-password">👁</button>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                @endif
            </div>
        </body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#showPassword').on('click', function(){
            var passwordField = $('input[name="password"]');
            var passwordFieldType = passwordField.attr('type');

            if(passwordFieldType == 'password')
            {
                passwordField.attr('type', 'text');
                $(this).removeClass('show');
            } else {
                passwordField.attr('type', 'password');
                $(this).addClass('show');
            }
        });
    });
</script>
