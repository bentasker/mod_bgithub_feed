<?php
/**
 * @subpackage	mod_bgithub
 * @copyright	Copyright (C) 2013 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');





?>

<div class="modBGitHubWrap<?php echo $suffix; ?>"

<?php if ($params->get('DivSize') > 0): ?>
 style="width: <?php echo $params->get('DivSize');?>;"
<?php endif;?>

>

<?php //print_r($github->getIssues()); ?>


<div class="CommitWrapper">
<?php

$commits = $github->getCommits();
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
