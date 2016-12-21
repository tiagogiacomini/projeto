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


	// FAZ A BUSCA POR CLIENTE e PREENCHE OS CAMPOS NO FORM
	$('#btn_buscacliente').click(function () {
		
		$("#edit_busca_cliente").unmask();	

		var valor   = $("#edit_busca_cliente").val();
		var tamanho = valor.length;
		
		if (valor.length >= 11 ) {
			
			var tipo;
			
			//verifica se é CPF ou CNPJ
			if (tamanho == 11 ) {
				tipo = "CPF";
			}
			if (tamanho == 14) {
				tipo = "CNPJ";
			}

			$('#edit_busca_cliente').cpfcnpj({
		        
		        mask	 : false,
		        validate : 'cpfcnpj',
		        event    : 'click',
		        handler  : '#btn_buscacliente',
		        
		        ifValid	 : function (input) { 
		        
		        	
		        	$("#alerta-cnpj-incorreto").addClass('invisivel');
		        	$("#gbox_pesquisa_cliente").addClass('has-success'); 
		        	$("#edit_formapagto").focus();

		        },
		        
		        ifInvalid : function (input) { 
		        
		        	
		        	$("#gbox_pesquisa_cliente").removeClass('has-success'); 
					$("#alerta-cnpj-incorreto").removeClass('invisivel');
					$("#edit_busca_cliente").focus();

					$.session.set('cnpj_incorreto', 'O ' + tipo + ' informado não é válido!');

		        }
		    });

			var url = "/painel/buscacliente/" + $("#edit_busca_cliente").val();
	
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
					     	
					     	// mascara o campo
					     	$("#edit_busca_cliente").unmask();

					 		if (tamanho == 11){
        						 $("#edit_busca_cliente").mask("999.999.999-99");
    						} 
    						else { 
    							$("#edit_busca_cliente").mask("99.999.999/9999-99");
    						} 
					    },

						error : function(data) {
							
									     	
						}	

				});
			});
		}
	});   


	///////////////////////////////////////////////////////////////////////////////////
	// C L I E N T E S
	///////////////////////////////////////////////////////////////////////////////////

	// FAZ A BUSCA POR CEP e PREENCHE OS CAMPOS NO FORM
	$('#edit_cep').blur(function () {
		if ($(this).val().length == 8) {
			
			var url = "/painel/buscacep/" + $(this).val();
	
			Pace.track(function(){
			
				$.ajax({url      : url, 
						dataType : "json",
					    success  : function(data) {

					    	console.log(data);

					     	if (data.ENDERECO) {
					     		$("#edit_endereco").val(data.ENDERECO);
					     		$(".edit_endereco").val(data.ENDERECO);
					     	}

					     	if (data.ENDERECO) {
					     		$("#edit_numero").val(data.NUMERO);
					     		$(".edit_numero").val(data.NUMERO);
					     	}

					     	if (data.BAIRRO) {
					     		$("#edit_bairro").val(data.BAIRRO);
								$(".edit_bairro").val(data.BAIRRO);					     		
					     	}

					     	if (data.NOME) {
					     		$("#edit_cidade").val(data.NOME);
								$(".edit_cidade").val(data.NOME);						     		
					     	}

					     	if (data.ESTADO) {
					     		$("#edit_estado").val(data.ESTADO);
					     		$(".edit_estado").val(data.ESTADO);
					     	}

			     		}
				});
			});
		}
	});   



}); //document ready
	
