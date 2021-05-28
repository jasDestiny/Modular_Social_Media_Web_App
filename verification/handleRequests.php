<?php
$(document).on('submit','#popupForm', function(e){
e.preventDefault();
var formData = new FormData($(this)[0]);
formData.append('file', $('#file')[0].files[0]);
$.ajax({
url: "http://localhost/twitter/core/ajax/addTweet.php",
type: "POST",
data: formData,
success: function(data){
result = JSON.parse(data);
if(result['error']){
$('<div class="error-banner"><div class="error-banner-inner"><p
id="errorMsg">'+result.error+'</p></div></div>').insertBefore('.header-wrapper');
$('.errorbanner').
hide().slideDown(300).delay(5000).slideUp(300);
$('.popup-tweet-wrap').hide();
}else if (result['success']){
$('<div class="error-banner"><div class="error-banner-inner"><p
id="errorMsg">'+result.success+'</p></div></div>').insertBefore('.header-wrapper');
$('.errorbanner').
hide().slideDown(300).delay(5000).slideUp(300);
$('.popup-tweet-wrap').hide();
}
},
});
});
});
cache: false,
contentType: false,
processData: false
?>