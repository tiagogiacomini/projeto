@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<title>SpartumWEB - Pedidos</title>

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
			
			<div class="container-fluid form-group-style listagem">
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
				<table class="table table-striped">
		  			<thead> 
			  			<tr class="row">
			  				<th class="col-sm-1 col-md-1">Nº PEDIDO</th>
			  				<th class="hidden-xs col-md-1">DATA EMISSÃO</th>
			  				<th class="hidden-xs col-md-1">DATA ENTREGA</th>
			  				<th class="col-sm-6 col-md-6">CLIENTE</th>
			  				<th class="col-sm-1 col-md-1 text-right">TOTAL</th>
			  				<th class="col-sm-3 col-md-2 text-center">AÇÕES</th>
			  			</tr>
			  		</thead>

		  			<tbody>
		  			
		  			@foreach($pedidos as $pedido)
			  			<tr class="row listagem">
			  				
			  		 		<td >{!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</td>
							<td class="hidden-xs">{!! \Carbon\Carbon::parse($pedido->DATA_EMISSAO)->format('d/m/Y') !!}</td>			  		 		
							<td class="hidden-xs">{!! \Carbon\Carbon::parse($pedido->PREVISAO_ENTREGA)->format('d/m/Y') !!}</td>			  		 		
			  				<td>{!! $pedido->RAZAO !!}</td>
			  				<td class="text-right">R$ {!! number_format( $pedido->TOTAL, 2, ',', '.') !!}</td>
			  				<td class="text-center">
			  					<a href="{!! route('show_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-success"><i class="fa fa-eye"></i></a>
			  				    <a href="{!! route('edit_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
			  				    <a href="{!! route('print_pedido',  $pedido->ID_PEDIDO) !!}" class="btn btn-warning"><i class="fa fa-print"></i></a>
			  				    <a href="{!! route('delete_pedido', $pedido->ID_PEDIDO) !!}" class="btn btn-danger" ><i class="fa fa-trash-o"></i></a>
			  				 </td>


			  			</tr>
			  		@endforeach
			  		
			  		</tbody>

				</table>
			@endif

			</div>

			<div class="center_obj">
				<center>
					@if ($pedidos->total() == 0) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ($pedidos->total() == 1) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ($pedidos->total() > 1) 
					<p>Exibindo <strong>{!! $pedidos->count() !!} </strong> pedidos, num total de <strong>{!! $pedidos->total() !!}</strong> pedidos encontrados.</p>
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