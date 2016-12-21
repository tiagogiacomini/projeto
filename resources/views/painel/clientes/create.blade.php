@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/jsmask.js"></script>
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/ajax.js"></script>


</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-chevron-left fa-2x"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-users fa-2x"></i><h2>&nbspInclusão de Cliente</h2>
			</div>
		</div>


			<form method="POST" action="/painel/clientes/store">
				{{ csrf_field() }}
				
				<div class="form-group container_forms">	
					
					@if(Session::has('cnpj_cliente'))
					<div class="alert alert-danger">
						{!! Session::get('cnpj_cliente') !!}
					</div>
					@endif	

					<label for="edit_cnpj">CPF/CNPJ</label>	
					<input class="form-control" type="number" class="edit_cnpj" name="edit_cnpj" id="edit_cnpj" value="{!! \Request::input('edit_cnpj') !!}" placeholder="Somente números ">

					
					@if(Session::has('ierg_cliente'))
					</br>
					<div class="alert alert-danger">
						{!! Session::get('ierg_cliente') !!}
					</div>
					@endif	

					<label for="edit_ierg">IE/RG</label>	
					<input class="form-control" type="number" class="edit_ierg" name="edit_ierg" id="edit_ierg" value="{!! \Request::input('edit_ierg') !!}" placeholder="Somente números">
					
					@if(Session::has('razao_cliente'))
					</br>
					<div class="alert alert-danger">
						{!! Session::get('razao_cliente') !!}
					</div>
					@endif	

					<label for="edit_razao">Nome/Razão Social</label>	
					<input class="form-control" type="text" class="edit_razao" name="edit_razao" id="edit_razao" value="{!! \Request::input('edit_razao') !!}" placeholder="Nome Principal do Cliente">
					
					<label for="edit_nome">Nome Fantasia</label>	
					<input class="form-control" type="text" class="edit_nome" name="edit_nome" id="edit_nome" value="{!! \Request::input('edit_nome') !!}" placeholder="Nome Fantasia (opcional)">

					<label for="edit_telefone">Telefone</label>	
					<input class="form-control phone_br" type="text" class="edit_telefone" name="edit_telefone" id="edit_telefone" value="{!! \Request::input('edit_telefone') !!}" placeholder="Somente números">
				</div>

				<div class="form-group container_forms">
					
					@if(Session::has('cep_cliente'))
					<div class="alert alert-danger">
						{!! Session::get('cep_cliente') !!}
					</div>
					@endif	

					<label for="edit_cep">CEP</label>	
					<div class="input-group">
						<input class="form-control" type="number" value="{!! \Request::input('edit_cep') !!}" name="edit_cep" id="edit_cep" placeholder="Insira o CEP (sem pontos ou traços)">
						<div class="input-group-addon"><button type="button" id="btn_buscacep" style="border: none; background-color: #eee;"><i class="fa fa-search"></i></div>
					</div>
						
					
					<label for="edit_endereco">Endereço</label>	
					<input class="form-control" type="text" name="edit_endereco" value="{!! \Request::input('edit_endereco') !!}" id="edit_endereco" placeholder="Endereço" disabled="disabled">

					<label for="edit_numero">Número</label>	
					<input class="form-control" type="number" name="edit_numero" value="{!! \Request::input('edit_numero') !!}"  id="edit_numero" placeholder="Número">
					
					<label for="edit_bairro">Bairro</label>	
					<input class="form-control" type="text" name="edit_bairro" value="{!! \Request::input('edit_bairro') !!}"  id="edit_bairro" placeholder="Bairro" disabled="disabled">
					
					<label for="edit_cidade">Cidade</label>	
					<input class="form-control" type="text" name="edit_cidade" value="{!! \Request::input('edit_cidade') !!}"  id="edit_cidade" placeholder="Cidade"disabled="disabled">

					<label for="edit_estado">Estado</label>	
					<input class="form-control" type="text" name="edit_estado" value="{!! \Request::input('edit_estado') !!}" id="edit_estado" placeholder="Estado" disabled="disabled">

				</div>

				<input type="hidden" name="edit_endereco" class="edit_endereco">
				<input type="hidden" name="edit_bairro" class="edit_bairro">
				<input type="hidden" name="edit_cidade" class="edit_cidade">
				<input type="hidden" name="edit_estado" class="edit_estado">
				
				<div class="form-group container_forms">
					<input type="submit" class="btn btn-primary form-control" value="Salvar">
				</div>
					
			</form>
		