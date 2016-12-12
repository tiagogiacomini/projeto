@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
<body>

    <div>
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-bars fa-2x"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbsp{!!config('app.name')!!}</h1>
            </div>
        </div>

        <div class="container_botoes center_obj">
            <div>
                
                <a href="{!! route('pedido') !!}" >
                    <span class="btn_painel"><i class="fa fa-shopping-basket fa-3x"></i>
                       </br>
                       <p>Pedido</p>
                    </span>
                </a>
                <a href="{!! route('clientes') !!}">                 
                    <span class="btn_painel"><i class="fa fa-users fa-3x"></i>
                       <br>
                       <p>Clientes</p>
                    </span>
                </a>
                </br>                
                <a href="{!! route('produtos') !!}">                
                    <span class="btn_painel"><i class="fa fa-cubes fa-3x"></i>
                        </br>
                        <p>Produtos</p>
                    </span>
                </a>
                <a href="#">    
                    <span class="btn_painel"><i class="fa fa-cogs fa-3x"></i>
                        </br>
                        <p>Opções</p>
                    </span>
                </a>
            </div>
        </div>
    </div>

@include('partials.footer')

</body>
</html>