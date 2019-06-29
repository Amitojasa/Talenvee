<h4>Example getting duration of audio/video file before upload</h4>
<p>Select an audio /video file</p>

<form action='#' method='post' enctype='multipart/form-data'>
 File: <input type='file' name='fup' id='fup' /><br>
 Duration: <input type='text' name='f_du' id='f_du' size='5' /> seconds<br>
 <input type='submit' value='Upload' />
</form>
<audio id='audio'></audio>

<script>

var f_duration =0; //store duration
document.getElementById('audio').addEventListener('canplaythrough', function(e){
 f_duration = Math.round(e.currentTarget.duration);
 document.getElementById('f_du').value = f_duration;
 URL.revokeObjectURL(obUrl);
});

//when select a file, create an ObjectURL with the file and add it in the #audio element
var obUrl;
document.getElementById('fup').addEventListener('change', function(e){
 var file = e.currentTarget.files[0];
 //check file extension for audio/video type
 if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
 obUrl = URL.createObjectURL(file);
 document.getElementById('audio').setAttribute('src', obUrl);
 }
});
</script>