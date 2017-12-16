/* #########

	Form Validation

#############
*/
function FormValid(Valid_Arr,Valid_Type_Arr,Form1){
	var Split_Arr = Valid_Arr.split(",");
	var Split_Type_Arr = Valid_Type_Arr.split(",");

	for(i = 0;i < Split_Arr.length; i++){
		var Field_Val = $("#"+Split_Arr[i]).val();
		var Field_Type = $("#"+Split_Arr[i]).get(0).type;
		if(Field_Type == 'text' || Field_Type == 'password' || Field_Type == 'textarea' ){
				if(Field_Val == ''){
					$("#"+Split_Arr[i]).css('background-color', '#F6DDD8');
					$("#"+Split_Arr[i]+"v").show('normal');  ;
					$("#"+Split_Arr[i]+"v").html('Field Should not Empty');  ;
					var E = 1;
				}
		}
		if(Field_Type == 'select-one'){
				if(Field_Val == '0'){
					$("#"+Split_Arr[i]).css('background-color', '#F6DDD8');
					$("#"+Split_Arr[i]+"v").show('animate');  ;
					$("#"+Split_Arr[i]+"v").html('Select the Values');  ;
					var E = 1;
				}
		}

	}

	if(E == 1){
			return false;
	}
}

/* #########

 	Checkbox Limitation

#############
*/
function anyCheck(form)
{
	var total = 0;
	var max1 = form.Edit.length;
	for(var idx = 0; idx < max1; idx++){
		if(eval("document.List_Form.Edit[" + idx + "].checked") == true){
			total += 1;
		}
	}
	if(total == 0){
		if(document.List_Form.Edit.checked != true){
			alert('Select atleast one');
			return false;
		}
	}
	else{
		if(total > 1){
			alert('Only one Record Allowed at a time');
			return false;
		}
		else{
			return true;
		}
	}
}

/* ###############################

 	Confirm Message

##################################
*/

function Confirm_Message(Message,form){
	
	var total = 0;
	var max = form.Edit.length;
	for(var idx = 0; idx < max; idx++){
		if(eval("document.List_Form.Edit[" + idx + "].checked") == true){
			total += 1;
		}
	}
	if(total == 0){
		if(document.List_Form.Edit.checked != true){
			alert('Select atleast one');
			return false;
		}
	}
	else{
		var see = confirm(Message); 
		if(see == false)
			return false;
		else
			return true;
	}	
}

/* ###########################################

 	Filter Function for search Area

##########################################
*/


function Filter_Func(ID,VAL,File){
	var Url = File+".php?SearchD=Yes&"+ID+"="+VAL;
	window.location = Url;

}