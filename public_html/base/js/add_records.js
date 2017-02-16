$(document).ready(function(){
	time();
	check_state();
	$('input').change(check_state);
});
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
//---------------------------------------------------------
function check_state(){
	if($('input[name=date_out]').val() == ""){
		$('select[name=state]').prop("disabled", true);
		$('select[name=state]').val("Невыполнено");
	}else{
		$('select[name=state]').prop("disabled", false);
	}
}
//---------------------------------------------------------
//---------------------------------------------------------
function send(id){
	$('#'+id).attr('disabled',true);
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
		string='name='+mas[0]+'&vin='+mas[1]+'&car_name='+mas[2]+'&phone='+mas[3]+'&num_plate='+mas[4]+'&date_in='+mas[5]+'&date_out='+mas[6]+'&state='+mas[7];
		$.post(
		'http://storuta.dp.ua/base_script/insert_record_first.php',
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
	location.replace("http://storuta.dp.ua/base/records");
}
//-----------------------------------------------
function scroll_to_elem(elem,speed) {
		var destination = $('.'+elem).last().offset().top;
		$("html,body").animate({scrollTop: destination}, speed);
}
//---------------------------------------------------------------------------------------------------------------