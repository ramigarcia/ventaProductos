$(document).ready(function () {
	mostrarProductos();
});

function mostrarProductos() {
	var mostrarproductos = "true";
	$.ajax({
		url: "./procesos/mostrarProductos.php",
		type: "post",
		data: {
			mostrar: mostrarproductos,
		},
		success: function (data) {
			$("#registros").html(data);
		},
	});
}

function comprar(idproductoCompra) {
	$("#idproductoCompra").val(idproductoCompra); // es el id
	// alert("id " + idproducto);
	$.post(
		"./procesos/comprar.php",
		{ idproducto: idproducto },
		function (data, status) {
			var id_productoComprar = JSON.parse(data);
			// console.log(id_producto);
			$("#nombrePComprar").val(id_productoComprar.nombre);
			$("#categoriaPComprar").val(id_productoComprar.categoria);
			$("#descripcionPComprar").val(id_productoComprar.descripcion);
			$("#precioPComprar").val(id_productoComprar.precio);
			$("#stockPComprar").val(id_productoComprar.stock);
		}
	);
	$("#comprarProducto").modal("show");
}
