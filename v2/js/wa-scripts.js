console.log("Variables");
/**
 * Funciones
 */
$(function() {
  "use strict";
  console.log("Website " + base_url);

/**
 * Menú hover
 */
 $(".dropdown").hover(            
  function() {
    $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
    $(this).toggleClass('open');
    $('b', this).toggleClass("caret caret-up");                
  },
  function() {
    $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
    $(this).toggleClass('open');
    $('b', this).toggleClass("caret caret-up");                
  });

/**
 * Lightslider
 */
$('#salones-slider').lightSlider({
        item:9,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        pager:false,
        responsive : [
            {
                breakpoint:1300,
                settings: {
                    item:8,
                    slideMove:2,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:1120,
                settings: {
                    item:7,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:970,
                settings: {
                    item:6,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:800,
                settings: {
                    item:5,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:700,
                settings: {
                    item:4,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:3,
                    slideMove:1
                  }
            },
            {
                breakpoint:280,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ]
    });

/**
 * Validar Formulario #form-contactanos
 */
//Validar formulario
$('#form-contactanos').formValidation({
  framework: 'bootstrap',
  message: 'Valor no válido.',
        /*icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
          fields: {
            nombre: {
              row: '.form-group',
              validators: {
                notEmpty: {
                  message: 'Ingrese Nombres y Apellidos.'
                }
              }
            },
            email: {
              row: '.form-group',
              validators: {
                notEmpty: {
                  message: 'Ingrese su correo.'
                },
                emailAddress: {
                  message: 'Ingrese un correo válido.'
                }
              }
            },
            telefono: {
              row: '.form-group',
              validators: {
                notEmpty: {
                  message: 'Ingrese un teléfono.'
                }
              }
            }
          }
        });

/**
 * Galería
 */
if ( $( "#lightgallery" ).length ) {
  $( '.btn-galeria a' ).on( 'click', function ( event ) {
    $('#lightgallery a').first().trigger("click");
  });

  $('#lightgallery').lightGallery({
    download:false
  });
}

/*$( '.btn-galeria a' ).on( 'click', function ( event ) {
  $('#lightgallery a').first().trigger("click");
});

$('#lightgallery').lightGallery({
  download:false
});*/

/**
 * Menu Responsive
 */

// Initialize Slidebars
var controller = new slidebars();
controller.init();

// Toggle main menu
$( '.js-toggle-main-menu' ).on( 'click', function ( event ) {
  event.preventDefault();
  event.stopPropagation();
  controller.toggle( 'main-menu' );
} );

// Close any
$( document ).on( 'click', '.js-close-any', function ( event ) {
  if ( controller.getActiveSlidebar() ) {
    event.preventDefault();
    event.stopPropagation();
    controller.close();
  }
} );

// Close Slidebar links
$( '[off-canvas] a' ).on( 'click', function ( event ) {
  event.preventDefault();
  event.stopPropagation();

  var url = $( this ).attr( 'href' ),
  target = $( this ).attr( 'target' ) ? $( this ).attr( 'target' ) : '_self';

  controller.close( function () {
    window.open( url, target );
  } );
} );

// Add close class to canvas container when Slidebar is opened
$( controller.events ).on( 'opening', function ( event ) {
  $( '[canvas]' ).addClass( 'js-close-any' );
} );

// Add close class to canvas container when Slidebar is opened
$( controller.events ).on( 'closing', function ( event ) {
  $( '[canvas]' ).removeClass( 'js-close-any' );
} );
//--Menu responsive

});