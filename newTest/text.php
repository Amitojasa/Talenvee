<script src="https://cdn.rawgit.com/jashkenas/underscore/1.8.3/underscore-min.js" type="text/javascript"></script>

<form method="POST">
<textarea class="mention" id="mention" cols="10" rows="3" placeholder="What's going on?" ></textarea>
<input type="button" value="Post" class="postMention">
</form>

<script>
$('textarea.mention').mentionsInput({
onDataRequest:function (mode, query, callback) {

$.getJSON('get_users_json.php', function(responseData) {
    responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
callback.call(this, responseData);
});
}
});

$('.postMention').click(function() {
$('textarea#mention').mentionsInput('val', function(text) {
// var post_text = document.getElementById('mention').value;
var post_text=text;
console.log(post_text);
if(post_text != '')
{
var post_data = "text="+encodeURIComponent(post_text);
$.ajax({
type: "POST",
data: post_data,
url: 'post.php',
success: function(msg) {
if(msg== 1)
{
alert('Something Went Wrong!');
} else {
$("#post_updates").prepend(msg);
//reset the textarea after successful update
$("textarea.mention").mentionsInput('reset');
}
}
});
} else {
alert("Post cannot be empty!");
}
});
});
</script>
