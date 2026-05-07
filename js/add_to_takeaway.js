$(document).ready(function(){
    $('.btn_add_pack').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_add_pack = $form.find(".btn_add_pack").val();
        var num_takeaway = $form.find(".num_takeaway").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_add_pack:btn_add_pack,num_takeaway:num_takeaway},
        success:function(response){
            $("#add_pack_message").html(response);
        }
    });                
    }); 
  });



  $(document).ready(function(){
    $('.btn_minus_pack').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_minus_pack = $form.find(".btn_minus_pack").val();
        var num_takeaway = $form.find(".num_takeaway").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_minus_pack:btn_minus_pack,num_takeaway:num_takeaway},
        success:function(response){
            $("#add_pack_message").html(response);
        }
    });                
    }); 
  });


  //2 takeaway

  $(document).ready(function(){
    $('.btn_add_pack2').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_add_pack2 = $form.find(".btn_add_pack2").val();
        var num_takeaway2 = $form.find(".num_takeaway2").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_add_pack2:btn_add_pack2,num_takeaway2:num_takeaway2},
        success:function(response){
            $("#add_pack_message2").html(response);
        }
    });                
    }); 
  });



  $(document).ready(function(){
    $('.btn_minus_pack2').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_minus_pack2 = $form.find(".btn_minus_pack2").val();
        var num_takeaway2 = $form.find(".num_takeaway2").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_minus_pack2:btn_minus_pack2,num_takeaway2:num_takeaway2},
        success:function(response){
            $("#add_pack_message2").html(response);
        }
    });                
    }); 
  });

  //3 takeaway

  $(document).ready(function(){
    $('.btn_add_pack3').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_add_pack3 = $form.find(".btn_add_pack3").val();
        var num_takeaway3 = $form.find(".num_takeaway3").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_add_pack3:btn_add_pack3,num_takeaway3:num_takeaway3},
        success:function(response){
            $("#add_pack_message3").html(response);
        }
    });                
    }); 
  });



  $(document).ready(function(){
    $('.btn_minus_pack3').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_minus_pack3 = $form.find(".btn_minus_pack3").val();
        var num_takeaway3 = $form.find(".num_takeaway3").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_minus_pack3:btn_minus_pack3,num_takeaway3:num_takeaway3},
        success:function(response){
            $("#add_pack_message3").html(response);
        }
    });                
    }); 
  });

  //4 takeaway

  $(document).ready(function(){
    $('.btn_add_pack4').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_add_pack4 = $form.find(".btn_add_pack4").val();
        var num_takeaway4 = $form.find(".num_takeaway4").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_add_pack4:btn_add_pack4,num_takeaway4:num_takeaway4},
        success:function(response){
            $("#add_pack_message4").html(response);
        }
    });                
    }); 
  });



  $(document).ready(function(){
    $('.btn_minus_pack4').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_minus_pack4 = $form.find(".btn_minus_pack4").val();
        var num_takeaway4 = $form.find(".num_takeaway4").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_minus_pack4:btn_minus_pack4,num_takeaway4:num_takeaway4},
        success:function(response){
            $("#add_pack_message4").html(response);
        }
    });                
    }); 
  });


   //5 takeaway

   $(document).ready(function(){
    $('.btn_add_pack5').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_add_pack5 = $form.find(".btn_add_pack5").val();
        var num_takeaway5 = $form.find(".num_takeaway5").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_add_pack5:btn_add_pack5,num_takeaway5:num_takeaway5},
        success:function(response){
            $("#add_pack_message5").html(response);
        }
    });                
    }); 
  });



  $(document).ready(function(){
    $('.btn_minus_pack5').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_minus_pack5 = $form.find(".btn_minus_pack5").val();
        var num_takeaway5 = $form.find(".num_takeaway5").val();
  
    $.ajax({
        url: "php/add_to_takeaway.php",
        method: "post",
        data: {btn_minus_pack5:btn_minus_pack5,num_takeaway5:num_takeaway5},
        success:function(response){
            $("#add_pack_message5").html(response);
        }
    });                
    }); 
  });