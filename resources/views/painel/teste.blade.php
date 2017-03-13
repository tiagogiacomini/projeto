@include('partials.header')

<div class="card-tamanho">
	<div class="card-header">

		<div class="text-center"><strong>36</strong></div>

	</div>

	<div class="card-content">

		<input class="form-control input-lg campo-tamanho text-right" type="number" >

	</div>

	<div class="card-footer">
		
		<i class="fa fa-usd icone-preco"></i>
		<span class="card-preco">R$ 55,00</span>	
	
	</div>
</div>

<style type="text/css">


	.card-tamanho {
		
		border        : 1px solid #ccc;
		border-radius : 5px;
		border-bottom : 3px solid #ccc;
		width         : 100px;
		font-family   : 'Abel', sans-serif;

	}

	.card-header {

		border-radius    : 4px 4px 0px 0px;
		background-color : #1777D9;
		height           : 22px;
		border-bottom    : 1px solid #53A4F5;
		font-size        : 16px;
		color            : #fff; 	

	}

	.card-content {

		height : 50px;

	}

	.card-footer {

		height           : 25px;
		background-color : #ddd;
		border-radius    : 0px 0px 3px 3px;  

	}

	.campo-tamanho {

		margin    : 5px;
		width     : 87px;
		font-size : 32px;

	}

	.card-preco {

		position : relative;
		float    : right;
		padding  : 3px;
		color    : #666; 

	}

	.icone-preco {

		position : relative;
		top      : 3px;
		left     : 5px;

	}

	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
  		
  		-webkit-appearance : none; 
  		margin	           : 0; 
	
	}


</style>