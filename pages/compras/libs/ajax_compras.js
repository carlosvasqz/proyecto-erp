$(function(){
	var ENV_WEBROOT = "../";

	$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {
		
		var descripcion = $("#txt_producto").val();
		var cantidad = $("#txt_cantidad").val();
		var existencia = $("#txt_existencia").val();
		var costo = $("#txt_costo").val();
		var porcentaje = $("#txt_porcentaje").val();
		var precio = $("#txt_precio").val();
		$.ajax({
			url: 'Controller/ProductoController_Compras.php?page=1',
			type: 'post',
			data: { 'descripcion':descripcion, 'cantidad':cantidad, 'existencia':existencia, 'costo':costo, 'porcentaje':porcentaje, 'precio':precio},
			dataType: 'json'
		}).done(function(data){
			if(data.success==true){
				
				$("#txt_producto").val('');
				$("#txt_cantidad").val('');
				$("#txt_existencia").val('');
				$("#txt_costo").val('');
				$("#txt_porcentaje").val('');
				$("#txt_precio").val('');
				alertify.success(data.msj);
				$(".detalle-producto").load('detalle_compra.php');
			}else{
				alertify.error(data.msj);
			}
		})
	});
	
	$(".eliminar-producto").off("click");
	$(".eliminar-producto").on("click", function(e) {
		var id = $(this).attr("id");
		$.ajax({
			url: 'Controller/ProductoController_Compras.php?page=2',
			type: 'post',
			data: {'id':id},
			dataType: 'json'
		}).done(function(data){
			if(data.success==true){
				alertify.success(data.msj);
				$(".detalle-producto").load('detalle_compra.php');
			}else{
				alertify.error(data.msj);
			}
		})
	});
	
});

