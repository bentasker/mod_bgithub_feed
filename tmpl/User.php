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

$userrepos = $github->getUsersRepos($owner);



?>

<div class="modBGitHubWrap<?php echo $suffix; ?>"

<?php if ($params->get('DivSize') > 0): ?>
 style="width: <?php echo $params->get('DivSize');?>;"
<?php endif;?>

>

<?php //print_r($github->getIssues()); ?>


<div class="CommitWrapper">
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
      <td colspan="3" class='GHubUser GHubCell'> <a href='<?php echo $url;?>' target=_blank><?php echo $owner;?></a> on GitHub</td>
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

   </tbody>

</table>





<?php




$X = 0;

foreach ($commits as $commit){

if ($X == $dispcount){ break; }

//print_r($commit);
//echo "<br /><br />\n\n\n\n";

$text = $commit->commit->message;

$url = "https://github.com/$owner/$repo/commit/{$commit->sha}";
$curl = "https://github.com/$owner/$repo/tree/{$commit->sha}";

$author = $commit->committer->login;
$authorurl = "https://github.com/$author";
$cdate = date($dateformat,strtotime($commit->commit->committer->date));

$gravatar = "<img class='bGitHubGravatar' src='{$commit->committer->avatar_url}'>";

$cno = substr($commit->sha,0,10);


?>
<li class="commit" id="commit<?php echo $X;?>" 
>

<div class="indCommitwrap">

  <?php if ($displayimg):?>
      <div class='commitGrav'><?php echo $gravatar; ?></div>
  <?php endif; ?>

  <div class="commitcontent">
    <div class="committext" id="CommitText<?php echo $X;?>">
      <?php echo $text; ?><br />
	<?php if ($dispCommitter):?>
	    <a class='commitAuthor' target=_blank href="<?php echo $authorurl;?>"><?php echo $author; ?></a>
	<?php endif; ?>
      - <span class='CommitDate'><?php echo $cdate; ?></span>
    </div>
  </div>


  <div class='commitPos'>

      <div class='commitButton'>
	<a href='<?php echo $url; ?>' target=_blank class='commitLink'><?php echo $cno;?></a>
      </div>

      <a class='commitTree' href='<?php echo $curl;?>' target=_blank>Browse Code</a>
  </div>


</div>
</li>

<?php
$X++;
}



?>



</div>



</div>
