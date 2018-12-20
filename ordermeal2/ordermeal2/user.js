// index.blade.php codes................

$(document).ready(function(){
    $("#login").click(function(){
        $("#myLoginModal").modal();
// The following code is to avoid login and signup modal pop-up to show up at 
// the same time on one screen if login and sign buttons are clicked simultaneously
        $("#mySignupModal").hide();
    });
});


$(document).ready(function(){
    $("#signup").click(function(){
        $("#mySignupModal").modal();
// The following code is to avoid login and signup modal pop-up to show up at 
// the same time on one screen if login and sign buttons are clicked simultaneously
        $("#myLoginModal").hide();
    });
});


//Mobile menu button
function myFunction(x) {
    x.classList.toggle("change");
}

// Login Form validation 

    function validate(){
        if (document.loginForm.l_email.value == ""){
            document.getElementById("emailErrorMessage").style.display="block";
            document.loginForm.l_email.focus();
            return false;
        }
        
        if (document.loginForm.l_password.value == ""){
            document.getElementById("pwdErrorMessage").style.display="block";
            // document.loginForm.pwd.focus();
            return false;
        }
    }













// user.php codes.............................
       

       $(document).ready(function(){
            $("#userInfo").click(function(){
                $("#headImage").show();
            });
        });
       
       
       // Login onclick modal codes
        $(document).ready(function(){
            $(".login").click(function(){
                $("#myLoginModal").modal();
            });
        });

        //Signup onclick modal codes
        $(document).ready(function(){
            $(".signup").click(function(){
                $("#mySignupModal").modal();
            });
        });


        // mobile menu button toggle codes
        function myFunction(x) {
            x.classList.toggle("change");
        }

        $(document).ready(function(){
            $(".cont").click(function(){
                $(".mobile-nav").toggle(1000);
            });
        });

        // Sidebar javascript codes
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("main").style.display = "none";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.getElementById("main").style.display = "block";
}


/// cartContent codes
            $(document).ready(function(){
                $("#cart").click(function(){
                    $(".sideContent").hide();
                    $("#cartContent").show();
                });
            });


/// walletContent codes
            $(document).ready(function(){
                $("#wallet").click(function(){
                    $(".sideContent").hide();
                    $("#walletContent").show();
                    $(".sidenav span").css("border-left", "#fff");   // enable border-left invisible on other list items
                    $(".sidenav #wallet").css("border-left", "2px solid #444");    //enable visibility of border-left on click
                });
            });


/// settingsContent codes
            $(document).ready(function(){
                $("#settings").click(function(){
                    $(".sideContent").hide();
                    $("#settingsContent").show();
                    $(".sidenav span").css("border-left", "#fff");  // enable border-left invisible on other list items
                    $(".sidenav #settings").css("border-left", "2px solid #444");   //enable visibility of border-left on click
                });
            });


/// persnalInformationContent codes
            $(document).ready(function(){
                $("#userInfo").click(function(){
                    $(".sideContent").hide();
                    $("#personalInformationContent").show();
                    $(".sidenav span").css("border-left", "#fff");   // enable border-left invisible on other list items
                    $(".sidenav #userInfo").css("border-left", "2px solid #444");    //enable visibility of border-left on click
                });
            });


// Go back history function

function goBack() {
    window.history.back();
}


// The funtion of the following code is to control swapping between "Checkout view" and "Summary" view on mobile

$(document).ready(function(){
    $(".mobileCheckout").click(function(){
        $(".leftSide").show();
    });
});

$(document).ready(function(){
    $(".mobileSummary").click(function(){
        $(".leftSide").hide();
        $("#orderSummary").show();
    });
});

///////////////////////////////////////////////////////////////

// The following code is to hide and show the profile submenu

$(document).ready(function(){
    $("#profile").click(function(){
        $("#profileInfo").toggle(1000);
    });
});

//////////////////////////////////////////////////////////////

