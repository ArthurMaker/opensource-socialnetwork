<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */

	   $image = $params['image'];
?>
<div class="activity-item" id="activity-item-<?php echo $params['post']->guid;?>">
   <div class="activity-item-container">
      <div class="owner">
       <img src="<?php echo ossn_site_url();?>avatar/<?php echo $params['user']->username;?>/small" width="40" height="40" />
      </div>
      <div class="post-controls">
         <?php 
		     if(ossn_is_hook('wall', 'post:menu')){
			   $menu['post'] = $params['post'];	 
	           echo ossn_call_hook('wall', 'post:menu', $menu); 
            }
		?>	
     </div>  
      <div class="subject">
            <?php if($params['user']->guid == $params['post']->owner_guid){ ?>
             <a class="owner-link" href="<?php echo ossn_site_url("u/{$params['user']->username}");?>"> <?php echo $params['user']->fullname;?> </a> 
             <?Php } else { 
			 
			  $owner = ossn_user_by_guid($params['post']->owner_guid);
			 ?>
             <a class="owner-link" href="<?php echo ossn_site_url("u/{$params['user']->username}");?>"> <?php echo $params['user']->fullname;?></a> <div class="ossn-wall-on ossn-posted-on"></div> <a class="owner-link" href="<?php echo ossn_site_url("u/{$owner->username}");?>"> <?php echo $owner->fullname;?></a>              
             <?php } ?>
             <br />
             <div class="time"> <?php echo ossn_user_friendly_time($params['post']->time_created);?>   <?php echo $params['location'];?> - <div class="ossn-inline-table ossn-icon-access-<?php echo $params['post']->access; ?>"></div></div>
      </div>
      <div class="description">
         <div class="post-text"><?php echo stripslashes($params['text']); ?> 
                <?php 
	  if(is_array($params['friends']) && !empty($params['friends'][0])){ ?>
      <div class="friends">
        &#x2014; with
       <?php 
	   foreach($params['friends'] as $friend){
		      $user = ossn_user_by_guid($friend);
			  $url =  ossn_site_url("u/{$user->username}");
			  $friends[] = "<a href='{$url}'>{$user->fullname}</a>";
	   }
	    echo implode(', ', $friends);
	   ?>
       </div>
       <?php } ?>
         
         
         </div>

      <?php 
		   if(!empty($image)){ ?>
              <img src="<?php echo ossn_site_url("post/photo/{$params['post']->guid}/{$image}");?>" />
           
       <?php  } ?>
       
      
      </div>
      </div>
   <div class="comments-likes">
    <?php
	 if(ossn_is_hook('post', 'likes')){
	 echo ossn_call_hook('post', 'likes', $params['post']); 
     }
	?>   
    <div class="comments-item" style="border-bottom:1px solid #ddd;">    
     <?php 
    if(ossn_is_hook('post', 'comments')){
	 echo ossn_call_hook('post', 'comments', $params['post']); 
     }
	?>
    </div>       
    </div>
 </div>
