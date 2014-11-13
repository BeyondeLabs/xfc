$(document).ready(
	function(){
		/*remove browser autofilling of forms*/
		$("input").attr("autocomplete","off"); //didn't work for Chrome!

		$(".form input[type=text]:first").focus();
	}
);