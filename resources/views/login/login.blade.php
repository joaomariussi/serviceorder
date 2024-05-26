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
        <div class="container">
            <div class="banner">

            </div>
            <div class="login-container">
                <h1 class="login-title">LOGIN</h1>

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(auth()->check())
                    <p>Está logado - <a href="{{ route('logout') }}">Sair</a></p>
                @else
                    @error('error')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <form action="{{ route('login') }}" method="post" class="login-form">
                        @csrf
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="email">Usuário</label>
                            <input class="input-email" type="text" name="email" id="email"
                                   placeholder="Usuário" value="teste@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <div class="password-wrapper">
                                <input class="input-senha" type="password" name="password" id="password" value="1234" placeholder="Senha" required>
                                <span id="showPassword" class="show-eye-icon"><i class="fas fa-eye"></i></span>
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a href="#" class="forgot-password">Recuperar senha?</a>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-lg">LOGIN</button>
                        </div>
                    </form>
                @endif
            </div>
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

        // Adiciona posicionamento absoluto ao ícone do olho
        var passwordWrapper = $('.password-wrapper');
        var showPassword = $('#showPassword');
        showPassword.css({
            'position': 'absolute',
            'right': '10px',
            'top': '50%',
            'transform': 'translateY(-50%)',
            'cursor': 'pointer'
        });
        passwordWrapper.css('position', 'relative');
    });
</script>
