@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/clientes.js"></script>
<title>SpartumWEB - Editando Cliente</title>


</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-user"></i><h2>&nbspCliente</h2>
			</div>
		</div>

        <div style="position: relative; top: 70px;">

            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

			<form method="POST" action="/painel/clientes/update/{!! $cliente->CNPJ !!}" id="form_cliente" >
				{{ csrf_field() }}

                <div class="form-group form-group-style">	
				    
				    <div class="alert alert-danger invisivel" id="alerta-cnpj">
                        
                    </div>

					<div class="alert alert-warning invisivel" id="alerta-cliente">
	                
	                </div>


					<div class="row">
						<div class="col-md-6">
							<label for="edit_cnpj">CPF/CNPJ</label>	
							<input class="form-control input-lg" type="number" name="edit_cnpj" id="edit_cnpj" value="{!! $cliente->CNPJ !!}" disabled >
						</div>

						<div class="col-md-6">
							<label for="edit_ierg">IE/RG</label>	
							<input class="form-control input-lg" type="number" name="edit_ierg" id="edit_ierg" value="{!! $cliente->IERG !!}" >
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<label for="edit_razao">Nome/Razão Social</label>	
							<input class="form-control" type="text" name="edit_razao" id="edit_razao" value="{!! $cliente->RAZAO !!}" autofocus >
						</div>
						
						<div class="col-md-6">
							<label for="edit_nome">Nome Fantasia</label>	
							<input class="form-control" type="text" name="edit_nome" id="edit_nome" value="{!! $cliente->NOME_FANTASIA !!}" >
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<label for="edit_telefone">Telefone</label>	
							<input class="form-control phone" type="text" name="edit_telefone" id="edit_telefone" value="{!! $cliente->TELEFONE !!}">
						</div>

						<div class="col-md-6">
							<label for="edit_tipopessoa">Tipo Pessoa</label>	
							{{ \Form::select('edit_tipopessoa', array('FÍSICA' => 'FÍSICA', 'JURÍDICA' => 'JURÍDICA'), $cliente->PFPJ, array('class' => 'edit_tipopessoa form-control', 'id' => 'edit_tipopessoa')) }}
						
						</div>
					</div>

				</div>

				</br>
	            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-map-marker"></i>&nbspInformações do Endereço</p>            

				<div class="form-group form-group-style">

   					<div class="alert alert-warning invisivel" id="alerta-cep">
                
	                </div>


					<div class="row">
						<div class="col-md-3">	
							<label for="edit_cep">CEP</label>	
							<div class="input-group">
								<input class="form-control input-lg cep" type="number" value="{!! $cliente->CEP !!}" name="edit_cep" id="edit_cep">
								<div class="input-group-addon"><button type="button" id="btn_buscacep" style="border: none; background-color: #eee;"><i class="fa fa-search"></i></div>
							</div>
						</div>
								
						<div class="col-md-6">
							<label for="edit_endereco">Endereço</label>	
							<input class="form-control input-lg" type="text" name="edit_endereco" value="{!! $cliente->ENDERECO !!}" id="edit_endereco" disabled>
						</div>

						<div class="col-md-3">
							<label for="edit_numero">Número</label>	
							<input class="form-control input-lg" type="number" name="edit_numero" value="{!! $cliente->NUMERO !!}"  id="edit_numero" >
						</div>
					</div>
							
					<div class="row">
						<div class="col-md-3">
							<label for="edit_bairro">Bairro</label>	
							<input class="form-control" type="text" name="edit_bairro" value="{!! $cliente->BAIRRO !!}" id="edit_bairro" disabled>
						</div>

						<div class="col-md-6">
							<label for="edit_cidade">Cidade</label>	
							<input class="form-control" type="text" name="edit_cidade" value="{!! $cliente->CIDADE !!}" id="edit_cidade" disabled>
						</div>

						<div class="col-md-3">
							<label for="edit_estado">Estado</label>	
							<input class="form-control" type="text" name="edit_estado" value="{!! $cliente->ESTADO !!}" id="edit_estado" disabled>
						</div>

					</div>
				</div>

				</br>
	            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-dollar"></i>&nbspInformações da Tabela de Preços</p>        
				
				<div class="form-group-style">
					<div class="row">
						<div class="col-md-12">
							<label for="edit_tabpreco">Tabela de Preços</label>	
							{{ \Form::select('edit_tabpreco', $tabelaPrecos, $cliente->ID_TABELA, array('class' => 'edit_tabpreco form-control', 'id' => 'edit_tabpreco', 'disabled' => 'disabled')) }}
						</div>
					</div>
				</div>				

				<input type="hidden" name="edit_cnpj" class="edit_cnpj" id="edit_cnpj" value="{!! $cliente->CNPJ !!}"> 
				<input type="hidden" name="edit_endereco" class="edit_endereco" id="edit_endereco" value="{!! $cliente->ENDERECO !!}">  
				<input type="hidden" name="edit_bairro" class="edit_bairro" id="edit_bairro" value="{!! $cliente->BAIRRO !!}">
				<input type="hidden" name="edit_cidade" class="edit_cidade" id="edit_cidade" value="{!! $cliente->CIDADE !!}" >
				<input type="hidden" name="edit_estado" class="edit_estado" id="edit_estado" value="{!! $cliente->ESTADO !!}">
				<input type="hidden" name="edit_tabpreco" class="edit_tabpreco" id="edit_tabpreco" value="{!! $cliente->ID_TABELA !!}">
				
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

		</div>
		