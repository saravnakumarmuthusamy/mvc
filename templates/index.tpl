{extends file="layout.tpl"}
{block name=title}EAB - Login{/block}
{block name=head}
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
{/block}
{block name=content}
<section id="signUp">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
         
          <div class="sign-form">
            <div class="loginForm">
              <h2><b>Login Form</b></h2>
              <form class="signin-form form" target="_top" id="signinform"  method="post" action="{$smarty.const.ROOT_HTTP_PATH}/index.php">
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
                           
                            
                            <a target="_parent" href="{$fbloginUrl}"><button  type="button" class="btn facebook-btn"><i class="fa fa-facebook" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with Facebook</button></a>
                          </div>
                          <div class="col-lg-2 col-sm-12 text-center">
                            <span style="line-height: 2.5;"><b>OR</b></span>
                          </div>
                          <div class="col-lg-5 col-sm-12">
                            <a target="_parent" href="{$linloginUrl}"><button   type="button" class="btn linkedIn-btn"><i class="fa fa-linkedin" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with LinkedIn</button></a>
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
                      <p>Not a member yet? <a href="{$smarty.const.ROOT_HTTP_PATH}/register.php">Signup Now!</a></p>
                     </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
{/block}

