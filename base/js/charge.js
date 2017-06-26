$(document).ready(function(){
	//----------------------------------------
	$(".datepicker").datepicker({ 
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	dayNamesMin: ['Вс','Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
	monthNames: ['Январь', 'Февраль', 'Март','Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь','Октябрь', 'Ноябрь', 'Декабрь']
	 });
	 //---------------------------------------
	$('.charge_comment').click(function(){
		var id = $(this).attr('id');
		if($('.'+id).hasClass('vis')){
			$('.'+id).removeClass('vis');
		}
		else{
			$('.'+id).addClass('vis');
		}
	});
	//----------------------------------------
	
	var id = $('.charge_for_color').attr('id');
	if(id){
		$('.p_'+id).addClass('charge_color');
	}else{
		$('.p_'+$('#show_id').attr('class')).addClass('charge_color');
	}
	//----------------------------------------
	$('#charge_money').click(function(){
		if($('.charge_add_salary').hasClass('vis')){
			$('.charge_add_salary').fadeIn('1000').removeClass('vis');
		}else{
			$('.charge_add_salary').fadeOut('1000').addClass('vis');
		}
	});
	//----------------------------------------
	$('.charge_ok').click(function(){
		var input = $('input');
		var money,date,comment,person;
		input.each(function(){
			if($(this).attr('name') == 'money'){
				money = $(this).val();
			}
			if($(this).attr('name') == 'date'){
				date = $(this).val();
			}
			if($(this).attr('name') == 'comment'){
				comment = $(this).val();
			}
		});
		person = $('.charge_add_salary').attr('id');
		if((person>0)&&(date.length > 8)){ // ((money>0)&&(person>0)&&(date.length > 8))
			$('.charge_ok').addClass('vis');
			var string = 'comment='+comment+'&date='+date+'&money='+money+'&person='+person;
			$.post(
			'http://storuta.dp.ua/base_script/insert_charge.php',
			string);
			round_();
		}
		
	});
	//------------------------------
	$('#charge_date').click(function(){
		if($('.charge_add_date').hasClass('vis')){
			$('.charge_add_date').fadeIn('1000').removeClass('vis');
		}else{
			$('.charge_add_date').fadeOut('1000').addClass('vis');
		}
	});
	//-------------------------------
	$('.charge_ok_date').click(function(){
		var first = $('.date_first').val();
		var second = $('.date_second').val();	
		if((first)&&(second)){
			var date1 = new Date(first.replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));
			var date2 = new Date(second.replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));
			if(date1 <= date2){
				document.location.href = "http://storuta.dp.ua/base/charge/show/date/"+first+"_"+second;
			}	
		}
	});
	
});
//----------------
function round_(){
	$('#rotateImg').removeClass('loading_off');
	$('#rotateImg').addClass('loading_on');
	var angle = 0;
	setInterval(function(){
		angle+=15;
		jQuery("#rotateImg").rotate(angle);
	},50);
	setTimeout(reload_,500);
}
function reload_(){
	location.reload();
}