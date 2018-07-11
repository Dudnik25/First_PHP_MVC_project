var site_url = '/portal/';
var ajax_count = 0;

//Пагинация в каталоге
    function reuestcat(page) {
        var search = $('#s_cat_2').val();
        var page_id = page;
        $("#s_cat_2").attr("disabled", true);
        $.ajax({
            url: site_url + 'index.php',
            method: "POST",
            data: { id : page_id, search : search , 'action' : 'cat_select_2'},
            cache: false,
            success: function (result) {
                console.log("All fine!");
                $( "#catalog" ).html( result );
                $("#s_cat_2").attr("disabled", false);
            },
            error: function (result) {
                $("#s_cat_2").attr("disabled", false);
            }
        });
    }
//Пагинация в избранном
function favor_page(page) {
    var page_id = page;
    $.ajax({
        url: site_url + 'index.php',
        method: "POST",
        data: { id : page_id, 'action' : 'favor_page'},
        cache: false,
        success: function (result) {
            console.log("All fine!");
            $( "#favor_page" ).html( result );
        },
        error: function (result) {
        }
    });
}
//Добавление в избранное
    function favor(id) {
    $("#favor_hide").slideToggle("fast");
    $("#favor_ok").data("id", id);
}
//Календарь

function calendar(year, mon) {
    $("#cal_load").show();
    $.ajax({
        url: site_url + 'index.php',
        method: "POST",
        data: { year : year, mon : mon, 'action' : 'calendar_page'},
        cache: false,
        success: function (result) {
            console.log("All fine!");
            $( "#calendar" ).html( result );
            setTimeout(function () {
                $("#cal_load").hide();
            }, 300)


        },
        error: function (result) {
        }
    });
}

$( document ).ready(function() {

//Отправка форм
    $('form').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        form.find("button").attr("disabled", true);
        if (ajax_count < 1) {
            ajax_count = 1;
            $.ajax({
                url: site_url + 'index.php',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    var redirect = result.split('===');
                    if (redirect[0] == 'redirect') {
                        ajax_count = 0;
                        window.location = redirect[1];
                    } else {
                        $(form).find("div.form_error").html(result);
                        ajax_count = 0;
                    }
                    form.find("button").attr("disabled", false);
                },
                error: function (result) {
                    $(form).find("div.form_error").html('Ошибка отправки запроса!');
                    ajax_count = 0;
                    form.find("button").attr("disabled", false);
                }
            });
        }
});
//----------------------------------------------------------------------------------------------------------------------------------------------
//Каталог
//----------------------------------------------------------------------------------------------------------------------------------------------
//Выбор из общего списка комерческих интересов
    $("#s_cat_1").change(function () {
        var str = $(this).val();
        var arr = str.split('-');
        console.log("Выбран селект! Значения: " + arr);
        $("#s_cat_1").attr("disabled", true);
        $.ajax({
            url: site_url + 'index.php',
            method: "POST",
            data: { arr1 : arr[0] , arr2 : arr[1] , 'action' : 'cat_select_1'},
            cache: false,
            success: function (result) {
                console.log("All fine!");
                $("#s_cat_2").html(result);
                $("#s_cat_2").removeAttr("disabled");
                $("#s_cat_1").attr("disabled", false);
            },
            error: function (result) {
                $("#s_cat_1").attr("disabled", false);
            }
        });
    });
//Выбор из подробного списка комерческих интересов
    $('#s_cat_2').change(function () {
        reuestcat(1);
    });

    $("#favor_cencel").click(function () {
        $("#favor_hide").slideToggle("fast");
    });

    $("#favor_ok").click(function () {
        var id = $(this).data("id");
        $.ajax({
            url: site_url + 'index.php',
            method: "POST",
            data: { id : id , 'action' : 'favor_control'},
            cache: false,
            success: function (result) {
                if (result == 'add') {
                    $("#fav" + id).addClass("fav_active");
                }
                if (result == 'remove') {
                    if ($("div").is("#favor_page")) {
                        $("#fav" + id).parent("div").parent("div").parent("div").parent("div.card").parent().remove();
                    } else {
                        $("#fav" + id).removeClass("fav_active");
                    }
                }
                $("#favor_hide").slideToggle("fast");
            },
            error: function () {
                $("#favor_hide").slideToggle("fast");
            }
        });
    });
//----------------------------------------------------------------------------------------------------------------------------------------------
//Календарь

    $("#calendar").on('click','.cal_cell', function() {
        var content = $(this).siblings("div.cal_ajax");
        var day = $(this).data("cal-date");
        var mon = $("#cal_mon").data("cal-mon");
        var year = $("#cal_year").data("cal-year");
        if (day != '') {
            $.ajax({
                url: site_url + 'index.php',
                method: "POST",
                data: { day : day ,mon : mon, year : year, 'action' : 'events_date'},
                cache: false,
                success: function (result) {
                    content.html(result);
                    if (content.css('display') == 'none') {
                        $("div.cal_ajax").slideUp("slow");
                        content.slideToggle("slow");
                    }
                },
                error: function () {
                    if (content.css('display') == 'none') {
                        $("div.cal_ajax").slideUp("slow");
                        content.slideToggle("slow");
                    }
                }
            });

        }
    });

 //Управление окном с событиями в календаре

    $("#calendar").on('click','.ajax_close', function() {
        $(this).parent("div.cal_ajax").slideUp("slow");
    });


//----------------------------------------------------------------------------------------------------------------------------------------------
//Добавление и удаление форм
//Добавление блока контактов
$("#add_but_contact").click(function () {
    $(this).parent().siblings("div.hide").filter(':first').children(".card-body").children("input").filter(':last').val("yes");
    $(this).parent().siblings("div.hide").filter(':first').removeClass("hide");
});
//Удаление блока контактов
$(".buttonxc").click(function () {
    var size = $(this).parent(".card-header").parent(".contact").parent("div").parent("form").find(".contact.hide").length;
    if (size == 4) {} else {
        $(this).parent(".card-header").parent(".contact").addClass("hide");
        $(this).parent(".card-header").parent(".contact").children(".card-body").children(".form-group").children("input").val('');
        $(this).parent(".card-header").parent(".contact").children(".card-body").children("input").filter(':last').val("no");
    }
});
//Добавление блока комерции и типа компании
$("#add_but_commerce, #add_but_companytype").click(function () {
    $(this).parent().siblings(".card-body").children(".form-group.hide").filter(':first').children("input").filter(':last').val('yes');
    $(this).parent().siblings(".card-body").children(".form-group.hide").filter(':first').removeClass("hide");
});
//Удаление блока комерции и типа компании
$(".buttonx").click(function () {
    var size = $(this).parent().parent().parent(".form-group").parent(".card-body").find(".form-group.hide").length;
    if (size == 4) {} else {
       $(this).parent().parent().parent(".form-group").children("input").filter(':last').val('no');
        $(this).parent().parent().parent(".form-group").addClass("hide");
       $(this).parent().siblings(".select").children("select").prop('selectedIndex',0);
    }
});

});
//----------------------------------------------------------------------------------------------------------------------------------------------