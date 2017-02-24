@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

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
	        </div>

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
                            <input type="text" class="form-control input-sm"  value="{!! $config->RAZAO !!}" disabled>                        
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
                        <div class="col-md-10">
                            <label for="edit_endereco"><small>Endereço</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->ENDERECO !!}" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="edit_numero"><small>Número</small></label>
                            <input type="text" class="form-control input-sm" value="{!! $config->NUMERO !!}" disabled>
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

		<p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-industry"></i>&nbspDados da Empresa Utilizadora</p>            
        <div class="form-group-style">

        </div>





