<div id="posttable">
  <table>
    <thead>
        <tr>
           <th>Name</th>
           <th>Post</th>
           <th>Time</th>
           <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $post): ?>
       <tr>
          <td><?=$post['first_name']?> <?=$post['last_name']?></td>
          <td><?=$post['content']?></td>
          <td><?=Time::display($post['created'],'Y/m/d G:i')?></td>
          <td>
               <?php if ($post['post_user_id'] == $this_user_id): ?>
                  <form method='POST' action='/posts/delete/<?=$post["post_id"]?>'>
                     <input type="submit" value="Delete">
                  </form> <br/>
               <?php else: ?>
                  <?php $currentlikestatus=1; ?>
                  <?php $currentrating=0; ?>
                  <?php foreach($likes_ratings as $likes): ?>
                       <?php if ($likes['post_id'] == $post['post_id']): ?>
                            <?php $currentlikestatus=$likes['likes']; ?>
                            <?php $currentrating=$likes['rating']; ?>
                       <?php endif; ?>
                  <?php endforeach; ?>
                  <?php if (isset($currentlikestatus) && (($currentlikestatus != 0) && ($currentlikestatus != 1))): ?>
                       <?php $currentlikestatus = 1; ?>
                  <?php endif; ?>
                  <?php if (isset($currentrating) && (($currentrating < 0) || ($currentrating > 5))): ?>
                       <?php $currentrating = 0; ?>
                  <?php endif; ?>
                  <?php $bgimage = "background='/images/DisLike.png'"; ?>
                  <?php if ($currentlikestatus == 1): ?>
                      <form method='POST' action='/posts/dislike/<?=$post["post_id"]?>'>
                          <input type="submit" value="Dislike">
                      </form><br/>
                      <?php $bgimage = "background='/images/Like.png'"; ?>
                  <?php else: ?>
                      <form method='POST' action='/posts/like/<?=$post["post_id"]?>'>
                          <input type="submit" value="Like">
                      </form><br />
                  <?php endif; ?>
                  Rate
                          <form method='POST' action='/posts/rate/<?=$post["post_id"]?>'>
                          <select name="rating" onchange="this.form.submit()">
                            <option <?php if ($currentrating == 0) echo "selected='selected'";?> value="0">None</option>
                            <option <?php if ($currentrating == 1) echo "selected='selected'";?> value="1">Worst</option>
                            <option <?php if ($currentrating == 2) echo "selected='selected'";?> value="2">Bad</option>
                            <option <?php if ($currentrating == 3) echo "selected='selected'";?> value="3">OK</option>
                            <option <?php if ($currentrating == 4) echo "selected='selected'";?> value="4">Good</option>
                            <option <?php if ($currentrating == 5) echo "selected='selected'";?> value="5">Excellent</option>
                          </select>
                       </form>
               <?php endif; ?>
           </td>
       </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
   var dable = new Dable("posttable");
</script>
   
<p>
   <a href="http://jigsaw.w3.org/css-validator/check/referer">
      <img style="border:0;width:88px;height:31px"
           src="http://jigsaw.w3.org/css-validator/images/vcss"
           alt="Valid CSS!" />
   </a>
   <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fp2.twclak.biz%2Fposts%2F">
      <img style="border:0;width:88px;height:31px"
           src="/images/HTML5_Logo_512.png"
           alt="Valid HTML5!" />
   </a>
</p> 

