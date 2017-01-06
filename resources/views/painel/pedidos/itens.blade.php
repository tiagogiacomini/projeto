@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/pedidos._itens.js"></script>

</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbspPedidoWEB - Itens</h1>
            </div>
        </div>

        <div style="position: relative; top: 70px;">
            
            <div class="form-group form-group-style">
                <div class="row">
                    <div class="col-md-6">
                        <label for="edit_nrpedido">Nº do PEDIDO</label>
                        <input type="number" class="form-control" value="{!! sprintf('%06d', $pedido->ID_PEDIDO) !!}" disabled>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="edit_vendedor">Vendedor Responsável</label>
                        <input type="text" class="form-control" value="{!! $vendedor_nome !!}" disabled>
                    </div>
                </div>
            </div>

                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="edit_produtos">Produtos</label> 
                            {{ \Form::select('edit_produtos', $produtos, null, array('class' => 'edit_produtos form-control uppercase', 'id' => 'edit_produtos')) }}
                        </div>
                    </div>
                </div>




        </div>
