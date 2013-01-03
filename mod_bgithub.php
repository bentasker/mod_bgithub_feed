<?php
/**
 * @subpackage	mod_bgithub
 * @copyright	Copyright (C) 2013 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */



// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

//$params->def('greeting', 1);


$github = new modBGitHubHelper;
$github->setparams($params);


$document =& JFactory::getDocument();
$document->addStyleSheet("modules/mod_bgithub/assets/mod_bgithub-". $params->get('Style') .".css");


$dateformat = $params->get('DateFormat');
$displayimg = $params->get('CommitImg');
$owner = $params->get('Owner');
$repo = $params->get('repo');
$dispcount = $params->get('DispRecords');
$dispCommitter = $params->get('DispCommitter');
$suffix = $params->get('ClssSuffix');


require JModuleHelper::getLayoutPath('mod_bgithub', $params->get('layout', 'Commits'));