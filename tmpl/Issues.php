<?php
/**
 * @subpackage	mod_bgithub
 * @copyright	Copyright (C) 2013 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

$dispcount = $params->get('DispRecords');
$dispCommitter = $params->get('DispCommitter');


?>




<?php

$issues = $github->getIssues($params->get('IssueStatus'),$params->get('IssueSort'),$params->get('IssueOrder'),$params->get('IssueLabels'));


$X = 0;


foreach ($issues as $issue){

if ($X == $dispcount){ break; }


$title = str_replace("'","&apos;",htmlspecialchars($issue->title));



$issueno = $issue->number;
$url = $issue->html_url;
$created = date($dateformat,strtotime($issue->created_at));
$status = $issue->state;
$label = $issue->labels[0]->name;
$body = str_replace("'","&apos;",htmlspecialchars($issue->body));
$creator = $issue->user->login;
$creatorurl = "http://github.com/$creator";

$gravatar = "<img class='bGitHubGravatar' src='{$issue->user->avatar_url}'>";

?>
<li class="commit" id="commit<?php echo $X;?>" 
>

<div class="indCommitwrap">

  <?php if ($displayimg):?>
      <div class='commitGrav'><?php echo $gravatar; ?></div>
  <?php endif; ?>

  <div class="commitcontent">
    <div class="committext" id="CommitText<?php echo $X;?>">
      <span class='issueNo'>#<?php echo $issueno;?></span> <a class='IssueURL' id='BGitHubIssueUrl<?php echo $X; ?>' title='<h3>Issue #<?php echo $issueno;?> - <?php echo $title;?></h3><?php echo $body; ?>' href='<?php echo $url; ?>'><?php echo $title; ?></a><br />
	<div class='issueDets'>
	<?php if ($dispCommitter):?>
	    by <a class='commitAuthor' target=_blank href="<?php echo $creatorurl;?>"><?php echo $creator; ?></a>
	<?php endif; ?>

      <span class='CommitDate'><?php echo $created; ?></span>
      </div>
    </div>
  </div>


  <div class='issuePos'>

      <div class='issueType issueType<?php echo str_replace(" ","",$label); ?>'>
	<?php echo $label;?>
      </div>


      
  </div>
<div class='issueStatus IssStatus<?php echo $status; ?>'><?php echo $status; ?></div>

</div>
</li>

<?php

// Add the tooltip
JHTML::_('behavior.tooltip','#BGitHubIssueUrl'.$X,array("className"=>'tool'));

$X++;
}



?>







