$(document).ready(()=>{
   $('#signupBox').hide()
   $("#signupBox").css("display", "none")
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
    $('#addAdmin-btn').click((e) => {
       e.preventDefault()
       if ($("#addAdmin-form")[0].checkValidity()) {
         e.preventDefault()
          $('#addAdmin-btn').val('Please wait...')
          if ($('#pass').val() !== $('#cpass').val()) {
              $('#addAdmin-btn').val('Sign Up')
              $('#passMsg3').text("Passwords do not match")
          } else {
              $('#passMsg3').text("")
              $.ajax({
                  url: '../config/admin_check.php',
                  method: 'post',
                  data: $('#addAdmin-form').serialize() + "&action=addAdmin",
                  success: function(response) {
                     console.log(response);
                     $('#passMsg3').text(response)
                     if (response === 'Registered') {
                     //   window.location = "home.php"
                     } else {
                        $('#regAlert').html(response)
                        $('#addAdmin-btn').val('Sign Up')
                     }
                  }
              })
          }
      }

  })

  // Login script
$('#login-btn').click((e)=>{
   e.preventDefault();
   if($('#login-form')[0].checkValidity()){
         e.preventDefault()
         $('#login-btn').val('Please wait...')
         $.ajax({
            url: 'config/authCheck.php',
            method:'post',
            data:$('#login-form').serialize() + '&action=login',
            success:(res)=>{
               $('#passMsg').text(res)
               if(res === 'logged in'){
                     window.location = 'Dashboard';
               }else{
                  $('#loginAlert').html(res)
                  $('#login-btn').val('Sign in')
               }
            }
         })
   }
   console.log('here');
})

  // forgot script
   $('#deleteAdmin-btn').click(e=>{
      e.preventDefault();
      if($('#deleteAdmin-form')[0].checkValidity()){
          e.preventDefault()
          $('#deleteAdmin-btn').val('Please wait...')
          $.ajax({
              url:'config/authCheck.php',
              method:'post',
              data:$('#deleteAdmin-form').serialize()+'&action=deleteAdmin',
              success:function(res){
                  $('#deleteAdmin-btn').val('Reset Password')
                  $('#deleteAdmin-form')[0].reset()
                  $('#deleteAdmin').html(res)
              }
          })
      }
  })


//   edit credentials
  $('#form-submit').click((e) => {
   e.preventDefault()
   if ($("#edit-form")[0].checkValidity()) {
     e.preventDefault()
      $('#edit-btn').val('Please wait...')
      if ($('#pass').val() !== $('#cpass').val()) {
          $('#edit-btn').val('Sign Up')
          $('#passMsg3').text("Passwords do not match")
      } else {
          $('#passMsg3').text("")
          $.ajax({
              url: '../config/authCheck.php',
              method: 'post',
              data: $('#edit-form').serialize() + "&action=edit",
              success: function(response) {
                 console.log(response);
                 $('#passMsg3').text(response)
                 if (response === 'done') {
                     $('#editForm').hide();
                     $('.Submitted').show()
                 } else {
                    $('#regAlert').html(response)
                    $('#edit-btn').val('Save')
                 }
              }
          })
      }
  }

})



  // reset password
   $('#reset-btn').click((e) => {
      e.preventDefault()
      if ($("#reset-form")[0].checkValidity()) {
         e.preventDefault()
         $('#reset-btn').val('Please wait...')
         if ($('#pass').val() !== $('#cpass').val()) {
            $('#reset-btn').val('Sign Up')
            $('#passMsg').text("Passwords do not match")
         } else {
            $('#passMsg').text("")
            $.ajax({
               url: '../config/authCheck.php',
               method: 'post',
               data: $('#reset-form').serialize() + "&action=reset",
               success: function(response) {
                  console.log(response);
                  $('#passMsg').text(response)
                  if (response === 'done') {
                        
                  } else {
                     $('#regAlert').html(response)
                     $('#edit-btn').val('Save')
                  }
               }
            })
         }
      }
   });
