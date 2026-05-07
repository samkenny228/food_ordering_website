$(document).ready(function(){
    $('.takeaway_id').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#pack_form");
        var takeaway_id = $form.find(".takeaway_id").val();
        var pack_uniquieid = $form.find(".pack_uniquieid").val();
        
  
    $.ajax({
        url: "php/select_takeaway.php",
        method: "post",
        data: {takeaway_id:takeaway_id,pack_uniquieid:pack_uniquieid},
        success:function(response){
            $("#update_takeaway_message").html(response);
        }
    });                
    }); 
  });