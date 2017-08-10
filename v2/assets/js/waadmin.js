var left_side_width = 220; //Sidebar width in pixels
/*
 * SIDEBAR MENU
 * ------------
 * This is a custom plugin for the sidebar menu. It provides a tree view.
 * 
 * Usage:
 * $(".sidebar).tree();
 * 
 * Note: This plugin does not accept any options. Instead, it only requires a class
 *       added to the element that contains a sub-menu.
 *       
 * When used with the sidebar, for example, it would look something like this:
 * <ul class='sidebar-menu'>
 *      <li class="treeview active">
 *          <a href="#>Menu</a>
 *          <ul class='treeview-menu'>
 *              <li class='active'><a href=#>Level 1</a></li>
 *          </ul>
 *      </li>
 * </ul>
 * 
 * Add .active class to <li> elements if you want the menu to be open automatically
 * on page load. See above for an example.
 */
 $(function() {
  "use strict";

$.fn.tree = function() {

  return this.each(function() {
    var btn = $(this).children("a").first();
    var menu = $(this).children(".treeview-menu").first();
    var isActive = $(this).hasClass('active');

            //initialize already active menus
            if (isActive) {
              menu.show();
              btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
            }
            //Slide open or close the menu on link click
            btn.click(function(e) {
              e.preventDefault();
              if (isActive) {
                    //Slide up to close menu
                    menu.slideUp();
                    isActive = false;
                    btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
                    btn.parent("li").removeClass("active");
                  } else {
                    //Slide down to open menu
                    menu.slideDown();
                    isActive = true;
                    btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
                    btn.parent("li").addClass("active");
                  }
                });

            /* Add margins to submenu elements to give it a tree look */
            menu.find("li > a").each(function() {
              var pad = parseInt($(this).css("margin-left")) + 10;

              $(this).css({"margin-left": pad + "px"});
            });

          });

};

/*
 * TODO LIST CUSTOM PLUGIN
 * -----------------------
 * This plugin depends on iCheck plugin for checkbox and radio inputs
 */
 $.fn.todolist = function(options) {
        // Render options
        var settings = $.extend({
            //When the user checks the input
            onCheck: function(ele) {
            },
            //When the user unchecks the input
            onUncheck: function(ele) {
            }
          }, options);

        return this.each(function() {
          $('input', this).on('ifChecked', function(event) {
            var ele = $(this).parents("li").first();
            ele.toggleClass("done");
            settings.onCheck.call(ele);
          });

          $('input', this).on('ifUnchecked', function(event) {
            var ele = $(this).parents("li").first();
            ele.toggleClass("done");
            settings.onUncheck.call(ele);
          });
        });
      };


    });

/* 
 * Make sure that the sidebar is streched full height
 * ---------------------------------------------
 * We are gonna assign a min-height value every time the
 * wrapper gets resized and upon page load. We will use
 * Ben Alman's method for detecting the resize event.
 * 
 **/
 function _fix() {
    //Get window height and the wrapper height
    var height = $(window).height() - $("body > .header").height();
    $(".wrapper").css("min-height", height + "px");
    var content = $(".wrapper").height();
    //If the wrapper height is greater than the window
    if (content > height)
        //then set sidebar height to the wrapper
      $(".left-side, html, body").css("min-height", content + "px");
      else {
        //Otherwise, set the sidebar to the height of the window
        $(".left-side, html, body").css("min-height", height + "px");
      }
    }

    function fix_sidebar() {
    //Make sure the body tag has the .fixed class
    if (!$("body").hasClass("fixed")) {
      return;
    }

    //Add slimscroll
    $(".sidebar").slimscroll({
      height: ($(window).height() - $(".header").height()) + "px",
      color: "rgba(0,0,0,0.2)"
    });
  }


