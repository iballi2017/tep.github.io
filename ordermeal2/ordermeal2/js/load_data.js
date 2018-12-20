$(document).ready(function(){
   // load_data();
    $('#action').val("Register");
    $('#action2').val("Login");


    $('#user_form').on('submit', function(event) {
        event.preventDefault();
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var email = $('#email').val();
        var pwd   = $('#password').val();
        var add   = $('#address').val();
        var phone = $('#phone').val();

        if ((fname != '') && (lname !='') && (email !='') && (pwd !='') && (add !='') && (phone !='') )
        {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData: false,
                success:function(data)
                {

                    alert (data);
                    $('#user_form')[0].reset();
                    //load_data();
                }
            });
        }
        else
        {
            alert("All fields are Required");
        }
    });


    $('#loginForm').on('submit', function(event) {
        event.preventDefault();
        var email = $('#l_email').val();
        var pwd   = $('#l_password').val();


        if ((email !='') && (pwd !='') )
        {
            $.ajax({
                url: "login.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData: false,
                success:function(data) {
                    if (data === 'success') {
                        window.location.replace("user.php");
                    } else if (data === 'success2') {
                        window.location.replace("dashboard.php");
                    } else {
                        alert("Username do not match any record");
                    }
                }
            });
        }
        else
        {
            alert("All fields are Required");
        }
    });



});
