@include('partials.header')

<link rel="stylesheet" type="text/css" href="/css/geral.css">

</head>
	<body>
		


		<div class="container_painel">
			<div class="btn_menu">
				<i class="fa fa-bars fa-2x"></i>
			</div>
			<div class="top_bar center_obj">
				<i class="fa fa-puzzle-piece fa-2x"></i><h1>&nbspProdutos</h1>
			</div>

		</div>
		
		<div class="container_listagem">
			<div class="center_obj">
				<form class="form-inline" method="GET">
					<div class="form-group">
					    <label class="sr-only" for="edit_busca">Pesquisa</label>
						<div class="input-group">
	  						<div class="input-group-addon"><i class="fa fa-search fa-2x"></i></div>
	  							<input type="text" class="form-control inputs_form" id="edit_busca" placeholder="Pesquisa...">
	  						</div>
						</div>
						<button type="submit" class="btn btn-primary form-control inputs_form">Pesquisar</button>
				</form>
			</div>
			<table class="table table-hover table-striped">
	  			<thead> 
		  			<tr class="row">
		  				<th class="col-xs-2 col-md-2">CÓD.</div>
		  				<th class="col-xs-8 col-md-8">DESCRIÇÃO</div>
		  			</tr>
		  		</thead>

	  			<tbody>
	  			@foreach($produtos as $produto)
		  			<tr class="row listagem">
		  				<td class="col-xs-2 col-md-2">{!! $produto->MODELO    !!}</div>
		  				<td class="col-xs-8 col-md-8">{!! $produto->DESCRICAO !!}</div>
		  			</tr>
		  		@endforeach
		  		</tbody>

			</table>
			<div class="center_obj">
				<p>Exibindo <strong>25</strong> produtos, num total de <strong>{!! $produtos_count !!}</strong> produtos cadastrados.</p>
			</div>
			<div class="center_obj">
			{{-- $produtos->links() --}}
			</div>
		</div>

		
		
		
	</body>
</html>