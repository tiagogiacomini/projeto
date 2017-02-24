@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/clientes.js"></script>
<title>SpartumWEB - Novo Cliente</title>

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-chevron-left fa-2x btn_cancelar"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-user-plus"></i><h2>&nbspCliente</h2>
			</div>
		</div>

        <div style="position: relative; top: 70px;">

            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-id-card-o"></i>&nbspInformações do Cliente</p>            

			<form method="POST" action="/painel/clientes/store" id="form_cliente">
				{{ csrf_field() }}

                <div class="form-group form-group-style">	
				    
				    <div class="alert alert-danger invisivel" id="alerta-cnpj">
                        
                    </div>

					<div class="alert alert-warning invisivel" id="alerta-cliente">
	                
	                </div>

					<div class="row">

						<div class="col-md-6">
							<label for="edit_cnpj">CPF/CNPJ</label>	
							<input class="form-control input-lg" type="number"  name="edit_cnpj" id="edit_cnpj" value="{!! \Request::input('edit_cnpj') !!}" placeholder="Somente números ">
						</div>
						
						<div class="col-md-6">
							<label for="edit_ierg">IE/RG</label>	
							<input class="form-control input-lg" type="number"  name="edit_ierg" id="edit_ierg" value="{!! \Request::input('edit_ierg') !!}" placeholder="Somente números">
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<label for="edit_razao">Nome/Razão Social</label>	
							<input class="form-control uppercase" type="text" name="edit_razao" id="edit_razao" value="{!! \Request::input('edit_razao') !!}" placeholder="Nome Principal do Cliente">
						</div>
						
						<div class="col-md-6">
							<label for="edit_nome">Nome Fantasia</label>	
							<input class="form-control uppercase" type="text" name="edit_nome" id="edit_nome" value="{!! \Request::input('edit_nome') !!}" placeholder="Nome Fantasia (opcional)">
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<label for="edit_telefone">Telefone<small> (Somente Números)</small></label>	
							<input class="form-control" type="text" name="edit_telefone" id="edit_telefone" >
						</div>

						<div class="col-md-4">
							<label for="edit_email">Email</label>	
								<div class="input-group gbox_email">			  	
									<span class="input-group-addon">@</span>
									<input class="form-control" type="text" name="edit_email" id="edit_email" >
								</div>
						</div>

						<div class="col-md-4">
							<label for="edit_tipopessoa">Tipo Pessoa</label>	
							<select class="form-control uppercase" type="text" class="edit_tipopessoa" name="edit_tipopessoa" id="edit_tipopessoa" value="{!! \Request::input('edit_tipopessoa') !!}">
								<option>FÍSICA</option>
								<option>JURÍDICA</option>
							</select>
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
								<input class="form-control input-lg" type="number" value="{!! \Request::input('edit_cep') !!}" name="edit_cep" id="edit_cep">
								<div class="input-group-addon"><button type="button" id="btn_buscacep" style="border: none; background-color: #eee;"><i class="fa fa-search"></i></div>
							</div>
						</div>
								
						<div class="col-md-6">
							<label for="edit_endereco">Endereço</label>	
							<input class="form-control input-lg" type="text" name="edit_endereco" value="{!! \Request::input('edit_endereco') !!}" id="edit_endereco" placeholder="Endereço" disabled="disabled">
						</div>

						<div class="col-md-3">
							<label for="edit_numero">Número</label>	
							<input class="form-control input-lg" type="number" name="edit_numero" value="{!! \Request::input('edit_numero') !!}"  id="edit_numero" placeholder="Número">
						</div>
					</div>
							
					<div class="row">
						<div class="col-md-3">
							<label for="edit_bairro">Bairro</label>	
							<input class="form-control" type="text" name="edit_bairro" value="{!! \Request::input('edit_bairro') !!}"  id="edit_bairro" placeholder="Bairro" disabled>
						</div>

						<div class="col-md-6">
							<label for="edit_cidade">Cidade</label>	
							<input class="form-control" type="text" name="edit_cidade" value="{!! \Request::input('edit_cidade') !!}"  id="edit_cidade" placeholder="Cidade" disabled>
						</div>

						<div class="col-md-3">
							<label for="edit_estado">Estado</label>	
							<input class="form-control" type="text" name="edit_estado" value="{!! \Request::input('edit_estado') !!}" id="edit_estado" placeholder="Estado" disabled>
						</div>

					</div>
				</div>

				</br>
	            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-dollar"></i>&nbspInformações da Tabela de Preços</p>            

				<div class="form-group-style">
					<div class="alert alert-warning invisivel" id="alerta-tabpreco">
	                
	                </div>
	                <div class="row">
						<div class="col-md-12">
							<label for="edit_tabpreco">Tabela de Preços</label>	
							{{ \Form::select('edit_tabpreco', $tabelaPrecos, null, array('class' => 'edit_tabpreco form-control uppercase', 'id' => 'edit_tabpreco')) }}
						</div>
					</div>
				</div>

				<input type="hidden" name="edit_endereco" class="edit_endereco uppercase"> 
				<input type="hidden" name="edit_bairro" class="edit_bairro uppercase" >
				<input type="hidden" name="edit_cidade" class="edit_cidade uppercase" >
				<input type="hidden" name="edit_estado" class="edit_estado uppercase">
				<br>

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
		