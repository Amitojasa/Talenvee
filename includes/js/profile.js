
function followUser(id){
        $.ajax({
            url:"profile/followUser.php?id="+id, //the page containing php script
            type: "POST", //request type
            success:function(result){
                
                if(result.trim()=='login'){
                    alert("Please login!!");
                }else if(result.trim()=="follow"){
                    document.getElementById("follow-btn").innerHTML="UnFollow";
                    document.getElementById("follow-btn").className="btn btn-outline-secondary";
                }else if(result.trim()=="unfollow"){
                    document.getElementById("follow-btn").innerHTML="Follow";
                    document.getElementById("follow-btn").className="btn btn-primary";
                }
            }
        });
}

function editPhoto(){
    window.location = "profile/edit";
}

function descChange(){
    document.getElementById('desc-form').style.display='block';
}
function usernameChange(){
    document.getElementById('username-form').style.display='block';
}
function interestEdit(){
    document.getElementById('interest-form').style.display='block';
    var myCollection=document.getElementsByClassName('closer');
    var i;
    for (i = 0; i < myCollection.length; i++) {
    myCollection[i].style.display = "block";
    }

}

function addTag(){

    tagValue=document.getElementById('input-tag').value;
    if(tagValue!=""){
        $.ajax({
            url:"profile/addInterestTag.php?tag="+tagValue, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                if(result.trim()=='login'){
                    alert("Please login!!");
                }else if(result.trim()=='max'){
                    alert("You can add max 20 tags !!");
                }else if(result.trim()=="already exists"){
                    alert("already exists");
                }else if(result.trim()=="added"){
                    $('#interests').load('profileSetup.php #intertagcard');
                }
            }
        });
    }
}
function removeTag(tag){

    tagValue=tag;
    if(tagValue!=""){
        $.ajax({
            url:"profile/removeInterestTag.php?tag="+tagValue, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                if(result.trim()=='login'){
                    alert("Please login!!");
                }else if(result.trim()=="Sorry"){
                    alert("Sorry");
                }else if(result.trim()=="removed"){
                    $('#interests').load('profileSetup.php #intertagcard');

                }
            }
        });
    }
}
function validateUser(val)
{
    var regex = /^[a-zA-Z_0-9]+$/;
    if (regex.test(val)) {
        return true;
    }
    else {
        return false;
    }
}
function checkUser (){
    uname=document.getElementById('username').value;
    if(validateUser(uname)){
        $.ajax({
            url:"validations/checkUser.php?uname="+uname, //the page containing php script
            type: "POST", //request type
            success:function(result){
                document.getElementById('resultUname').innerHTML=result;
                if(result=="<span class='text-danger'>User already Exists.</span>"){
                    document.getElementById('sub-userName').setAttribute("disabled", "");
                }else{
                    document.getElementById('sub-userName').removeAttribute("disabled", "");
                }
           }
         });
    }else{
            document.getElementById('resultUname').innerHTML="<span class='text-danger'>You cal only use alphabets, numbers and _ </span>";
          }
    }

