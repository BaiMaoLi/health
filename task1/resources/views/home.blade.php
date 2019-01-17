<!DOCTYPE html>
<html lang="en">

<head>


<style type="text/css">
  
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
*:focus {
  outline: none;
}

body {
  margin: 0;
  padding: 0;
  background: #DDD;
  font-size: 16px;
  color: #222;
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
}

#login-box {
  position: relative;
  margin: 5% auto;
  width: 300px;
  height: 450px;
  background: #FFF;
  border-radius: 2px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
}

.left {
  position: absolute;
  top: 0;
  left: 0;
  box-sizing: border-box;
  padding: 40px;
  width: 300px;
  height: 400px;
}

h1 {
  margin: 0 0 20px 0;
  font-weight: 300;
  font-size: 18px;
  font-weight: bolder;
}

input[type="text"],
input[type="password"] {
  display: block;
  box-sizing: border-box;
  margin-bottom: 20px;
  padding: 4px;
  width: 220px;
  height: 32px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-bottom: 2px solid #16a085;
  color: #16a085;
  transition: 0.2s ease;
}

input[type="submit"] {
  margin-top: 28px;
  width: 150px;
  height: 32px;
  background: #16a085;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  text-transform: uppercase;
  transition: 0.1s ease;
  cursor: pointer;
}

input[type="submit"]:hover,
input[type="submit"]:focus {
  opacity: 0.8;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

input[type="submit"]:active {
  opacity: 1;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}
button.social-signin {
  margin-bottom: 20px;
  width: 220px;
  height: 36px;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  transition: 0.2s ease;
  cursor: pointer;
}

button.social-signin:hover,
button.social-signin:focus {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin:active {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin.facebook {
  background: #32508E;
}

button.social-signin.twitter {
  background: #55ACEE;
}

button.social-signin.google {
  background: #DD4B39;
}
#newusersignup{
  display: none;
}
#memberlogin{
  display: none;
}
#speciallog{
  display: none;
}
</style>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{asset('vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/freelancer.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/page2.css')}}" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" style="margin:auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#" style="margin-left: 100px">HOME</a>
            </li>            
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio" style="margin-left: 100px">LOGIN</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#disclaimer" style="margin-left: 100px">DISCLAIMER</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact" style="margin-left: 100px">CONTACT US</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="{{asset('img/profile.png')}}" alt="">
        <h1 class="text-uppercase mb-0">THATAINTAFARE.COM</h1>
      </div>
      <div class="non" style="height: 300px">
        
      </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio" style="padding-top: 0">
      <div class="container1" style="width: 100%;height: 40%;padding-top: 0px">
        <img class="img-fluid mb-5 d-block mx-auto" style="width: 100%;height: 10%" src="{{asset('img/logo.jpg')}}" alt="">
      </div> 
      <div class="container">
        <div class="row" style="margin-top: 50px">
          <div id="loginmenu" style="width:15%;margin-left: 20%">
            <button id="newuser" style="background-color:lightgrey "><label style="font-size: 18px;color:black;font-weight:bolder;margin:auto;">New User</label></button>
         </div>
          <div id="loginmenu" style="width:15%;margin: auto">
            <button id="member" style="background-color:lightgrey "><label style="font-size: 18px;color:black;margin:auto">Member</label></button>
          </div>
          <div id="loginmenu" style="width:15%;margin-right: 20%">
            <button id="speciallogin" style="background-color:lightgrey "><label style="font-size: 18px;color:black;margin:auto">Special Login</label></button>
          </div>
        </div>

        <div id="logintext" style="width: 80%;height: 450px;background-color:white;border-radius:10px;margin:auto;margin-top: 20px;margin-bottom: 10%">
        

        <div id="memberlogin">
          <form action="#" method="post">
              <div id="login-box">
              <div class="left" style="width:40%;margin-left: 30%;margin-top: 50px">
                 <h1 style="font-size: 18px">Member Login</h1>
                    <input type="text" style="width: 200px;margin-bottom: 30px" name="uniquenumber" placeholder="Unique Number" />
                    <input type="text" style="width: 200px;margin-bottom: 30px" name="4digits" placeholder="4-Digits" />
                    <input type="submit" name="signup_submit" value="Login" />
              </div>
              </div>
          </form>
        </div>
       
        <div id="newusersignup">
          <form action="#" method="post">
              <div id="login-box">
                 <div class="left" style="width:40%;margin-left:30%;margin-top: 50px">
                     <h1 style="font-size: 18px">List your information.</h1>
    
                        <input type="text" style="width: 200px;margin-bottom: 20px" name="username" placeholder="Fullname" />
                        <input type="text" style="width: 200px;margin-bottom: 20px" name="adress" placeholder="Adress" />
                        <input type="text" style="width: 200px;margin-bottom: 20px" name="phonenumber" placeholder="Phonenumber" />
                        <input type="text" style="width: 200px;margin-bottom: 20px"name="email" placeholder="E-mail" />
                        <input type="text" style="width: 200px;margin-bottom: 0px"name="4digits" placeholder="4-Digits" />
   
                        <input type="submit" name="signup_submit" value="Sign up" />
                 </div>
              </div>
          </form>
          </div>

          <div id="speciallog">
          <form action="#" method="post">
              <div id="login-box">
              <div class="left" style="margin-left:30%;margin-top: 50px">
                  <h1 style="font-size: 18px">Special Login</h1>
                  <input type="text" style="width: 200px;margin-bottom: 30px" name="uniquenumber" placeholder="Unique Number" />
                  <input type="text" style="width: 200px;margin-bottom: 30px" name="4digits" placeholder="4-Digits" />  
                  <input type="submit" name="signup_submit" value="Login" />
              </div>
              </div>
          </form>
          </div>

        </div>
      </div>


    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="disclaimer" style="padding-top:0">
      <div class="container0" style="width: 100%;height: 100%;padding-top: 0px">
        <img class="img-fluid mb-5 d-block mx-auto" style="width: 100%;height: 10%" src="{{asset('img/logo.jpg')}}" alt="">
      </div>
      <div class="container3" style="height: 600px;width:100%">
        <div class="text-center mt-4">

        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" style="padding-top:0">
      <div class="container2" style="width: 100%;height: 40%">
        <img class="img-fluid mb-5 d-block mx-auto" style="width: 100%;height: 10%" src="{{asset('img/logo.jpg')}}" alt="">
      </div> 
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">CONTACT US</h2>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form name="sentMessage" id="contactForm" novalidate="novalidate">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Name</label>
                  <input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email Address</label>
                  <input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Phone Number</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Message</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>



