$(document).ready(function(){
    $('.cart_btn').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#form_nav");
        var cart_btn = $form.find(".cart_btn").val();
        
  
    $.ajax({
        url: "php/goto_cart_menu.php",
        method: "post",
        data: {cart_btn:cart_btn},
        success:function(response){
            $("#goto_cat_menu_message").html(response);
        }
    });                
    }); 
  });