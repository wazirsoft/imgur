<?php

/**
*
* Script para Upload no imgur.com
*
* Esse script tem como função fazer o upload de uma imagem
* E para isso ele usar o site imgur.com como hospedagem
*
* Script to Upload on imgur.com
*
* This script has the function to upload an image
* And for that it uses the site imgur.com as hosting
* 
* @author Gildásio Júnior
* @link gildasio.net
*
**/

function upload($img){
	$ch = curl_init();
	$data = array(
		'Filedata' => "@$img"
	);
	curl_setopt($ch,CURLOPT_URL,'http://imgur.com/upload');
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$up = curl_exec($ch);
	curl_close($ch);

	preg_match("/\"success\":(.*?),\"status\"/i",$up,$ok);

	if($ok[1] === 'true'){
		preg_match("/hashes\":\[\"(.*?)\"\],\"hash/i",$up,$link);
		$link = 'Link of image: http://imgur.com/'.$link[1];
		return $link;
	}
	elseif($ok[1] === 'false'){
		$erro = 'An error occurred, please try again later.';
		$erro = $erro."\n";
		$erro = $erro.'Or report in gildasio.net';
		return $erro;
	}
	else{
		$erro = 'An error occurred, please try again later.';
		$erro = $erro."\n";
		$erro = $erro.'Or report in gildasio.net';
		return $erro;
	}
}

if((count($argv) != 2) || !(is_file($argv[1])) || !(file_exists($argv[1]))){
	echo "\nScript by Gildasio Junior";
	echo "\nSee more in gildasio.net";
	echo "\n\n";
	echo "Use: php $argv[0] [an imagem location]";
	echo "\n\n";
	exit;
}

echo "\nScript by Gildasio Junior";
echo "\nSee more in gildasio.net";
echo "\n\n";
echo upload($argv[1])."\n\n";

?>
