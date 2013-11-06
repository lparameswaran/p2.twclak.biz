<script>
    function validateEmail(email) 
    {
       var re = /\S+@\S+\.\S+/;
       return re.test(email);
    }
    function validateFirstName(first_name) 
    {
       var re = /\S+[\s+\S+]/;
       return re.test(first_name);
    }
    function validateLastName(last_name) 
    {
       var re = /\S+[\s+\S+]/;
       return re.test(last_name);
    }
    function validatePassword(password) 
    {
       return password.length > 5;
    }
    function validateForm() 
    {
        var error = false;
        if (!validateFirstName(document.forms["signUpForm"]["first_name"])) {
           error = true;
           document.getElementById("error_first_name").innerHTML = "<td>First Name can be upto 2 words. Please fix.</td>";
        }
        if (!validateLastName(document.forms["signUpForm"]["last_name"])) {
           error = true;
           document.getElementById("error_last_name").innerHTML = "<td>Last Name can be upto 2 words. Please fix.</td>";
        }
        if (!validateEmail(document.forms["signUpForm"]["email"])) {
           error = true;
           document.getElementById("error_email").innerHTML = "<td>Invalid Email format. Please fix.</td>";
        }
        if (!validatePassword(document.forms["signUpForm"]["password"])) {
           error = true;
           document.getElementById("error_password").innerHTML = "<td>Password too short. Please fix.</td>";
        }
        return !error;
    }
</script>
<form method='POST' name="signUpForm" action='/users/p_signup'>

    <table>
      <tr>
        <td>First Name</td>
        <?php if (isset($first_name)): ?>
            <td><input type='text' name='first_name' value='<?=$first_name?>'></td>
        <?php else: ?>
            <td><input type='text' name='first_name'></td>
        <?php endif; ?>
        <td class="error"><?php if (isset($error_first_name)) echo $error_first_name; ?></td>
        <div class="error" id="error_first_name"></div>
      </tr>
      <tr>
        <td>Last Name</td>
        <?php if (isset($last_name)): ?>
           <td><input type='text' name='last_name' value='<?=$last_name?>'></td>
        <?php else: ?>
            <td><input type='text' name='last_name'></td>
        <?php endif; ?>
        <td class="error"><?php if (isset($error_last_name)) echo $error_last_name; ?></td>
        <div class="error" id="error_last_name"></div>
      </tr>
      <tr>
        <td>Email Address</td>
        <?php if (isset($email)): ?>
           <td><input type='email' name='email' value='<?=$email?>'></td>
        <?php else: ?>
            <td><input type='email' name='email'></td>
        <?php endif; ?>
        <td class="error"><?php if (isset($error_email)) echo $error_email; ?></td>
        <div class="error" id="error_email"></div>
      </tr>
      <tr>
        <td>Password</td>
        <?php if (isset($password)): ?>
           <td><input type='password' name='password' value='<?=$password?>'></td>
        <?php else: ?>
            <td><input type='password' name='password'></td>
        <?php endif; ?>
        <td class="error"><?php if (isset($error_password)) echo $error_password; ?></td>
        <div class="error" id="error_password"></div>
      </tr>
      <tr>
	<!-- <td colspan="3"><input type='submit' onsubmit="validateForm()" value='Sign up'></td> -->
        <td colspan="3"><input type='submit' value='Sign up'></td>
      </tr>
    </table>
</form>
