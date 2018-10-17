<?php

require_once('./line_class.php');

$channelAccessToken = 'ekoS3czNUVhCtyE0w8VOoOJqIF2RJvzdTmV4nxomwm4X7hhjkAM4iE+SffmtWVR/kjMtof1p5SKOH03rTEenT2UvziLYfowfK3xBkt/orPAQB8Fi+jVOJOVwcAyfKBqOix+VVSxgvY/x0Q6wjm9TLQdB04t89/1O/w1cDnyilFU='; //Your Channel Access Token
$channelSecret = '536034f91a81a37d4331209cf4adbb0a';//Your Channel Secret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];

//$mention = substr($pesan_datang, 0, 4);

$mention = strtok($pesan_datang, ' ');

if($message['type'] == 'text'){
	if(strcasecmp($mention, 'susu') == 0){
		$pesan_datang = substr($pesan_datang, 5);
		
		exec("node index.js $pesan_datang", $output);
		$diterima = $output[0];

		$balas = array(
							'UserID' => $profil->userId,
                            'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);

		$result =  json_encode($balas);

		file_put_contents('./reply.json',$result);


		$client->replyMessage($balas);
	}elseif (strcasecmp($mention, 'apakah') == 0) {
		
		if(mt_rand(0,1) == 0) {
			$diterima = 'Iya';
		}else{
			$diterima = 'Tidak';
		}


		$balas = array(
							'UserID' => $profil->userId,
                            'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);

		$result =  json_encode($balas);

		file_put_contents('./reply.json',$result);


		$client->replyMessage($balas);
	}
}

//if ($message['type'] == 'text' && ($mention == 'susu' || $mention == 'Susu' || $mention == 'SUSU')) {
	
	// $pesan=str_replace(" ", "%20", $pesan_datang);
	// $key = '2292d3a1-d850-461a-bd49-20298c4fd6f8'; //API SimSimi
	// $url = 'http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=id&ft=1.0&text='.$pesan;
	// $json_data = file_get_contents($url);
	// $url=json_decode($json_data,1);
	// $diterima = $url['response'];

	

	/*exec("node index.js $pesan_datang", $output);
	$diterima = $output[0];

	$balas = array(
							'UserID' => $profil->userId,
                            'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);

	$result =  json_encode($balas);

	file_put_contents('./reply.json',$result);


	$client->replyMessage($balas);*/
//}