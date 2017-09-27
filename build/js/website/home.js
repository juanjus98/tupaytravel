var observer = lozad('.lozad', {
    rootMargin: '10px 0px', // syntax similar to that of CSS Margin
    threshold: 0.1 // ratio of element convergence
});
observer.observe();

$(function() {
	//Slider de videos home
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

    //Slider de fotos home
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

	//Slimscroll
	$('.box-wscroll').slimScroll({
		height: '233px'
	});

	//Toolbar static all
	$("#tool-bar").sticky({ topSpacing: 0 });

	/**
	 * Fecha datepicker
	 */
	 /*$(".select-fecha").datepicker({
	 	minDate: 0,
	 	defaultDate: "+1w",
	 	changeMonth: true,
	 	changeYear: true,
	 	numberOfMonths: 1
	 });*/

	 $(".show_calendar").click(function() {
	 	$(".select-fecha").datepicker("show");
	 });

/**
 * Datepicker para formulario de busqueda
 */
 var dpOptions = {
 	format: 'dd-mm-yyyy',
 	startDate: '+1d',
 	language: "es",
 	autoclose: true,
 };

 var dp1 = $("#date_from");
 var dp2 = $("#date_to");

 var datePicker1 = dp1.datepicker(dpOptions).
 on('changeDate', function (e) {
 	var nDate = new Date(e.date);
 	nDate.setDate(nDate.getDate() + 1);
 	datePicker2.datepicker('setStartDate', nDate);
 	dp2.focus();
 });

 var datePicker2 = dp2.datepicker(dpOptions);

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