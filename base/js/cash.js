$(document).ready(function(){
	//----------------------------------------calculate money
	var sum_out = 0, sum_in = 0;
	$('.cash_out').each(function(){
		sum_out += parseInt($(this).text());
	});
	$('.cash_in').each(function(){
		sum_in += parseInt($(this).text());
	});
	$('.cash_out_h5').append(sum_out);
	$('.cash_in_h5').append(sum_in);
	//----------------------------------------
	$(".datepicker").datepicker({ 
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	dayNamesMin: ['Вс','Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
	monthNames: ['Январь', 'Февраль', 'Март','Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь','Октябрь', 'Ноябрь', 'Декабрь']
	 });
	 //---------------------------------------
	$('#cash_date').change(function(){
		document.location.href = "http://storuta.dp.ua/base/cash/show/id/"+$('#cash_date').val();
	});
	//----------------------------------------
	$('.money_in').click(function(){
		if(!$('.i_money_in').is(":visible")){
			$('.i_money_in').fadeIn('1000');
		}else{
			$('.i_money_in').fadeOut('1000');
		}
	});
	//----------------------------------------
	$('.money_out').click(function(){
		if(!$('.i_money_out').is(":visible")){
			$('.i_money_out').fadeIn('1000');
		}else{
			$('.i_money_out').fadeOut('1000');
		}
	});
	//----------------------------------------
	$('.ok_in').click(function(){
		var money = $('input[name=money_in]').val();
		var comment = $('input[name=comment_in]').val();
		if((money)&&(comment)){
			$(this).addClass('vis');
			var date = $('.i_money_in').attr('id');
			date = date[3]+date[4]+'/'+date[0]+date[1]+'/'+date[6]+date[7]+date[8]+date[9];
			date = Date.parse(date);
			var string = 'comment='+comment+'&money='+money+'&date='+date;
			$.post(
			'http://storuta.dp.ua/base_script/insert_cash_in.php',
			string, round_);
		}
	});
	//----------------------------------------
	$('.minus_but_in').click(function(){
		$.post(
		'http://storuta.dp.ua/base_script/insert_cash_in_delete.php',
		"id="+$(this).parent().parent().attr('id'), round_);
	});
	//----------------------------------------
	$('.ok_out').click(function(){
		var money = $('input[name=money_out]').val();
		var comment = $('input[name=comment_out]').val();
		var variant = $('select').val();
		if((money)&&(comment)&&(variant)){
			$(this).addClass('vis');
			var date = $('.i_money_in').attr('id');
			date = date[3]+date[4]+'/'+date[0]+date[1]+'/'+date[6]+date[7]+date[8]+date[9];
			date = Date.parse(date);
			var string = 'comment='+comment+'&money='+money+'&date='+date+'&variant='+variant;
			$.post(
			'http://storuta.dp.ua/base_script/insert_cash_out.php',
			string, round_);
			
		}
	});
	//----------------------------------------
	$('.minus_but_out').click(function(){
		$.post(
		'http://storuta.dp.ua/base_script/insert_cash_out_delete.php',
		"id="+$(this).parent().parent().attr('id'));
		round_();
	});
	//----------------------------------------
	$('.arrow_in').click(function(){
		if($('.t_money_in').is(':visible')){
			$('.t_money_in').fadeOut();
		}else{
			$('.t_money_in').fadeIn();
		}
	});
	//----------------------------------------
	$('.arrow_out').click(function(){
		if($('.t_money_out').is(':visible')){
			$('.t_money_out').fadeOut();
		}else{
			$('.t_money_out').fadeIn();
		}
	});
	//----------------------------------------
	//----------------------------------------	
});
//----------------------
function round_(){
	$('#rotateImg').removeClass('loading_off');
	$('#rotateImg').addClass('loading_on');
	var angle = 0;
	setInterval(function(){
		angle+=15;
		jQuery("#rotateImg").rotate(angle);
	},50);
	setTimeout(reload_, 500);
}
function reload_(){
	location.reload();
}