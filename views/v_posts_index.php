<table id="posttable" border="2">
    <tr>
       <th>Name</th>
       <th>Post</th>
       <th>Time</th>
       <th>Actions</th>
    </tr>
    <?php foreach($posts as $post): ?>
       <tr>
          <td><?=$post['first_name']?> <?=$post['last_name']?></td>
          <td><?=$post['content']?></td>
          <td><?=Time::display($post['created'],'Y/m/d G:i')?></td>
          <td>
             <table>
               <?php if ($post['post_user_id'] == $this_user_id): ?>
                  <tr><td><form method='POST' action='/posts/delete/<?=$post["post_id"]?>'>
                     <input type="submit" value="Delete">
                  </form></td></tr>
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
                      <tr><td colspan="2" background="/images/Like.png"><form method='POST' action='/posts/dislike/<?=$post["post_id"]?>'>
                          <input type="submit" value="Dislike">
                      </form></td></tr>
                      <?php $bgimage = "background='/images/Like.png'"; ?>
                  <?php else: ?>
                      <tr><td colspan="2" background="/images/DisLike.png"><form method='POST' action='/posts/like/<?=$post["post_id"]?>'>
                          <input type="submit" value="Like">
                      </form></td></tr>
                  <?php endif; ?>
                  <tr><td>Rate</td>
                       <td <?=$bgimage?>>
                          <form method='POST' action='/posts/rate/<?=$post["post_id"]?>'>
                          <select name="rating" onchange="this.form.submit()">
                            <option <?php if ($currentrating == 0) echo "selected='selected'";?> value="0">None</option>
                            <option <?php if ($currentrating == 1) echo "selected='selected'";?> value="1">Worst</option>
                            <option <?php if ($currentrating == 2) echo "selected='selected'";?> value="2">Bad</option>
                            <option <?php if ($currentrating == 3) echo "selected='selected'";?> value="3">OK</option>
                            <option <?php if ($currentrating == 4) echo "selected='selected'";?> value="4">Good</option>
                            <option <?php if ($currentrating == 5) echo "selected='selected'";?> value="5">Excellent</option>
                          </select>
                       </form></td>
                   </tr>
               <?php endif; ?>
             </table>
           </td>
       </tr>
    <?php endforeach; ?>
</table>
