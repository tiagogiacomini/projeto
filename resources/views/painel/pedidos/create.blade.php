@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script src="/js/functions.js"></script>
<script src="/js/ajax.js"></script>

</head>
<body>

    <div>
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-bars fa-2x"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbspPedidoWEB</h1>
            </div>
        </div>


        <div style="position: relative; top: 90px;">
            <div class="content">
                <div class="form-group" >
                <p><strong>Cliente</strong></p>
                    <form id="form_pedido" method="GET" action="">
                        
                        @if (isset($dados_cliente['achou']))
                            @if (!empty($dados_cliente['achou']))                           
                                <div class="alert alert-warning">
                                    <strong>Atenção! </strong> {!! $dados_cliente['achou'] !!}
                                </div>
                            @endif
                        @endif
                        
                        <div class="input-group">
                        
                        @if (isset($dados_cliente['cnpj']))
                            <input type="text" class="form-control input-lg" id="cnpj_cliente" maxlength="18" name="cnpj_cliente" value="{!! $dados_cliente['cnpj'] !!}" placeholder="Informe o CPF ou CNPJ do cliente">
                        @else
                            <input type="text" class="form-control input-lg" id="cnpj_cliente" maxlength="18" name="cnpj_cliente" placeholder="Informe o CPF ou CNPJ do cliente">
                        @endif
                        
                        <div class="input-group-addon"><button id="btn_buscacliente"><i class="fa fa-search"></i></button></div> 

                        </div>                          
                        @if (isset($dados_cliente['nome']))
                            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" value="{!! $dados_cliente['nome'] !!}" disabled>
                        @else
                            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" disabled>
                        @endif




                        <input type="submit" class="btn btn-primary btn_salvar" value="Salvar">
                    </form>
                </div>
            </div>
        </div>

    </div>
