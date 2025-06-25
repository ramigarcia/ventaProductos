$(buscar_reg());

function buscar_reg(consulta){
	$.ajax({
		url: 'buscar.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#registros").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

$(document).on('keyup','#caja_criterio', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_reg(valor);
	}else{
		buscar_reg();
	}
});