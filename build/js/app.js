$.datepicker.regional['es'] = {
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

$.datepicker.setDefaults($.datepicker.regional['es']);

$(function() {
	//Select search select2
	$(".select_search").select2();

	//Galería
	$('#imageGallery').lightSlider({
		gallery:true,
		item:1,
		loop:true,
		/*auto:true,*/
		thumbItem:9,
		slideMargin:0,
		enableDrag: true,
		enableTouch: true,
		currentPagerPosition:'left',
		onSliderLoad: function(el) {
			el.lightGallery({
				selector: '#imageGallery .lslide'
			});
		}   
	});

	//Slimscroll
	$('.box-wscroll').slimScroll({
		height: '233px'
	});

	//Toolbar static
	$("#tool-bar").sticky({ topSpacing: 0 });

	//Galería videos.
	$("#content-slider").lightSlider({
		loop:true,
		auto:true,
		item:4,
		slideMove:2,
		easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
		speed:600,
		pauseOnHover: true,
		pager: false,
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

    //Galería de fotos.
    $("#content-slider-fotos").lightSlider({
    	loop:true,
    	auto:true,
    	item:4,
    	slideMove:2,
    	easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
    	speed:600,
    	pauseOnHover: true,
    	pager: false,
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

	//Ver video fancybox
	$(".various").fancybox({
		maxWidth  : 800,
		maxHeight : 600,
		fitToView : false,
		width   : '70%',
		height    : '70%',
		autoSize  : false,
		closeClick  : false,
		openEffect  : 'none',
		closeEffect : 'none'
	});

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

	/*if($('select#adultos').val() == "0"){
		alert('Debe seleccionar al menos un Adulto');
		$('select#adultos').focus();
		return false;
	}*/

	//Setear url
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	date_from = date_from.replace("-", "");
	date_from = date_from.replace("-", "");
	date_to = date_to.replace("-", "");
	date_to = date_to.replace("-", "");

	var urlBusqueda = 'paquetes-tours/desde_' + date_from + 'hasta_' + date_to;
	$(location).attr('href',urlBusqueda);
});

	});