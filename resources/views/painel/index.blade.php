@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/pace.min.js"></script>

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
                <h2>&nbsp{!! config('app.name') !!}</h2>
            </div>
        </div>

        <div class="container_botoes">
            <div>

                <a class="links_icones" href="{!! route('clientes') !!}">
                    <span class="btn_painel" data-toggle="tooltip" title="Permite incluir ou exibir clientes!">
                    
                        <i class="fa fa-users fa-3x"></i>
                    
                    </br><p>Clientes</p>
                    </span>
                </a>
                                              
                <a class="links_icones" href="{!! route('produtos') !!}">
                <span class="btn_painel" data-placement="bottom" data-toggle="tooltip" title="Somente exibe produtos!">
                    
                        <i class="fa fa-cubes fa-3x"></i>
                
                    </br><p>Produtos</p>
                    </span>
                </a>
                
                </br>
                
                <a class="links_icones" href="{!! route('pedidos') !!}" >
                    <span class="btn_painel" data-toggle="tooltip" title="Permite incluir, editar ou excluir pedidos!">
                    
                        <i class="fa fa-shopping-basket fa-3x"></i>

                    </br><p>Pedidos</p>
                    </span>
                </a>

                <a class="links_icones" href="{!! route('configuracoes') !!}" >
                    <span class="btn_painel" data-toggle="tooltip" title="Configurações do SpartumWEB!">
                    
                        <i class="fa fa-gears fa-3x"></i>

                    </br><p>Configurações</p>
                    </span>
                </a>
                                
            </div>
        </div>
    </div>

@include('partials.footer')

