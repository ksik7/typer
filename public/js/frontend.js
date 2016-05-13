$(document).ready(function () {
    $('a').click(function (e) {
        e.preventDefault();
        var element = $(this);
        getAction(element);
    });
});

function dataParse(response) {

    var test = response['ajax']['DataLeague_0'];
    test = JSON.parse(test);
    $('#test').html('');
    for (var i in test) {
        var value = test[i.toString()];
        $('#test').append('<li class="list-group-item-text">' + value + '</li>');
    }
}

function getAction(element) {

    var url = element.attr('href');
    $.ajax({

        url: url,
        type: "POST",
        data: "format=json",
        async: false,
        success: function(response){
            dataParse(response);
        }
    });
    return false;
}

