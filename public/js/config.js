$(document).ready(function() {

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





}); //document ready