$(document).ready(function() {

    $("#txtDanger").hide();

    $("#formLogin").submit(function(event) {
        event.preventDefault();

        var button_content = $("button[name='login']").text();
        $("button[name='login']").text("");
        $("button[name='login']").html('... <i class="fa fa-refresh w3-spin"></i> ...');
        $("button[name='login']").prop('disabled', true);

        var form_data = $("#formLogin").serialize();

        $.ajax({
            url: "src/ajax/login.php",
            type: "POST",
            dataType: "json",
            cache: false,
            data: form_data,
            success: function(result) {
                console.log("Success");
                console.log(result);

                if (result.status) {
                    window.location.href = result.data;
                } else {
                    $("#txtDanger").show();
                    $("#msgDanger").html(result.message);
                }

            },
            error: function(xhr) {
                console.log("Error");
                console.log(xhr);
                // alert(xhr.responseJSON.message);
            },
            /*beforeSend: function() {
            console.log("beforeSend");
            },*/
            complete: function() {
                $("button[name='login']").html('');
                $("button[name='login']").html(button_content);
                $("button[name='login']").prop('disabled', false);
            }
        });
    });
});