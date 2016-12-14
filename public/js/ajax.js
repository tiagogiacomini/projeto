$(document).ready(function() {

	// FAZ A BUSCA POR CEP e PREENCHE OS CAMPOS NO FORM
	$('#edit_cep').blur(function() {
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

});