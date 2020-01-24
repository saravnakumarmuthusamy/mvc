{extends file="layout.tpl"}
{block name=title}EAB - Login{/block}
{block name=head}
<style>
</style>
{/block}
{block name=content}
  <section id="signUp">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
          <div class="sign-form">
            <div class="loginForm">
              <h2><b>Login Form</b></h2>
              <form class="signin-form">
                <div class="row">
                      <div class="col-md-12">
                        <!-- <label><b>User Name</b></label> -->
                        <input type="text" name="username" class="form-control" placeholder="Email" required="">
                      </div>
                      <div class="col-md-12">
                        <!-- <label><b>Password</b></label> -->
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                      </div>
                      <div class="col-md-12 button_sec">
                        <div class="form-row">
                          <div class="col-lg-5 col-sm-12">
                            <!-- <input type="button" class="btn facebook-btn" value="Login with Facebook"><i class="fa fa-facebook myIcons" aria-hidden="true"></i> -->
                            <button type="button" class="btn facebook-btn"><i class="fa fa-facebook" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with Facebook</button>
                          </div>
                          <div class="col-lg-2 col-sm-12 text-center">
                            <span style="line-height: 2.5;"><b>OR</b></span>
                          </div>
                          <div class="col-lg-5 col-sm-12">
                            <button type="button" class="btn linkedIn-btn"><i class="fa fa-linkedin" aria-hidden="true" style="padding-right: 10px;font-size: 14px;"></i>Login with LinkedIn</button>
                          </div>
                        </div>
                      </div>
                      <div class="ForgotPassWord">
                          <a class="text-center">Forgot Password ?</a>
                      </div>
                       <div class="submitBtn">
                          <button type="button" class="btn submit-btn">Submit &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                          <!-- <input type="button" class="btn submit-btn" value="Submit"> -->
                          
                     </div>
                     <div class="newUser">
                      <p>Not a member yet? <a>Signup Now!</a></p>
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

