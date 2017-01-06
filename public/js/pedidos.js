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

				     	$("#gbox_pesquisa_cliente").addClass('has-success');
		     	
				     	
				    },

					error : function(data) {

						$("#edit_fantasia" ).val("");
						$("#edit_pessoa"   ).val("");
						$("#edit_ierg"     ).val("");
						$("#edit_endereco" ).val("");
						$("#edit_numero"   ).val("");
						$("#edit_bairro"   ).val("");
						$("#edit_cidade"   ).val("");
						$("#edit_estado"   ).val("");
						$("#edit_cep"      ).val("");
						$("#edit_razao"    ).val("");

						$("#alerta-nao-encontrado").removeClass("invisivel");
						$("#alerta-nao-encontrado").html("<p>Nenhum cliente encontrado!<strong><a href=\"clientes/create/?edit_cnpj=" + $("#edit_busca_cliente").val() + "\"> Cadastrar</strong></a> agora?</p>");
					}	

			});
		});
	});

	

	//BTN CANCELAR
	$(".btn_cancelar").click(function() {
		history.back();
		return false;
	});	

	
}); //document ready
	
