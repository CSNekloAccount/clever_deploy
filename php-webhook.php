<?php
/** 
  * This script is for easily deploying updates to Github repos to your local server
  * 
  * INSTRUCTIONS:
  * 1. Edit the variables below
  * 2. Upload this script to your server somewhere it can be publicly accessed
  * 3. Make sure the apache user owns this script (e.g., sudo chown www-data:www-data webhook.php)
  * 4. (optional) If the repo already exists on the server, make sure the same apache user from step 3 also owns that directory (e.g., sudo chown -R www-data:www-data)
  *
**/

// Set Variables
$LOCAL_ROOT         = "/path/to/repo/parent/directory";
$LOCAL_REPO_NAME    = "REPO_NAME";
$LOCAL_REPO         = "{$LOCAL_ROOT}/{$LOCAL_REPO_NAME}";
$REMOTE_REPO        = "git@github.com:username/reponame.git";
$BRANCH     		    = "master";

if ( $_POST['payload'] ) {
  // Only respond to POST requests from Github
  
  if( file_exists($LOCAL_REPO) ) {
    
    // If there is already a repo, just run a git pull to grab the latest changes
    shell_exec("cd {$LOCAL_REPO} && git pull");

    die("done " . mktime());
  } else {
    
    // If the repo does not exist, then clone it into the parent directory
    shell_exec("cd {$LOCAL_ROOT} && git clone {$REMOTE_REPO}");
    
    die("done " . mktime());
  }
}

?>