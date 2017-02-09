$(document).ready(function() {


	//////////////////////////////////////////////////////////////////////////
    //  P E D I D O S
    //////////////////////////////////////////////////////////////////////////



    //faz o collapse dos dados do cliente no PEDIDO
    $("#gbox_endereco").on("hide.bs.collapse", function(){
	  $(".btn_collapse").html('<i class="fa fa-chevron-down fa-2x"></i>');
	});
	
	$("#gbox_endereco").on("show.bs.collapse", function(){
	    $(".btn_collapse").html('<i class="fa fa-chevron-up fa-2x"></i>');
	});


	//
    function BuscaCliente() {

		var valor = $("#edit_busca_cliente").val();

		if (valor.length == 0 )  {
			return false;
		}

		var url   = "/painel/buscacliente/" + valor;

		Pace.track(function(){
		
			$.ajax({ url      : url, 
					 dataType : "json",
				     
				     success  : function(data) {

						console.log(data);

				     	if (data.NOME_FANTASIA) {
				     		$("#edit_fantasia").val(data.NOME_FANTASIA);
				     	}
				     	if (data.RAZAO) {
				     		$("#edit_razao").val(data.RAZAO);
						}
				     	if (data.PFPJ) {
				     		$("#edit_pessoa").val(data.PFPJ);
						}

				     	if (data.IERG) {
							$("#edit_ierg").val(data.IERG);
				     	}
						if (data.ENDERECO) {
				     		$("#edit_endereco").val(data.ENDERECO);
						}
						if (data.NUMERO) {
				     		$("#edit_numero").val(data.NUMERO);
						}
						if (data.BAIRRO) {
				     		$("#edit_bairro").val(data.BAIRRO);
				     	}
				     	if (data.CIDADE) {
				     		$("#edit_cidade").val(data.CIDADE);
				     	}
				     	if (data.ESTADO) {
				     		$("#edit_estado").val(data.ESTADO);
				     	}
				     	if (data.CEP) {
				     		$("#edit_cep").val(data.CEP);
				     	}

				     	if (data.TELEFONE) {
				     		$("#edit_telefone").val(data.TELEFONE);
				     	}

				     	if (data.ID_TABELA) {
				     		$("#id_tabela_preco").val(data.ID_TABELA);
				     	}

				     	$("#gbox_pesquisa_cliente").addClass('has-success');
				     	$("#gbox_itens").removeClass('invisivel');
				     	$("#btn_additem").removeClass('invisivel');
				     	$("#alerta-nao-encontrado").addClass("invisivel");
				     	
				    },

					error : function(data) {

						$("#edit_fantasia" ).val();
						$("#edit_pessoa"   ).val();
						$("#edit_ierg"     ).val();
						$("#edit_endereco" ).val();
						$("#edit_numero"   ).val();
						$("#edit_bairro"   ).val();
						$("#edit_cidade"   ).val();
						$("#edit_estado"   ).val();
						$("#edit_cep"      ).val();
						$("#edit_razao"    ).val();

						$("#gbox_pesquisa_cliente").removeClass('has-success');
						$("#alerta-nao-encontrado").removeClass("invisivel");
						$("#alerta-nao-encontrado").html("<p>Nenhum cliente encontrado!<strong><a href=\"/painel/clientes/create/?edit_cnpj=" + $("#edit_busca_cliente").val() + "\"> Cadastrar</strong></a> agora?</p>");
					}	

			});
		});

    }


	// clique na lupa busca CLIENTE
	$('#btn_buscacliente').click(function () {

		BuscaCliente();
		
	});

	
	
	//ONSHOW DO MODAL DE INSERÇÂO DE ITENS
	$('#modalItens').on('shown.bs.modal', function () {

		$('#edit_busca_prod').focus();
	
	})


	$("#edit_busca_prod").keyup(function() {
		
		if ( $(this).val().length === 1 ) {

		    if  ( !$("#gbox_nenhum_resultado").hasClass('invisivel')) {

				$("#gbox_nenhum_resultado").addClass('invisivel');
			}

			if  ( !$("#gbox_nenhuma_tabela").hasClass('invisivel')) {

				$("#gbox_nenhuma_tabela").addClass('invisivel');

			}
		}

 	});

	// faz a pesquisa de produto no modal de inserção de item
	$("#btn_busca_prod").click(function() {
		
		var valor 			= $("#edit_busca_prod").val();
		var id_tabela_preco = $("#id_tabela_preco").val(); 

		if ( valor.length == 0 )  {
			return false;
		}
 
		if (( id_tabela_preco == 0 ) || 
			( id_tabela_preco == null)) {
			return false;
		}

		$("#gbox_nenhum_resultado").addClass('invisivel');
		$("#gbox_nenhuma_tabela").addClass('invisivel');


		//pesquisar por modelo
		if ($("#sel_pesquisa_por").val() == 'MODELO') {

			var url = '/painel/pedidos/busca_prod_modelo/' + valor;
		} 

		if ($("#sel_pesquisa_por").val() == 'DESCRICAO') {

			var url = '/painel/pedidos/busca_prod_descr/' + valor;		
		}

		Pace.track(function(){
		
			$.ajax({ url      : url, 
					 dataType : "json",
				     
				     success  : function(data) {

						console.log(data);

				     	var id_produto = data.ID_PRODUTO;
						
						//preenche os tamanhos do produto
						$.ajax({ url     : '/painel/pedidos/busca_prod_tamanho/' + id_produto + '/' + id_tabela_preco ,
					             dataType: 'json'  ,

					            success : function(data_tam) {
					             	
					            	console.log(data_tam);
									
									var primeiro_preco;

					            	//se nao houver tamanhos
					            	if (!$.isArray(data_tam) || !data_tam.length)  {

					            		$("#gbox_resultado").addClass('invisivel');
										$("#gbox_nenhuma_tabela").removeClass('invisivel');
						        	
						        		return false;	
					            	}
					            	
					            	// eche o select com os tamanhos
		  			            	$("#edit_tamanhos").html('');

					            	$.each(data_tam, function(index) {

					            		$("#edit_tamanhos").append('<option value=' + this.TAMANHO + ' data-preco=' + this.PRECO_VENDA +'>' + this.TAMANHO + '</option>');
					            		if ( index == 0 )
					            		    primeiro_preco = this.PRECO_VENDA;
					            	});

					            	$("#edit_preco").val(primeiro_preco);
					            	$("#edit_quantidade").val(1);
					            	$("#edit_tamanhos").focus();

					            },

					            error : function() {
								
									$("#gbox_resultado").addClass('invisivel');
									$("#gbox_nenhum_resultado").removeClass('invisivel');

						
					            }

					    });

						    
					    if (data.UNIDADE) {
				     		$("#edit_unidade").val(data.UNIDADE);
				     	}
				     	if (data.DESCRICAO) {
				     		$("#edit_descricao").val(data.DESCRICAO);
						}
						if (data.GENERO) {
				     		$("#edit_genero").val(data.GENERO);
						}
						if (data.COR) {
				     		$("#edit_cor").val(data.COR);
						}
						if (data.GRUPO) {
				     		$("#edit_grupo").val(data.GRUPO);
						}
						if (id_produto) {
				     		$("#id_produto").val(id_produto);
						}


						$("#gbox_itens").removeClass('invisivel');
				     	$("#gbox_resultado").removeClass('invisivel');
				     	$("#btn_add_prod").removeClass('invisivel');
		    	     	$("#gbox_nenhum_resultado").addClass('invisivel');
		    	     	$("#gbox_nenhuma_tabela").addClass('invisivel');
		    	     		    	     	
		     					     	
				    },

					error : function(data) {

						$("#gbox_resultado").addClass('invisivel');
						$("#btn_add_prod").addClass('invisivel');
						$("#gbox_nenhum_resultado").removeClass('invisivel');

						$("#edit_busca_prod").focus();
						$("#edit_busca_prod").select();
									
					}	

			});
		});

	});

	// PEGA O PREÇO DE VENDA DO TAMANHO ESCOLHIDO
	function AlteraPreco() {

		$("#edit_preco").val( $("#edit_tamanhos").children('option:selected').data('preco') );
		$("#preco_unitario").val( $("#edit_tamanhos").children('option:selected').data('preco') );
	}

	$("#edit_tamanhos").on('change blur', (function() {
		
		AlteraPreco();

	}));


	//ADICIONA PRODUTO NO PEDIDO VIA AJAX (POST)
 	$("#submit_form_item").on('click touch', (function() {

 		if (( $("#edit_quantidade").val() == 0 ) || ( $("#edit_quantidade").val() == null )) {

 			$("#gbox_quantidade").addClass('has-error');
 			$("#edit_quantidade").focus();
 			return false;
 		}  

		if ( $("#edit_tamanhos").val() == null ) {

 			$("#edit_tamanhos").focus();
 			return false;
 		}  

		if (( $("#edit_preco").val() == 0 ) || ( $("#edit_preco").val() == null )) {

 			return false;
 		}  
 		


 		var id_pedido  = $("#id_pedido").val(); 
 		var id_produto = $("#id_produto").val(); 
 		var formURL    = '/painel/pedidos/additem';

 		 console.log(formURL + ' - ' + 'PRODUTO: ' + id_produto + ' - PEDIDO: ' + id_pedido);
 		 
 	
 		//monta JSON dos dados na UNHA
 		var dados 	   = '{  "id_produto": ' + '"' + id_produto 			         + '"' + ',' +
 		                    '"id_pedido": '  + '"' + id_pedido 				         + '"' + ',' +
 		                    '"tamanho": '    + '"' + $("#edit_tamanhos").val() 	     + '"' + ',' +
 		                    '"quantidade": ' + '"' + $("#edit_quantidade").val()     + '"' + ',' +
 		                    '"preco": '   	 + '"' + $("#edit_preco").val() 	     + '"' + ' }';



 		//parsea
 		var jsonobj = JSON.parse(dados);                   

 		Pace.track(function(){
	 		
	 		$.ajax({ url      : formURL,
	 			     type     : 'POST' ,
	 			     data     : jsonobj  , 
	 			     dataType : 'json',

	 			    success : function (data) {

	 			     	console.log(data);

	 			     				
	 			     	$("#tabela_itens").append('<tr><td >' + $("#edit_busca_prod" ).val() + '</td>' + 
	 			     		 						  '<td class="text-center">' + data.TAMANHO  + '</td>' + 			     		 						  
	 			     		 						  '<td class="hidden-xs">' + $("#edit_descricao"  ).val()  + '</td>' +
													  '<td class="hidden-xs text-right">R$ '  + data.PRECO_UNT + '</td>' +
													  '<td class="hidden-xs text-right">' + data.QUANTIDADE  + '</td>' + 			     		                          
													  '<td class="text-right">R$ '+ data.TOTAL_ITEM + '</td>' +
													  '<td class="text-center"> '+ '<button type="button" class="btn btn-danger btn_exclui_prod"' +
													  											     ' data-idprod="'+ id_produto   + '"' + 
													                                                 ' data-idped="' + id_pedido    + '"' + 
													                                                 ' data-tam="'   + data.TAMANHO + '">' + 
													                                                 '<i class="fa fa-trash-o"></i></button></td></tr>'
													  );

	                    	 			     	
	 			     	$("#edit_quantidade").val(1);

	 			     	$("#gbox_item_incluso").removeClass('invisivel');
	 			        $("#tabela_itens").removeClass('invisivel');
	 			     	$("#gbox_quantidade").removeClass('has-error');
						
						$("#gbox_item_incluso").fadeTo(2000, 500).slideUp(500, function(){		
	    					$("#gbox_item_incluso").slideUp(500);
						});

			
						$("#edit_tamanhos").focus();
						
						$("#total_pedido").val( '' );
						$("#total_pedido").val( 'R$ ' + data.TOTAL_PEDIDO );

	 			    }, 


	 			    error : function () {

	 			    	$("#gbox_item_erro").removeClass('invisivel');
	 			    	$("#gbox_quantidade").removeClass('has-error');

 						$("#gbox_item_erro").fadeTo(3000, 3000).slideUp(500, function(){		
	    					$("#gbox_item_erro").slideUp(3000);
						});

	 			    }


	 		});
		});
 	}));


	//EXCLUI ITEM DO PEDIDO 
	$("#tabela_itens").on('click', '.btn_exclui_prod' , function() {

		var row        = $(this).closest('tr');
		var sender     = $(this).closest('button');
		var id_produto = sender.data('idprod');
		var id_pedido  = sender.data('idped' );
		var tamanho    = sender.data('tam'   );

		var formURL    = '/painel/pedidos/removeitem';
		var dados      = '{  "id_produto": ' + id_produto + ',' +
 		                    '"id_pedido": '  + id_pedido  + ',' +
					        '"tamanho": "'   + tamanho    + '" }';
 		//parsea
 		var jsonobj = JSON.parse(dados); 

 		console.log(jsonobj);  

		Pace.track( function(){
			
			$.ajax({ url      : formURL,
	 			     type     : 'DELETE' ,
	 			     data     : jsonobj  , 
	 			     dataType : 'json',

	 			     success : function(data) {

	 			     	// se der bom na DELECAO, remove a TR na exibição
	 			     	if (data.STATUS == 'OK') {

		 			     	row.fadeOut('1000', function() {
		 			     		row.remove();
							});

							$("#total_pedido").val( '' );
							$("#total_pedido").val( 'R$ ' + data.TOTAL );
		 			     	
		 			    }

	 			     },

	 			     error : function() {

	 			     }

	 		});

		});
			
	});

	$("#btn_salvar").click(function() {
		
		$("#form_pedido").submit();
			
	});


	//BTN CANCELAR
	$(".btn_cancelar").click(function() {
		history.back();
		return false;
	});	


}); //document ready
	
