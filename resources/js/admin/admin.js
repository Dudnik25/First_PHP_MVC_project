

function getAdminContent($page) {
    var page_id = $page;
    $.ajax({
        url: site_url + 'index.php',
        method: "POST",
        data: { id : page_id, 'action' : 'admin_content'},
        cache: false,
        success: function (result) {
            console.log("All fine!");
            $("#admin_page").html( result );
        },
        error: function (result) {
            $("#admin_page").html("<div class='eroor'>Ошибка соединения с сервером!</div>")
        }
    });
}



$( document ).ready(function() {




});