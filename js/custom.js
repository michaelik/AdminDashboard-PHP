$(document).ready(function (){
//prevent form submission due to form unfilled via disabling submission button.
    $('.m-show').on('click', function() 
    {
      $('#form')[0].reset();
      $(validate);
      $('#name, #email, #password, #C_password').change(validate);
    });
   function validate() {
        if($('#name').val().length > 0 && 
          $('#email').val().length > 0 && 
          $('#password').val().length > 0 && 
          $('#C_password').val().length > 0) 
        {
          //eliminate disabled
           $("#submit").prop("disabled", false);
        }
        else
        { 
          //enable disabled
           $("#submit").prop("disabled", true);
        }
     }
//function to check email on keyboard/ctrl+v/mouse copy-paste
function Checkemail() {
    $('.checking_email').on({
    input: OutputTxt,
    keyup: OutputTxt
  });
}
function OutputTxt() {
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
              // prevent form submission due to error otherwise
              $("#form").submit(function(event){
                if($('.error_email').text() == ''){
                    $("#form").submit();
                }
                else{
                   event.preventDefault();
                }
              });
            }
       });
}
$(Checkemail);
/*function that identify if the checkbox is checked(1) 
otherwise (0) and transfer the values to the server side
through ajax*/
var toggleCheckBox = function() {
  //store the result of the "value attribute" in the variable id.
  var id = $(this).attr("value");
  //conditional statement that verify if the checkbox is checked.
  if($(this).prop("checked") == true)
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
        alert("Data Checked");
      } 
    });
};
$("input[type=checkbox]").on("click", toggleCheckBox);
});