/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.8
 *
 */
 (function($) {

  $.fn.extend({
    slimScroll: function(options) {

      var defaults = {

        // width in pixels of the visible scroll area
        width : 'auto',

        // height in pixels of the visible scroll area
        height : '250px',

        // width in pixels of the scrollbar and rail
        size : '7px',

        // scrollbar color, accepts any hex/color value
        color: '#000',

        // scrollbar position - left/right
        position : 'right',

        // distance in pixels between the side edge and the scrollbar
        distance : '1px',

        // default scroll position on load - top / bottom / $('selector')
        start : 'top',

        // sets scrollbar opacity
        opacity : 0.4,

        // enables always-on mode for the scrollbar
        alwaysVisible : false,

        // check if we should hide the scrollbar when user is hovering over
        disableFadeOut : false,

        // sets visibility of the rail
        railVisible : false,

        // sets rail color
        railColor : '#333',

        // sets rail opacity
        railOpacity : 0.2,

        // whether  we should use jQuery UI Draggable to enable bar dragging
        railDraggable : true,

        // defautlt CSS class of the slimscroll rail
        railClass : 'slimScrollRail',

        // defautlt CSS class of the slimscroll bar
        barClass : 'slimScrollBar',

        // defautlt CSS class of the slimscroll wrapper
        wrapperClass : 'slimScrollDiv',

        // check if mousewheel should scroll the window if we reach top/bottom
        allowPageScroll : false,

        // scroll amount applied to each mouse wheel step
        wheelStep : 20,

        // scroll amount applied when user is using gestures
        touchScrollStep : 200,

        // sets border radius
        borderRadius: '7px',

        // sets border radius of the rail
        railBorderRadius : '7px'
      };

      var o = $.extend(defaults, options);

      // do it for every element that matches selector
      this.each(function(){

        var isOverPanel, isOverBar, isDragg, queueHide, touchDif,
        barHeight, percentScroll, lastScroll,
        divS = '<div></div>',
        minBarHeight = 30,
        releaseScroll = false;

        // used in event handlers and for better minification
        var me = $(this);

        // ensure we are not binding it again
        if (me.parent().hasClass(o.wrapperClass))
        {
            // start from last bar position
            var offset = me.scrollTop();

            // find bar and rail
            bar = me.siblings('.' + o.barClass);
            rail = me.siblings('.' + o.railClass);

            getBarHeight();

            // check if we should scroll existing instance
            if ($.isPlainObject(options))
            {
              // Pass height: auto to an existing slimscroll object to force a resize after contents have changed
              if ( 'height' in options && options.height == 'auto' ) {
                me.parent().css('height', 'auto');
                me.css('height', 'auto');
                var height = me.parent().parent().height();
                me.parent().css('height', height);
                me.css('height', height);
              } else if ('height' in options) {
                var h = options.height;
                me.parent().css('height', h);
                me.css('height', h);
              }

              if ('scrollTo' in options)
              {
                // jump to a static point
                offset = parseInt(o.scrollTo);
              }
              else if ('scrollBy' in options)
              {
                // jump by value pixels
                offset += parseInt(o.scrollBy);
              }
              else if ('destroy' in options)
              {
                // remove slimscroll elements
                bar.remove();
                rail.remove();
                me.unwrap();
                return;
              }

              // scroll content by the given offset
              scrollContent(offset, false, true);
            }

            return;
          }
          else if ($.isPlainObject(options))
          {
            if ('destroy' in options)
            {
              return;
            }
          }

        // optionally set height to the parent's height
        o.height = (o.height == 'auto') ? me.parent().height() : o.height;

        // wrap content
        var wrapper = $(divS)
        .addClass(o.wrapperClass)
        .css({
          position: 'relative',
          overflow: 'hidden',
          width: o.width,
          height: o.height
        });

        // update style for the div
        me.css({
          overflow: 'hidden',
          width: o.width,
          height: o.height
        });

        // create scrollbar rail
        var rail = $(divS)
        .addClass(o.railClass)
        .css({
          width: o.size,
          height: '100%',
          position: 'absolute',
          top: 0,
          display: (o.alwaysVisible && o.railVisible) ? 'block' : 'none',
          'border-radius': o.railBorderRadius,
          background: o.railColor,
          opacity: o.railOpacity,
          zIndex: 90
        });

        // create scrollbar
        var bar = $(divS)
        .addClass(o.barClass)
        .css({
          background: o.color,
          width: o.size,
          position: 'absolute',
          top: 0,
          opacity: o.opacity,
          display: o.alwaysVisible ? 'block' : 'none',
          'border-radius' : o.borderRadius,
          BorderRadius: o.borderRadius,
          MozBorderRadius: o.borderRadius,
          WebkitBorderRadius: o.borderRadius,
          zIndex: 99
        });

        // set position
        var posCss = (o.position == 'right') ? { right: o.distance } : { left: o.distance };
        rail.css(posCss);
        bar.css(posCss);

        // wrap it
        me.wrap(wrapper);

        // append to parent div
        me.parent().append(bar);
        me.parent().append(rail);

        // make it draggable and no longer dependent on the jqueryUI
        if (o.railDraggable){
          bar.bind("mousedown", function(e) {
            var $doc = $(document);
            isDragg = true;
            t = parseFloat(bar.css('top'));
            pageY = e.pageY;

            $doc.bind("mousemove.slimscroll", function(e){
              currTop = t + e.pageY - pageY;
              bar.css('top', currTop);
              scrollContent(0, bar.position().top, false);// scroll content
            });

            $doc.bind("mouseup.slimscroll", function(e) {
              isDragg = false;hideBar();
              $doc.unbind('.slimscroll');
            });
            return false;
          }).bind("selectstart.slimscroll", function(e){
            e.stopPropagation();
            e.preventDefault();
            return false;
          });
        }

        // on rail over
        rail.hover(function(){
          showBar();
        }, function(){
          hideBar();
        });

        // on bar over
        bar.hover(function(){
          isOverBar = true;
        }, function(){
          isOverBar = false;
        });

        // show on parent mouseover
        me.hover(function(){
          isOverPanel = true;
          showBar();
          hideBar();
        }, function(){
          isOverPanel = false;
          hideBar();
        });

        // support for mobile
        me.bind('touchstart', function(e,b){
          if (e.originalEvent.touches.length)
          {
            // record where touch started
            touchDif = e.originalEvent.touches[0].pageY;
          }
        });

        me.bind('touchmove', function(e){
          // prevent scrolling the page if necessary
          if(!releaseScroll)
          {
            e.originalEvent.preventDefault();
          }
          if (e.originalEvent.touches.length)
          {
            // see how far user swiped
            var diff = (touchDif - e.originalEvent.touches[0].pageY) / o.touchScrollStep;
            // scroll content
            scrollContent(diff, true);
            touchDif = e.originalEvent.touches[0].pageY;
          }
        });

        // set up initial height
        getBarHeight();

        // check start position
        if (o.start === 'bottom')
        {
          // scroll content to bottom
          bar.css({ top: me.outerHeight() - bar.outerHeight() });
          scrollContent(0, true);
        }
        else if (o.start !== 'top')
        {
          // assume jQuery selector
          scrollContent($(o.start).position().top, null, true);

          // make sure bar stays hidden
          if (!o.alwaysVisible) { bar.hide(); }
        }

        // attach scroll events
        attachWheel(this);

        function _onWheel(e)
        {
          // use mouse wheel only when mouse is over
          if (!isOverPanel) { return;}

          /*var e = e || window.event;*/

          var delta = 0;
          if (e.wheelDelta) { delta = -e.wheelDelta/120; }
          if (e.detail) { delta = e.detail / 3; }

          var target = e.target || e.srcTarget || e.srcElement;
          if ($(target).closest('.' + o.wrapperClass).is(me.parent())) {
            // scroll content
            scrollContent(delta, true);
          }

          // stop window scroll
          if (e.preventDefault && !releaseScroll) { e.preventDefault(); }
          if (!releaseScroll) { e.returnValue = false; }
        }

        function scrollContent(y, isWheel, isJump)
        {
          releaseScroll = false;
          var delta = y;
          var maxTop = me.outerHeight() - bar.outerHeight();

          if (isWheel)
          {
            // move bar with mouse wheel
            delta = parseInt(bar.css('top')) + y * parseInt(o.wheelStep) / 100 * bar.outerHeight();

            // move bar, make sure it doesn't go out
            delta = Math.min(Math.max(delta, 0), maxTop);

            // if scrolling down, make sure a fractional change to the
            // scroll position isn't rounded away when the scrollbar's CSS is set
            // this flooring of delta would happened automatically when
            // bar.css is set below, but we floor here for clarity
            delta = (y > 0) ? Math.ceil(delta) : Math.floor(delta);

            // scroll the scrollbar
            bar.css({ top: delta + 'px' });
          }

          // calculate actual scroll amount
          percentScroll = parseInt(bar.css('top')) / (me.outerHeight() - bar.outerHeight());
          delta = percentScroll * (me[0].scrollHeight - me.outerHeight());

          if (isJump)
          {
            delta = y;
            var offsetTop = delta / me[0].scrollHeight * me.outerHeight();
            offsetTop = Math.min(Math.max(offsetTop, 0), maxTop);
            bar.css({ top: offsetTop + 'px' });
          }

          // scroll content
          me.scrollTop(delta);

          // fire scrolling event
          me.trigger('slimscrolling', ~~delta);

          // ensure bar is visible
          showBar();

          // trigger hide when scroll is stopped
          hideBar();
        }

        function attachWheel(target)
        {
          if (window.addEventListener)
          {
            target.addEventListener('DOMMouseScroll', _onWheel, false );
            target.addEventListener('mousewheel', _onWheel, false );
          }
          else
          {
            document.attachEvent("onmousewheel", _onWheel);
          }
        }

        function getBarHeight()
        {
          // calculate scrollbar height and make sure it is not too small
          barHeight = Math.max((me.outerHeight() / me[0].scrollHeight) * me.outerHeight(), minBarHeight);
          bar.css({ height: barHeight + 'px' });

          // hide scrollbar if content is not long enough
          var display = barHeight == me.outerHeight() ? 'none' : 'block';
          bar.css({ display: display });
        }

        function showBar()
        {
          // recalculate bar height
          getBarHeight();
          clearTimeout(queueHide);

          // when bar reached top or bottom
          if (percentScroll == ~~percentScroll)
          {
            //release wheel
            releaseScroll = o.allowPageScroll;

            // publish approporiate event
            if (lastScroll != percentScroll)
            {
              var msg = (~~percentScroll === 0) ? 'top' : 'bottom';
              me.trigger('slimscroll', msg);
            }
          }
          else
          {
            releaseScroll = false;
          }
          lastScroll = percentScroll;

          // show only when required
          if(barHeight >= me.outerHeight()) {
            //allow window scroll
            releaseScroll = true;
            return;
          }
          bar.stop(true,true).fadeIn('fast');
          if (o.railVisible) { rail.stop(true,true).fadeIn('fast'); }
        }

        function hideBar()
        {
          // only hide when options allow it
          if (!o.alwaysVisible)
          {
            queueHide = setTimeout(function(){
              if (!(o.disableFadeOut && isOverPanel) && !isOverBar && !isDragg)
              {
                bar.fadeOut('slow');
                rail.fadeOut('slow');
              }
            }, 1000);
          }
        }

      });

      // maintain chainability
      return this;
    }
  });

$.fn.extend({
  slimscroll: $.fn.slimScroll
});

})(jQuery);

