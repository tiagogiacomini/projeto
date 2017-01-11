@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-shopping-basket fa-2x"></i><h1>&nbspPedidos</h1>
			</div>
		</div>
		
		<div class="container_listagem">
			
			<div class="container-fluid form-group-style">
				<form method="GET" action="/painel/pedidos/busca">
					{{-- csrf_field() --}}
					
					<p>Pesquisa</p>


					    <label class="sr-only" for="edit_busca">Pesquisa</label>
						<div class="input-group">	
							<div class="input-group-addon"><a href="{!! url('/painel/pedidos/create') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
							@if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira o Nº do Pedido" value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira o Nº do Pedido" autofocus>
	  						@endif
	  						<div class="input-group-addon"><button type="submit" style="border: none; background-color: #eee;"><i class="fa fa-search fa-2x"></i></div>
	  					</div>
			
				</form>
			</div>
			</br>
		
			<div class="container-fluid form-group-style">

			@if (isset($pedidos))
				@if(Session::has('cad_pedido_msg'))
				    <div class="alert alert-info">
				        {!! Session::get('cad_pedido_msg') !!}
				    </div>
				@endif
				<table class="table table-hover table-striped">
		  			<thead> 
			  			<tr class="row">
			  				<th class="col-sm-2 col-md-2">Nº PEDIDO</th>
			  				<th class="hidden-xs col-md-2">DATA EMISSÃO</th>
			  				<th class="col-sm-7 col-md-7">CLIENTE</th>
			  				<th class="col-sm-1 col-md-1 text-center">AÇÕES</th>
			  			</tr>
			  		</thead>

		  			<tbody>
		  			
		  			@foreach($pedidos as $pedido)
			  			<tr class="row listagem">
			  				
			  		 		<td class="col-sm-2 col-md-2">{!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</td>
							<td class="hidden-xs col-md-2">{!! \Carbon\Carbon::parse($pedido->DATA_EMISSAO)->format('d/m/Y') !!}</td>			  		 		
			  				<td class="col-sm-7 col-md-7">{!! $pedido->RAZAO !!}</td>
			  				<td class="col-sm-1 col-md-1 text-center">
			  					<a href="@{!! route('show_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-success"><i class="fa fa-eye"></i></a>
			  				    <a href="@{!! route('edit_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
			  				    <a href="@{!! route('delete_pedido', $pedido->ID_PEDIDO) !!}" class="btn btn-danger" ><i class="fa fa-trash-o"></i></a>
			  				 </td>


			  			</tr>
			  		@endforeach
			  		
			  		</tbody>

				</table>
			@endif

			</div>

			<div class="center_obj">
				<center>
					@if ((isset($pedidos_count) && ($pedidos_count == 0))) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ((isset($pedidos_count) && ($pedidos_count == 1))) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ((isset($pedidos_count) && ($pedidos_count > 1))) 
					<p>Exibindo <strong>{!! $pedidos->count() !!} </strong>registros, num total de <strong>{!! $pedidos_count !!}</strong> registros encontrados.</p>
					@endif
				</center>
			</div>
						
			<div class="center_obj">
			@if(isset($pedidos))
				{!! $pedidos->render() !!}
			@endif
			</div>
		</div>
		
	</body>
</html>			