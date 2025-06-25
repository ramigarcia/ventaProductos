//mostrar productos sin recargar
$(document).ready(function () {
	mostrarProductos();
});
// agregar productos
/* function agregarProducto(e) {
   //limpiar modal
   $("#modalNewProduct").on("show.bs.modal", function (event) {
     $("#modalNewProduct input").val("");
   });
   var nombre = $("#nombreProducto").val();
   var categoria = $("#categoria").val();
   var imagen = $("#imagenProducto").val();
   var descripcion = $("#descripcion").val();
   var precio = $("#precio").val();
   var stock = $("#stock").val();
   if (nombre == "") {
//     setTimeout(function () {
//       $("#alertNombreP")
//         .html("<span style='color:red;'>* Debe ingresar un nombre</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertNombreP").focus();
//     return false;
   } else if (categoria == "") {
//     setTimeout(function () {
//       $("#alertCategoriaP")
//         .html("<span style='color:red;'>* Debe elegir una categoria</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertCategoriaP").focus();
//     return false;
   } else if (imagen == "") {
//     setTimeout(function () {
//       $("#alertImagenP")
//         .html("<span style='color:red;'>* Debe ingresar una imagen</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertImagenP").focus();
//     return false;
   } else if (descripcion == "") {
//     setTimeout(function () {
//       $("#alertDescripcionP")
//         .html("<span style='color:red;'>* Debe ingresar una descripcion</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertDescripcionP").focus();
//     return false;
   } else if (precio == "") {
//     setTimeout(function () {
//       $("#alertPrecioP")
//         .html("<span style='color:red;'>* Debe ingresar un precio</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertPrecioP").focus();
//     return false;
   } else if (stock == "") {
//     setTimeout(function () {
//       $("#alertStockP")
//         .html("<span style='color:red;'>* Debe ingresar un stock mínimo</span>")
//         .fadeOut(6000);
//     }, 1000);
//     $("#alertStockP").focus();
//     return false;
   } else {
     $.ajax({
       url: "procesos/agregarProducto.php",
       type: "post",
       data: {
         nombreP: nombre,
         categoriaP: categoria,
         imagenP: imagen,
         descripcionP: descripcion,
         precioP: precio,
         stockP: stock,
       },
       success: function (data) {
         console.log(data);
         $("#modalNewProduct").modal("hide");
         mostrarProductos();
       },
     });
   }
 }*/
//traer tabla de clientes
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

function editProducto(idproducto) {
	$("#idproducto").val(idproducto); // es el id
	// alert("id " + idproducto);
	$.post(
		"./procesos/actualizarProducto.php",
		{ idproducto: idproducto },
		function (data, status) {
			var id_producto = JSON.parse(data);
			// console.log(id_producto);
			$("#nombreP").val(id_producto.nombre);
			$("#categoriaP").val(id_producto.categoria);
			$("#descripcionP").val(id_producto.descripcion);
			$("#precioP").val(id_producto.precio);
			$("#stockP").val(id_producto.stock);
		}
	);
	$("#editProducto").modal("show");
}

// actualizar producto
function actualizarProducto() {
	var productNombre = $("#nombreP").val();
	var productCategoria = $("#categoriaP").val();
	var productDescripcion = $("#descripcionP").val();
	var productPrecio = $("#precioP").val();
	var productStock = $("#stockP").val();
	var productId = $("#idproducto").val();
	//alert('id ' + productId);
	if (productNombre == "") {
		setTimeout(function () {
			console.log($("#nombreP"));
			$("#alertNombre")
				.html("<span style='color:red;'>* Debe ingresar un nombre</span>")
				.fadeOut(6000);
		}, 1000);
		$("#alertNombre").focus();
		return false;
	} else if (productCategoria == "") {
		setTimeout(function () {
			$("#alertCategoria")
				.html("<span style='color:red;'>* Debe elegir una categoria</span>")
				.fadeOut(6000);
		}, 1000);
		$("#alertCategoria").focus();
		return false;
	} else if (productDescripcion == "") {
		setTimeout(function () {
			$("#alertDescripcion")
				.html("<span style='color:red;'>* Debe ingresar una descripcion</span>")
				.fadeOut(6000);
		}, 1000);
		$("#alertDescripcion").focus();
		return false;
	} else if (productPrecio == "") {
		setTimeout(function () {
			$("#alertPrecio")
				.html("<span style='color:red;'>* Bebe ingresar un precio</span>")
				.fadeOut(6000);
		}, 1000);
		$("#alertPrecio").focus();
		return false;
	} else if (productStock == "") {
		setTimeout(function () {
			$("#alertStock")
				.html("<span style='color:red;'>* Debe ingresar un stock mínimo</span>")
				.fadeOut(6000);
		}, 1000);
		$("#alertStock").focus();
		return false;
	} else {
		$.post(
			"./procesos/actualizarProducto.php",
			{
				productNombre: productNombre,
				productCategoria: productCategoria,
				productDescripcion: productDescripcion,
				productPrecio: productPrecio,
				productStock: productStock,
				productId: productId,
			},
			function (data, status) {
				console.log(data);
				$("#editProducto").modal("hide");
				mostrarProductos();
			}
		);
	} //cierra else
}

function si_no_delete(id) {
	alertify.confirm(
		"Eliminar producto",
		"¿Esta seguro que quiere eliminar este producto? " + id,
		function () {
			eliminarProducto(id);
		},
		function () {
			alertify.error("Cancelado");
		}
	);
}

// eliminar producto
function eliminarProducto(idProductoD) {
	$("#idproductoDelete").val(idProductoD);
	$.post(
		"./procesos/eliminarProducto.php",
		{ idProductoD: idProductoD },
		function (data, status) {
			// console.log(idProducto, data);
			$("#deleteProductModal").modal("hide");
			mostrarProductos();
		}
	);
}
