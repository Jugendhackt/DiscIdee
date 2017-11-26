$(document).ready(function(){
    $("#addbutton").click(function(){
        $(".erscheinen").show();
        console.log("called")
    });
    $("#sendbutton").click(function(){
        alert("Vielen Dank für deine Idee!")
        $.ajax({
            url:"handler.php?action=addTopic",
            data:{par1:$("#addtitle").val(),
                par2:$("#addtext").val()},
            success:function(){
                load_topics();
            }
        })
    })
})

