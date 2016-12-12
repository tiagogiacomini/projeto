@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/login.css">

</head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title"><i class="fa fa-user-circle-o"></i>&nbsp{!! config('app.name') !!}</div>
                    <div class="form-group" >
                        <form id="form_login" method="POST" action="/auth/login">
                        
                        @if (isset($falha_login))
                           @if ($falha_login)
                           
                           <div class="alert alert-warning">
                                <strong>Atenção! </strong>Usuário ou senha estão incorretos, verifique!
                            </div>

                           @endif
                        @endif

                        <input type="text" name="edit_usuario" id="usuario" class="form-control edit_usuario" placeholder="Nome de Usuário" autofocus></br>
                        <input type="password" name="edit_password" class="form-control edit_senha" placeholder="SENHA"></br>
                        <input type="submit" name="btn_login" class="btn_login btn btn-primary" value="Login">
                    </form>
                </div>

                <div class="links">
                    <a href="http://infinitysoft.com.br">www.infinitysoft.com.br</a>
                </div>
            </div>
        </div>
    </body>
</html>
