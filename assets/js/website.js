/**
 * Variables globales
 */
$.getDataJson = function(url, data, callback) {
	return $.ajax({
		method: 'POST',
		url: url,
		data: data,
		dataType: 'json',
		success: callback
	});
};
$.datepicker.regional["es"] = {
	closeText: 'Cerrar',
	prevText: '< Ant',
	nextText: 'Sig >',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	weekHeader: 'Sm',
	dateFormat: 'dd-mm-yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional["es"]);

function getDate(element) {
	var date;
	try {
		date = $.datepicker.parseDate(dateFormat, element.value);
	} catch( error ) {
		date = null;
	}
	return date;
}

$(function() {
	//Reservar
$('#modal-reservar').on('shown.bs.modal', function () {
	$('#nombres').focus();
});

$('#form-reservar').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) {
    // handle the invalid form...
    console.log("Error formulario");
  } else {
    console.log("Enviar formulario");
    /*var data_form = $( this ).serializeFormJSON();
    console.log(data_form);*/

	var formdata = $(this).serializeArray();
	var data = {};
	$(formdata ).each(function(index, obj){
	data[obj.name] = obj.value;
	});

	//Escribir detalles en #list-form-data
	if($('#item_pais_origen').length == 0 ){
		$( "#list-form-data" ).append( '<li id="item_pais_origen"><input type="hidden" name="pais_origen" id="pais_origen" value="' + data.pais_origen + '"><span class="fa fa-check text-success"></span> País de origen: ' + data.pais_origen + '</li>' );
	}

	if($('#item_ciudad').length == 0 ){
		$( "#list-form-data" ).append( '<li id="item_ciudad"><input type="hidden" name="ciudad" id="ciudad" value="' + data.ciudad + '"><span class="fa fa-check text-success"></span> Ciudad: ' + data.ciudad + '</li>' );
	}

	if(data.adultos > 0 && $('#item_adultos').length == 0 ){
		$( "#list-form-data" ).append( '<li id="item_adultos"><input type="hidden" name="adultos" id="adultos" value="' + data.adultos + '"><span class="fa fa-check text-success"></span> Adultos: ' + data.adultos + '</li>' );
	}

	if(data.adolecentes > 0 && $('#item_adolecentes').length == 0){
		$( "#list-form-data" ).append( '<li id="item_adolecentes"><input type="hidden" name="adolecentes" id="adolecentes" value="' + data.adolecentes + '"><span class="fa fa-check text-success"></span> Adolecentes: ' + data.adolecentes + '</li>' );
	}

	if(data.ninios > 0 && $('#item_ninios').length == 0){
		$( "#list-form-data" ).append( '<li id="item_ninios"><input type="hidden" name="ninios" id="ninios" value="' + data.ninios + '"><span class="fa fa-check text-success"></span> Niños: ' + data.ninios + '</li>' );
	}

	if(data.infantes > 0 && $('#item_infantes').length == 0){
		$( "#list-form-data" ).append( '<li id="item_infantes"><input type="hidden" name="infantes" id="infantes" value="' + data.infantes + '"><span class="fa fa-check text-success"></span> Infantes: ' + data.infantes + '</li>' );
	}

	console.log(data);

    $('#modal-reservar').modal('show');
  }
  return false;
});

//Enviar formulario final form-reservar-completar
$('#form-reservar-completar').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) {
    console.log("Error formulario no enviar formulario");
    return false;
  } else {
    console.log("Enviar formulario");
  }
});

	//Select search select2
	$(".select_search").select2();

	$( ".imageLisGallery" ).hover(function() {
		console.log("Hover");
	});

	//Slider de videos
	$('#content-slider').lightSlider({
        item:4,
        auto:true,
        loop:true,
        slideMove:2,
        pager:false,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:2,
                    slideMove:1
                  }
            }
        ]
    });

    //Slider de fotos
	$('#content-slider-fotos').lightSlider({
        item:4,
        auto:true,
        loop:true,
        slideMove:2,
        pager:false,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:2,
                    slideMove:1
                  }
            }
        ]
    });
	
	//Galería en listado
	$('.imageLisGallery').lightSlider({
		adaptiveHeight:true,
		item:1,
		slideMargin:0,
		loop:true,
		pager:false,
		auto:true,
	});

	//Galería
	$('#imageGallery').lightSlider({
		gallery:true,
		item:1,
		loop:false,
		pager:false,
		thumbItem:9,
		slideMargin:0,
		enableDrag: true,
		enableTouch: true,
		currentPagerPosition:'left',
		adaptiveHeight:false,
		/*onSliderLoad: function(el) {
			el.lightGallery({
				selector: '#imageGallery .lslide'
			});
		}*/   
	});

	//Galería de hoteles
	$('#imageGalleryHotel').lightSlider({
		gallery:true,
		item:1,
		loop:false,
		pager:true,
		thumbItem:9,
		slideMargin:0,
		enableDrag: true,
		enableTouch: true,
		currentPagerPosition:'left',
		adaptiveHeight:true,
	});

	//Slimscroll
	$('.box-wscroll').slimScroll({
		height: '233px'
	});

	//Toolbar static
	$("#tool-bar").sticky({ topSpacing: 0 });


	/**
	 * Fecha datepicker
	 */
	 $(".select-fecha").datepicker({
	 	minDate: 0,
	 	defaultDate: "+1w",
	 	changeMonth: true,
	 	changeYear: true,
	 	numberOfMonths: 1
	 });

	 $(".show_calendar").click(function() {
	 	$(".select-fecha").datepicker("show");
	 });

	/**
	 * Formulario home
	 */
	 var dateFormat = "dd-mm-yy",
	 from = $( "#date_from" )
	 .datepicker({
	 	minDate: 0,
	 	defaultDate: "+1w",
	 	changeMonth: true,
	 	changeYear: true,
	 	numberOfMonths: 1
	 }).on( "change", function() {
	 	to.datepicker( "option", "minDate", getDate( this ) );
	 }),
	 to = $( "#date_to" ).datepicker({
	 	defaultDate: "+1w",
	 	changeMonth: true,
	 	changeYear: true,
	 	numberOfMonths: 1
	 })
	 .on( "change", function() {
	 	from.datepicker( "option", "maxDate", getDate( this ) );
	 });

	 $("#fecha_inicio_show").click(function() {
	 	$("#date_from").datepicker("show");
	 });

	 $("#fecha_fin_show").click(function() {
	 	$("#date_to").datepicker("show");
	 });

	 $('#buscar').on('click',function(event){
	 	event.preventDefault();
	//Validar
	if($('#date_from').val()==""){
		alert('Seleccionar Fecha Inicio de Tour');
		$('#date_from').focus();
		return false;
	}

	if($('#date_to').val()==""){
		alert('Seleccionar Fecha Fin de Tour');
		$('#date_to').focus();
		return false;
	}

	//Setear url
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	date_from = date_from.replace("-", "");
	date_from = date_from.replace("-", "");
	date_to = date_to.replace("-", "");
	date_to = date_to.replace("-", "");

	var urlBusqueda = base_url + 'paquetes-tours/desde_' + date_from + 'hasta_' + date_to;
	$(location).attr('href',urlBusqueda);
});

	});