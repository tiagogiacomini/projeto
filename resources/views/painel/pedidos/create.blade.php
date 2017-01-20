@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/pedidos.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-user-circle-o fa-2x"></i><h1>&nbspPedidoWEB</h1>
            </div>
        </div>

        <div style="position: relative; top: 70px;">
            
            <div class="form-group form-group-style">
                <div class="row">
                    <div class="col-md-6">
                        <label for="edit_nrpedido">Nº Pedido (provisório)</label>
                        <input type="text" class="form-control input-lg text-right" value="{!! sprintf('%06d', $id_pedido)  !!}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_vendedor">Vendedor Responsável</label>
                        <input type="text" class="form-control input-lg" value="{!! $vendedor_nome !!}" disabled>
                    </div>
                </div>
            </div>


            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

            <form id="form_pedido" method="POST" action="/painel/pedidos/store">
                {{ csrf_field() }}
                <div class="content">
                    <div class="form-group form-group-style" >
                                            
                        <div class="alert alert-danger invisivel" id="alerta-cnpj">
                            
                        </div>
                        
                        <div class="alert alert-warning invisivel" id="alerta-nao-encontrado">
                            
                        </div>                  

                        <label for="pesquisa_cliente">Informe o CPF/CNPJ do Cliente</label>                                                                   
                        <div class="input-group" id="gbox_pesquisa_cliente">
                            
                            <input type="text" class="form-control input-lg" id="edit_busca_cliente" name="pesquisa_cliente" value="{!! \Request::input('pesquisa_cliente') !!}" placeholder="Informe o CPF ou CNPJ do cliente" autofocus>

                            <div class="input-group-addon"><button type="button" style="border: none; background-color: transparent;" id="btn_buscacliente"><i class="fa fa-search fa-2x"></i></button></div> 
                        </div>                          
                                                                         
                        <div class="collapse" id="gbox_endereco">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="edit_razao"><small>Razão Social</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_razao" name="edit_razao" disabled>                        
                                </div>

                                <div class="col-md-4">
                                    <label for="edit_fantasia"><small>Nome Fantasia</small></label>
                                    <input type="text" class="form-control input-sm" id="edit_fantasia" name="edit_fantasia" disabled>
                                </div>

                                <div class="col-md-2">
                                    <label for="edit_telefone"><small>Telefone</small></label>
                                    <input type="text" class="form-control input-sm phone" id="edit_telefone" name="edit_telefone" disabled>
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
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-calendar"></i>&nbspInformações sobre Datas</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_dataemissao">Data de Emissão</label>
                            <input type="date" class="form-control input-lg" id="edit_dataemissao" name="edit_dataemissao" value="{!! date('Y-m-d') !!}" >
                        </div>
                        <div class="col-md-6">
                            <label for="edit_dataentrega">Data de Entrega (previsão)</label>
                            <input type="date" class="form-control input-lg" id="edit_dataentrega" name="edit_dataentrega" value="{!! date('Y-m-d', strtotime('+1 month')) !!}" >
                        </div>
                    </div>
                </div>   

                                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-money"></i>&nbspInformações sobre a Forma de Pagamento</p>         

                <div class="form-group form-group-style">
                    <label for="edit_formapagto">Forma de pagamento</label>
                    <input type="text" class="form-control input-lg uppercase" maxlength="30" id="edit_formapagto" name="edit_formapagto" value="" placeholder="Ex: 30/60/90 ou A VISTA...">
                </div>   

                </br>
                
                {{--
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspInformações dos produtos</p>         
                
                <div class="form-group form-group-style">
                    <label for="edit_busca">Clique em "+" para adicionar um produto</label>
                    <div class="input-group">   
                        <div class="input-group-addon"><a href="{!! url('/painel/clientes/adiciona') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
                        <input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Inserir produto..." value="">
                    </div>
                </div>

                --}}


                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-commenting"></i>&nbspObservações</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea style="resize:none;" rows="5" maxlength="255" class="form-control" id="edit_obs" name="edit_obs" value=""></textarea>
                        </div>
                    </div>
                </div>   

                </br>

                
                <p class="titulo-gbox invisivel">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspItens do Pedido</p>         
                <div class="form-group form-group-style invisivel listagem" id="gbox_itens">
                       
                    <table class="table table-hover table-striped invisivel" id="tabela_itens">
                        <thead> 
                            <tr>
                                <th class="col-sm-1 col-md-1">MODELO</th>
                                <th class="col-sm-1 col-md-1 text-center">TAMANHO</th>
                                <th class="hidden-xs col-md-5">DESCRIÇÃO</th>
                                <th class="hidden-xs col-md-1 text-right">PREÇO</th>
                                <th class="hidden-xs col-md-1 text-right">QUANTIDADE</th>
                                <th class="col-sm-3 col-md-2 text-right">TOTAL</th>
                                <th class="col-sm-1 col-md-1 text-center"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    
                    <div class="center_obj">
                        <button type="button" style="border: none; background-color: transparent;" id="btn_additem" data-toggle="modal" data-target="#modalItens"><i class="fa fa-plus fa-3x"></i></button>
                    </div>

                </div>   


                <input type="hidden" name="id_vendedor"     value="{!! $vendedor_id !!}" class="id_vendedor" id="id_vendedor">
                <input type="hidden" name="id_tabela_preco" class="id_tabela_preco" id="id_tabela_preco">
                <input type="hidden" name="id_pedido"       id="id_pedido" value="{!! $id_pedido !!}">
                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-usd"></i>&nbspTotal do Pedido</p>         

                <div class="form-group-style" id="gbox_total_pedido">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg text-right" id="total_pedido" disabled>
                        <div class="input-group-addon"> 
                            <i class="fa fa-usd fa-2x"></i>
                        </div>                   
                    </div>
                </div>


                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" class="form-control btn btn-primary input-lg" id="btn_salvar" value="Concluir Pedido">
                        </div>
                        
                        <div class="col-md-6">
                            <input type="button" class="form-control btn btn-danger input-lg btn_cancelar" value="Cancelar">
                        </div>
                    </div>
                </div>


            </form>
        </div>

    </div>



    {{-- MODAL PARA INSERCAO DE ITENS --}}
    <div id="modalItens" class="modal fade" tabindex="-1" role="document" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-basket"></i> Adicionar Produto</h4>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sel_pesquisa_por">Pesquisar por</label>
                            <select id="sel_pesquisa_por" class="form-control input-lg">                                
                                <option value="MODELO">MODELO</option>
                                <option value="DESCRICAO">DESCRIÇÃO</option>                                    
                            </select>
                        </div>    
                        
                        <div class="col-md-9 gbox_pesquisa_prod">
                            <label for="edit_busca_prod">Pesquisar</label>
                            <div class="input-group">
                                <input type="text" id="edit_busca_prod" class="form-control uppercase input-lg">
                                <div class="input-group-addon"><button type="button" style="border: none; background-color: transparent;" id="btn_busca_prod"><i class="fa fa-search fa-2x"></i></button></div> 
                            </div>
                        </div>
                    </div>
                    
                    </br>
                    <div class="form-group invisivel" id="gbox_resultado">

                    <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspDetalhes do Produto Encontrado</p>         
                        <form id="form_additem" method="POST" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="edit_descricao">Descrição do Produto</label>
                                    <input id="edit_descricao" class="form-control" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="edit_unidade">Unidade</label>
                                    <input id="edit_unidade" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit_grupo">Grupo do Produto</label>
                                    <input id="edit_grupo" class="form-control" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="edit_genero">Gênero do Produto</label>
                                    <input id="edit_genero" class="form-control" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="edit_cor">Cor do Produto</label>
                                    <input id="edit_cor" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit-tamanhos">Tamanhos Disponíveis</label>
                                    <select id="edit_tamanhos" name="edit_tamanhos" class="form-control input-lg">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="edit-preco">Preço Unitário</label>
                                    <input id="edit_preco" name="edit_preco" class="form-control input-lg" disabled>
                                </div>
                                <div class="form-group" id="gbox_quantidade">
                                    <div class="col-md-4">
                                        <label for="edit-quantidade">Quantidade</label>
                                        <input id="edit_quantidade" name="edit_quantidade" class="form-control input-lg" type="number">
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="id_produto" id="id_produto">
                            <input type="hidden" name="id_pedido"  id="id_pedido" value="{!! $id_pedido !!}">
                            <input type="hidden" name="preco_unitario" id="preco_unitario">     

                        </form>
                    </div>

                    <div class="form-group invisivel" id="gbox_nenhum_resultado">
                        <div class="alert alert-danger">
                            <p><strong>Nenhum resultado encontrado para o critério informado!</strong></p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_item_incluso">
                        <div class="alert alert-info">
                            <p><strong>Produto incluído com sucesso no pedido!</strong></p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_item_erro">
                        <div class="alert alert-danger">
                            <p><strong>Não foi possível incluir este produto! </strong></p>
                        </div>
                    </div>
                
                    <div class="center_obj invisivel" id="btn_add_prod">
                        <div >
                            <button type="button" class="btn btn-primary btn-lg" id="submit_form_item">Adicionar Produto</button>
                        </div>
                    </div>

                </div> {{-- model-body --}}


                <div class="modal-footer">
              
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Concluir</button>    
                    
                </div>
            </div>
        </div>

    </div>