function popupCenter(url, title, w, h) {
  // Fixes dual-screen position                         Most browsers      Firefox
  var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
  var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;

  var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
  var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

  var left = ((width / 2) - (w / 2)) + dualScreenLeft;
  var top = ((height / 2) - (h / 2)) + dualScreenTop;
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  // Puts focus on the newWindow
  if (window.focus) {
    newWindow.focus();
  }
}
$(function() {
    "use strict";
    console.log("Developer!");
    //Chosen select
    $(".chosen-select").chosen({
        no_results_text: "Oops, sin resultados!",
        width: "100%",
        search_contains: true
    });

    //Ciudades en orden
    var MY_SELECT = $('select[multiple].chosen-select').get(0);

    $(document).on("change", "#ciudades_select", function() {
        console.log("Conservar orden");
        var selection = ChosenOrder.getSelectionOrder(MY_SELECT);

        $('#ciudades_text').val('');
        var ciudades_text = '';
        $(selection).each(function(i) {
            /*$('#order-list').append("<li>" + selection[i] + "</li>");*/
            ciudades_text += selection[i] + ',';
        });
        $('#ciudades_text').val(ciudades_text.slice(0,-1));

        return false;
    });

    //Submit Eliminar 
    $(document).on("click", "#btn-eliminar", function() {
        if (confirm("Realemente desea aliminar")) {
            $("#index_form").submit();
        } else {
            return false;
        }
        return false;
    });

    //QUITAR ITEM TR
    $(document).on("click", ".btn-quitar-tr", function() {
        $(this).parents("tr.row-table-rm").hide().remove();
        return false;
    });

    //AGREGAR CARACTERISTICA DE UN PRODUCTO
    $(document).on("click", "#btn-agregar-caracteristica", function() {
        var html = '<tr class="row-table-rm"> <td><input type="text" name="caracteristicas[titulo][]" class="form-control input-sm" placeholder="Título"></td><td><input type="text" name="caracteristicas[descripcion][]" class="form-control input-sm" placeholder="Descripción"></td><td> <a href="#" class="btn btn-danger btn-xs btn-quitar-tr">Quitar <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a> </td></tr>';
        $("#items-caracteristicas").append(html);
        return false;
    });

    //AGREGAR ESPECIFICACIONES DE UN PRODUCTO
    $(document).on("click", "#btn-agregar-especificacion", function() {
        var html = '<tr class="row-table-rm"> <td><input type="text" name="especificaciones[titulo][]" class="form-control input-sm" placeholder="Título"></td><td><input type="text" name="especificaciones[descripcion][]" class="form-control input-sm" placeholder="Descripción"></td><td> <a href="#" class="btn btn-danger btn-xs btn-quitar-tr">Quitar <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a> </td></tr>';
        $("#items-especificaciones").append(html);
        return false;
    });

    //AGREGAR DETALLES DE UN SERVICIO
    $(document).on("click", "#btn-agregar-detalle-servicio", function() {
        var html = '<tr class="row-table-rm"> <td><input type="text" name="detalles[titulo][]" class="form-control input-sm" placeholder="Título"></td><td><textarea name="detalles[descripcion][]" rows="3" class="form-control input-sm" placeholder="Descripción"></textarea></td><td> <a href="#" class="btn btn-danger btn-xs btn-quitar-tr">Quitar <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a> </td></tr>';
        $("#items-servicio").append(html);
        return false;
    });

    //Cargar popup
    $(document).on("click", ".wapopup", function() {
       var url = $(this).attr('href');
       var title = $(this).attr('title');
       var height = $(this).data('height');
       var width = $(this).data('width');
       popupCenter(url,title,width,height);
       return false;

   });

    // -------- Toggle navbar Muestra/Oculta
    $(document).on("click", "#wa-togle", function() {
        var left_side = $(".left-side");
        if(left_side.hasClass("collapse-left")){
            Cookies.set('collpase_cookie', '2'); //2:Menu oculto
        }else{
            Cookies.set('collpase_cookie', '1'); //0,1:Menu visible
        }
        return false;
    });

    // -------- MENU MODULOS Mostrar/Ocultar
    $(document).on("click", ".wa-modulo", function() {
        var id_modulo = $(this).data('idmodulo');
        var treeview_active = $(this).parent("li.treeview");    
        if(treeview_active.hasClass("active")){
            Cookies.set(id_modulo, '1'); //1:Activo
        }else{
            Cookies.set(id_modulo, '2'); //2:Inactivo
        }
        return false;
    });

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {
            $('.row-offcanvas').toggleClass('active');
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
            $('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            $('.left-side').toggleClass("collapse-left");
            $(".right-side").toggleClass("strech");
        }
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();

    /*     
     * Add collapse and remove events to boxes
     */
     $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });

    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
     */
     $(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
     $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });

     $("[data-widget='remove']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        box.slideUp();
    });

     /* Sidebar tree view */
     $(".sidebar .treeview").tree();

    //Fire upon load
    _fix();
    //Fire when wrapper is resized
    $(".wrapper").resize(function() {
        _fix();
        fix_sidebar();
    });

    //Fix the fixed layout sidebar scroll bug
    fix_sidebar();

    /*
     * We are gonna initialize all checkbox and radio inputs to 
     * iCheck plugin in.
     * You can find the documentation at http://fronteed.com/iCheck/
     */
     $("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });

    // -------- Checkbox All
    $("input#chkTodo").on('ifChecked', function(event){
        //$(".chk").prop("checked",true);
        $(".chk").iCheck('check');
    });

    $("input#chkTodo").on('ifUnchecked', function(event){
        //$(".chk").prop("checked",false);
        $(".chk").iCheck('uncheck');
    });

    /**
     * Cambiar contraseña
     */
     $("input#ck_cambiar_pass").on('ifChecked', function(event){
        console.log("Activado");
        $("#cont-passwords").show();
        //$(".chk").prop("checked",true);
        /*$(".chk").iCheck('check');*/
    });

     $("input#ck_cambiar_pass").on('ifUnchecked', function(event){
        console.log("Desactivado");
        $("#cont-passwords").hide();
        //$(".chk").prop("checked",false);
        /*$(".chk").iCheck('uncheck');*/
    });

 });