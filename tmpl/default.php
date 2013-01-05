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

<div class="modBGitHubWrap<?php echo $suffix; ?>" <?php if ($params->get('DivSize') > 0): ?> style="width: <?php echo $params->get('DivSize');?>;"<?php endif;?>>
  <div class="CommitWrapper">
<?php
$layout = $params->get('layout', 'default');

if ($layout != '_:default'){
// Load the desired layout
require JModuleHelper::getLayoutPath('mod_bgithub', $layout );

}else{
// Default layout is essentially just the other layouts, all in one as tabs
$document->addScript("modules/mod_bgithub/assets/mod_bgithub.js");

?>
<div class='BGHubTabSwitcher'>
  <ul class='BGHubTabswitch'>
    <li class='BGHubTabSwitch BGHubActitab' id='BGHubCommitsBut' onclick='switchtabs("BGHubCommits","BGHubTabContent","BGHubTabSwitch")'>Commits</li>
    <li class='BGHubTabSwitch' id='BGHubIssuesBut' onclick='switchtabs("BGHubIssues","BGHubTabContent","BGHubTabSwitch")'>Issues</li>
    <li class='BGHubTabSwitch' id='BGHubUserBut' onclick='switchtabs("BGHubUser","BGHubTabContent","BGHubTabSwitch")'><?php echo $owner;?></li>
  </ul>
</div>
<hr />

<div class='BGHubTabContent' id='BGHubCommitsTab'>
<?php require JModuleHelper::getLayoutPath('mod_bgithub', 'Commits' ); ?>
</div>

<div class='BGHubTabContent' id='BGHubIssuesTab' style='display: none;'>
<?php require JModuleHelper::getLayoutPath('mod_bgithub', 'Issues' ); ?>
</div>

<div class='BGHubTabContent' id='BGHubUserTab' style='display: none;'>
<?php require JModuleHelper::getLayoutPath('mod_bgithub', 'User' ); ?>
</div>

<?php
}
// Layout switch ends
?>


  </div>
</div>