<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

        <!== Global JS/CSS includes -->
        <LINK href="/css/main.css" rel="stylesheet" type="text/css">
					
	<!-- Controller Specific JS/CSS -->

        <!== Global JS/CSS head -->
</head>

<body>	
     <table style="width:100%">
        <tr>
           <td><a href='/'>Home</a></td>
           <?php if($user): ?>
              <td><a href='/posts/users'>Change Follow-ers</a></td>
              <td><a href='/posts/'>View Posts</a></td>
              <td><a href='/posts/add'>Add Posts</a></td>
              <td><a href='/users/logout'>Logout</a></td>
           <!-- Menu options for users who are not logged in -->
           <?php else: ?>
              <td><a href='/users/signup'>Signup</a></td>
              <td><a href='/users/login'>Log in</a></td>
           <?php endif; ?>
         </tr>
      </table>
      <?php if (isset($content)) echo $content; ?>
</body>
</html>
