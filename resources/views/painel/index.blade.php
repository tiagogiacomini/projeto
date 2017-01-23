@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<title>SpartumWEB - Home</title>
<script type="text/javascript">
   
    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();

    });

</script>

</head>
<body>

    <div>
        <div class="container_painel">
            <div class="btn_menu">
                <a href="{!! route('logout') !!}" class="links_icones"><i class="fa fa-power-off fa-2x"></i></a>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbsp{!! config('app.name') !!}</h1>
            </div>
        </div>

        <div class="container_botoes full_height flex_center center_obj">
            <div>
                <span class="btn_painel" data-toggle="tooltip" title="Permite incluir, editar ou excluir pedidos!">
                    <a class="links_icones" href="{!! route('pedidos') !!}" >
                        <i class="fa fa-shopping-basket fa-3x"></i>
                    </a>
                <br><p>Pedidos</p></span>
                                
                <span class="btn_painel" data-toggle="tooltip" title="Permite incluir ou exibir clientes!">
                    <a class="links_icones" href="{!! route('clientes') !!}">
                        <i class="fa fa-users fa-3x"></i>
                    </a>
                <br><p>Clientes</p></span>
                
                </br>                
                
                <span class="btn_painel" data-placement="bottom" data-toggle="tooltip" title="Somente exibe produtos!">
                    <a class="links_icones" href="{!! route('produtos') !!}">
                        <i class="fa fa-cubes fa-3x"></i>
                    </a>
                </br><p>Produtos</p></span>
                
                <span class="btn_painel" data-placement="bottom" data-toggle="tooltip" title="Configurações do aplicativo!">
                    <a class="links_icones" href="#">
                        <i class="fa fa-cogs fa-3x"></i>
                    </a>
                </br><p>Opções</p></span>
                
            </div>
        </div>
    </div>

@include('partials.footer')

