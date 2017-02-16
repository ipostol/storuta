// JavaScript Document
$(document).ready(function(){
	function move(i,j,k,length,matrix,first_i,first_j){
		matrix[i][j]=k;
		/*var string='';
				for(var i1=0;i1<length;i1++){
			for(var j1=0;j1<length;j1++){
				string+=matrix[i1][j1]+' ';
			}
			string+='\n';
				}
			alert(string+k+' i: '+i+' j: '+j+' f_i: '+first_i+' f_j: '+first_j);
			*/
			k++;
			if((i==first_i)&&(j==first_j)){
				var i =0;
				var j = 0;
				$('td').each(function(){
					if(matrix[i][j]>2)
						$(this).addClass('end');
					j++;		
					if(j==length){
						j=0;
						i++;
					}
				});	
				exit();
			}else{
				
				
				
				if((i-1>=0)&&(matrix[i-1][j]==0)) move(i-1,j,k,length,matrix,first_i,first_j);
				if((j+1<length)&&(matrix[i][j+1]==0)) move(i,j+1,k,length,matrix,first_i,first_j);
				if((i+1<length)&&(matrix[i+1][j]==0)) move(i+1,j,k,length,matrix,first_i,first_j);
				if((j-1>=0)&&(matrix[i][j-1]==0)) move(i,j-1,k,length,matrix,first_i,first_j);				
			}
			matrix[i][j]=0;
			k--;
		}
	var length = parseInt($('#button').attr('name'));
	var matrix = new Array(length);
	var string = '';
	var first_i=Array(0,0);
	var first_j=Array(0,0);
	var temp = 0;
	var i = 0;
	var j = 0;
	for(i=0;i<length;i++) matrix[i]= new Array(length);
	for(i=0;i<length;i++)
		for(j=0;j<length;j++)matrix[i][j]=0;
	$('td').click(function(){
		if($(this).hasClass('for_td')){
			$(this).removeClass('for_td');
		}else{
			$(this).addClass('for_td');
		}
	});
	$('#button').click(function(){
		alert("С помощью клика выберете начальну точку");
		$('td').click(function(){
		if($(this).hasClass('first')){
			$(this).removeClass('first');
		}else{
			if($(this).hasClass('for_td')){
				$(this).addClass('first');
				$(this).removeClass('for_td');
			}
		}
		});
		
	});
	$('#button1').click(function(){
		var i = 0;
		var j = 0;
		$('td').each(function(){
			if($(this).hasClass('for_td')){
				matrix[i][j] = 1;
			}
			if($(this).hasClass('first')){
				first_i[temp] = i;
				first_j[temp] = j;
				temp++;
			}
			j++;
			if(j==length){
				j=0;
				i++;
			}
			});
		var answer = move(first_i[0],first_j[0],3,length,matrix,first_i[1],first_j[1]);
		if(!$('.end').length>0)
			alert("Выхода нет");
		});
});
