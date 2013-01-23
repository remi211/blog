<?php 
$loggedUserEmail = $this->Session->read('Auth.User.email');
$loggedUserId = $this->Session->read('Auth.User.id');
?>

<div class="navbar-inner">
    <div class="container">
      
        <ul >
          <li id="fat-menu" class="dropdown">
            <a href="#" class="" data-toggle=""><i class="icon-user icon-white"></i> <?php echo $loggedUserEmail ?><b class="caret"></b></a>
            <ul class="">
              <li><a href="<?php echo $this->Html->url('/posts/archives/'); ?>"><i class="icon-pencil icon-black"></i> Manage Blogs</a></li>
              <li><a href="<?php echo $this->Html->url('/playlists/archives/'); ?>"><i class="icon-pencil icon-black"></i> Manage Playlist</a></li>
              <li><a href="<?php echo $this->Html->url('/images/index/'); ?>"><i class="icon-pencil icon-black"></i> Manage Images</a></li>      
              <li><a href="<?php echo $this->Html->url('/videos/index/'); ?>"><i class="icon-pencil icon-black"></i> Manage Videos</a></li>      
              <li><a href="<?php echo $this->Html->url('/users/edit/'.$loggedUserId); ?>"><i class="icon-user icon-black"></i> Edit your info</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url('/users/'); ?>"><i class="icon-user icon-black"></i> Manage users</a></li>
              <li><a href="<?php echo $this->Html->url('/settings/'); ?>"><i class="icon-cog icon-black"></i> Edit settings</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url('/settings/clearCache/'); ?>"><i class="icon-trash icon-black"></i> Clear all cache</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url('/users/logout/'); ?>"><i class=" icon-off icon-black"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
    </div>
</div>