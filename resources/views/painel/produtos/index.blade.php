@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		<div class="container_painel">
			<div class="btn_menu">
				<a href="{!! route('home') !!}" class="links_icones"><i class="fa fa-home fa-2x"></i></a>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-puzzle-piecefa-2x"></i><h1>&nbspProdutos</h1>
			</div>
		</div>
		
		<div class="container_listagem">
			
			<div class="container-fluid form-group-style">
				<form method="GET" action="/painel/produtos/busca">
					{{-- csrf_field() --}}
					
					<p>Pesquisa</p>

					@if(Session::has('msg_pesquisa'))
					    <div class="alert alert-warning">
					        {!! Session::get('msg_pesquisa') !!}
					    </div>
					@endif

					    <label class="sr-only" for="edit_busca">Pesquisa</label>
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
			</br>
		
			<div class="container-fluid form-group-style">

			@if (isset($produtos))
			<table class="table table-hover table-striped">
	  			<thead> 
		  			<tr class="row">
		  				<th class="col-xs-4 col-md-2">MODELO</th>
		  				<th class="col-xs-8 col-md-10">DESCRIÇÃO</th>
		  			</tr>
		  		</thead>

	  			<tbody>
	  			@foreach($produtos as $produto)
		  			<tr class="row listagem">
		  				<td class="col-xs-4 col-md-2">{!! $produto->MODELO !!}</td>
						<td class="col-xs-8 col-md-10">{!! $produto->DESCRICAO !!}</td>
				  	</tr>
		  		@endforeach
		  		</tbody>
			</table>
			@endif
			

			</div>

			<div class="center_obj">
				<center>
					@if ((isset($produtos_count) && ($produtos_count == 0)) && (!Session::has('msg_pesquisa'))) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ((isset($produtos_count) && ($produtos_count == 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ((isset($produtos_count) && ($produtos_count > 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>{!! $produtos->count() !!}</strong> registros, num total de <strong>{!! $produtos_count !!}</strong> registros encontrados.</p>
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