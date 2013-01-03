<?php
/**
 * @subpackage	mod_btwitter
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */




// no direct access
defined('_JEXEC') or die;

class modBGitHubHelper
{
	
function setparams($params){
$this->params = $params;
}






function getCommits(){

$branch = $this->params->get('Branch');
$owner = $this->params->get('Owner');
$repo = $this->params->get('repo');
$stat = "?sha=$branch";



$uri = "https://api.github.com/repos/$owner/$repo/commits$stat";

$type = 'commits'.$owner.$repo.$branch;

return $this->getData($uri,$type);


}



function getUsersRepos($user){

$uri = "https://api.github.com/users/$user/repos";
$type = 'userrepos-'.$user;
return $this->getData($uri,$type);
}




function getUser($user){
$uri = "https://api.github.com/users/$user";
$type="user-".$user;
return $this->getData($uri,$type);
}




function getIssues($status = 'open',$sort='updated',$dir='desc',$labels = null){

$owner = $this->params->get('Owner');
$repo = $this->params->get('repo');
$stat = '';



$stat = "?state=$status&sort=$sort&direction=$dir";

if (!empty($labels)){
$stat .= "&labels=$labels";
}



$uri = "https://api.github.com/repos/$owner/$repo/issues$stat";
$type = 'issues_'.$owner.$repo.$status.$sort.$dir."_labels-".str_replace(",","",$labels);

return $this->getData($uri,$type);
}




function getData($uri,$type){


$cachetime = $this->params->get('shortcache');
if ($this->params->get('CachingEnabled')){
// Get the config object from factory
        $conf =& JFactory::getConfig();
        // Get the current cachetime value
        $oldcachetime = $conf->getValue('config.cachetime');
        
	
	// Set the cache time to 30 mins 
        $conf->setValue('config.cachetime', $cachetime);
	



        // Get the Cache object
        $cache =& JFactory::getCache('mod_bgithub_'.$type, 'output');
        // Enable caching (if disabled in global configuration)
        $cache->setCaching( 1 );
        // Try to get the results from cache


    if (!($json = $cache->get('mod_bgithub_'.$type."_json"))) {
                                   
            if ($json = $this->place_request($uri)) {
                // Store the data in cache
                if (!$cache->store($json, 'mod_bgithub_'.$type."_json")) {
                    // If storing in cache failed then we will return the error
                    $error = 'cache';
                }
            } else {
                $error = 'Could not retrieve';
            }
        }


// Reset the cachetime
$conf->setValue('config.cachetime', $oldcachetime);

return $json;

    }else{
// Caching Disabled, just place the request
return $this->place_request($uri);
    }


}





function place_request($uri){


unset($this->result);

// Check whether we can use File or if we need to resort to Curl
if (ini_get('allow_url_fopen')){
$results = implode("",$this->placefilerequest($uri));
}else{
$results = $this->placecurlrequest($uri);

}





$this->result = json_decode($results);

return $this->result;
}








function placefilerequest($uri){
$results = file("$uri");


return $results;
}


function placecurlrequest($uri){
 $ch = curl_init("$uri");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    $data = curl_exec($ch);
 
    curl_close($ch);

return $data;
}


}
