$(document).ready(function(){
    $('.plus_cart_quantity').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#cart_update_quantity");
        var plus_cart_quantity = $form.find(".plus_cart_quantity").val();
        var update_cart_id = $form.find(".update_cart_id").val();
        var quantity = $form.find(".quantity").val();
        var pack_for_cart = $form.find(".pack_for_cart").val();
  
    $.ajax({
        url: "php/cart_quantity_update.php",
        method: "post",
        data: {plus_cart_quantity:plus_cart_quantity,update_cart_id:update_cart_id,quantity:quantity,pack_for_cart:pack_for_cart},
        success:function(response){
            $("#cart_quantity_update_message").html(response);
        }
    });                
    }); 
  });

  $(document).ready(function(){
    $('.minus_cart_quantity').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#cart_update_quantity");
        var minus_cart_quantity = $form.find(".minus_cart_quantity").val();
        var update_cart_id = $form.find(".update_cart_id").val();
        var quantity = $form.find(".quantity").val();
        var pack_for_cart = $form.find(".pack_for_cart").val();
  
    $.ajax({
        url: "php/cart_quantity_update.php",
        method: "post",
        data: {minus_cart_quantity:minus_cart_quantity,update_cart_id:update_cart_id,quantity:quantity,pack_for_cart:pack_for_cart},
        success:function(response){
            $("#cart_quantity_update_message").html(response);
        }
    });                
    }); 
  });