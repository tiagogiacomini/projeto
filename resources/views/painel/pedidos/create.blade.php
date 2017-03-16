@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
    
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/pedidos.js"></script>

<title>SpartumWEB - Novo Pedido $id_pedido !!}</title>
</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
            </div>
            <div class="top_bar center_obj">
                <h2>&nbspPedido</h2>
            </div>
        </div>

        <div style="position: relative; top: 70px;">
            
            <div class="form-group form-group-style">
                <div class="row">
                    <div class="col-md-6">
                        <label for="edit_nrpedido">Nº Pedido (provisório)</label>
                        <input type="text" class="form-control input-lg text-right" value="{!!  $id_pedido  !!}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_vendedor">Vendedor Responsável</label>
                        <input type="text" class="form-control input-lg" value="{!! $vendedor_nome !!}" disabled>
                    </div>
                </div>
            </div>


            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

            <form id="form_pedido" method="POST" action="/painel/pedidos/store">
                
                <div class="content">
                    <div class="form-group form-group-style" >
                                            
                        <div class="alert alert-danger invisivel" id="alerta-cnpj">
                            
                        </div>
                        
                        <div class="alert alert-warning invisivel" id="alerta-nao-encontrado">
                            
                        </div>                  

                        <label for="pesquisa_cliente">Informe o CPF/CNPJ do Cliente</label>                                                                   
                        <div class="input-group" id="gbox_pesquisa_cliente">
                            
                            <input type="number" class="form-control input-lg" id="edit_busca_cliente" name="pesquisa_cliente" value="{!! \Request::input('pesquisa_cliente') !!}" placeholder="Informe o CPF ou CNPJ do cliente" autofocus>

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
                        <div class="col-md-6" >
                            <label for="edit_dataemissao">Data de Emissão</label>
                            <div class="input-group date">
                                <input type="text" class="form-control input-lg" id="edit_dataemissao" name="edit_dataemissao" value="{!! date('d/m/Y') !!}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_dataentrega">Data de Entrega (previsão)</label>
                            <div class="input-group date">
                                <input type="text" class="form-control input-lg" id="edit_dataentrega" name="edit_dataentrega" value="{!! date('d/m/Y', strtotime('+ 1 month' )) !!}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                
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
                            @if ($config->FLG_PRAZO_PAGTO_TABELA_EXTERNA) 
                            {{ \Form::select('edit_prazopagto', $prazoPagto, null, array('class' => 'edit_prazopagto form-control uppercase input-lg', 'id' => 'edit_prazopagto')) }}
                            @else
                            <input class="form-control uppercase input-lg" name="edit_prazopagto">
                            @endif
                        </div>
                    </div>
                </div>

                </br>

                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-commenting"></i>&nbspObservações</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea style="resize:none;" rows="5" maxlength="255" class="form-control" id="edit_obs" name="edit_obs" value=""></textarea>
                        </div>
                    </div>
                </div>   

                </br>

                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-cubes"></i>&nbspItens do Pedido</p>         
                <div class="form-group form-group-style listagem">
                       
                    <table class="table table-bordered table-striped" id="tabela_itens">
                       
                        @if ($config->FLG_USA_GRADE_PEDIDO == 1) 
                        <thead>
                            <tr>
                                <th width="50">REFERÊNCIA</th>
                                <th width="30" class="hidden-md hidden-lg hidden-sm text-center"><i class="fa fa-hashtag"></i></th>
                                <th width="20" class="hidden-xs hidden-sm text-right">34</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">36</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">38</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">40</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">42</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">44</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">46</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">48</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">50</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">52</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">54</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">P</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">M</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">G</th>
                                <th width="20" class="hidden-xs hidden-sm text-right">GG</th>
                                <th width="20" class="text-right">QTD.</th>
                                <th width="30" class="hidden-xs text-right">UNIT.</th>
                                <th width="30" class="text-right">TOTAL</th>
                                <th width="20" class="text-center"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                    @else
                        <thead> 
                            <tr>
                                <th class="col-sm-1 col-md-1">MODELO</th>
                                <th class="hidden-xs col-md-5">DESCRIÇÃO</th>
                                <th class="hidden-xs col-md-1 text-right">PREÇO</th>
                                <th class="hidden-xs col-md-1 text-right">QUANTIDADE</th>
                                <th class="col-sm-3 col-md-2 text-right">TOTAL</th>
                                <th class="col-sm-1 col-md-1 text-center"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                    @endif

                        <tbody id="grid_itens">

                        </tbody>
                    </table>

                </div>   
                


                <input type="hidden" name="id_vendedor"     value="{!! $vendedor_id !!}" class="id_vendedor" id="id_vendedor">
                <input type="hidden" name="id_tabela_preco" class="id_tabela_preco" id="id_tabela_preco">
                <input type="hidden" name="id_pedido"       id="id_pedido" value="{!! $id_pedido !!}">
                <input type="hidden" name="_token"          id="_token" >
                
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

                </br>

                <div class="btn_additem invisivel" id="btn_additem">
                    <button type="button" style="border: none; background-color: transparent;" data-toggle="modal" data-target="#modalItens"><p class="plus">+</p></button>
                </div>



                <div class="form-group-style">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <input type="button" class="form-control btn btn-primary input-lg" id="btn_salvar" value="Concluir Pedido">
                        </div>
                        
                        <div class="col-xs-6 col-md-6">
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
                        <form id="form_additem"  >
                            
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
                                
                                {{-- FACO A LEITURA DOS PARAMETROS PARA VER SE UTILIZA GRADE OU NAO--}}
                                @if($config->FLG_USA_GRADE_PEDIDO == 1)
                                </br>
                                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-hashtag"></i>&nbspGrade do Produto</p>      
                                <div class="itens_grade">

                                {{-- JAVASCRIPT VAI ENCHER ISSO AQUI --}}
                                </div>                              



                                @else
                                
                                <div class="col-md-6">
                                    <label for="edit-preco">Preço Unitário</label>
                                    <input id="edit_preco" name="edit_preco" class="form-control input-lg" disabled>
                                </div>
                                <div class="form-group" id="gbox_quantidade">
                                    <div class="col-md-6">
                                        <label for="edit-quantidade">Quantidade</label>
                                        <input id="edit_quantidade" name="edit_quantidade" class="form-control input-lg" type="number">
                                    </div>
                                </div>
                                @endif


                            </div>

                            {{-- INPUTS HIDDEN --}} 
                            <input type="hidden" name="id_produto" id="id_produto">
                            <input type="hidden" name="id_pedido"  id="id_pedido" value="{!! $id_pedido !!}">
                            <input type="hidden" name="preco_unitario" id="preco_unitario">    

                            {{-- INPUTS HIDDEN CONFIG --}}
                            <input type="hidden" id="flg_usa_grade"    value="{!! $config->FLG_USA_GRADE_PEDIDO !!}">
                            <input type="hidden" id="flg_limpa_campos" value="{!! $config->FLG_LIMPA_CAMPOS_ADD_ITEM !!}">


                        </form>
                    </div>

                    <div class="form-group invisivel" id="gbox_nenhum_resultado">
                        <div class="alert alert-warning">
                            <p><strong>Ops!</strong> Nenhum resultado encontrado para o critério informado!</p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_nenhuma_tabela">
                        <div class="alert alert-warning">
                            <p><strong>Atenção!</strong> O produto foi encontrado, porém não existe tabela de preços vinculada ao cliente selecionado. Verifique com a gerência financeira para corrigir!</p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_item_incluso">
                        <div class="alert alert-success">
                            <p><strong>Ok!</strong> Produto incluído com sucesso!</p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_item_erro">
                        <div class="alert alert-danger">
                            <p><strong>Atenção!</strong> Não foi possível incluir este produto! É provável que este produto/grade já tenha sido incluído!</p>
                        </div>
                    </div>
                
                    <div class="center_obj invisivel" id="btn_add_prod">
                        <div >
                            <button type="button" class="btn btn-primary btn-lg" id="submit_form_item"><i class="fa fa-plus"></i> Adicionar Produto</button>
                        </div>
                    </div>

                </div> {{-- model-body --}}


                <div class="modal-footer">
              
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fa fa-check"></i> Concluir</button>    
                    
                </div>
            </div>
        </div>

    </div>

