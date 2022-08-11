<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('js/owl.carousel.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

<script>$(".custom-file-input").on("change",function(){var fileName=$(this).val().split("\\").pop();$(this).siblings(".custom-file-label").addClass("selected").html(fileName);});</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script> 
<script type="text/javascript">$("#file-1").fileinput({theme:'fa',uploadUrl:"/imageUpload.php",allowedFileExtensions:['jpg','png','gif'],overwriteInitial:false,maxFileSize:2000,maxFilesNum:10,slugCallback:function(filename){return filename.replace('(','_').replace(']','_');}});var video=document.querySelector("#videoElement");if(navigator.mediaDevices.getUserMedia){navigator.mediaDevices.getUserMedia({video:true}).then(function(stream){video.srcObject=stream;}).catch(function(err0r){console.log("Something went wrong!");});}</script>    
    
<script>$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});</script>
</body>

</html>