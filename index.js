function load_topics() {
    $.ajax({
        url: "handler.php?action=topic",
        success: function (result) {
            var Inhalt = $('#Inhalt');
            Inhalt.text('');
            for (i = 0; i < result.length; i++) {
                var Themen = $('<div>');
                Themen.addClass('Themen');
                Inhalt.append(Themen);
                var topic = $('<h1>');
                var link = $('<a>');
                link.attr("href", "themen.html");
                topic.addClass('topic');
                topic.text(result[i]['name']);
                link.append(topic);
                Themen.append(link);
                var themenfrage = $('<p>');
                themenfrage.addClass('themenfrage');
                themenfrage.text(result[i]['question']);
                Themen.append(themenfrage);
            }
        },
        error: function () {
            alert('Ups');
        },
    });
}