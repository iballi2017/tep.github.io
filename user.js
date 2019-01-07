// index.html codes................

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
        if (document.loginForm.email.value == ""){
            document.getElementById("emailErrorMessage").style.display="block";
            document.loginForm.email.focus();
            return false;
        }
        
        if (document.loginForm.pwd.value == ""){
            document.getElementById("pwdErrorMessage").style.display="block";
            // document.loginForm.pwd.focus();
            return false;
        }
    }

//Cart notification

var add = (function () {
    var counter = 0;
    return function () {return counter += 1;}
  })();
  
  function addToCart(){
    document.getElementById("cartNum").innerHTML = add();
    document.getElementById("cartNum").style.display="block"
  }











// user.html codes.............................
       

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

// PAYMENT OPTION CODES
// card option open and close
$(document).ready(function(){
    $("#cardOptionClick").click(function(){
        $("#cardInfo").toggle(1000);
        $("#walletInfo").hide(1000);
        $("#transferInfo").hide(1000);
    });
});

// wallet option open and close
$(document).ready(function(){
    $("#walletOptionClick").click(function(){
        $("#walletInfo").toggle(1000);
        $("#cardInfo").hide(1000);
        $("#transferInfo").hide(1000);
    });
});

// transfer option open and close
$(document).ready(function(){
    $("#transferOptionClick").click(function(){
        $("#transferInfo").toggle(1000);
        $("#walletInfo").hide(1000);
        $("#cardInfo").hide(1000);
    });
});


////cartView1 codes to update price per quantity
function multiply(){
    var b = document.getElementById("price").value;
    var a = document.getElementById("qtyNum").value;
    var c = parseInt(a) * parseInt(b);
    // document.write(c);

    if(a !== NaN){
        document.getElementById("subAmount").textContent = c;
    }else{
        document.getElementById("subAmount").textContent = b;
    }
}


///////This code snippet enables the delete of an item column from the dashboard
//////on file "dashboard-Edtitem.html"
function deleteConfirmation(){
    var retVal = confirm("Do you want to continue ?");
    if(retVal == true){
        return true;
    }else{
        return false;
    }
}