var slideitem = 0;
window.onload = function() {
   setInterval(passarSlide, 2000);
   
   var slidewidth = document.getElementById("slideshow").offsetWidth;
   var objs = document.getElementsByClassName("slide");
   for(var i in objs) {
      objs[i].style.width = slidewidth;
   }
}
function passarSlide(){
   var slidewidth = document.getElementById("slideshow").offsetWidth;
   if(slideitem >= 3){
      slideitem = 0;
   } else {
        slideitem++;
   }
   document.getElementsByClassName("slideshowarea")[0].style.marginLeft = "-" + (slidewidth * slideitem + "px");
}   


function mudarSlide(pos){
   slideitem = pos;
   var slidewidth = document.getElementById("slideshow").offsetWidth;
   document.getElementsByClassName("slideshowarea")[0].style.marginLeft = "-" + (slidewidth * slideitem + "px");
}