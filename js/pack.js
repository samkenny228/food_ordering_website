  $(document).ready(function(){
    $('.how_many_pack').click(function(e){
        e.preventDefault();
        var $form = $(this).closest("#pack_form");
        var how_many_pack = $form.find(".how_many_pack").val();
        var num_pack = $form.find(".num_pack").val();
        var pickup = $form.find(".pickup").val();
  
    $.ajax({
        url: "php/pack.php",
        method: "post",
        data: {how_many_pack:how_many_pack,num_pack:num_pack,pickup:pickup},
        success:function(response){
            $("#pack_message").html(response);
        }
    });                
    }); 
  });
