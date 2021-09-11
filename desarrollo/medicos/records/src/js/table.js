$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("body").on("click", ".btnEditarDatos", function(event) {
        var id = $(this).val();
        $("#idEdit").val(id);
        $("#formEditData").submit();
    });
});