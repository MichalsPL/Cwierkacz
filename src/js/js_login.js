$(document).ready(function(){

$('.message a').one('click', function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

})