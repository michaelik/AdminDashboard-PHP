$(document).ready(function (){
	$('.checking_email').keyup(function (e){
       var email = $('.checking_email').val();
       $.ajax({
       	type: "POST",
       	url: "code.php",
       	data: {
       		"check_submit_btn": 1,
       		"email_id": email,
       	},
	    success: function (response) {
	       		$('.error_email').text(response);
	    }
       });
	});
});
/* function that identify if the checkbox is checked(1) 
otherwise (0) and transfer the values to the server side
through ajax*/
function toggleCheckbox(box)
{
   //store the result of the "value attribute" in the variable id.
    var id = $(box).attr("value");
   //conditional statement that verify if the checkbox is checked.
    if($(box).prop("checked") == true)
    {
      var visible = 1;
    }
    else
    {
      var visible = 0;
    }

    var data = {
      "checkbox_data": 1,
      "id": id,
      "visible": visible
    };

    $.ajax({
      type: "post",
      url: "code.php",
      data: data,
      success: function(response){
        // alert("Data Checked");
      }
    });
}