@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-users fa-2x"></i><h1>&nbspClientes</h1>
			</div>
		</div>
		
		<div class="container_listagem">
			
			<div class="container-fluid form-group-style">
				<form method="GET" action="/painel/clientes/busca">
					{{-- csrf_field() --}}
					
					<p>Pesquisa</p>

					@if(Session::has('msg_pesquisa'))
					    <div class="alert alert-warning">
					        {!! Session::get('msg_pesquisa') !!}
					    </div>
					@endif

					    <label class="sr-only" for="edit_busca">Pesquisa</label>
						<div class="input-group">	
							<div class="input-group-addon"><a href="{!! url('/painel/clientes/create') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
							@if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira CPF/CNPJ ou RAZÃO..." value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira CPF/CNPJ ou RAZÃO..." autofocus>
	  						@endif
	  						<div class="input-group-addon"><button type="submit" style="border: none; background-color: #eee;"><i class="fa fa-search fa-2x"></i></div>
	  					</div>
			
				</form>
			</div>
			</br>
		


			<div class="container-fluid form-group-style">

			@if (isset($clientes))
				@if(Session::has('cad_cliente_msg'))
				    <div class="alert alert-info">
				        {!! Session::get('cad_cliente_msg') !!}
				    </div>
				@endif
				<table class="table table-hover table-striped">
		  			<thead> 

			  			<tr class="row">
			  				<th class="col-sm-2 col-md-2">CPF/CNPJ</th>
			  				<th class="col-sm-9 col-md-9">NOME/RAZÃO SOCIAL</th>
			  				<th class="col-sm-1 col-md-1">AÇÕES</th>
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
			  				<td class="col-sm-1 col-md-1"><a href="{!! route('show_cliente', $cliente->CNPJ) !!}" class="btn btn-success"><i class="fa fa-eye"></i></a>
			  				                              <a href="{!! route('edit_cliente', $cliente->CNPJ) !!}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>


			  			</tr>
			  		@endforeach
			  		
			  		</tbody>

				</table>
			@endif

			</div>

			<div class="center_obj">
				<center>
					@if ((isset($clientes_count) && ($clientes_count == 0)) && (!Session::has('msg_pesquisa'))) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ((isset($clientes_count) && ($clientes_count == 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ((isset($clientes_count) && ($clientes_count > 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>{!! $clientes->count() !!} </strong>registros, num total de <strong>{!! $clientes_count !!}</strong> registros encontrados.</p>
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