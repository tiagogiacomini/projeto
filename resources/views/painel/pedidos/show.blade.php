@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/pedidos.js"></script>
<title>SpartumWEB - Exibindo Pedido Nº {!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</title>

</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-shopping-basket"></i><h2>&nbspPedido {!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</h2>
            </div>
        </div>

        <div style="position: relative; top: 70px;">

            @if (!is_null($pedido->DATA_IMPORTACAO))
            <div class="form-group-style text-center">
                <i class="fa fa-warning fa-2x"></i><h1>Atenção</h1>
                <p>Este pedido já foi importado pelo sistema interno da empresa em {!! \Carbon\Carbon::parse($pedido->DATA_IMPORTACAO)->format('d/m/Y H:i') !!} por {!! $pedido->NOME_USUARIO_IMP !!}.</p>
  
            </div>
            @endif

            </br>            
            <div class="form-group form-group-style">
                <div class="row">
                    <div class="col-md-6">
                        <label for="edit_nrpedido">Nº Pedido (provisório)</label>
                        <input type="text" class="form-control input-lg text-right" value="{!! sprintf('%06d', $pedido->ID_PEDIDO) !!}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_vendedor">Vendedor Responsável</label>
                        <input type="text" class="form-control input-lg" value="{!! $vendedor_nome !!}" disabled>
                    </div>
                </div>
            </div>


            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

            <form id="form_pedido">
                
                <div class="content">
                    <div class="form-group form-group-style" >

                        <div class="row">
                            <div class="col-md-12">
                                <label for="pesquisa_cliente">CPF/CNPJ do Cliente</label>                                                                   
                                <input type="text" class="form-control input-lg" value="{!! $cliente->CNPJ !!}" disabled>
                            </div>
                        </div>
                                                                                                                         
                        <div class="collapse" id="gbox_endereco">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="edit_razao"><small>Razão Social</small></label>
                                    <input type="text" class="form-control input-sm"  value="{!! $cliente->RAZAO !!}" disabled>                        
                                </div>

                                <div class="col-md-4">
                                    <label for="edit_fantasia"><small>Nome Fantasia</small></label>
                                    <input type="text" class="form-control input-sm"  value="{!! $cliente->NOME_FANTASIA !!}" disabled>
                                </div>

                                <div class="col-md-2">
                                    <label for="edit_telefone"><small>Telefone</small></label>
                                    <input type="text" class="form-control input-sm phone" value="{!! $cliente->TELEFONE !!}" disabled>
                                </div>                                
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <label for="edit_endereco"><small>Endereço</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->ENDERECO !!}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="edit_numero"><small>Número</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->NUMERO !!}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit_bairro"><small>Bairro</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->BAIRRO !!}" disabled>                        
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="edit_cidade"><small>Cidade</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->CIDADE !!}" disabled>                        
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="edit_estado"><small>Estado</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->ESTADO !!}" disabled>                        
                                </div>

                                <div class="col-md-2">
                                    <label for="edit_cep"><small>CEP</small></label>
                                    <input type="text" class="form-control input-sm" value="{!! $cliente->CEP !!}" disabled>                        
                                </div>
                            </div>
                        </div>

                        <div class="center_obj"><a class="btn_collapse" data-toggle="collapse" href="#gbox_endereco"><i class="fa fa-chevron-down fa-2x"></i></a></div>

                    </div>
                </div>

                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-calendar"></i>&nbspInformações sobre Datas</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        
                        @php
                            $dt_emis = \DateTime::createFromFormat('Y-m-d', $pedido->DATA_EMISSAO);
                            $dt_entr = \DateTime::createFromFormat('Y-m-d', $pedido->PREVISAO_ENTREGA);
                        @endphp

                        <div class="col-md-6" >
                            <label for="edit_dataemissao">Data de Emissão</label>
                            <div class="input-group date">
                                <input type="text" class="form-control input-lg" id="edit_dataemissao" name="edit_dataemissao" value="{!! $dt_emis->format('d/m/Y') !!}" disabled><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_dataentrega">Data de Entrega (previsão)</label>
                            <div class="input-group date">
                                <input type="text" class="form-control input-lg" id="edit_dataentrega" name="edit_dataentrega" value="{!! $dt_entr->format('d/m/Y') !!}" disabled><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                
                            </div>
                        </div>
                    </div>
                </div>     
                                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-money"></i>&nbspInformações sobre o Prazo de Pagamento</p>         

                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="edit_prazopagto">Prazo de Pagamento</label> 
                            {{ \Form::select('edit_prazopagto', $prazoPagto, $pedido->ID_PRAZO, array('class' => 'edit_prazopagto form-control uppercase input-lg', 'id' => 'edit_prazopagto', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>  

                </br>
                

                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-commenting"></i>&nbspObservações</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea style="resize:none;" rows="5" class="form-control" disabled> {!! $pedido->OBSERVACAO !!} </textarea>
                        </div>
                    </div>
                </div>   

                </br>

                
                <p class="titulo-gbox ">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspItens do Pedido</p>         
                <div class="form-group form-group-style  listagem" id="gbox_itens">
                       
                    <table class="table table-striped table-bordered" id="tabela_itens">
                        <thead> 
                            <tr>
                                <th class="col-sm-1 col-md-1">MODELO</th>
                                <th class="col-sm-1 col-md-1 text-center">TAMANHO</th>
                                <th class="hidden-xs col-md-5">DESCRIÇÃO</th>
                                <th class="hidden-xs col-md-1 text-right">PREÇO</th>
                                <th class="hidden-xs col-md-1 text-right">QUANTIDADE</th>
                                <th class="col-sm-3 col-md-2 text-right">TOTAL</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($itens as $item) 
                            <tr>
                                <td class="col-sm-1 col-md-1">{!! $item->MODELO !!}</td>
                                <td class="col-sm-1 col-md-1 text-center">{!! $item->TAMANHO !!}</td>
                                <td class="hidden-xs col-md-5">{!! $item->DESCRICAO !!}</td>
                                <td class="hidden-xs col-md-1 text-right">R$ {!! number_format( $item->PRECO_UNITARIO , 2, ',', '.') !!}</td>
                                <td class="hidden-xs col-md-1 text-right">{!! $item->QUANTIDADE !!}</td>
                                <td class="col-sm-3 col-md-2 text-right">R$ {!! number_format( $item->PRECO_TOTAL , 2, ',', '.') !!}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                </div>   
                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-usd"></i>&nbspTotal do Pedido</p>         

                <div class="form-group-style" id="gbox_total_pedido">
                    <div class="input-group">
                        <input type="text" class="p_total form-control input-lg text-right" value="R$ {!! number_format( $pedido->TOTAL , 2, ',', '.')  !!}" disabled>
                        <div class="input-group-addon"> 
                            <i class="fa fa-usd fa-2x"></i>
                        </div>                   
                    </div>
                </div>

                </br>


                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="button" class="form-control btn btn-primary input-lg btn_cancelar" value="Voltar">
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
