        @include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/session.js"></script>
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/validacpfcnpj.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/ajax.js"></script>

</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-bars fa-2x"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbspPedidoWEB</h1>
            </div>
        </div>

        <div style="position: relative; top: 70px;">
            
            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

            <form id="form_pedido" method="POST" action="">
                {{ csrf_field() }}
                <div class="content">
                    <div class="form-group form-group-style" >
                    
                        <div class="alert alert-danger invisivel" id="alerta-cnpj-incorreto">
                            {!! Session::get('cnpj_incorreto') !!}
                        </div>
                        

                        @if(Session::has('cnpj_correto_nao_existe'))
                        <div class="alert alert-danger">
                            {!! Session::get('cnpj_correto_nao_existe') !!}<a href="{!! route('painel/clientes/adiciona') !!}">Deseja incluir?</a>
                        </div>
                        @endif  

                        <label for="pesquisa_cliente">Informe o CPF/CNPJ ou NOME/RAZÃO SOCIAL do cliente</label>                                                                   
                        <div class="input-group" id="gbox_pesquisa_cliente">
                            
                            <input type="text" class="form-control input-lg" id="edit_busca_cliente" name="pesquisa_cliente" value="{!! \Request::input('pesquisa_cliente') !!}" placeholder="Informe o CPF ou CNPJ do cliente" autofocus>
                        
                            <div class="input-group-addon"><button type="button" style="border: none; background-color: none;" id="btn_buscacliente"><i class="fa fa-search"></i></button></div> 
                        </div>                          
                                                                         
                        <div class="collapse" id="gbox_endereco">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="edit_razao"><small>Razão Social</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_razao" name="edit_razao" disabled>                        
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_fantasia"><small>Nome Fantasia</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_fantasia" name="edit_fantasia" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <label for="edit_endereco"><small>Endereço</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_endereco" name="edit_endereco" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="edit_numero"><small>Número</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_numero" name="edit_numero" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit_bairro"><small>Bairro</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_bairro" name="edit_bairro" disabled>                        
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="edit_cidade"><small>Cidade</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_cidade" name="edit_cidade" disabled>                        
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="edit_estado"><small>Estado</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_estado" name="edit_estado" disabled>                        
                                </div>

                                <div class="col-md-2">
                                    <label for="edit_cep"><small>CEP</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_cep" name="edit_cep" disabled>                        
                                </div>
                            </div>

                        </div>

                        <div class="center_obj"><a class="btn_collapse" data-toggle="collapse" href="#gbox_endereco"><i class="fa fa-chevron-down fa-2x"></i></a></div>

                    </div>
                </div>

                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-money"></i>&nbspInformações sobre a Forma de Pagamento</p>         

                <div class="form-group form-group-style">
                    <label for="edit_formapagto">Forma de pagamento</label>
                    <input type="text" class="form-control input-lg" id="edit_formapagto" name="edit_formapagto" value="" placeholder="Ex: 30/60/90 ou A VISTA...">
                </div>   

                </br>
                
                <div class="gbox_header">
                    <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspInformações dos produtos</p>         
                </div>

                <div class="form-group form-group-style">
                    <label for="edit_busca">Clique em "+" para adicionar um produto</label>
                    <div class="input-group">   
                        <div class="input-group-addon"><a href="{!! url('/painel/clientes/adiciona') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
                        <input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Inserir produto..." value="">
                    </div>
                </div>

                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" class="form-control btn btn-primary" value="Salvar">
                        </div>
                        
                        <div class="col-md-6">
                            <input type="button" class="form-control btn btn-danger" value="Cancelar">
                        </div>
                    </div>
                </div>


            </form>
        </div>

    </div>