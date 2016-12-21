@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		


		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-chevron-left fa-2x"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-puzzle-piece fa-2x"></i><h1>&nbspProdutos</h1>
			</div>

		</div>

		<div class="container_listagem">
			<div class="center_obj">
				<form class="form-inline" method="GET" action="/painel/produtos/busca">
					{{-- csrf_field() --}}

					<div class="form-group">
					
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
					</div>
				
				</form>
			</div>

			@if (isset($produtos))
			<table class="table table-hover table-striped">
	  			<thead> 
		  			<tr class="row">
		  				<th class="col-xs-2 col-md-2">CÓD.</th>
		  				<th class="col-xs-8 col-md-8">DESCRIÇÃO</th>
		  			</tr>
		  		</thead>

	  			<tbody>
	  			@foreach($produtos as $produto)
		  			<tr class="row listagem">
		  				<td class="col-xs-2 col-md-2"><a href="{!! $produto->ID_PRODUTO !!}">{!! $produto->MODELO !!}</a></td>
						<td class="col-xs-8 col-md-8"><a href="{!! $produto->ID_PRODUTO !!}">{!! $produto->DESCRICAO !!}</td>
				  	</tr>
		  		@endforeach
		  		</tbody>
			</table>
			@endif
			
			<div class="center_obj">
				<center>
					@if ((isset($produtos_count) && ($produtos_count == 0)) && (!Session::has('msg_pesquisa'))) 
					<p><strong>Nenhum registro encontrado</strong></p>
					@endif
					@if ((isset($produtos_count) && ($produtos_count == 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>1</strong> registro.</p>
					@endif
					@if ((isset($produtos_count) && ($produtos_count > 1)) && (!Session::has('msg_pesquisa'))) 
					<p>Exibindo <strong>10 </strong>registros, num total de <strong>{!! $produtos_count !!}</strong> registros encontrados.</p>
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