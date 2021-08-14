countCart();
$(document).ready(function() {

    var cargarCarrito = function() {

        $.ajax({
            url: "public/ajax/cartproducts.php",
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(result) {
                $("#carrito_productos").html(result.carrito_productos);
            },
            error: function(xhr) {
                console.log("error -> cartproducts");
                console.log(xhr);
            }
        });

    }

    cargarCarrito();

    var sesionActiva = function() {

        $.ajax({
            url: "public/ajax/sesion.php",
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(result) {
                if (result.login) {

                    $("#btnLogin").hide();
                    $("#btnRegistrar").hide();
                    $("#btnPagar").show();

                } else {
                    $("#btnLogin").show();
                    $("#btnRegistrar").show();
                    $("#btnPagar").hide();

                }
            },
            error: function(xhr) {
                console.log("error -> cartproducts");
                console.log(xhr);
            }
        });

    }

    sesionActiva();

    $("body").on("click", ".btnEliminar", function(event) {

        event.preventDefault();
        var producto = $(this).val();

        if (producto == null || producto.length == 0 || /^\s+$/.test(producto)) {

            alert("Ocurrio un error inesperado intentelo de nuevo mas tarde!");

        } else {
            $.ajax({
                url: "public/ajax/removeproductcart.php",
                type: "POST",
                dataType: "json",
                data: {
                    "producto": producto
                },
                cache: false,
                success: function(result) {
                    cargarCarrito();
                },
                error: function(xhr) {
                    console.log("error -> removeproductcart");
                }
            });
        }

    });

});