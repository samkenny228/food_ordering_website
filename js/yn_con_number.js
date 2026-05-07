$(document).ready(function(){
    $('.y_con_number').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#yn_login_form");
        var y_con_number = $form.find(".y_con_number").val();
        var y_phone_number = $form.find(".y_phone_number").val();
  
    $.ajax({
        url: "php/yn_con_number.php",
        method: "post",
        data: {y_con_number:y_con_number,y_phone_number:y_phone_number},
        success:function(response){
            $("#login_message").html(response);
        }
    });                
    }); 
  });

  $(document).ready(function(){
    $('.n_con_number').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#yn_login_form");
        var n_con_number = $form.find(".n_con_number").val();
  
    $.ajax({
        url: "php/yn_con_number.php",
        method: "post",
        data: {n_con_number:n_con_number},
        success:function(response){
            $("#login_message").html(response);
        }
    });                
    }); 
  });