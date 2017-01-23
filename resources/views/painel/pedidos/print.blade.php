	<!DOCTYPE html> 
<html lang="pt-br"> 
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/css/print-pedido.css">
	
	<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



	<title>Impressão de Pedido</title> 
</head> 
<body> 
	<div class="page">

		<div class="round-rect cabecalho">
			<img src="/img/loofting.bmp" class="logo">

			<div class="titulo">Pedido Nº {!! sprintf('%06d', $pedido->ID_PEDIDO) !!}</div>
			<p class="provisorio">* Número provisório * </p>
		</div>

		<div class="titulos-gbox">
			<i class="fa fa-info-circle"></i><strong> Informações Principais</strong>
		</div>

		<div class="round-rect datas" >
			<span class="nome-vendedor">Vendedor: <strong>{!! $vendedor_nome !!}</strong></span>
			<span class="data-emissao">Data Emissão: <strong>{!! date('d/m/Y', strtotime($pedido->DATA_EMISSAO)) !!}</strong></span>
			<span class="data-entrega">Data Entrega (previsão): <strong>{!! date('d/m/Y', strtotime($pedido->PREVISAO_ENTREGA)) !!}</strong></span>			
		</div>
		
		<div class="titulos-gbox">
			<i class="fa fa-user-circle"></i><strong> Dados do Cliente</strong>
		</div>
		
		<div class="round-rect cliente">
			<div class="razao-cliente">Razão Social: <strong>{!! $cliente->RAZAO !!}</strong></div>
			@if($cliente->PFPJ == 'JURÍDICA' ) 
			<div class="cnpj-cliente">CNPJ: <strong>{!! Helpers::mask($cliente->CNPJ, '##.###.###/####-##') !!}</strong></div>
			@else 
			<div class="cnpj-cliente">CPF: <strong>{!! Helpers::mask($cliente->CNPJ, '###.###.###-##') !!}</strong></div>
			@endif
			<div class="nome-cliente">Nome Fantasia: <strong>{!! $cliente->NOME_FANTASIA !!}</strong></div>
			<div class="ierg-cliente">IE/RG: <strong>{!! $cliente->IERG !!}</strong></div>
			<div class="end-cliente">Endereço: <strong>{!! $cliente->ENDERECO .', ' .$cliente->NUMERO !!}</strong></div>
			<div class="bairro-cliente">Bairro: <strong>{!! $cliente->BAIRRO!!}</strong></div>
			<div class="cep-cliente">CEP: <strong>{!! Helpers::mask($cliente->CEP, '##.###-###') !!}</strong></div>
			<div class="cidest-cliente">Cidade/UF: <strong>{!! $cliente->CIDADE .'/'. $cliente->ESTADO !!}</strong></div>
		</div>

		<div class="titulos-gbox">
			<i class="fa fa-usd"></i><strong> Forma de Pagamento</strong>
		</div>

		<div class="round-rect forma-pagto">
			<div class="forma-pgto">Condição de Pagamento: <strong>{!! $pedido->CONDICAO_PAGTO !!}</strong></div>
		</div>

		<div class="titulos-gbox">
			<i class="fa fa-cubes"></i><strong> Itens do Pedido</strong>
		</div>

		<div class="round-rect itens">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="50">REFERÊNCIA</th>
						<th width="20" class="text-right">34</th>
						<th width="20" class="text-right">36</th>
						<th width="20" class="text-right">38</th>
						<th width="20" class="text-right">40</th>
						<th width="20" class="text-right">42</th>
						<th width="20" class="text-right">44</th>
						<th width="20" class="text-right">46</th>
						<th width="20" class="text-right">48</th>
						<th width="20" class="text-right">50</th>
						<th width="20" class="text-right">52</th>
						<th width="20" class="text-right">54</th>
						<th width="20" class="text-right">P</th>
						<th width="20" class="text-right">M</th>
						<th width="20" class="text-right">G</th>
						<th width="20" class="text-right">GG</th>
						<th width="20" class="text-right">QTD.</th>
						<th width="30" class="text-right">UNIT.</th>
						<th width="30" class="text-right">TOTAL</th>
					</tr>
				</thead>

				<tbody>	
						@php 
							$quant_total_pecas = 0;
						@endphp

						@foreach($produtos as $item)

						<tr>
							<td>{!! $item['MODELO'] !!}</td>
							
							@php
								$quant_total = 0;
							@endphp			


							@for($i=34; $i<=62; $i+=2)
								
								@if ( $item['GRADE'][ strval($i) ] > 0 )				     	
									<td class="text-right" data-idx="{!! $i !!}">{!! $item['GRADE'][ strval($i) ] !!}</td>		
								@else
									<td data-idx="{!! $i !!}"></td>
								@endif								
											
								@php 
									$quant_total = $quant_total + $item['GRADE'][ strval($i) ];
								@endphp 

							@endfor

							@php 
								$quant_total_pecas = $quant_total_pecas + $quant_total;
							@endphp

							<td class="text-right">{!! $quant_total !!}</td>
							<td class="text-right">{!! number_format( $item['PRECO'] , 2, ',', '.') !!}</td>
							<td class="text-right">{!! number_format( ($item['PRECO'] * $quant_total) , 2, ',', '.') !!}</td>

						</tr>
					
					@endforeach
				
				</tbody>
			</table>
		</div>
		
		<div class="round-rect total">
			
			<span class="total_pecas">PEÇAS: <strong>{!! $quant_total_pecas !!}</strong></span>
			<span class="total_pedido">TOTAL: <strong>R$ {!! number_format($pedido->TOTAL, 2, ',', '.') !!}</strong></span>
			
		</div>


		<div class="titulos-gbox">
			<i class="fa fa-commenting"></i><strong> Observações</strong>
		</div>
		<div class="round-rect obs">
			<div class="obs-pedido"><strong>{!! $pedido->OBSERVACAO !!}</strong></div>
		</div>

		<div class="assinaturas">
			<div class="data_assinatura">{!! $cliente->CIDADE . '/' . $cliente->ESTADO . ', ' . date('d/m/Y', strtotime($pedido->DATA_EMISSAO)) !!}.</div>
			<div class="cli_assinatura"><strong>{!! $cliente->RAZAO !!}</strong></div>

		</div>

	</div>

</body>
</hmtl>