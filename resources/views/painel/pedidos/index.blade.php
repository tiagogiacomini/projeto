@include('partials.header')

<script type="text/javascript" src="/js/pace.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/geral.css">
<title>SpartumWEB - Pedidos</title>

<script type="text/javascript">
   
    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip({html: true});

    });

</script>

</head>
	<body>
		<div id="barra_topo">
			<div>
				<div class="btn_menu">
					<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
				</div>
				<div class="top_bar center_obj">
					<i class="fa fa-shopping-basket"></i><h2>&nbspPedidos</h2>
				</div>
			</div>
			
			<div class="form-group-style barra_pesquisa">
				<form method="GET" action="/painel/pedidos/busca">
						<div class="input-group">	
							<div class="input-group-addon"><a href="{!! url('/painel/pedidos/create') !!}"><i class="fa fa-plus fa-2x"></i></a></div>
							@if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Pesquisa Pedido" value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Pesquisa Pedido" autofocus>
	  						@endif
	  						<div class="input-group-addon"><button type="submit" style="border: none; background-color: #eee;"><i class="fa fa-search fa-2x"></i></div>
	  					</div>
			
				</form>
			</div>
		</div>
		
		<div class="container_listagem">
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
			  				<th class="col-sm-1 col-md-1">Nº</th>
			  				<th class="hidden-xs col-md-1">EMISSÃO</th>
			  				<th class="hidden-xs col-md-1">ENTREGA</th>
			  				<th class="col-sm-6 col-md-6">CLIENTE</th>
			  				<th class="hidden-xs col-md-1 text-right">TOTAL</th>
			  				<th class="col-sm-3 col-md-2 text-center">AÇÕES</th>
			  			</tr>
			  		</thead>

		  			<tbody>
		  			
		  			@foreach($pedidos as $pedido)
			  			@if (is_null($pedido->ID_USUARIO_IMP)) 
			  			<tr class="row listagem">
			  			@else
			  			<tr class="row listagem info" data-toggle="tooltip" title="<p>Pedido já importado pelo CAPPELLUS!</p><p>Importado em: {!! \Carbon\Carbon::parse($pedido->DATA_IMPORTACAO)->format('d/m/Y H:i') !!} por {!! $pedido->NOME_USUARIO_IMP !!}.</p>">
			  			@endif			  				
			  		 		<td >{!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</td>
							<td class="hidden-xs">{!! \Carbon\Carbon::parse($pedido->DATA_EMISSAO)->format('d/m/Y') !!}</td>			  		 		
							<td class="hidden-xs">{!! \Carbon\Carbon::parse($pedido->PREVISAO_ENTREGA)->format('d/m/Y') !!}</td>			  		 		
			  				<td>{!! $pedido->RAZAO !!}</td>
			  				<td class="hidden-xs text-right">R$ {!! number_format( $pedido->TOTAL, 2, ',', '.') !!}</td>
			  				<td class="text-center">
			  					<a href="{!! route('show_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-success btn_acao"><i class="fa fa-eye"></i></a>
			  				    @if (is_null($pedido->ID_USUARIO_IMP)) 
			  				    <a href="{!! route('edit_pedido'  , $pedido->ID_PEDIDO) !!}" class="btn btn-primary btn_acao"><i class="fa fa-edit"></i></a>
			  				    <a href="{!! route('delete_pedido', $pedido->ID_PEDIDO) !!}" class="btn btn-danger  btn_acao"><i class="fa fa-trash-o"></i></a>
			  				    @endif
			  				    <a href="{!! route('print_pedido',  $pedido->ID_PEDIDO) !!}" class="btn btn-warning btn_acao"><i class="fa fa-print"></i></a>
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