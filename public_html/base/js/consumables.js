$(document).ready(function(){
	
	$('.time').click(function(){
		if($('.for_time').is(':hidden')){
			$('.for_time').fadeIn(1000);
		}else{
			$('.for_time').fadeOut(1000,do_it);
		}
	});
	do_it();
	$(".consumables_select").change(do_it);
	$('.time_input').change(do_it);
	$(".datepicker").datepicker({ 
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	dayNamesMin: ['Вс','Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
	monthNames: ['Январь', 'Февраль', 'Март','Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь','Октябрь', 'Ноябрь', 'Декабрь']
	});
	
	
	//----------------------------------------
});
function paint(data){
	$('.cons_content').empty();
	$('.cons_content').append(data);
}
function do_it(){
		var id = "id=" + $(".consumables_select").val();
		if((($('.time_input').first().val()) || ($('.time_input').last().val()))&&(!$('.for_time').is(':hidden')))
			var date = "&date=" + $('.time_input').first().val() + '_' + $('.time_input').last().val();
		else 
			var date = "";
		$.ajax( "http://storuta.dp.ua/base_script/consumables.php", 
		{
        	type: "post",
        	data: id + date,
			response: 'html',
			success: paint
      	});

	}