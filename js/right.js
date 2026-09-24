$(document).bind("contextmenu",function(e){
  return false;
    });
$(document).ready(function(){
  $("img").attr('draggable',false);
   if (document.querySelector('.content') !== null) {
    var target = document.querySelector('.content')

// Create an observer instance.
var observer = new MutationObserver(function(mutations) {
    $("img").attr('draggable',false);
	
	
});

// Pass in the target node, as well as the observer options.
observer.observe(target, {
    attributes:    true,
    childList:     true,
    characterData: true
});
  }
});