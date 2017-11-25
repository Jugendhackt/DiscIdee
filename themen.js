function load_arguments(){
    $.ajax({
        url: "handler.php?action=getForTopic&par1=1",
        success: function(result){
            var topic=$('.topic');
            topic.text(result['name']+ 'Hello');
            var themenfrage = $('.themenfrage');
            themenfrage.text(result['question']+'Hello');
            var erklaerung=$('.erklaerung');
            erklaerung.text(result['description']+ 'Hello')
            var proarg=$('.proarg');
            proarg.text('');
            var conarg=$('.conarg');
            conarg.text('');
        for(i=0; i<result['Argument'].length; i++){
            var proarg1=$('<div>');
            proarg1.text(result[i]['text']);
            proarg.append(proarg1);
        }
        },
        error: function () {
            alert('Ups');
        },

    });
}