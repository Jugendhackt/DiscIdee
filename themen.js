function load_arguments() {
    $.ajax({
        url: "handler.php?action=getForTopic&par1=2",
        success: function (result) {
            var topic = $('.topic');
            topic.text(result['name']);
            var themenfrage = $('.themenfrage');
            themenfrage.text(result['question']);
            var erklaerung = $('.erklaerung');
            erklaerung.text(result['description']);
            var proarg = $('#contentpro');
            proarg.text('');
            var conarg = $('#contentcon');
            conarg.text('');
            for (i = 0; i < result['Argument'].length; i++) {
                var arg1 = $('<div>');
                var isPro=result['Argument'][i]['isPro'];
               if (isPro==1){
                proarg.append(arg1);
               }
               else {
                conarg.append(arg1);   
               }
                var argumentname = $('<h1>');
                argumentname.text(result['Argument'][i]['text']);
                arg1.append(argumentname);
                var Argument = result['Argument'][i];
                var reason = $('<div>');
                arg1.append(reason);
                for (x = 0; x < Argument['reason'].length; x++) {
                    var reason1 = $('<p>');
                    reason1.text(Argument['reason'][x]['text']);
                    reason.append(reason1);
                }
            }
        },
        error: function () {
            alert('Ups');
        },

    });
}