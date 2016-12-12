@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<script type="text/javascript" src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/ajax.js"></script>

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-bars fa-2x"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-users fa-2x"></i><h1>&nbspInclusão de Cliente</h1>
			</div>
		</div>


			<form method="POST" action="/painel/clientes/store">
				{{ csrf_field() }}
				
				<div class="form-group container_forms">		
					<label for="edit_cnpj">CPF/CNPJ</label>	
					<input class="form-control" type="text" class="edit_cnpj" name="edit_cnpj" id="edit_cnpj" value="{!! \Request::old('edit_cnpj') !!}" placeholder="Ex.: 00.000.000/0000-00 ">
					
					<label for="edit_ierg">IE/RG</label>	
					<input class="form-control" type="text" class="edit_ierg" name="edit_ierg" id="edit_ierg" value="{!! \Request::old('edit_ierg') !!}" placeholder="Inscrição estadual ou RG">
					
					<label for="edit_razao">Nome/Razão Social</label>	
					<input class="form-control" type="text" class="edit_razao" name="edit_razao" id="edit_razao" value="{!! \Request::old('edit_razao') !!}" placeholder="Nome Principal do Cliente">
					
					<label for="edit_nome">Nome Fantasia</label>	
					<input class="form-control" type="text" class="edit_nome" name="edit_nome" id="edit_nome" value="{!! \Request::old('edit_nome') !!}" placeholder="Nome Fantasia (opcional)">

					<label for="edit_telefone">Telefone</label>	
					<input class="form-control" type="text" class="edit_telefone" name="edit_telefone" id="edit_telefone" value="{!! \Request::old('edit_telefone') !!}" placeholder="Telefone">
				</div>

				<div class="form-group container_forms">
					<label for="edit_cep">CEP</label>	
					<div class="input-group">
						<input class="form-control" type="text" value="{!! \Request::old('edit_cep') !!}" name="edit_cep" class="edit_cep" id="edit_cep" placeholder="Insira o CEP (sem pontos ou traços)">
						<div class="input-group-addon"><i class="fa fa-search"></i></div>
					</div>
						
					
					<label for="edit_endereco">Endereço</label>	
					<input class="form-control" type="text" nome="edit_endereco" class="edit_endereco" id="edit_endereco" placeholder="Endereço" disabled>

					<label for="edit_numero">Número</label>	
					<input class="form-control" type="text" nome="edit_numero" class="edit_numero" id="edit_numero" placeholder="Número">
					
					<label for="edit_bairro">Bairro</label>	
					<input class="form-control" type="text" nome="edit_bairro" class="edit_bairro" id="edit_bairro" placeholder="Bairro" disabled>
					
					<label for="edit_cidade">Cidade</label>	
					<input class="form-control" type="text" nome="edit_cidade" class="edit_cidade" id="edit_cidade" placeholder="Cidade" disabled>

					<label for="edit_estado">Estado</label>	
					<input class="form-control" type="text" nome="edit_estado" class="edit_estado" id="edit_estado" placeholder="Estado" disabled>
				</div>
				
				<div class="form-group container_forms">
					<input type="submit" class="btn btn-primary form-control" value="Salvar">
				</div>
					
			</form>
		