// Login script
$('#admin-btn').click((e)=>{
    e.preventDefault();
    if($('#admin-form')[0].checkValidity()){
          e.preventDefault()
          $('#admin-btn').val('Please wait...')
          $.ajax({
             url: 'config/admin_check.php',
             method:'post',
             data:$('#admin-form').serialize() + '&action=admin_login',
            success:(res)=>{
                $('#passMsg').text(res)
                if(res === 'logged in'){
                      window.location = 'Dashboard';
                }else{
                   $('#loginAlert').html(res)
                   $('#admin-btn').val('Sign in')
                }
            }
         })
    }
 })