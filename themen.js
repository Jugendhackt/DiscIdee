var timer = null;
var focused = null;
var text = null;
function start_load_arguments(){
    load_arguments();
    
   /* $(window).scroll(function() {
    
    if(focused != null){
        
        var id = "#"+focused;
        var hT = $(id).offset().top,
        hH = $(id).outerHeight(),
        wH = $(window).height(),
        wS = $(this).scrollTop();
        if ((wS > (hT+hH-wH))){
            
            console.log("drueber");
        }
        if (!(wS > (hT+hH-wH))){
            alert('H1 on the view!');
        }
    }
});*/

   $(window).on('scroll', function() {
        if(focused != null){
            //var element_position = $("#"+focused).offset().top;
            var element_position = $("#"+focused).position().top;
            var y_scroll_pos = window.pageYOffset;
            var scroll_pos_test = element_position;
            if((y_scroll_pos > scroll_pos_test)||(y_scroll_pos < (scroll_pos_test-window.innerHeight))) {
                focused = null;
            }
        }
});
    
    timer = setInterval(reloadTimer, 1000);
}

function load_arguments() {
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return decodeURI(results[1]) || 0;
        }
    }
    $.ajax({
        url: "handler.php?action=getForTopic&par1="+$.urlParam('id'),
        dataType: "json",
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
                var isPro = result['Argument'][i]['isPro'];
                if (isPro == 1) {
                    proarg.append(arg1);
                } else {
                    conarg.append(arg1);
                }
                var argumentname = $('<h1>');
                argumentname.text(result['Argument'][i]['text']);
                
                var input = $('<input type="text" placeholder="Begründung" id="reason'+result['Argument'][i]['ID']+'">');
                
                input.click(function(){
                    var id = $(this).attr('id');
                    startTyping(id);
                });
                input.bind('input', function(){
                    //alert(result['Argument'][i]['ID']);
                    var id = $(this).attr('id');
                    startTyping(id);
                });

                
                var button = $('<button type="submit" onclick="addReason('+result['Argument'][i]['ID']+')">');
                button.text("Hinzufügen")
                
                arg1.append(argumentname);
                var Argument = result['Argument'][i];
                var reason = $('<div>');
                arg1.append(reason);
                for (x = 0; x < Argument['reason'].length; x++) {
                    var reason1 = $('<p>');
                    reason1.text(Argument['reason'][x]['text']);
                    reason.append(reason1);
                }
                arg1.append(input);
                arg1.append(button);
            }
            

            if(focused != null){
                $('#'+focused).focus();
                $('#'+focused).val(text);
             
            }
        
            
        },
        error: function () {
            alert('Ups');
        },

    });
}




function add_pro_argument() {

    $.ajax({
        url: "handler.php?action=addArgument",
        data: {
            par1: $("#neuesPro").val(),
            par2: $.urlParam('id'),
            par3: 1,
        },
        success: function (result) {
            load_arguments();
        }
    });


}

function add_con_argument() {
     $.ajax({
        url: "handler.php?action=addArgument",
        data: {
            par1: $("#neuesCon").val(),
            par2: $.urlParam('id'),
            par3: 0,
        },
        success: function (result) {
            load_arguments();
        }
    });

}
function reloadTimer(){

    load_arguments();

    
}
function startTyping(inputID){

    focused = inputID;
    text = $("#"+inputID).val();

}



function addReason(argumentID){
    console.log($("#reason" + argumentID).val());
      $.ajax({
        url: "handler.php?action=addReason",
        data: {
            par1: $("#reason" + argumentID).val(),
            par2: argumentID,
        },
        success: function (result) {
            load_arguments();
            console.log("reload");
            
        }
    });
    $("#reason" + argumentID).val(" ");
    focused = null;

}

