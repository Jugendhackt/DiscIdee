$(document).ready(function(){
    $("#addbutton").click(function(){
        $(".erscheinen").show();
        console.log("called")
    });
    $("#sendbutton").click(function(){
        alert("Vielen Dank für deine Idee!")
        $.ajax({
            url:"handler.php?action=addTopic&par1=testtitel&par2=testbeschreibung"
        })
    })
})

