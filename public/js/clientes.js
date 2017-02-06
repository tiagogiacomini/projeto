$(document).ready(function() {
	
	///////////////////////////////////////////////////////////////////////////////////
	// C L I E N T E S
	///////////////////////////////////////////////////////////////////////////////////
	//pega o URL pra verificar se está editando ou incluindo
	var url = $(location).attr('href');
	var tipoEdicao;

	if ( url.search( 'edit' ) == -1 ) {
			tipoEdicao = 'inclusão';
	} else { 
		tipoEdicao = 'edição'; 
	}

	if (tipoEdicao == 'inclusão') {
		$("#edit_cnpj").focus();
	} else {
		$("#edit_razao").focus();
	}



	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('.phone').mask(SPMaskBehavior, spOptions);

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
					    	}

							if ($("#edit_cnpj").val().length == 14) {
					    		tipo = "CNPJ";
					    	}

							$("#alerta-cnpj").removeClass("invisivel");
							$("#alerta-cnpj").html("<p>Já existe um cliente cadastrado para o " + tipo + " informado!</p>");


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

					    	$("#alerta-cep").addClass('invisivel');

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


					     	$("#edit_numero").focus();

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


	$("#form_cliente").submit(function() {


		$("#alerta-cliente").addClass('invisivel');
		$("#alerta-cep").addClass('invisivel');
			
		//valida Inscricao ou RG
		if ( $("#edit_ierg").val() == "" ) {

			$("#alerta-cliente").html('<strong>Atenção!</strong><p> É obrigatório informar o RG/Inscrição Estadual</p>');
			$("#alerta-cliente").removeClass('invisivel');
			$("#edit_ierg").focus();

			return false;
		}

		if ( $("#edit_razao").val() == "" ) {

			$("#alerta-cliente").html('<strong>Atenção!</strong><p> É obrigatório informar o Nome/Razão Social</p>');
			$("#alerta-cliente").removeClass('invisivel');
			$("#edit_Razao").focus();

			return false;
		}
		
		if ( $("#edit_cep").val() == "" ) {

			$("#alerta-cep").html('<strong>Atenção!</strong><p> É obrigatório informar o CEP</p>');
			$("#alerta-cep").removeClass('invisivel');
			$("#edit_cep").focus();

			return false;
		}

		if (tipoEdicao == 'inclusão') {
			
			if ( $("#edit_tabpreco").val() == -1 ) /* NENHUMA */ {

				$("#alerta-tabpreco").html('<strong>Atenção!</strong><p> Selecione uma tabela de preço!</p>');
				$("#alerta-tabpreco").removeClass('invisivel');
				$("#edit_tabpreco").focus();

				return false;
			}
		}


	});

	

}); //document ready