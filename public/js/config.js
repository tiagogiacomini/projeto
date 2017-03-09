$(document).ready(function() {

	// LENDO OS HIDDENS E MONTANDO OS ENABLED E DISABLED
	//determina o default de acordo com o BANCO DE DADOS
	if ($('#hidden_usa_pedido_grade').val() == 0) {

      		$('#flag_pedido_grade').bootstrapToggle('off');
			$('#flag_pedido_grade').bootstrapToggle('disable');

      		$('#flag_pedido_tam_modo_lista').bootstrapToggle('off');
			$('#flag_pedido_tam_modo_lista').bootstrapToggle('disable');

  	} else {

		$('#flag_pedido_grade').bootstrapToggle('enable');	      		
		$('#flag_pedido_tam_modo_lista').bootstrapToggle('enable');			
  	
 	}
	

 	if ($('#hidden_imp_pedido_grade').val() == 0) {
		
		$('#flag_pedido_tam_modo_lista').bootstrapToggle('off');
		$('#flag_pedido_tam_modo_lista').bootstrapToggle('disable');

	} else {

		$('#flag_pedido_tam_modo_lista').bootstrapToggle('enable');

	}


	// click no USA GRADE 
	$('#flag_usa_grade_pedido').change(function() {

		// se desmarcar a utilizacao da grade, desativa todos os demais controles que envolvem este critério
      	if (!($(this).prop('checked'))) {

      		$('#flag_pedido_grade').bootstrapToggle('off');
			$('#flag_pedido_grade').bootstrapToggle('disable');

      		$('#flag_pedido_tam_modo_lista').bootstrapToggle('off');
			$('#flag_pedido_tam_modo_lista').bootstrapToggle('disable');

      	} else {

			$('#flag_pedido_grade').bootstrapToggle('enable');	      		
			$('#flag_pedido_tam_modo_lista').bootstrapToggle('enable');			
      	
      	}
    
    });


    //click no MODO GRADE da IMPRESSAO DO PEDIDO
    $('#flag_pedido_grade').change(function() {
    	
		if ($(this).prop('checked')) {
   			
   			$('#flag_pedido_tam_modo_lista').bootstrapToggle('off');
			$('#flag_pedido_tam_modo_lista').bootstrapToggle('disable');
		
		} else {

   			$('#flag_pedido_tam_modo_lista').bootstrapToggle('enable');

		}

    });


	//BTN CANCELAR
	$(".btn_cancelar").click(function() {
		history.back();
		return false;
	});	


}); //document ready