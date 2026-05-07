$(document).ready(()=>{
    $("#login_form").on("submit",(e)=>{
      e.preventDefault();
      var spinner = '<div class="spinner-border text-dark" role="status" style="height: 20px; width:20px;"><span class="sr-only">Loading...</span></div>'
      console.log("login");
      $("#spin_message").html(spinner);
      var formData = new FormData(document.getElementById("login_form"));
  
      $.ajax({  
        url:"php/login.php",
        type:"POST",
        data:formData,
        processData:false,
        contentType:false
      }).done((response)=>{
        $("#spin_message").text("");
        console.log(response);
        $("#login_message").html(response);

        
      })
    })
  })

