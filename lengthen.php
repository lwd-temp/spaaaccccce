<?php
 
//ini_set('display_errors', 0);

$quotes = array('Whats_your_favorite_thing_about_space_Mine_is_space'
,'Space'
,'Gotta_go_to_space_Lady_Lady'
,'Oo_Oo_Oo_Lady_Oo_Lady_Oo_Lets_go_to_space'
,'Space_going_to_space_cant_wait'
,'Space'
,'Space_Trial_Puttin_the_system_on_trial_In_space_Space_system_On_trial_Guilty_Of_being_in_space_Going_to_space_jail'
,'Dad_Im_in_space'
,'Im_proud_of_you_son'
,'Dad_are_you_space'
,'Yes_Now_we_are_a_family_again'
,'Space_space_wanna_go_to_space_yes_please_space_Space_space_Go_to_space'
,'Space_space_wanna_go_to_space'
,'Space_space_going_to_space_oh_boy'
,'Ba_Ba_Ba_ba_ba_Space_Ba_Ba_Ba_ba_ba'
,'Oh_Play_it_cool_Play_it_cool_Here_come_the_space_cops'
,'Help_me_space_cops_Space_cops_help'
,'Going_to_space_going_there_cant_wait_gotta_go_Space_Going'
,'Better_buy_a_telescope_Wanna_see_me_Buy_a_telescope_Gonna_be_in_space'
,'Space_Space'
,'Im_going_to_space'
,'Oh_boy'
,'Yeah_yeah_yeah_okay_okay'
,'Space_Space_Gonna_go_to_space'
,'Space_Space_Go_to_space'
,'Yes_Please_Space'
,'Ba_Ba_Ba_ba_ba_Space'
,'Gonna_be_in_space'
,'Ohhhh_space'
,'Wanna_go_to_space_Space'
,'Lets_go_lets_go_to_space_Lets_go_to_space'
,'I_love_space_Love_space'
,'Atmosphere_Black_holes_Astronauts_Nebulas_Jupiter_The_Big_Dipper'
,'Orbit_Space_orbit_In_my_spacesuit'
,'Space'
,'Ohhh_the_Sun_Im_gonna_meet_the_Sun_Oh_no_Whatll_I_say_Hi_Hi_Sun_Oh_boy'
,'Look_an_eclipse_No_Dont_look'
,'Come_here_space_I_have_a_secret_for_you_No_come_closer'
,'Space_space_wanna_go_to_space'
,'Wanna_go_to_wanna_go_to_space'
,'Space_wanna_go_wanna_go_to_space_wanna_go_to_space'
,'Im_going_to_space'
,'Hey_hey_hey_hey_hey'
,'Hey_Hey_Hey_Hey_Hey_Hey_lady_Lady__Space_Lady_Oh_I_know_I_know_I_know_I_know_I_know_I_know_lets_go_to_space'
,'Oooh_Ooh_Hi_hi_hi_hi_hi_Where_we_going_Where_we_going_Hey_Lady_Where_we_going_Where_we_going_Lets_go_to_space'
,'Lady_I_love_space_I_know_Spell_it_S_P_AACE_Space_Space'
,'I_love_space'
,'Hey_lady_Lady_Im_the_best_Im_the_best_at_space'
,'Oh_oh_oh_oh_Wait_wait_Wait_I_know_I_know_I_know_wait_Space'
,'Wait_wait_wait_wait_I_know_I_know_I_know_Lady_wait_Wait_I_know_Wait_Space'
,'Gotta_go_to_space'
,'Gonna_be_in_space'
,'Oh_oh_oh_ohohohoh_oh_Gotta_go_to_space'
,'Space_Space_Space_Space_Comets_Stars_Galaxies_Orion'
,'Are_we_in_space_yet_Whats_the_holdup_Gotta_go_to_space_Gotta_go_to_SPACE'
,'Going_to_space'
,'Yeah_yeah_yeah_Im_going_Going_to_space'
,'Love_space_Need_to_go_to_space'
,'Space_space_space_Going_Going_there_Okay_I_love_you_space'
,'So_much_space_Need_to_see_it_all'
,'You_are_the_farthest_ever_in_space_Why_me_space_Because_you_are_the_best_Im_the_best_at_space_Yes'
,'Space_Court_For_people_in_space_Judge_space_sun_presiding_Bam_Guilty_Of_being_in_space_Im_in_space'
,'Please_go_to_space'
,'Wanna_go_to_space'
,'Gotta_go_to_space_Yeah_Gotta_go_to_space'
,'Hmmm_Hmmmmmm_Hmm_Hmmmmm_Space'
,'Ohmygodohmygodohmygod_Im_in_space'
,'Space_SPACE'
,'Im_in_space'
,'Where_am_I_Guess_Guess_guess_guess_Im_in_space'
,'Theres_a_star_Theres_another_one_Star_Star_star_star_Star'
,'Getting_bored_of_space'
,'Bam_Bam_bam_bam_Take_that_space'
,'Are_we_in_space'
,'We_are'
,'Oh_oh_oh_This_is_space_Im_in_space'
,'We_made_it_we_made_it_we_made_it_Space'
,'Earth'
,'Wanna_go_to_earth'
,'Wanna_go_to_earth_wanna_go_to_earth_wanna_go_to_earth_wanna_go_to_earth_Wanna_go_to_earth'
,'Wanna_go_home'
,'Wanna_go_home_wanna_go_home_wanna_go_home_wanna_go_home'
,'Earth_earth_earth'
,'Dont_like_space_Dont_like_space'
,'Its_too_big_Too_big_Wanna_go_home_Wanna_go_to_earth'
,'SPAAACCCCCE'
,'SPAAACE'
,'YEEEHAAAAAW');

$url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']);

if(!empty($url_to_shorten) && preg_match('|^https?://|', $url_to_shorten))
{

	require('config.php');

	// check if the client IP is allowed to shorten
	if($_SERVER['REMOTE_ADDR'] != LIMIT_TO_IP)
	{
		die('You are not allowed to shorten URLs with this service.');
	}
	
	// check if the URL is valid
	if(CHECK_URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_to_shorten);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		curl_close($handle);
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404')
		{
			die('Not a valid URL');
		}
	}
	
	// check if the URL has already been shortened
	$already_shortened = mysql_result(mysql_query('SELECT local_url FROM ' . DB_TABLE. ' WHERE long_url="' . mysql_real_escape_string($url_to_shorten) . '"'), 0, 0);
	if(!empty($already_shortened))
	{
		// URL has already been shortened
		$local_url = $already_shortened;
	}
	else
	{
		// URL not in database, insert
		$local_url = getLocalURL($quotes);
		mysql_query('LOCK TABLES ' . DB_TABLE . ' WRITE;');
		mysql_query('INSERT INTO ' . DB_TABLE . ' (long_url, created, creator, local_url) VALUES ("' . mysql_real_escape_string($url_to_shorten) . '", "' . time() . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '", "' . $local_url . '")');
		mysql_query('UNLOCK TABLES');
	}
	echo BASE_HREF . $local_url;
}

function getLocalURL ($array)
{
	$keys = array_rand($array, 3);
	$str = $array[$keys[0]].'_'.$array[$keys[1]].'_'.$array[$keys[2]];
	return $str;
}

function stringToArray($s)
{
    $r = array();
    for($i=0; $i<strlen($s); $i++) 
         $r[$i] = $s[$i];
    return $r;
}

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer] . $out;
}