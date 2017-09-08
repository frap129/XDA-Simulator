<?php
/*
REQUIREMENTS
* A custom slash command on a Slack team
* A web server running PHP5
USAGE
* Place this script on a server running PHP5 with cURL.
* Set up a new custom slash command on your Slack team: 
  http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for 
  the command. /xda is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the 
  autocomplete list for slash commands.
* If you do, enter a short description and usage hint.
*/
# Grab some of the values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$token = $_POST['token'];
$text = $_POST['text'];
# Check the token and make sure the request is from our team 
if($token != 'S13kr23oqMAUvTaLn0cD1oDe'){ #replace this with the token from your slash command configuration page
  $msg = "The token for the slash command doesn't match. Check your script.";
  die($msg);
  echo $msg;
}
$user_agent = "XDASimulator/1.1";
$words = array( "voltez", "does", "no", "not", "thinks", "dev", "sir", "pls",
	       "jiosim", "rom", "bro", "carbin", "kernal", "voLte", "broke",
	       "work", "good", "bad", "neeed", "it", "its", "other",
	       "legend rom", "linage", "rr", "pocketmode", "oxygen oos camera" );
if (!empty($text)) {
	$words[] = $text;
}
$size = rand(2, 10);
$reply = "";
for ($i = 0; $i < $size; $i++) {
	$reply .= $words[array_rand($words, 1)];
	$reply .= " ";
}

# Encode response in JSON
$data = array(
	response_type => in_channel,
    text => $reply
);

header('Content-type:application/json');
$message = json_encode($data);

# Send the reply back to the user. 
echo $message;
