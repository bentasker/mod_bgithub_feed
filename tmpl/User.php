<?php
/**
 * @subpackage	mod_bgithub
 * @copyright	Copyright (C) 2013 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

$user = $github->getUser($owner);

if (!$user) { return ; }





?>



<?php

$url = $user->html_url;
$joined = date($params->get('JoinedDate'),strtotime($user->created_at));
$company = $user->company;
$locat = $user->location;
$gravatar = "<img class='bGitHubGravatar' src='{$user->avatar_url}'>";
$blog = $user->blog;



?>

<table class='GHubUserInfo'>
  <tbody>
  <tr>
      
     

      <td colspan="3" class='GHubUser GHubCell'>

<div class='GHubLogo'></div>


<h3><a href='<?php echo $url;?>' target=_blank><?php echo $owner;?></a> on GitHub</h3></td>
  </tr>

  <tr>
      <td class='GHubGrav GHubCell'><?php echo $gravatar; ?></td>
      <td class='GHubJoined GHubCell'>    Joined
	    <div class='GHubJoinedDate GHubContent'>
		<?php echo $joined;?>
	    </div>
      </td>

      <td class='GHubLocation GHubCell'> 
      &nbsp;
	

	    <?php if (!empty($locat)):?>
	    Location
	    <div class='GHubLocationl GHubContent'>
	      <?php echo $locat; ?>
	    </div>
	    <?php endif; ?>
      </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td class='GHubCo GHubCell'> 
	  &nbsp;

	  <?php if (!empty($company)):?>
	      Company
		<div class='GHubCoNme GHubContent'>
		    <?php echo $company; ?>
		</div>
	  <?php endif;?>
      </td>
      <td class='GHubBlog GHubCell'>
	&nbsp;


	<?php if (!empty($blog)):?>
	Blog
	<div class='GHubBlogNme GHubContent'>
	  <a href='<?php echo $blog; ?>' target=_blank><?php echo $blog; ?></a>
	</div>
	<?php endif; ?>
      </td>
  </tr>


  <?php if ($params->get('UserListRepos')): ?>
  <tr class='UserRepos'>
  <td colspan="3"><h3>User's Repositories</h3></td>
  </tr>


  <?php
  $userrepos = $github->getUsersRepos($owner);
  $userrepofilter = $params->get('UserRepoFilter');
  $filt = explode(",",$userrepofilter);

  $X = 0;

  foreach ($userrepos as $repo){

      if ((!empty($userrepofilter)) && ((in_array("!".$repo->name,$filt)))){
      continue;
      }


      if ($X == $dispcount){ break; }

  $reponame = $repo->name;
  $url = $repo->html_url;
  $desc = $repo->description;
  $lang = $repo->language;
  $lastupdate = date( $params->get('RepoDate'), strtotime($repo->updated_at));


  ?>
  <tr class='UserRepo' onclick='window.location.href = "<?php echo $url; ?>";'>
    <td colspan="3">
      <div class='UserRepoNme'>
	  <span class='UserRepoName'><a href='<?php echo $url; ?>' target=_blank><?php echo $reponame; ?></a></span><br />
	  <span class='UserRepoDesc'><?php echo $desc; ?></span><br />
	  <span class='repoupdDate'>Last updated <?php echo $lastupdate;?></span> 
      </div>

      <div class='repoLang'>
      <?php echo $lang; ?>
      </div>
      
    </td>
  </tr>

  <?php


  }


 endif;?>

   </tbody>

</table>






