$(function() {
    "use strict";

    //Chosen select
    $(".chosen-select").chosen({
        no_results_text: "Oops, sin resultados!",
        width: "100%",
        search_contains: true
    });

    //Ciudades en orden
/*    var MY_SELECT = $('select[multiple].chosen-select').get(0);

    $(document).on("change", "#ciudades_select", function() {
        console.log("Conservar orden");
        var selection = ChosenOrder.getSelectionOrder(MY_SELECT);

        var ciudades_text = '';
        $('#ciudades_text').val('');
        $(selection).each(function(i) {
            ciudades_text += selection[i] + ',';
        });
        $('#ciudades_text').val(ciudades_text.slice(0,-1));

        return false;
    });*/

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