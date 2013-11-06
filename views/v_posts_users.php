<table>
<?php foreach($users as $user): ?>
  <?php if(isset($user['first_name'])): ?>
    <tr>
       <td>
          <?php if(isset($connections[$user['user_id']])): ?>
              <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
          <?php else: ?>
              <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
          <?php endif; ?>
       </td>
       <td>
          <!-- Print this user's name -->
          <?=$user['first_name']?> <?=$user['last_name']?>
       </td>
     </tr>
  <?php endif; ?>
<?php endforeach; ?>
</table>

<p>
   <a href="http://jigsaw.w3.org/css-validator/check/referer">
      <img style="border:0;width:88px;height:31px"
           src="http://jigsaw.w3.org/css-validator/images/vcss"
           alt="Valid CSS!" />
   </a>
   <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fp2.twclak.biz%2Fposts%2Fusers">
      <img style="border:0;width:88px;height:31px"
           src="/images/HTML5_Logo_512.png"
           alt="Valid HTML5!" />
   </a>
</p> 

