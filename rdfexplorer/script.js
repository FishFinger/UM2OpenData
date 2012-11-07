var zoom = 100;
$(document).ready(function() {
  $(document).keypress(function(event){
// + = 43
// - = 45
    if(event.which == 43){
      zoom+=10;
    }
    else if(event.which == 45){
      zoom-=10;
    }
    $("#graph").css("height",zoom+"em");
  });
});
