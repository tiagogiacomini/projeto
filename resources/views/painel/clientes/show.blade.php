@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/clientes.js"></script>

<title>SpartumWEB - Exibindo Cliente</title>

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

			<form method="POST" action="/painel/clientes/update/{!! $cliente->CNPJ !!}" >
				{{ csrf_field() }}

                <div class="form-group form-group-style">	
				    
				    <div class="alert alert-danger invisivel" id="alerta-cnpj">
                        
                    </div>

					<div class="row">
						<div class="col-md-6">
							<label for="edit_cnpj">CPF/CNPJ</label>	
							@if ($cliente->PFPJ == 'JURÍDICA')
							<input class="form-control input-lg" type="text" name="edit_cnpj" value="{!! Helpers::mask($cliente->CNPJ, '##.###.###/####-##') !!}" disabled >
							@else 
							<input class="form-control input-lg" type="text" name="edit_cnpj" value="{!! Helpers::mask($cliente->CNPJ, '###.###.###-##') !!}" disabled >
							@endif

						</div>

						<div class="col-md-6">
							<label for="edit_ierg">IE/RG</label>	
							<input class="form-control input-lg" type="number" name="edit_ierg" id="edit_ierg" value="{!! $cliente->IERG !!}"  disabled>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<label for="edit_razao">Nome/Razão Social</label>	
							<input class="form-control" type="text" name="edit_razao" id="edit_razao" value="{!! $cliente->RAZAO !!}"  disabled>
						</div>
						
						<div class="col-md-6">
							<label for="edit_nome">Nome Fantasia</label>	
							<input class="form-control" type="text" name="edit_nome" id="edit_nome" value="{!! $cliente->NOME_FANTASIA !!}" disabled>
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<label for="edit_telefone">Telefone</label>	
							<input class="form-control phone" type="text" name="edit_telefone" id="edit_telefone" value="{!! $cliente->TELEFONE !!}" disabled>
						</div>

						<div class="col-md-4">
							<label for="edit_email">Email</label>	
								<div class="input-group gbox_email">			  	
									<span class="input-group-addon">@</span>
									<input class="form-control" type="text" name="edit_email" id="edit_email" value="{!! $cliente->EMAIL !!}" disabled>
								</div>
						</div>


						<div class="col-md-4">
							<label for="edit_tipopessoa">Tipo Pessoa</label>	
							{{ \Form::select('edit_tipopessoa', array('FÍSICA' => 'FÍSICA', 'JURÍDICA' => 'JURÍDICA'), $cliente->PFPJ, array('class' => 'edit_tipopessoa form-control', 'id' => 'edit_tipopessoa', 'disabled' => 'disabled')) }}
						
						</div>
					</div>

				</div>

				</br>
	            <p class="titulo-gbox">&nbsp&nbsp&nbsp&nbsp<i class="fa fa-map-marker"></i>&nbspInformações do Endereço</p>            

				<div class="form-group form-group-style">

					<div class="row">
						<div class="col-md-3">	
							<label for="edit_cep">CEP</label>	
							<input class="form-control input-lg" type="text" value="{!! Helpers::mask($cliente->CEP, '##.###-###') !!}" name="edit_cep" id="edit_cep" disabled>
						</div>
								
						<div class="col-md-6">
							<label for="edit_endereco">Endereço</label>	
							<input class="form-control input-lg" type="text" name="edit_endereco" value="{!! $cliente->ENDERECO !!}" id="edit_endereco" disabled>
						</div>

						<div class="col-md-3">
							<label for="edit_numero">Número</label>	
							<input class="form-control input-lg" type="number" name="edit_numero" value="{!! $cliente->NUMERO !!}"  id="edit_numero" disabled>
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