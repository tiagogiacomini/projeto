@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">
<title>SpartumWEB - Produtos</title>
</head>
	<body>
		<div id="barra_topo">
			<div>
				<div class="btn_menu">
					<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
				</div>
				<div class="top_bar center_obj">
					<i class="fa fa-puzzle-piecefa-2x"></i><h1>&nbspProdutos</h1>
				</div>
			</div>

					
			<div class="form-group-style barra_pesquisa">
				<form method="GET" action="/painel/produtos/busca">
				
					@if(Session::has('msg_pesquisa'))
					    <div class="alert alert-warning">
					        {!! Session::get('msg_pesquisa') !!}
					    </div>
					@endif
					    
						<div class="input-group">	
						    @if ((isset($pesquisa)) && (!empty($pesquisa)))
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira o MODELO ou DESCRIÇÃO..." value="{!! $pesquisa !!}" autofocus>
	  						@else
	  						<input type="text" class="form-control inputs_form" name="pesquisa" id="edit_busca" placeholder="Insira o MODELO ou DESCRIÇÃO..." autofocus>
	  						@endif
	  						<div class="input-group-addon"><button type="submit" style="border: none; background-color: #eee;"><i class="fa fa-search fa-2x"></i></div>
	  					</div>			
				</form>
			</div>
		</div>
		</br>
		
		<div class="container_listagem">

			<div class="form-group-style">

			@if (isset($produtos))
			<table class="table table-striped">
	  			<thead> 
		  			<tr class="row">
		  				<th class="col-sm-4 col-md-2">MODELO</th>
		  				<th class="hidden-xs col-md-1 text-center">UNIDADE</th>
		  				<th class="col-sm-8 col-md-4">DESCRIÇÃO</th>
		  				<th class="hidden-xs col-md-2">GRUPO</th>
		  				<th class="hidden-xs col-md-2">COR</th>
		  				<th class="hidden-xs col-md-1">GÊNERO</th>
		  			</tr>
		  		</thead>

	  			<tbody>
	  			@foreach($produtos as $produto)
		  			<tr class="row listagem">
		  				<td class="col-sm-4 col-md-2">{!! $produto->MODELO !!}</td>
						<td class="hidden-xs col-md-1 text-center">{!! $produto->UNIDADE !!}</td>
						<td class="col-sm-8 col-md-4">{!! $produto->DESCRICAO !!}</td>
						<td class="hidden-xs col-md-2">{!! $produto->GRUPO !!}</td>
						<td class="hidden-xs col-md-2">{!! $produto->COR !!}</td>
						<td class="hidden-xs col-md-1">{!! $produto->GENERO !!}</td>
				  	</tr>
		  		@endforeach
		  		</tbody>
			</table>
			@endif
			

			</div>
			</br>

			<div class="center_obj">
				<center>
					@if (($produtos->total() == 0) && (!Session::has('msg_pesquisa'))) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if (($produtos->total() == 1) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if (($produtos->total() > 1) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>{!! $produtos->count() !!}</strong> produtos, num total de <strong>{!! $produtos->total() !!}</strong> produtos encontrados.</p>
					@endif	
				</center>
			</div>

			<div class="center_obj">
			@if(isset($produtos))
			{!! $produtos->render() !!}
			@endif
			</div>
		</div>
		
	</body>
</html>