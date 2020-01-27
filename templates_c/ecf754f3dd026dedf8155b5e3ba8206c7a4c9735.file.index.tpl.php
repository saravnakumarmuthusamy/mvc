<?php /* Smarty version Smarty-3.0.7, created on 2020-01-24 17:52:15
         compiled from "C:\xampp\htdocs\silica\templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8476243125e2b20bfb79405-39993310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecf754f3dd026dedf8155b5e3ba8206c7a4c9735' => 
    array (
      0 => 'C:\\xampp\\htdocs\\silica\\templates/index.tpl',
      1 => 1564056902,
      2 => 'file',
    ),
    '7210a61fd9dbb4f81b2f375fd512e1e8115fac9b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\silica\\templates/layout.tpl',
      1 => 1564653432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8476243125e2b20bfb79405-39993310',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>EAB - Login</title><link rel="stylesheet" href="<?php echo @ROOT_HTTP_PATH;?>
/css/bootstrap_4.3.1.min.css" /><link rel="stylesheet" href="<?php echo @ROOT_HTTP_PATH;?>
/css/bootstrap-datepicker.css" /><link rel="stylesheet" href="<?php echo @ROOT_HTTP_PATH;?>
/css/bootstrap-datetimepicker.min.css" /><link href="<?php echo @ROOT_HTTP_PATH;?>
/images/eab_fav.ico" /><!-- <link rel="stylesheet" href="<?php echo @ROOT_HTTP_PATH;?>
/css/font-awesome_4.7.0.min.css" /> --><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="<?php echo @ROOT_HTTP_PATH;?>
/css/styleNew.css"><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/jquery_3.4.1.min.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/popper_1.14.0.min.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/moment.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/bootstrap_4.3.1.min.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/notify.min.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/bootstrap-datepicker.js"></script><script src="<?php echo @ROOT_HTTP_PATH;?>
/js/bootstrap-datetimepicker.min.js"></script><style type="text/css">.myHeader {-webkit-box-shadow: 0px 1px 21px -9px rgba(0,0,0,0.75);-moz-box-shadow: 0px 1px 21px -9px rgba(0,0,0,0.75);box-shadow: 0px 1px 21px -9px rgba(0,0,0,0.75);}</style>

<style>
</style>
<script type="text/javascript">

   function loginform(){
      
      if($("#username").val() == ''){
        $.notify("Please Enter Email Address", "error");
      }else if($("#password").val() == ''){
        $.notify("Please Enter Password", "error");
      }else{
        if( !isValidEmailAddress($("#username").val())) {
          $.notify("Please Enter Valid Email Address", "error");
        }else{
                 checkuservalid();
        }
      }
      
  }


function checkuservalid(){


          var check_email=$("#username").val();
          var check_password=$("#password").val();

          $.ajax({
                url:'ajax/deleteUser.php',
                type:'POST',
                dataType:'JSON',
                data:{ validUser:1,check_email:check_email,check_password:check_password},
             
                  success:function(response){

                        if(response.success == 1 ){
                             $("#signinform").submit();
                        }else{
                          $.notify(response.message, "error");
                            
                        }
                        
                }
            });
       
   
}


  function isValidEmailAddress(emailAddress) {

    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_` { | } ~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_` { | } ~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
   
      return pattern.test(emailAddress);
 }




</script>

</head>
<body>
<div class="header">
</div>
<div class="">
		
<section id="signUp">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
         
          <div class="sign-form">
            <div class="loginForm">
              <h2><b>Login Form</b></h2>
              <form class="signin-form form" target="_top" id="signinform"  method="post" action="<?php echo @ROOT_HTTP_PATH;?>
/index.php">
                <div class="row">
                      <div class="col-md-12">
                        <!-- <label><b>User Name</b></label> -->
                        <input type="text" name="username" id="username" class="form-control" placeholder="Email" >
                      </div>
                      <div class="col-md-12">
                        <!-- <label><b>Password</b></label> -->
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                      </div>
                      <div class="col-md-12 button_sec">
                        <div class="form-row">
                          
                          <!-- <div class="col-lg-5 col-sm-12">
                           
                            
                            <a target="_parent" href="<?php echo $_smarty_tpl->getVariable('fbloginUrl')->value;?>
"><button  type="button" class="btn facebook-btn"><i class="fa fa-facebook" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with Facebook</button></a>
                          </div>
                          <div class="col-lg-2 col-sm-12 text-center">
                            <span style="line-height: 2.5;"><b>OR</b></span>
                          </div>
                          <div class="col-lg-5 col-sm-12">
                            <a target="_parent" href="<?php echo $_smarty_tpl->getVariable('linloginUrl')->value;?>
"><button   type="button" class="btn linkedIn-btn"><i class="fa fa-linkedin" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with LinkedIn</button></a>
                          </div> -->
                        </div>
                      </div>
                      <div class="ForgotPassWord">
                          <a class="text-center" href="javascript:void(0);">Forgot Password ?</a>
                      </div>
                       <div class="submitBtn">
                          <!-- <button type="button" name="submit"  value="Login" class="btn submit-btn" onclick="loginform();">Submit &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></button> -->

                          <button type="button" class="btn submit-btn" name="Login" value="Login" onclick="loginform()">Submit &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                          <input type="hidden" name="Login" value="1"> 
                        
                          
                     </div>
                     <div class="newUser">
                      <p>Not a member yet? <a href="<?php echo @ROOT_HTTP_PATH;?>
/register.php">Signup Now!</a></p>
                     </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

</div>
<div class="footer">
<!--   <p>All Right Reserved <b>SAM AI,Inc.</b> Copyright &copy; 2019</p> -->
</div>


</body>
</html>

</html>