$(document).ready(function(){
    $('.btn_save_pack').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#takeaway_form");
        var btn_save_pack = $form.find(".btn_save_pack").val();
        var select_takeaway = $form.find(".select_takeaway").val();
        var num_takeaway = $form.find(".num_takeaway").val();
        var pack_num = $form.find(".pack_num").val();

        var select_takeaway2 = $form.find(".select_takeaway2").val();
        var num_takeaway2 = $form.find(".num_takeaway2").val();
        var pack_num2 = $form.find(".pack_num2").val();

        var select_takeaway3 = $form.find(".select_takeaway3").val();
        var num_takeaway3 = $form.find(".num_takeaway3").val();
        var pack_num3 = $form.find(".pack_num3").val();

        var select_takeaway4 = $form.find(".select_takeaway4").val();
        var num_takeaway4 = $form.find(".num_takeaway4").val();
        var pack_num4 = $form.find(".pack_num4").val();
         
        var select_takeaway5 = $form.find(".select_takeaway5").val();
        var num_takeaway5 = $form.find(".num_takeaway5").val();
        var pack_num5 = $form.find(".pack_num5").val();
  
    $.ajax({
        url: "php/save_pack.php",
        method: "post",
        data: {btn_save_pack:btn_save_pack,select_takeaway:select_takeaway,num_takeaway:num_takeaway,pack_num:pack_num,
               select_takeaway2:select_takeaway2,num_takeaway2:num_takeaway2,pack_num2:pack_num2,
               select_takeaway3:select_takeaway3,num_takeaway3:num_takeaway3,pack_num3:pack_num3,
               select_takeaway4:select_takeaway4,num_takeaway4:num_takeaway4,pack_num4:pack_num4,
               select_takeaway5:select_takeaway5,num_takeaway5:num_takeaway5,pack_num5:pack_num5
        },
        success:function(response){
            $("#save_pack_message").html(response);
        }
    });                
    }); 
  });