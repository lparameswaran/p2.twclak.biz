<div id='index'>
   <div id="heading"> Welcome to <span id="appname"><?=APP_NAME?></span><?php if($user) echo ', '.$user->first_name; ?> </div>
   <div id="blogdescr"><span id="appname"><?=APP_NAME?></span> is a simple micro-blogging platform which lets you connect with your family and friends. We hope you enjoy this site and more importantly your interactions with your loved ones. Some samples are included from sample personalities.</div>
   <table id="addlfeatures" border="1">
      <tr> <th> +1 features </th> </tr>
      <tr> <td> Like/Unlike posts </td> </tr>
      <tr> <td> Rating of posts </td> </tr>
      <tr> <td> Delete own posts </td> </tr>
      <tr> <td> (Javascript) Table searching/pagination/sorting </td> </tr>
   </table>
   <div id="blogfooter"><span id="appname"><?=APP_NAME?></span> has been developed by Lakshman Parameswaran for CSCIE15, Harvard University, Fall 2013 - Professor Susan Buck </div>
   <?php $included = 3; ?>
</div>

