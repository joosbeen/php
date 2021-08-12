function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
function selectVehiculo() {
    document.getElementById("formVehiculo").submit();
}
$(document).ready(function () {

    $("#myInput").text("");
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#destino option").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
document.getElementById("btnsreservaciones").style.display = "none";
function cargarAsientosReservados() {
    $.ajax({
        url: "src/ajaxs/hacientos/cargarocupados.php",
        type: 'GET',
        async: true,
        data: {
            'unidad': $("#vehiculo").val()
        },
        success: function (data, textStatus, jqXHR) {

            for (item in data["hacientos"]) {
                $("button[name='" + data["hacientos"][item].haciento + "']").attr("disabled", true);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}
cargarAsientosReservados();
function cargarAsientosPrereservados() {
    $.ajax({
        url: "src/ajaxs/hacientos/ocupados.php",
        type: 'GET',
        async: true,
        data: {
            'unidad': $("#vehiculo").val()
        },
        success: function (data, textStatus, jqXHR) {
            var btnsEliminarRes = '';
            var exiteHacientos = false;
            var total = 0;
            for (item in data["hacientos"]) {
                total = total + (new Number(data["hacientos"][item].precio));
                exiteHacientos = true;
                $("button[name='" + data["hacientos"][item].haciento + "']").attr("disabled", true);
                btnsEliminarRes = btnsEliminarRes + '<button class="w3-button w3-xlarge w3-circle w3-red w3-card-4" onclick="btnEliminarReservacion(' + data["hacientos"][item].id + ',\'' + data["hacientos"][item].haciento + '\')">' + data["hacientos"][item].haciento + '</button>';
            }
            $("#total").text("$"+total);
            if (exiteHacientos) {
                document.getElementById("btnsreservaciones").style.display = "block";
            }
            $("#reservados").html('');
            $("#reservados").html(btnsEliminarRes);
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}
cargarAsientosPrereservados();
function apartarHaciento(haciento) {
    $.ajax({
        url: "src/ajaxs/hacientos/apartar.php",
        type: 'POST',
        async: true,
        data: {
            'haciento': haciento,
            'unidad': $("#vehiculo").val(),
            'destino': $("#destino").val()
        },
        success: function (data, textStatus, jqXHR) {
            if (data.operacion === "success") {
                $("button[name='" + haciento + "']").attr("disabled", true);
                cargarAsientosPrereservados();
            } else {
                alert(data.operacion);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("Error al registrar el usuario");
        }
    });
}

function btnEliminarReservacion(idHaciento, haciento){
    if(confirm("Decea eliminar el asientos" + haciento + "?")){
       $.ajax({
            url: "src/ajaxs/hacientos/eliminarasiento.php",
            type: 'POST',
            async: true,
            data: {
                'action':'asiento',
                'asiento': idHaciento
            },
            success: function (data, textStatus, jqXHR) {
                if (data.operacion === "success") {
                    $("button[name='" + haciento + "']").attr("disabled", false);
                    cargarAsientosPrereservados();
                } else {
                    alert(data.operacion);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error al registrar el usuario");
            }
        }); 
    }
}

function btnEliminarTodos(){
   if(confirm("Decea eliminar todos los asientos?")){
       $.ajax({
            url: "src/ajaxs/hacientos/eliminarasiento.php",
            type: 'POST',
            async: true,
            data: {
                'action':'unidad',
                'unidad': $("#vehiculo").val()
            },
            success: function (data, textStatus, jqXHR) {
                if (data.operacion === "success") {
                    
                    for (item in data["asientos"]) {                        
                        $("button[name='" + data["asientos"][item].haciento + "']").attr("disabled", false);
                    }
                    cargarAsientosPrereservados();
                    document.getElementById("btnsreservaciones").style.display = "none";
                } else {
                    alert(data.operacion);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error al registrar el usuario");
            }
        }); 
    } 
}

function btnReservar() {
    if(confirm("Reservar asientos selecionados?")){
       $.ajax({
            url: "src/ajaxs/hacientos/reservarasientos.php",
            type: 'POST',
            async: true,
            data: {
                'unidad': $("#vehiculo").val()
            },
            success: function (data, textStatus, jqXHR) {
                if (data.operacion === "success") {
                    cargarAsientosPrereservados();
                    document.getElementById("btnsreservaciones").style.display = "none";
                } else {
                    alert(data.operacion);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error al reservar los asientos");
            }
        }); 
    }
}