<style type="text/css">

</style>
<body>
  <div id="login-box">
    <div class="container1" style="width: 100%;height: 10%;padding-top: 0px">
        <img class="img-fluid mb-5 d-block mx-auto" style="width:20%;height: 100%" src="{{asset('img/logo.jpg')}}" alt="">
    </div>
  <div id="instructions" style="width:22%;height:5%;margin:auto;margin-top: 0px">
      <label style="font-size: 24px">INSERT TEXT INSTRUCTIONS</label>
  </div>

  <div class="left1">
    <?php for($i=0;$i<10;$i++){?>
    <div id="row1">
        <div id="name" style="display:inline-block;margin-left:25%">
          <label style="">NAME:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <label>FIRST</label>
        </div>  
        <div id="name" style="display:inline-block;">
            <input type="text" name="firstname" placeholder="First" />
        </div>
        <div id="name" style="display:inline-block;">
          <label>LAST:</label>
        </div>
        <div id="name" style="display:inline-block;">
          <input type="text" name="lastname" placeholder="Last" />
        </div>
        <div id="name" style="display:inline-block;">
          <label>PHONE:</label>
        </div>
        <div id="name" style="display:inline-block;">
          <input type="text" name="phone" placeholder="phone" />
        </div>
        <div id="name" style="display:inline-block;">
           <label>EMAIL:</label>
        </div>
        <div id="name" style="display:inline-block;">
           <input type="text" name="email" placeholder="E-mail" />
        </div>
    </div>
  <?php }?>
  </div>
  
<div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
    <label style="font-size: 24px">CATAGORY1</label>
</div>
<div class="catagory1">

    <?php for($i=0;$i<5;$i++){?>
    <div id="row1">
        <div id="name" style="display:inline-block;margin-left:25%">
            <label>NAME:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <label>FIRST</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="firstname" placeholder="First" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>LAST:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="lastname" placeholder="Last" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>PHONE:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="phone" placeholder="phone" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>EMAIL:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="email" placeholder="E-mail" />
        </div>
    </div>
  <?php }?>
  </div>
  
<div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
    <label style="font-size: 24px">CATAGORY2</label>
</div>
<div class="catagory2">

    <?php for($i=0;$i<5;$i++){?>
    <div id="row1">
        <div id="name" style="display:inline-block;margin-left:25%">
            <label>NAME:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <label>FIRST</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="firstname" placeholder="First" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>LAST:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="lastname" placeholder="Last" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>PHONE:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="phone" placeholder="phone" />
        </div>
        <div id="name" style="display:inline-block;">
            <label>EMAIL:</label>
        </div>
        <div id="name" style="display:inline-block;">
            <input type="text" name="email" placeholder="E-mail" />
        </div>
    </div>
    <?php }?>
  </div>
  
</div>
    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->
    <!-- <script type="text/javascript" language="javascript" src="jquery-3.3.7.min.js"></script> -->
 <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('js/contact_me.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('js/freelancer.min.js')}}"></script>

    <script tyle="text/javascript">
    $(document).ready(function(){
        $('#newuser').click(function(){
          $('#newusersignup').show();
          $('#memberlogin').hide();
          $('#speciallog').hide(); 
        });

        $('#member').click(function(){
          $('#newusersignup').hide();
          $('#memberlogin').show();
          $('#speciallog').hide(); 
        });        

        $('#speciallogin').click(function(){
          $('#newusersignup').hide();
          $('#memberlogin').hide();
          $('#speciallog').show(); 
        });
    });
    </script>
    
   
  </body>

</html>
