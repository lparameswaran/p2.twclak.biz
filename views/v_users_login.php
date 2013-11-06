<form method='POST' action='/users/p_login'>

    <table>
       <tr>
          <td colspan="2">
             <?php if (isset($message)) echo $message;?>
          </td>
       </tr>
       <tr>
          <td>
             Email
          </td>
          <td>
             <input type='text' name='email' value='<?php if (isset($email)) echo $email;?>'>
          </td>
       </tr>
       <tr>
          <td>
             Password
          </td>
          <td>
             <input type='password' name='password'>
          </td>
       </tr>
       <tr>
          <td colspan="2">
             <?php if(isset($error)): ?>
                <div class='error'>
                   Login failed. Please double check your email and password.
                </div>
             <?php endif; ?>
          </td>
       </tr>
       <tr>
          <td colspan="2">
             <input type='submit' value='Log in'>
          </td>
       </tr>
    </table>

</form>

<p>
   <a href="http://jigsaw.w3.org/css-validator/check/referer">
      <img style="border:0;width:88px;height:31px"
           src="http://jigsaw.w3.org/css-validator/images/vcss"
           alt="Valid CSS!" />
   </a>
   <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fp2.twclak.biz%2Fusers%2Flogin">
      <img style="border:0;width:88px;height:31px"
           src="/images/HTML5_Logo_512.png"
           alt="Valid HTML5!" />
   </a>
</p> 

