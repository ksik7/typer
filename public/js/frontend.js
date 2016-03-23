$(document).ready(function () {
    $('a#next').click(function () {
        var element = $(this);
        getProducts(element);
    });
    $('a#previous').click(function () {
        var element = $(this);
        getProducts(element);
    });
    $('a#page').click(function () {
        var element = $(this);
        getProducts(element);
    });

    var page = window.location.href;

    $.ajax({

        url: page,
        type: "POST",
        data: "format=json",
        async: false,
        success: function (response) {
            dataParse(response);
        }
    });

});

function dataParse(response) {

    var test = response['products'];
    var test = JSON.parse(test);
    $('#test').html('');
    for (var i in test) {
        $('#test').append('<li>' + test[i].Name + '</li>');
    }

    updatePageLink(response.currentPage);

}

function updatePageLink(page) {
    $("#previous").attr('page', page - 1);
    $("#next").attr('page', page + 1);
}

function getProducts(element) {

    var page = window.location.pathname;
    var url = page + '/index/page/' + element.attr('page');
    $.ajax({

        url: url,
        type: "POST",
        data: "format=json",
        async: false,
        success: function (response) {
            dataParse(response);
        }
    });
}

