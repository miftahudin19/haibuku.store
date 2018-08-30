<div class="wrapper">
    <div class="user_details column">
      <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic'] ?>"> </a>
      <div class="user_details_left_right">
        <p class="info">Nama&nbsp;Lengakap&nbsp;:&nbsp;<?php echo $user['first_name'] . "&nbsp;" . $user['last_name'];?></p><br>
        <p class="info">Username&nbsp;:&nbsp;<?php echo $user['username'];?></p><br>
        <p class="info">Alamat&nbsp;Email&nbsp;:&nbsp;<?php echo $user['email'];?></p><br>
        <p class="info"> <?php echo $user['signup_date'];?></p><br>
        <?php //echo "Posts: " . $user['num_posts']. "<br>";
        //echo "Likes: " . $user['num_likes'];
        ?>
      </div>  
    </div>
    
  </div>