function countCart() {
    $.ajax({
        url: "public/ajax/totalincart.php",
        type: "GET",
        dataType: "json",
        cache: false,
        success: function(rsp) {
            $("#cartbar").text(rsp.total);
            $("#cartsidebar").text(rsp.total);
        },
        error: function(xhr) {
            $("#cartbar").text('0');
            $("#cartsidebar").text('0');
        }
    });
}

function openOrCloseMenu() {
    var statusSidebar = document.getElementById("sidebarMenu").style.display;
    document.getElementById("sidebarMenu").style.display = (statusSidebar == "block") ? "none" : "block";
}