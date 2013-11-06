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
