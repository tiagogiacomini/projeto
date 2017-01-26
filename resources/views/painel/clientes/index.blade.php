@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<title>SpartumWEB - Clientes</title>
</head>
	<body>
		
		<div id="barra_topo">
			<div>
				<div class="btn_menu">
					<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
				</div>
				<div class="top_bar center_obj">
					<i class="fa fa-users"></i><h2>&nbspClientes</h2>
				</div>
			</div>
			
						
			<div class="barra_pesquisa form-group-style">
				<form method="GET" action="/painel/clientes/busca">

					@if(Session::has('msg_pesquisa'))
					    <div class="alert alert-warning">
					        {!! Session::get('msg_pesquisa') !!}
					    </div>
					@endif

						<div class="input-group">	
							<div class="input-group-addon"><a href="{!! url('/painel/clientes/create') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
							@if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Pesquisa Clientes" value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Pesquisa Clientes" autofocus>
	  						@endif
	  						<div class="input-group-addon"><button type="submit" style="border: none; background-color: #eee;"><i class="fa fa-search fa-2x"></i></div>
	  					</div>
			
				</form>
			</div>
		</div>

		</br>
		
		<div class="container_listagem">
			<div class="container-fluid form-group-style">

			@if (isset($clientes))
				@if(Session::has('cad_cliente_msg'))
				    <div class="alert alert-info">
				        {!! Session::get('cad_cliente_msg') !!}
				    </div>
				@endif
				<table class="table table-striped">
		  			<thead> 

			  			<tr class="row">
			  				<th class="col-sm-2 col-md-2">CPF/CNPJ</th>
			  				<th class="col-sm-9 col-md-9">NOME/RAZÃO SOCIAL</th>
			  				<th class="col-sm-1 col-md-1 text-center">AÇÕES</th>
			  			</tr>
			  		</thead>

		  			<tbody>
		  			
		  			@foreach($clientes as $cliente)
			  			<tr class="row listagem">
			  				@if (strlen($cliente->CNPJ) == 14)
			  		 		<td class="col-sm-2 col-md-2 cnpj">{!! Helpers::mask($cliente->CNPJ, '##.###.###/####-##') !!}</td>
			  				@else
							<td class="col-sm-2 col-md-2 cnpj">{!! Helpers::mask($cliente->CNPJ, '###.###.###-##') !!}</td>		  				
							@endif
			  				<td class="col-sm-9 col-md-9">{!! $cliente->RAZAO !!}</td>
			  				<td class="col-sm-1 col-md-1 text-center"><a href="{!! route('show_cliente', $cliente->CNPJ) !!}" class="btn btn-success btn_acao"><i class="fa fa-eye"></i></a>
			  				                              <a href="{!! route('edit_cliente', $cliente->CNPJ) !!}" class="btn btn-primary btn_acao"><i class="fa fa-edit"></i></a></td>


			  			</tr>
			  		@endforeach
			  		
			  		</tbody>

				</table>
			@endif

			</div>
			</br>

			<div class="center_obj">
				<center>
					@if ($clientes->total() == 0) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ($clientes->total() == 1) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ($clientes->total() > 1) 
					<p>Exibindo <strong>{!! $clientes->count() !!} </strong> clientes, num total de <strong>{!! $clientes->total() !!}</strong> clientes cadastrados.</p>
					@endif
				</center>
			</div>
						
			<div class="center_obj">
			@if(isset($clientes))
			{!! $clientes->render() !!}
			@endif
			</div>
		</div>
		
	</body>
</html>