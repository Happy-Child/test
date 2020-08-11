jQuery(document).ready(function( $ ) {


  var width = $( window ).width();
  console.log(width);

  // $('body').css('zoom', 1 );

  if ( width >= 1025 && width < 1920 ) {
    var prop = width / 1920;

      console.log(prop);

    $('body').css('zoom', prop );
  } else {
    $('body').css('zoom', 1 );
  }

  window.onresize = function(event) {
    var width = $( window ).width();

    if ( width >= 1025 && width < 1920 ) {
      var prop = width / 1920;

      console.log(prop);

      $('body').css('zoom', prop );
    } else {
      $('body').css('zoom', 1 );
    }
  };



});