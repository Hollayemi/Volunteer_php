$(document).ready(()=>{
   $('#signinBtn').click(()=>{
      $('#signupBox').hide()
      $('#signinBox').show()
      $('#forgotP').show();
   })
   $('#signupBtn').click(()=>{
      $('#signupBox').show()
      $('#signinBox').hide()
      $('#forgotP').hide();
   })
})

   //  j
    $('#register-btn').click((e) => {
      e.preventDefault()
      if ($("#register-form")[0].checkValidity()) {
         e.preventDefault()
          $('#register-btn').val('Please wait...')
          if ($('#r-password').val() !== $('#cpassword').val()) {
              $('#register-btn').val('Sign Up')
              $('#passMsg').text("Passwords do not match")
          } else {
              $('#passMsg').text("")
              $.ajax({
                  url: 'config/authCheck.php',
                  method: 'post',
                  data: $('#register-form').serialize() + "&action=register",
                  success: function(response) {
                     console.log(response);
                     if (response === 'Registered') {
                     //   window.location = "home.php"
                     } else {
                        $('#regAlert').html(response)
                        $('#register-btn').val('Sign Up')
                     }
                  }
              })
          }
      }

  })

  // Login script
  $('#login-btn').click((e)=>{
     e.preventDefault();
      // if($('#login-form')[0].checkValidity()){
      //     e.preventDefault()
      //     $('#login-btn').val('Please wait...')
      //     $.ajax({
      //         url:'assets/php/controller.php',
      //         method:'post',
      //         data:$('#login-form').serialize() + '&action=login',
      //         success:(res)=>{
                  
      //             if(res === 'login'){
      //                 window.location = 'home.php';
      //             }else{
      //                 $('#loginAlert').html(res)
      //                 $('#login-btn').val('Sign in')
      //             }
      //         }
      //     })
      // }
      console.log('here');
  })

  // forgot script
  $('#forgot-btn').click(e=>{
      if($('#forgot-form')[0].checkValidity()){
          e.preventDefault()
          $('#forgot-btn').val('Please wait...')
          $.ajax({
              url:'assets/php/controller.php',
              method:'post',
              data:$('#forgot-form').serialize()+'&action=forgot',
              success:function(res){
                  $('#forgot-btn').val('Reset Password')
                  $('#forgot-form')[0].reset()
                  $('#forgotAlert').html(res)
              }
          })
      }
  })