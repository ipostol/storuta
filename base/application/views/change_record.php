<?php
//-------------------------------------------------------------------
function pattern_works($vis='visibility'){
echo" 
  <tr id='cls_new_works_visibility' class='cls_new_works {$vis} change_display1'>
    <td width='43%'>
      <h5 class='padding_for_input'>Наименование работы</h5>
    </td>
    <td width='43%'>
      <h5 class='padding_for_input'>Кто выполнил</h5>
    </td>
    <td width='14%'>
      <h5 class='padding_for_input'>Стоимость</h5>
    </td>
  </tr>
";}
function pattern_works1($work, $params, $people, $who_doing_work, $vis, $pattern, $change = 'change_display1'){
echo"
  <tr height='43px' class='{$vis} cls_new_works {$change} {$pattern}'>
    <td>
      <input type='text' value='{$work['work']}' class='ruta_work'/>
    </td>
    <td>
      <select  name='who_doing' class='ruta_work'>
        <option disabled selected='selected'>Выберете работника</option>";
foreach($people as $ppl){
  if($ppl['presence'] == 0)
    continue;
  if($ppl['id']==$who_doing_work)
    $selected = "selected='selected'";
  echo "<option value='{$ppl['id']}' {$selected}>{$ppl['name']}</option>";
  $selected = '';
}
unset($ppl);
echo"
      </select> 
    </td>
    <td>
      <input type='text' style='width:70%' value='{$work['price']}' class='ruta_work sum_add work_add'/>
      <img class='minus_but visibility' src='{$params['url']}ico/minus.png' title='-' width='20px'/>
    </td>   
  </tr>
";
}
function pattern_goods($params, $vis='visibility'){
echo" 
  <tr id='cls_new_goods_visibility' class='cls_new_goods {$vis} change_display1'>
    <td width = '32%'>
      <h5 class='padding_for_input'>Наименование детали</h5>
    </td>
    <td width = '9%'>
      <h5 class='padding_for_input'>Цена</h5>
    </td>
    <td width = '9%' class = 'not_price'>
      <h5 class='padding_for_input'>Прайс</h5>
    </td>
    <td width = '9%' class = 'not_price'>
      <h5 class = 'padding_for_input'>Маржа</h5>
    </td>
    <td width = '9%' class = 'price_yes' >
    </td>
    <td width = '9%' class = 'price_yes' >
    </td>
    <td width = '14%' class = 'fuck fuck1'>
      <h5 class='padding_for_input'>Состояние</h5>
    </td>
    <td width = '27%'>
      <h5 class='padding_for_input'>Примечание</h5>
    </td>
  </tr>";
}
function pattern_goods1($good, $params, $vis, $pattern, $change = 'change_display1'){
echo "
  <tr height='43px' class='{$vis} cls_new_goods {$change} {$pattern}'>
    <td>
      <input type='text' style='width:190px' value='{$good['name']}' class='ruta_goods'/>     
    </td> 
    <td>
      <input type='text' style='width:36px' value='{$good['price']}' class='ruta_goods sum_add goods_add cena'/>
    </td>
    <td class = 'not_price'>
      <input type='text' style='width:36px' value='{$good['price_self']}' class='ruta_goods price'/>
    </td>
    <td class = 'not_price'>
      <p class = 'padding_for_input marga'>";echo $good['price'] - $good['price_self']; echo "</p>
    </td>
    <td class = 'price_yes' colspan = '2'>
      <img src = '{$params['url']}ico/filter.png' title='#' width = '10.8px' style = 'padding-left: 53.1px'/>
    </td>
    <td class = 'fuck fuck1'>";
    if($good['date']){
      echo "<input type='text' style='width:72px' value='";echo date('d.m.Y',$good['date'])."' class='datepicker ruta_goods'/>";
    }else{
      echo"
      <p class = 'buy_good'><img src = '{$params['url']}ico/buy.png' title='#' width='40px'/></p>
      <input type='text' style='width:72px' value='' class='datepicker ruta_goods visibility'/>";
    }echo"
    </td>
    <td>
      <input type='text' style='width:160px' value='{$good['comment']}' class='ruta_goods'/>
      <img class='minus_but visibility' src='{$params['url']}ico/minus.png' title='-' width='20px' style = 'margin-top:-35px'/>
    </td>
  </tr>
";
}
function pattern_money($vis = 'visibility'){
echo"
  <tr id='cls_new_money_visibility' class='cls_new_money {$vis} change_display1'>
    <td width='43%'>
      <h5 class='padding_for_input'>Дата оплаты</h5>
    </td>
    <td width='43%'>
      <h5 class='padding_for_input'>Примечание</h5>
    </td>
    <td width='14%'>
      <h5 class='padding_for_input'>Сумма</h5>
    </td>
  </tr>
";
}
function pattern_money1($charge, $params, $vis, $pattern, $change = 'change_display1'){
echo"
  <tr height='43px' class='{$vis} cls_new_money {$change} {$pattern}'>
    <td class='change_display1'>
      <input type='text' value = '";if($charge['date'])echo date('d.m.Y',(int)$charge['date']);echo"' class='ruta_money datepicker'/>
    </td>
    <td class='change_display1'>
      <input type='text' value = '{$charge['comment']}' class='ruta_money'/>
    </td>
    <td class='change_display1'>
      <input type='text' style='width:70%' value = '{$charge['money']}' class='ruta_money min_sum money_add'/>
      <img class='minus_but visibility' src='{$params['url']}ico/minus.png' title='-' width='20px'/>
    </td>
  </tr>
";
}
//------------------------------------------------------------------------------------------------
echo "
<div id='change_table' class='{$id}'>
<table class='change_main' width='650px' border='0px' id='{$date1}'>
  <tr height='43px'>
    <td>
      <p>Заказчик</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>{$records['client']}</p>
      <input name='name' type='text' value='{$records['client']}' class='change_display1'/>
    </td>
    <img src='{$params['url']}ico/edit.png' class = 'edit_button_in_change' title='#'/>
    <img src='{$params['url']}ico/ok.png' onclick='send()' class = 'change_display1 ok_button_in_change' title='#'/>
    <img src='{$params['url']}ico/info.png' class = 'info_button' title='?'/>
  </tr>
  <tr height='43px'>
    <td>
      <p>Модель</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>{$records['auto']}</p>
      <input name='car_name' type='text' value = '{$records['auto']}' class='change_display1'/>
    </td>
  </tr>
    <tr height='43px'>
    <td>
      <p>VIN</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>{$records['vin']}</p>
      <input name = 'vin' type='text' value = '{$records['vin']}' class='change_display1'/>
    </td>
  </tr>
  <tr height='43px'>
    <td>
      <p>ГосНомер</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>{$records['num_plate']}</p>
      <input name='num_plate' type='text' value = '{$records['num_plate']}' class='change_display1'/>
    </td>
  </tr>
  <tr height='43px'>
    <td>
      <p>Телефон</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>{$records['phone']}</p>
      <input name='phone' type='text' value = '{$records['phone']}' class='change_display1'/>
    </td>
  </tr>
  <tr height='43px'>
    <td>
      <p>Дата приёма</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>";if($records['date_in'])echo date('d.m.Y',$records['date_in']);echo"</p>
      <input name='date_in' type='text' value = '";if($records['date_in']) echo date('d.m.Y',$records['date_in']);echo"' class='datepicker change_display1'/>
    </td>
  </tr>
  <tr height='43px'>
    <td>
      <p>Дата выдачи</p>
    </td>
    <td class='td_left'>
      <p class='change_display'>";if($records['date_out'])echo date('d.m.Y',$records['date_out']);echo"</p>
      <input name='date_out' type='text' value = '";if($records['date_out'])echo date('d.m.Y',$records['date_out']);echo"' class='datepicker change_display1'/>
    </td>
  </tr>
  <tr height='43px'>
    <td>
      <p>Состояние</p>
    </td>
    <td class='td_left'>
";
if($records['state']==1) {
  $for_select = "Выполнено";
  $for_change_select = "selected='selected'";
}else {
  if($records['state'] == 2) {
    $for_select = "Должен";
    $for_change_select1 = "selected='selected'";
  }else {
    $for_select = "Невыполнено";
    $for_change_select = "";
  }
}
  
echo" 
      <p class='change_display' style=''>{$for_select}</p>
      <select name='state' class='change_display1'>
        <option value='0'>Невыполнено</option>
        <option value='1'{$for_change_select}>Выполнено</option>
        <option value='2'{$for_change_select1}>Должен</option>
      </select>
    </td>
  </tr>
</table>
<div class='separator'></div>
  <h4 align='center'>
    <span class = 'head_work_price'></span>
    Работы
    <img id='cls_new_works_' class='main_button_add change_display1' src='{$params['url']}ico/plus.png' title='+' width='17.5px'/>
    <img id='cls_new_works~' class='main_button_del change_display1' src='{$params['url']}ico/minus.png' title='-' width='17.5px'/>
  </h4>
<div class='separator'></div>
";
if(!count($works)){
echo "<table>";
pattern_works();
pattern_works1('', $params, $people, $who_doing_work, 'visibility', 'cls_new_works_pattern', '');
echo"</table>";
}
else{
echo"
<table class='table_change_works' width='650px' border='0px'>
  <tr class='change_display'>
    <td width='43%'>
      <h5 class='padding_for_input'>Наименование работы</h5>
    </td>
    <td width='43%'>
      <h5 class='padding_for_input'>Кто выполнил</h5>
    </td>
    <td width='14%'>
      <h5 class='padding_for_input'>Стоимость</h5>
    </td>
  </tr>
";
pattern_works('');
pattern_works1('', $params, $people, $who_doing_work, 'visibility', 'cls_new_works_pattern', '');
foreach($works as $work){
  $who_doing_work = $work['employee'];
echo"
  <tr height='43px' class='cls_new_works change_display'>
    <td>
      <p>{$work['work']}</p>
    </td>
    <td>
      <p>";
        foreach($people as $ppl){
          if($ppl['id']==$who_doing_work){
            echo "{$ppl['name']}";
            break;
          }
        }
        unset($ppl);
echo"</p>
    </td>
    <td>
      <p class = 'sum_add work_add'>{$work['price']}</p>  
    </td>
  </tr>
";
pattern_works1($work, $params, $people, $who_doing_work, '', '');
}
echo "
</table>
";
}
echo"
<div class='separator'></div>
  <h4 class='text_center'>
    <span class = 'head_goods_price'></span>
    Детали
    <img id='cls_new_goods_' class='main_button_add change_display1' src='{$params['url']}ico/plus.png' title='+' width='17.5px'/>
    <img id='cls_new_goods~' class='main_button_del change_display1' src='{$params['url']}ico/minus.png' title='-' width='17.5px'/>
  </h4>
<div class='separator'></div>";
if(!count($goods)){
  echo "<table>";
  pattern_goods($params);
  pattern_goods1('', $params, 'visibility', 'cls_new_goods_pattern', '');
  echo "</table>";
}else{
echo"
<table class='table_change_goods' width='650px' border='0px'>
  <tr class='change_display'>
    <td width = '207px'>
      <h5 class='padding_for_input'>Наименование детали</h5>
    </td>
    <td width = '56px'>
      <h5 class='padding_for_input'>Цена</h5>
    </td>
    <td width = '56px' class = 'not_price'>
      <h5 class='padding_for_input'>Прайс</h5>
    </td>
    <td width = '56px' class = 'not_price'>
      <h5 class='padding_for_input'>Маржа</h5>
    </td>
    <td width = '56px' class = 'price_yes' >
    </td>
    <td width = '56px' class = 'price_yes' >
    </td>
    <td width = '89px'>
      <h5 class='padding_for_input'>Состояние</h5>
    </td>
    <td width = '174px'>
      <h5 class='padding_for_input'>Примечание</h5>
    </td>
  </tr>
";
pattern_goods($params, '');
pattern_goods1('', $params, 'visibility', 'cls_new_goods_pattern', '');
foreach($goods as $good){
echo"<tr height='43px' class='cls_new_goods change_display'>
    <td>
      <p>{$good['name']}</p>      
    </td> 
    <td>
      <p class = 'sum_add goods_add'>{$good['price']}</p>
    </td>
    <td class = 'not_price'>
      <p>{$good['price_self']}</p>
    </td>
    <td class = 'not_price'>
      <p>";echo $good['price'] - $good['price_self']; echo"</p>
    </td>
    <td class = 'price_yes' colspan = '2'>
      <img src = '{$params['url']}ico/filter.png' title='#' width = '10.8px' style = 'padding-left: 53.1px'/>
    </td>
    
";
if($good['date']){
  echo "
    <td>
      <p>";echo date('d.m.Y',$good['date']);echo"</p>
    </td>";
}else echo "
    <td>
      <p>Не куплено</p>
    </td>";
echo "
    <td>
      <p>{$good['comment']}</p>
    </td>
  </tr>";
pattern_goods1($good, $params, '', '');
}
echo"</table>";
}
echo"
<div class='separator'></div>";
echo"
  <h4 align='center'>
    <span class = 'head_money_price'></span>
    Авансы
    <img id='cls_new_money_' class='main_button_add change_display1' src='{$params['url']}ico/plus.png' title='+' width='17.5px'/>
    <img id='cls_new_money~' class='main_button_del change_display1 ' src='{$params['url']}ico/minus.png' title='-' width='17.5px'/>
    <img id = 'yes' src='{$params['url']}ico/ready.png' title = '' width='17.5px'/>
    <img id = 'no' src='{$params['url']}ico/no_ready.png' title = '' width='17.5px'/>
  </h4>
<div class='separator'></div>";
if(!count($money)){
  echo "<table>";
  pattern_money();
  pattern_money1('', $params, 'visibility', 'cls_new_money_pattern','');
  echo "</table>";
}
else{
echo"
<table class='table_change_works' width='650px' border='0px'>
  <tr class='change_display'>
    <td width='43%'>
      <h5 class='padding_for_input'>Дата оплаты</h5>
    </td>
    <td width='43%'>
      <h5 class='padding_for_input'>Примечание</h5>
    </td>
    <td width='14%'>
      <h5 class='padding_for_input'>Сумма</h5>
    </td>
  </tr>
";
pattern_money('');
pattern_money1('', $params, 'visibility', 'cls_new_money_pattern','');
foreach($money as $charge){
echo"
  <tr height='43px' class='cls_new_money change_display'>
    <td>
      <p>";if($charge['date'])echo date('d.m.Y',$charge['date']);echo"</p>
    </td>
    <td>
      <p>{$charge['comment']}</p>
    </td>
    <td>
      <p class = 'min_sum money_add'>{$charge['money']}</p>
    </td
  </tr>
";
pattern_money1($charge,$params,'','');
}
echo "</table>";
}
?>
</div>
<div class = 'top_info_records' style = 'display:none;background-color:white'>
  <table width = '350px'>
      <tr>
      <td width = '40%'>
        <h5></h5>
      </td>
          <td width = '20%'>
              <h5 align = 'right'>Работы</h5>
            </td>
      <td width = '20%'>
              <h5 align = 'right'>Детали</h5>
            </td>
          <td width = '20%'>
              <h5 align = 'right'>Общее</h5>
            </td>
        </tr>
<?php
foreach($forecast as $temp => $temp1){
  echo"
      <tr>
          <td>
              <p>"; echo check_name($temp, $people); echo"</p>
            </td>
            <td>
              <p align = 'right'>{$temp1[0]} грн</p>
            </td>
      <td>
        <p align = 'right'>{$temp1[1]} грн</p>
      </td>
      <td>
        <p align = 'right'>{$temp1[2]} грн</p>
      </td>
        </tr>
  ";
}
unset($temp);
unset($temp1);
  echo"
    </table>
</div>";
?>