function clearDisplay(a){
    document.getElementById(a).style.display="none";
}
function clearDisplayInter(a){
    document.getElementById(a).style.display="none";
    var myCollection=document.getElementsByClassName('closer');
    var i;
    for (i = 0; i < myCollection.length; i++) {
    myCollection[i].style.display = "none";
    }
}
function likeIt(id){
        $.ajax({
            url:"profile/like.php?id="+id, //the page containing php script
            type: "POST", //request type
            success:function(result){
                if(result.trim()=="liked"){
                    document.getElementById('like'+id).className="fas fa-thumbs-up";
                    document.getElementById('count-likes'+id).innerHTML=parseInt(document.getElementById('count-likes'+id).innerHTML)+1;
                }else if(result.trim()=="login"){
                    alert("Please Login");
                }
                else{
                    document.getElementById('like'+id).className="far fa-thumbs-up";
                    document.getElementById('count-likes'+id).innerHTML=parseInt(document.getElementById('count-likes'+id).innerHTML)-1;
                }
           }
         });
}
function likeItSec(id){
        $.ajax({
            url:"profile/like.php?id="+id, //the page containing php script
            type: "POST", //request type
            success:function(result){
                if(result.trim()=="liked"){
                    document.getElementById('likeSec'+id).className="fas fa-thumbs-up";
                    document.getElementById('count-likesSec'+id).innerHTML=parseInt(document.getElementById('count-likesSec'+id).innerHTML)+1;
                }else if(result.trim()=="login"){
                    alert("Please Login");
                }else{
                    document.getElementById('likeSec'+id).className="far fa-thumbs-up";
                    document.getElementById('count-likesSec'+id).innerHTML=parseInt(document.getElementById('count-likesSec'+id).innerHTML)-1;
                }
           }
         });
}
function likeItThird(id){
        $.ajax({
            url:"profile/like.php?id="+id, //the page containing php script
            type: "POST", //request type
            success:function(result){
                if(result.trim()=="liked"){
                    document.getElementById('likeThird'+id).className="fas fa-thumbs-up";
                    document.getElementById('count-likesThird'+id).innerHTML=parseInt(document.getElementById('count-likesThird'+id).innerHTML)+1;
                }else if(result.trim()=="login"){
                    alert("Please Login");
                }else{
                    document.getElementById('likeThird'+id).className="far fa-thumbs-up";
                    document.getElementById('count-likesThird'+id).innerHTML=parseInt(document.getElementById('count-likesThird'+id).innerHTML)-1;
                }
           }
         });
}
function commentSub(id){
    // tagValue=document.getElementById('commentVal'+id).value;
    // if(tagValue!=""){
    //     $.ajax({
    //         url:"profile/addComment.php?comment="+tagValue+"&pid="+id, //the page containing php script
    //         type: "POST", //request type
            
    //         success:function(result){
    //             //alert(window.location.href);
    //             $('#comments'+id).load(window.location.href+' #commenting'+id);
    //         }
    //     });
    // }
    $('textarea#commentVal'+id).mentionsInput('val', function(text) {
        // var post_text = document.getElementById('mention').value;
        var post_text=text;
        console.log(post_text);
        if(post_text != '')
        {
        var post_data = "text="+encodeURIComponent(post_text);
        $.ajax({
        type: "POST",
        data: post_data,
        url: 'newTest/post.php?pid='+id,
        success: function(msg) {
        if(msg== 1)
        {
        alert('Please Login');
        } else {
            $("#post_updates").prepend(msg);
            //reset the textarea after successful update
            
            $("textarea#commentVal"+id).mentionsInput('reset');
            $('#comments'+id).load(window.location.href+' #commenting'+id);
        }
        }
        });
        } else {
        alert("Post cannot be empty!");
        }
        });
}
function removeComment(id,pid){
        $.ajax({
            url:"profile/removeComment.php?cid="+id, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                //location.reload();

                $('#comments'+pid).load(window.location.href+' #commenting'+pid);
            }
        });
}
function commentSubSec(id){
    // tagValue=document.getElementById('commentValSec'+id).value;
    // if(tagValue!=""){
    //     $.ajax({
    //         url:"profile/addComment.php?comment="+tagValue+"&pid="+id, //the page containing php script
    //         type: "POST", //request type
            
    //         success:function(result){
    //             //alert(window.location.href);
    //             $('#commentsSec'+id).load(window.location.href+' #commentingSec'+id);
    //         }
    //     });
    // }
    $('textarea#commentValSec'+id).mentionsInput('val', function(text) {
        // var post_text = document.getElementById('mention').value;
        var post_text=text;
        console.log(post_text);
        if(post_text != '')
        {
        var post_data = "text="+encodeURIComponent(post_text);
        $.ajax({
        type: "POST",
        data: post_data,
        url: 'newTest/post.php?pid='+id,
        success: function(msg) {
        if(msg== 1)
        {
        alert('Please Login');
        } else {
            $("#post_updates").prepend(msg);
            //reset the textarea after successful update
            
            $("textarea#commentValSec"+id).mentionsInput('reset');
            $('#commentsSec'+id).load(window.location.href+' #commentingSec'+id);
        }
        }
        });
        } else {
        alert("Post cannot be empty!");
        }
        });
}
function removeCommentSec(id,pid){
        $.ajax({
            url:"profile/removeComment.php?cid="+id, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                //location.reload();

                $('#commentsSec'+pid).load(window.location.href+' #commentingSec'+pid);
            }
        });
}
function commentSubThird(id){
    // tagValue=document.getElementById('commentValThird'+id).value;
    // if(tagValue!=""){
    //     $.ajax({
    //         url:"profile/addComment.php?comment="+tagValue+"&pid="+id, //the page containing php script
    //         type: "POST", //request type
            
    //         success:function(result){
    //             //alert(window.location.href);
    //             $('#commentsThird'+id).load(window.location.href+' #commentingThird'+id);
    //         }
    //     });
    // }
    $('textarea#commentValThird'+id).mentionsInput('val', function(text) {
        // var post_text = document.getElementById('mention').value;
        var post_text=text;
        console.log(post_text);
        if(post_text != '')
        {
        var post_data = "text="+encodeURIComponent(post_text);
        $.ajax({
        type: "POST",
        data: post_data,
        url: 'newTest/post.php?pid='+id,
        success: function(msg) {
        if(msg== 1)
        {
        alert('Please Login');
        } else {
            $("#post_updates").prepend(msg);
            //reset the textarea after successful update
            
            $("textarea#commentValThird"+id).mentionsInput('reset');
            $('#commentsThird'+id).load(window.location.href+' #commentingThird'+id);
        }
        }
        });
        } else {
        alert("Post cannot be empty!");
        }
        });
}
function removeCommentThird(id,pid){
        $.ajax({
            url:"profile/removeComment.php?cid="+id, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                //location.reload();

                $('#commentsThird'+pid).load(window.location.href+' #commentingThird'+pid);
            }
        });
}
function deletePost(id){
        $.ajax({
            url:"profile/delPost.php?id="+id, //the page containing php script
            type: "POST", //request type
            
            success:function(result){
                location.reload();
                // alert(result);

                // $('#showArea').load(window.location.href+' #areaMain');
            }
        });
}
$(document).ready(function(){
    $('.copy-btn').on("click", function(){
        value = $(this).data('clipboard-text'); //Upto this I am getting value
 
        var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(value).select();
          document.execCommand("copy");
          $temp.remove();
          alert("Link has been copied!!");
    })
});
// function searchUser2 (search_str){

//     $.ajax({
//         url:"search_user.php?search_str="+search_str, //the page containing php script
//         type: "POST", //request type
//         success:function(result){
//             document.getElementById('search_result2').innerHTML=result;
//         }
//     });
// }

// $('#inputor').atwho({
//     at: "@",
//     data:['Peter', 'Tom', 'Anne']
// });

// function checkMention(elem){
//     $(elem).mentionsInput({
//         onDataRequest:function (mode, query, callback) {
//         alert("hello");
//         $.getJSON('../newTest/get_users_json.php', function(responseData) {
//             responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
//         callback.call(this, responseData);
//         });
//         }
//         });
        
// }



