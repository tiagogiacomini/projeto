$(document).ready(function() {
	
	///////////////////////////////////////////////////////////////////////////////////
	// C L I E N T E S
	///////////////////////////////////////////////////////////////////////////////////

	// VERIFICA SE O CPF/CNPJ JA EXISTE NO BANCO E AVISA
	$('#edit_cnpj').blur(function () {
		if ($(this).val().length >= 11) {
			
			var url = "/painel/buscacliente/" + $(this).val();
	
			Pace.track(function(){
			
				$.ajax({url      : url, 
						dataType : "json",
					    success  : function(data) {

					    	console.log(data);

					    	var tipo = "";
					    	
					    	if ($("#edit_cnpj").val().length == 11) {
					    		tipo = "CPF";
					    		$("#edit_cnpj").mask('000.000.000-00');
					    	}

							if ($("#edit_cnpj").val().length == 14) {
					    		tipo = "CNPJ";
					    	}

							$("#alerta-cnpj").removeClass("invisivel");
							$("#alerta-cnpj").html("<p>Já existe um cliente cadastrdo para o " + tipo + " informado!</p>");


							$("#edit_cnpj").focus();

				 		},

			     		error : function(data) {

							$("#alerta-cnpj").addClass("invisivel");

			     		}
				});
			});
		}
	}); 



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

	//BTN CANCELAR
	$(".btn_cancelar").click(function() {
		history.back();
		return false;
	});	


	

}); //document ready