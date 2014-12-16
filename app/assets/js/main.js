_date_picker = false;

$(document).ready(
	function(){
		/*remove browser autofilling of forms*/
		$("input").attr("autocomplete","off"); //didn't work for Chrome!

		$(".form input[type=text]:first")
		.not(".commit-later input[type=text]:first").focus();

		if(_date_picker){
			$('.date-picker').datepicker(
				{
					format:'yyyy-mm-dd'
				}
			);
		}
	}
);