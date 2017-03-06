@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="/js/config.js"></script>

<title>SpartumWEB - Configurações</title>

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-gears"></i><h2>&nbspConfigurações</h2>
			</div>
		</div>
        <div style="position: relative; top: 70px;">
            
            <div class="form-group-style text-center">
                <i class="fa fa-gears fa-2x"></i><h1>Configurações do SpartumWEB</h1>
                <p>Algumas configurações só serão editadas pelo Spartum, sendo somente exibidas aqui.</p>
   
            </div>

            </br>
            
            @php
            	$dt_atualizacao    = new DateTime($config->ULTIMA_ATUALIZACAO_DADOS);       
            @endphp

			<p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-bar-chart"></i>&nbspInformações e Estatísticas</p>            
            <div class="form-group-style">
            	<div class="row">
                    <div class="col-md-6" >
                        <label for="edit_dataatualizacao">Última vez em que o banco da dados foi atualizado</label>
	                        <div class="input-group date">
                               <input type="text" class="form-control input-lg" id="edit_dataatualizacao" name="edit_dataatualizacao" value="{!! $dt_atualizacao->format('d/m/Y') !!}" disabled><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                    </div>
            	</div>
                <div class="col-md-6" >
                    <div class="input-group date">
                    	
                    </div>
                </div>

	        </div>
            </br>

			<p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-photo"></i>&nbspLogotipo da Empresa Utilizadora</p>            

            <div class="form-group-style">
                <div class="text-center">
                    <img src="{!! $config->PATH_LOGO_EMPRESA !!}" class="img-thumbnail">
                </div>
            </div>
            </br>

            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-industry"></i>&nbspDados da Empresa Utilizadora</p>            
            <div class="form-group-style">

                <div class="content">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit_cnpj">CNPJ da Empresa</label>                                                                   
                            <input type="text" id="edit_cnpj" class="form-control input-lg" value="{!! $config->CNPJ_UTILIZADOR !!}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="edit_ie">IE da Empresa</label>                                                                   
                            <input type="text" id="edit_ie" class="form-control input-lg" value="{!! $config->IE_UTILIZADOR !!}" disabled>
                        </div>

                    </div>
                                                                                                                         
                	<div class="row">
                        		       
                        <div class="col-md-6">
                            <label for="edit_razao"><small>Razão Social</small></label>
                            <input type="text" class="form-control input-sm"  value="{!! $config->RAZAO_SOCIAL !!}" disabled>                        
                        </div>

                        <div class="col-md-4">
                            <label for="edit_fantasia"><small>Nome Fantasia</small></label>
                            <input type="text" class="form-control input-sm"  value="{!! $config->NOME_FANTASIA !!}" disabled>
                        </div>

                        <div class="col-md-2">
                            <label for="edit_telefone"><small>Telefone</small></label>
                            <input type="text" class="form-control input-sm phone" value="{!! $config->TELEFONE !!}" disabled>
                        </div>                                
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="edit_endereco"><small>Endereço</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->ENDERECO !!}" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="edit_bairro"><small>Bairro</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->BAIRRO !!}" disabled>                        
                        </div>
                        
                        <div class="col-md-4">
                            <label for="edit_cidade"><small>Cidade</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->CIDADE !!}" disabled>                        
                        </div>
                        
                        <div class="col-md-2">
                            <label for="edit_estado"><small>Estado</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->ESTADO !!}" disabled>                        
                        </div>

                        <div class="col-md-2">
                            <label for="edit_cep"><small>CEP</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->CEP !!}" disabled>                        
                        </div>
                    </div>
                </div>
        </div>
        </br>

		<p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-toggle-on"></i>&nbspOpções diversas</p>            

		<form method="POST" action="/painel/config/store" id="form_config" >
		{{ csrf_field() }}
        
	        <div class="form-group-style">

                <table class="table">
                            
                    <tr><td> 
                        <h4><i class="fa fa-shopping-basket">&nbsp&nbsp</i>Opções do PEDIDO</h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="80%"><strong>Utilizar de GRADES na venda de ITENS do PEDIDO?</strong>
                                   </br><small>Esta opção faz com que o sistema utilize de uma tabela de grade de tamanhos para os produtos, desmarcando esta opção o sistema irá desmarcar também as opções de impressão que envolvem GRADE.</small>

                        </td>
                        <td width="20%" class="text-right">
                            @if ($config->FLG_USA_GRADE_PEDIDO == 0 )
                            <input type="checkbox" id="flag_usa_grade_pedido" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_usa_grade_pedido" data-onstyle="primary" data-offstyle="danger">
                            @else 
                            <input type="checkbox" id="flag_usa_grade_pedido" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_usa_grade_pedido" data-onstyle="primary" data-offstyle="danger" checked>
                            @endif                     
                        </td>
                    </tr>

                    <tr>
                        <td width="80%"><strong>Usar PRAZOS DE PAGAMENTO de uma tabela externa?</strong>
                                   </br><small>Esta opção faz com que o sistema utilize de uma tabela externa para exibir os prazos cadastrados num sistema retaguarda.</small>

                        </td>
                        <td width="20%" class="text-right">
                            @if ($config->FLG_PRAZO_PAGTO_TABELA_EXTERNA == 0 )
                            <input type="checkbox" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_prazo_tab_ext" data-onstyle="primary" data-offstyle="danger">
                            @else 
                            <input type="checkbox" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_prazo_tab_ext" data-onstyle="primary" data-offstyle="danger" checked>
                            @endif                     
                        </td>
                    </tr>


                    <tr> <td>
                        <h4><i class="fa fa-print">&nbsp&nbsp</i>Opções da Impressão do PEDIDO</h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="80%"><strong>Usar impressão de pedidos em formato GRADE?</strong>
                                   </br><small>Esta opção faz com que a impressão de pedidos mostre os tamanhos dos produtos nas colunas, logo após a descrição do item.</small>

                        </td>
                        <td width="20%" class="text-right">
                            @if ($config->FLG_IMP_PEDIDO_GRADE == 0 )
                            <input type="checkbox" id="flag_pedido_grade" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_pedido_grade" data-onstyle="primary" data-offstyle="danger">
                            @else 
                            <input type="checkbox" id="flag_pedido_grade" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_pedido_grade" data-onstyle="primary" data-offstyle="danger" checked>
                            @endif                     
                        </td>
                    </tr>
                	                    
                    <tr>
                        <td width="80%"><strong>Mostrar coluna de TAMANHO para impressão de pedido?</strong>
                                   </br><small>Esta opção faz com que a impressão de pedidos mostre ou não, os tamanhos dos produtos em modo lista.</small></td>

                        <td width="20%" class="text-right">
                            @if ($config->FLG_IMP_TAM_MODO_LISTA == 0 )
                            <input type="checkbox" id="flag_pedido_tam_modo_lista" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_pedido_tam_modo_lista" data-onstyle="primary" data-offstyle="danger"> 
                            @else 
                            <input type="checkbox" id="flag_pedido_tam_modo_lista" data-toggle="toggle" data-on="Sim" data-off="Não" name="flag_pedido_tam_modo_lista" data-onstyle="primary" data-offstyle="danger" checked>
                            @endif                      
                        </td>
                    </tr>
                </table>

	        </div>

            </br>
            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-commenting"></i>&nbspObservação Impressa no Pedido</p>     
            <div class="form-group-style">
                <div class="row">
                    <div class="col-md-12">
                        <textarea style="resize:none;" rows="3" name="edit_obs_pedido" maxlength="255" class="form-control">{!! $config->OBS_IMPRESSAO_PEDIDO !!}</textarea>
                    </div>
                </div>
            </div>
            
            </br>
            <div class="form-group-style">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <input type="submit" class="form-control btn btn-primary input-lg" value="Salvar">
                    </div>
                    
                    <div class="col-xs-6 col-md-6">
                        <input type="button" class="form-control btn btn-danger input-lg btn_cancelar" value="Cancelar">
                    </div>
                </div>
            </div>


	    </form>



