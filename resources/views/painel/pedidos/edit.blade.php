@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/pedidos.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>SpartumWEB - Editando Pedido Nº {!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</title>

</head>
<body>

    <div class="full-height">
        <div class="container_painel">
            <div class="btn_menu">
                <i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
            </div>
            <div class="top_bar center_obj">
                <i class="fa fa-shopping-basket fa-2x"></i><h1>&nbspPedido {!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</h1>
            </div>
        </div>

        <div style="position: relative; top: 70px;">
            
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

            <form id="form_pedido" method="POST" action="/painel/pedidos/update">
                {{ csrf_field() }}
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
                        <div class="col-md-6">
                            <label for="edit_dataemissao">Data de Emissão</label>
                            <input type="date" class="form-control input-lg" name="edit_dataemissao" value="{!! $pedido->DATA_EMISSAO !!}" >
                        </div>
                        <div class="col-md-6">
                            <label for="edit_dataentrega">Data de Entrega (previsão)</label>
                            <input type="date" class="form-control input-lg" name="edit_dataentrega" value="{!! $pedido->PREVISAO_ENTREGA !!}" >
                        </div>
                    </div>
                </div>   

                                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-money"></i>&nbspInformações sobre a Forma de Pagamento</p>         

                <div class="form-group form-group-style">
                    <label for="edit_formapagto">Forma de pagamento</label>
                    <input type="text" class="form-control input-lg uppercase" name="edit_formapagto" value="{!! $pedido->CONDICAO_PAGTO !!}" >
                </div>   

                </br>
                

                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-commenting"></i>&nbspObservações</p>         

                <div class="form-group form-group-style">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea style="resize:none;" rows="5" name="edit_obs" class="form-control"> {!! $pedido->OBSERVACAO !!} </textarea>
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
                                <th class="col-sm-1 col-md-1 text-center"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($itens as $item) 
                            <tr>
                                <td>{!! $item->MODELO !!}</td>
                                <td class="text-center">{!! $item->TAMANHO !!}</td>
                                <td class="hidden-xs">{!! $item->DESCRICAO !!}</td>
                                <td class="hidden-xs text-right">R$ {!! number_format( $item->PRECO_UNITARIO , 2, ',', '.') !!}</td>
                                <td class="hidden-xs text-right">{!! $item->QUANTIDADE !!}</td>
                                <td class="text-right">R$ {!! number_format( $item->PRECO_TOTAL , 2, ',', '.') !!}</td>
                                <td class="text-center"><button type="button" class="btn btn-danger btn_exclui_prod" data-idprod="{!! $item->ID_PRODUTO !!}" data-idped="{!! $pedido->ID_PEDIDO !!}" data-tam="{!! $item->TAMANHO !!}"><i class="fa fa-trash-o"></i></button></td></tr>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                    <div class="center_obj">
                        <button type="button" style="border: none; background-color: transparent;" id="btn_additem" data-toggle="modal" data-target="#modalItens"><i class="fa fa-plus fa-3x"></i></button>
                    </div>


                <input type="hidden" name="id_vendedor"     value="{!! $pedido->ID_VENDEDOR !!}" class="id_vendedor" id="id_vendedor">
                <input type="hidden" name="id_tabela_preco" class="id_tabela_preco" id="id_tabela_preco" value="{!! $cliente->ID_TABELA !!}">
                <input type="hidden" name="id_pedido"       id="id_pedido" value="{!! $pedido->ID_PEDIDO !!}">


                </div>   
                
                </br>
                <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-usd"></i>&nbspTotal do Pedido</p>         

                <div class="form-group-style" id="gbox_total_pedido">
                    <div class="input-group">
                        <input type="text" class="p_total form-control input-lg text-right" id="total_pedido" value="R$ {!! number_format( $pedido->TOTAL , 2, ',', '.')  !!}" disabled>
                        <div class="input-group-addon"> 
                            <i class="fa fa-usd fa-2x"></i>
                        </div>                   
                    </div>
                </div>
                
                <div class="form-group-style">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" class="form-control btn btn-primary input-lg" id="btn_salvar" value="Salvar Edição">
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
                            <input type="hidden" name="id_pedido"  id="id_pedido" value="{!! $pedido->ID_PEDIDO !!}">
                            <input type="hidden" name="preco_unitario" id="preco_unitario">     

                        </form>
                    </div>

                    <div class="form-group invisivel" id="gbox_nenhum_resultado">
                        <div class="alert alert-warning">
                            <p><strong>Nenhum resultado encontrado para o critério informado!</strong></p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_nenhuma_tabela">
                        <div class="alert alert-warning">
                            <p><strong>O produto foi encontrado, porém não existe tabela de preços vinculada ao cliente selecionado. Verifique com a gerência financeira para corrigir! </strong></p>
                        </div>
                    </div>

                    <div class="form-group invisivel" id="gbox_item_incluso">
                        <div class="alert alert-info">
                            <p><strong>Produto incluído com sucesso!</strong></p>
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