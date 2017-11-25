function load_arguments(){
    $.ajax({
        url: "handler.php?action=getForTopic&par1=1",
        success: function(result){
            var topic=$('.topic');
            topic.text(result['name']);
            var themenfrage = $('.themenfrage');
            themenfrage.text(result['question']);
            var erklaerung=$('.erklaerung');
            erklaerung.text(result['description']);
            var proarg=$('.proarg');
            proarg.text('');
            var conarg=$('.conarg');
            conarg.text('');
        for(i=0; i<result['Argument'].length; i++){
            var proarg1=$('<div>');
            proarg.append(proarg1);
            var argumentname=$('<h1>');
            argumentname.text(result['Argument'][i]['text']);
            proarg1.append(argumentname);

        }
        },
        error: function () {
            alert('Ups');
        },

    });
}