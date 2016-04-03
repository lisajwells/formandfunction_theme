jQuery(function( $ ){

  // Add opacity class to site header
  if( $( document ).scrollTop() > 0 ){
    $( '.site-header' ).addClass( 'shrink' );
    $( '.nav-secondary' ).addClass( 'shrink' );
    $( '.nav-tertiary' ).addClass( 'shrink' );
    $( '#mobile-menu-button' ).addClass( 'shrink' );
    $( '#mobile-inventory-menu-button' ).addClass( 'shrink' );
  }

  $( document ).on('scroll', function(){

    if ( $( document ).scrollTop() > 0 ){
      $( '.site-header' ).addClass( 'shrink' );
      $( '.nav-secondary' ).addClass( 'shrink' );
      $( '.nav-tertiary' ).addClass( 'shrink' );
      $( '#mobile-menu-button' ).addClass( 'shrink' );
      $( '#mobile-inventory-menu-button' ).addClass( 'shrink' );

    } else {
      $( '.site-header' ).removeClass( 'shrink' );
      $( '.nav-secondary' ).removeClass( 'shrink' );
      $( '.nav-tertiary' ).removeClass( 'shrink' );
      $( '#mobile-menu-button' ).removeClass( 'shrink' );
      $( '#mobile-inventory-menu-button' ).removeClass( 'shrink' );
    }

  });

  $( "#mobile-menu-button" ).click(function() {
    $( "nav.nav-secondary" ).toggle();
  });
  $( "div#mobile-inventory-menu-button" ).click(function() {
    $( "nav.nav-tertiary" ).toggle();
  });


  $( '.nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, .nav-tertiary .genesis-nav-menu'  ).addClass( 'responsive-menu' ).before( '<div class="responsive-menu-icon"></div>' );

  $( '.responsive-menu-icon' ).click(function(){
    $(this).next( '.nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, .nav-tertiary .genesis-nav-menu' ).slideToggle();
  });

  $( window ).resize(function(){
    if ( window.innerWidth > 980 ) {
    // if ( window.innerWidth > 800 ) {
      $( '.nav-primary .genesis-nav-menu,  .nav-secondary .genesis-nav-menu, .nav-tertiary .genesis-nav-menu, nav .sub-menu' ).removeAttr( 'style' );
      $( '.responsive-menu > .menu-item' ).removeClass( 'menu-open' );
    }
  });

  $( '.responsive-menu > .menu-item' ).click(function(event){
    if ( event.target !== this )
    return;
      $(this).find( '.sub-menu:first' ).slideToggle(function() {
      $(this).parent().toggleClass( 'menu-open' );
    });
  });

  // disappear #schedule-consult when scroll 450px from bottom
  // based on http://stackoverflow.com/questions/12797224/getting-the-scrollbottom-using-jquery
  $(window).scroll(function() {

    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 450) {
        $('#schedule-consult-button').addClass("sched-button-low");
        // setTimeout(function() {
        //   $('#schedule-consult-button').addClass("sched-button-none");
        // }, 3000);
    } else {
        // $('#schedule-consult-button').removeClass("sched-button-none");
        $('#schedule-consult-button').removeClass("sched-button-low");
    }
  });




});
