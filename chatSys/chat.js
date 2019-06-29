// function isUrl(s) {
//     var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
//     return regexp.test(s);
//  }
$('#msg').keyup(function(e){
   // console.log(e.which);
    if(e.which==13){
        
        $('#chatForm').submit();


    }
});

$('form').submit(function(){
    var msg=$('#msg').val();
    // if(isUrl(msg)){
    //     msg="<a href='"+msg+"'>"+msg+"</a>";
    // }
    // msg=btoa(msg);
    $.post("chatSys/messages.php?message="+msg, function(result){
        if(result==1){
            loadChat();
            $('#chatForm')[0].reset();
        }
    });
    return false;
});

loadChat();
function loadChat(){
    $.post('chatSys/getMessages1.php',function(response){
        var scrollPos= $('#chat-msgs').scrollTop();
        var scrollPos=parseInt(scrollPos)+(document.documentElement.clientHeight * 0.80);
        var scrollHeight = $('#chat-msgs').prop('scrollHeight');

        $('#chat-msgs').html(response);

        if(scrollPos<scrollHeight){

        }else{
            $('#chat-msgs').scrollTop($('#chat-msgs').prop('scrollHeight'));
        }
    });
}

setInterval(function(){
    loadChat();
},1000);