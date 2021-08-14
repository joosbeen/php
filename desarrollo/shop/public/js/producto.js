countCart();
$(document).ready(function() {

    $("#btnProductoAgregar").click(function(e) {

        var talla = $("#talla").val();        
        var cantidad = $("#cantidad").val();
        
        $("#talla").removeClass("input-error");
        $("#cantidad").removeClass("input-error");
        $("#msgError").text("");

        if (talla == null || talla == 0 || talla == "") {
            $("#msgError").text("El campo talla es obligatorio");
            $("#talla").addClass("input-error");
        } else if (cantidad == null || cantidad == 0 || cantidad == "") {
            $("#msgError").text("El campo cantidad es obligatorio");
            $("#cantidad").addClass("input-error");
        } else if (Number.isInteger(talla)) {
            $("#msgError").text("El campo talla es inválido.");
            $("#talla").addClass("input-error");
        } else if (Number.isInteger(cantidad)) {
            $("#msgError").text("El campo cantidad es inválido.");
            $("#cantidad").addClass("input-error");
        } else {

            var button_content = $(this).text();
            $(this).text("");
            $(this).html('agregagndo <i class="fa fa-refresh w3-spin"></i>');
            $(this).prop('disabled', true);
            var form_data = $("#formCar").serialize();

            $.ajax({
                url: "public/ajax/addtocart.php",
                type: "POST",
                dataType: "json",
                cache: false,
                data: form_data,
                success: function(result) {
                    countCart();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                },
                /*beforeSend: function() {
                console.log("beforeSend");
                },*/
                complete: function() {
                    $("#btnProductoAgregar").html('');
                    $("#btnProductoAgregar").html(button_content);
                    $("#btnProductoAgregar").prop('disabled', false);
                }
            });


        }

    });

});