@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-bars fa-2x"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-users fa-2x"></i><h1>&nbspClientes</h1>
			</div>
		</div>
		
		<div class="container_listagem">
			<div class="center_obj">
				<form class="form-inline" method="GET" action="/painel/clientes/busca">
					{{-- csrf_field() --}}

					<div class="form-group">
					
					@if(Session::has('msg_pesquisa'))
					    <div class="alert alert-warning">
					        {!! Session::get('msg_pesquisa') !!}
					    </div>
					@endif

					    <label class="sr-only" for="edit_busca">Pesquisa</label>
						<div class="input-group">	
						<div class="input-group-addon"><a href="{!! url('/painel/clientes/adiciona') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
							@if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira CPF/CNPJ ou RAZÃO..." value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira CPF/CNPJ ou RAZÃO..." autofocus>
	  						@endif
	  						<div class="input-group-addon"><i class="fa fa-search fa-2x"></i></div>
	  					</div>
					</div>
				
				</form>
			</div>

			@if (isset($clientes))
			<table class="table table-hover table-striped">
	  			<thead> 

		  			<tr class="row">
		  				<th class="col-xs-2 col-md-2">CPF/CNPJ</div>
		  				<th class="col-xs-8 col-md-8">NOME/RAZÃO SOCIAL</div>
		  			</tr>
		  		</thead>

	  			<tbody>
	  			
	  			@foreach($clientes as $cliente)
		  			<tr class="row listagem">
		  				@if (strlen($cliente->CNPJ) == 14)
		  		 		<td class="col-xs-2 col-md-2">{!! Helpers::mask($cliente->CNPJ, '##.###.###/####-##') !!}</div>
		  				@else
						<td class="col-xs-2 col-md-2">{!! Helpers::mask($cliente->CNPJ, '###.###.###-##') !!}</div>		  				
						@endif
		  				<td class="col-xs-8 col-md-8">{!! $cliente->RAZAO !!}</div>
		  			</tr>
		  		@endforeach
		  		
		  		</tbody>

			</table>
			@endif

			<div class="center_obj">
				@if ((isset($clientes_count) && ($clientes_count == 0)) && (!Session::has('msg_pesquisa'))) 
				<p><strong>Nenhum registro encontrado</strong></p>
				@endif
				@if ((isset($clientes_count) && ($clientes_count == 1)) && (!Session::has('msg_pesquisa'))) 
				<p>Exibindo <strong>1</strong> registro.</p>
				@endif
				@if ((isset($clientes_count) && ($clientes_count > 1)) && (!Session::has('msg_pesquisa'))) 
				<p>Exibindo <strong>{!! $clientes_count !!}</strong> registros encontrados.</p>
				@endif
			</div>
						
			<div class="center_obj">
			@if(isset($clientes))
			{!! $clientes->render() !!}
			@endif
			</div>
		</div>
		
	</body>
</html>