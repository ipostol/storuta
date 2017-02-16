$(document).ready(function(){
	$('.top_info_records').dblclick(function(){
		$('.top_info_records').fadeOut(1000);
	});
	$('.info_button').click(function(){
		if($('.top_info_records').is(':hidden')){
			$('.top_info_records').fadeIn(1000);
		}else{
			$('.top_info_records').fadeOut(1000);
		}
	});
	all_check();
	$('.not_price').addClass('not_price1');
	$('.change_display1').addClass('change_display_none');
	time();
	$('.minus_but').bind('click', Delete);
	$('.main_button_add').bind('click', Add);
	$('.main_button_del').bind('click', Delete_show);
	$('.edit_button_in_change').click(function(){
		bindEvents();
		if($('.change_display').hasClass('change_display_none')){
			$('.change_display').removeClass('change_display_none');
			$('.change_display1').addClass('change_display_none');
			all_check();
		}
		else{
			$('.change_display').addClass('change_display_none');
			$('.change_display1').removeClass('change_display_none');	
			all_check();
		}
	});
	$('input').change(all_check);
	$('.show_not_price').click(function(){
		$('.rem').remove();
		if($('.not_price1').length > 0){
			$('.not_price').removeClass('not_price1');
			$('.price_yes').addClass('visibility');
			var sum1 = 0;
			var sum2 = 0;
			$('.goods_add').each(function(){
				if($(this).text() > 0 )
					sum1  += Math.abs(parseInt($(this).text()));
			});
			var i = 0;
			$('.not_price').each(function(){
				if((i % 2 == 0) && ($(this).is(':visible')) && (($(this).text() > 0)|| ($(this).children().val() > 0))){
					if($(this).children().is('input')){
						sum2  += Math.abs(parseInt($(this).children().val()));
					}
					else
						sum2  += Math.abs(parseInt($(this).text()));
				}
				i++;
			});
			$(".table_change_goods").append("<tr class = 'rem'><td style = 'padding-left: 7px'>Общее</td><td style = 'padding-left: 7px'>" + sum1 + "</td><td style = 'padding-left: 7px'>" + sum2 + "</td><td style = 'padding-left: 7px'>" + (sum1 - sum2) + "</td><td></td><td></td><td></td></tr>");
		}else{
			$('.not_price').addClass('not_price1');
			$('.price_yes').removeClass('visibility');
		}
	});
});
//----------------------------------
function check_goods(){
	var cena = $('.cena');
	var price = $('.price');
	var marga = $('.marga');
	marga.each(function(){
		var find_ = $(this).parent().parent();
		$(this).empty().append(find_.find('input.cena').val() - find_.find('input.price').val());
	});
}
//----------------------------------
function check_money(name){
	var sum = 0;
		if($('.change_display').hasClass('change_display_none')){
		
		$('input.' + name + '_add').each(function(){
			if($(this).val().length>0){
				sum += Math.abs(parseInt($(this).val()));
			}
		});
	}else{
		$('p.' + name + '_add').each(function(){
			sum += Math.abs(parseInt($(this).text()));
		});
	}
	
	if(sum != 0)
		$('.head_' + name + '_price').empty().append(sum +" на ");
	else
		$('.head_' + name + '_price').empty();
}
function check_sum(){
	var sum = 0;
	if($('.change_display').hasClass('change_display_none')){
		
		$('input.sum_add').each(function(){
			if($(this).val().length>0){
				sum += Math.abs(parseInt($(this).val()));
			}
		});
		$('input.min_sum').each(function(){
			if($(this).val().length>0){
				sum -= Math.abs(parseInt($(this).val()));
			}
		});
		if(!sum){
			$('#yes').removeClass('visibility');
			$('#no').addClass('visibility');
		}
		else{
			$('#no').removeClass('visibility').attr('title',sum);;
			$('#yes').addClass('visibility');
		}
	}else{
		$('p.sum_add').each(function(){
			sum += Math.abs(parseInt($(this).text()));
		});
		$('p.min_sum').each(function(){
			sum -= Math.abs(parseInt($(this).text()));
		});
		if(!sum){
			$('#yes').removeClass('visibility');
			$('#no').addClass('visibility');
		}
		else{
			$('#no').removeClass('visibility').attr('title',sum);
			$('#yes').addClass('visibility');
			
		}
	}
	$('.ruta_money:last').attr('placeholder', sum);
}
function time() {
	var date = $(".datepicker");
	date.removeAttr('id');
	date.removeClass('hasDatepicker');
	$(".datepicker").datepicker({ 
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	dayNamesMin: ['Вс','Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
	monthNames: ['Январь', 'Февраль', 'Март','Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь','Октябрь', 'Ноябрь', 'Декабрь']
	 });
}
//-----------------------------------------------------------------
function Delete_show(){
	var but = $(this).attr("id");
	but = but.substr(0,but.length-1);
	but = $('.'+but).find('.minus_but');
	if(!but.hasClass('visibility'))
		but.addClass("visibility");
	else
		but.removeClass("visibility");
}
function Add(){
	var name = $(this).attr("id");
	name = name.substr(0,name.length-1);
	var clone = $('.'+name+'_pattern').clone();
	$('#'+name+'_visibility').removeClass('visibility');
	clone.addClass('change_display1');
	clone.removeClass('visibility').removeClass(name+'_pattern');
	$('.'+name).last().after(clone);
	time();
	scroll_to_elem(name,1000);
	bindEvents();
}
function Delete(){
	var str = $(this).parent().parent().attr("class").split(' ');
	$(this).parent().parent().remove();
	var i = 0;
	$('.'+str[0]).each(function(){
		if($(this).hasClass('change_display1'))
			i++;
	});
	if(i==1)
		$('#'+str[0]+'_visibility').addClass('visibility');
	bindEvents();
}
//---------------------------------------------------
function bindEvents () {
        $('.minus_but').unbind('click');
        $('.minus_but').bind('click', Delete);
		$('.main_button_add').unbind('click');
		$('.main_button_add').bind('click', Add);
		$('.main_button_del').unbind('click');
		$('.main_button_del').bind('click', Delete_show);
		$('.buy_good').unbind('click');
		$('.buy_good').bind('click', add_date);
		$('input').change(all_check);
		all_check();
    }
//---------------------------------------------------------
function check_state(){
	if($('input[name=date_out]').val() == ""){
		$('select[name=state]').prop("disabled", true);
		$('select[name=state]').val("0");
	}else{
		$('select[name=state]').prop("disabled", false);
	}
}
//---------------------------------------------------------
function all_check(){
	check_state();
	check_goods();
	check_sum();
	check_money("work");
	check_money("goods");
	check_money("money");
}
function add_date(){
	var date = $('.change_main').attr('id');
	$(this).parent().find('input').removeClass('visibility').val(date);
	$(this).addClass('visibility');
}
//---------------------------------------------------------
function send(){
	$('.ok_button_in_change').addClass('visibility');
	var id = $('#change_table').attr('class');
	var mas = Array("","","","","","","");
	var for_switch;
	$('input').each(function(){
		for_switch = $(this).attr("name");
		switch(for_switch){
			case 'name' :
			mas[0] = $(this).val();
			
			break;
			case 'vin' :
			mas[1] = $(this).val();
			
			break;
			case 'car_name' :
			mas[2] = $(this).val();
			
			break;
			case 'phone' :
			mas[3] = $(this).val();
			
			break;
			case 'num_plate' :
			mas[4] = $(this).val();
			
			break;
			case 'date_in' :
			mas[5] = $(this).val();
			
			break;
			case 'date_out' :
			mas[6] = $(this).val();
			
			break;
			}
		});
		mas[7] = $("select[name='state']").val();
		//-------------------------------------------
		var string_work="";
		var work = $('.ruta_work');
		work.each(function(){
			if(!$(this).parent().parent().hasClass('visibility'))
				string_work+=$(this).val()+'|';
		});		
		//-------------------------------------------
		var string_money="";
		var money = $('.ruta_money');
		money.each(function(){
			if(!$(this).parent().parent().hasClass('visibility'))
				string_money+=$(this).val()+'|';
		});
		//-------------------------------------------
		var string_goods="";
		var goods = $('.ruta_goods');
		goods.each(function(){
			if(!$(this).parent().parent().hasClass('visibility'))
				string_goods+=$(this).val()+'|';
		});		
		//------------------------------------------
		string='id='+id+'&name='+mas[0]+'&vin='+mas[1]+'&car_name='+mas[2]+'&phone='+mas[3]+'&num_plate='+mas[4]+'&date_in='+mas[5]+'&date_out='+mas[6]+'&state='+mas[7]+'&works='+string_work+'&money='+string_money+'&goods='+string_goods;
		$.post(
		'http://storuta.dp.ua/base_script/insert_record.php',
		string);
		$('#rotateImg').removeClass('loading_off');
		$('#rotateImg').addClass('loading_on');
		var angle = 0;
		setInterval(function(){
			angle+=15;
			jQuery("#rotateImg").rotate(angle);
		},50);
		setTimeout(replace_,1000);

}
//--------------------------
function replace_(){
	location.reload();
	//replace("http://storuta.dp.ua/base/records");
}
//-----------------------------------------------
function scroll_to_elem(elem,speed) {
		var destination = $('.'+elem).last().offset().top;
		$("html,body").animate({scrollTop: destination}, speed);
}
//---------------------------------------------------------------------------------------------------------------