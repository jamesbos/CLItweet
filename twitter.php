#!/usr/bin/php
<?php

//load out OAuth stuff
require_once('twitteroauth/twitteroauth.php');

//clear the terminal
echo exec('clear');

//some pretty timer for echoing banner
function sleepTime() {
	time_nanosleep(0, 100000000);
}

//our main twitter function
function tweettweet($thisMsg) {
	//set our keys
	$consumerKey = 'w9Udk8K5apLSgIa4nleVXA';
	$consumerSecret = 'X7BEo4DyBErE1MJ7AbZiHDtVQ6LZuau9jtIX6K6mnk';
	$oAuthToken = '34503580-i3jOGQnVp3F406hFpqOFV5oZEAMVDj5RFVJkALCCs';
	$oAuthSecret = 'Xsf9bmayGlJoCFHrK3wmhHbhNmVKbSMA1mBkryaRm4';
	//declare our tweet mech
	$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
	//echo nice sending msg
	echo "Sending...";
	//send a tweet
	$tweet->post('statuses/update', array('status' => $thisMsg));
	//echo confirmation msg	
	echo "Sent!\n";
}

//start STDIN function
function tweetFunction(){
	echo "Enter your tweet:";
	$msg = fgets(STDIN);
	$checkLen = strlen($msg);
			
		if($checkLen > 2) { 
				echo "Your tweet is too long, try again?:";
					$checkMsg = fgets(STDIN);
						if($checkMsg = 'y') 
							{ 
								tweetFunction(); 
							} 
							else 
								{	
									exit();
								}
			} 
			
			else 
				{
				// Tweet our message
				echo $msg;
				//tweettweet($msg);
				}
		return $msg;
		return $checkMsg;
}

function helpMsg() {
echo "+++++++++CLItweet PHP+++++++++\n";
echo "+Command Line Interface tweet+\n";
echo "+Coded by james@jamesbos.com +\n";
echo "+   Licensed under GPL v2    +\n";
echo "++++++++++++++++++++++++++++++\n";
echo "usage:\n\n"; 
echo "clitweet -s [your text] (send directly from CLI)\n";
echo "         -h (help message you're looking at!)\n";
echo "         -U (send your PC uptime)\n";
echo "         -D (send your dist info eg. uname -a)\n";
echo "Remeber to use escape characters when using qoutes\n"; 
echo "and other special chars eg. \' \& etc";
echo "You can also also enclose your entire tweet around\n";
echo "double qoutes\n"; 
}

function banner() {
	//echo out our welcome message
	echo "*************************\n";
	sleepTime();
	echo "**TWITTER UPDATE CLIENT**\n";
	sleepTime();
	echo "**e. james@jamesbos.com**\n";
	sleepTime();
	echo "**w. www.jamesbos.com****\n";
	sleepTime();
	echo "*************************\n";
	echo "\n";
}


$array = $_SERVER['argv'];

function makestring($array)
        {
        $outval = "";
        foreach ($array as $k=>$v)
                {
                if (2 > $k) continue; 
                if(is_array($v)) 
                {
                        $outval .= makestring($v);
                }
        else 
                {
                        $outval .= "$v ";
                }
        } 
return $outval;
}

$cliMsg = makestring($array);
$tweetUptime = exec('uptime');
	
	//declare our command line arguements
	$option = $_SERVER['argv'][1];
	if ($option == '-h') { helpMsg(); exit(); } 
	if ($option == '-s') { tweettweet($cliMsg); exit(); }
	if ($option == '-U') { tweettweet($tweetUptime); exit(); }
	//start with our banner
	banner();
	//start reading our tweet	
	tweetFunction();
	
?>

