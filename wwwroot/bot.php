<?php
/*
copyright @ medantechno.com
2017

*/

require_once('./line_class.php');

$channelAccessToken = 'z+JmaCop1/xi2EH1nhMoCEL44QcdBArVFhD5F6zgama2Bj4jFGwY3AAYfn2e6pYngKqjno7uJrob7W9rNRCC4pEtYWt9K9m6+763kzG9re1BloutMByHRybjtb7bsDUSHFIESNSlWQG85s9gVrGJtQdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = 'c50941ed7afdec174808ef73c5df5c93';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

//var_dump($client->parseEvents());



//$_SESSION['userId']=$client->parseEvents()[0]['source']['userId'];

/*
{
  "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
  "type": "message",
  "timestamp": 1462629479859,
  "source": {
    "type": "user",
    "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
  },
  "message": {
    "id": "325708",
    "type": "text",
    "text": "Hello, world"
  }
}
*/


$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];


$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = $message['text'];



//pesan bergambar
if($message['type']=='text')
{
	if($pesan_datang=='!ochi')
	{
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo '.$profil->displayName.', bot dibuat oleh ochi darma putra'
									)
							)
						);
				
	}
	else
	if($pesan_datang=='!spesial')
	{
		$get_sub = array();
		$aa =   array(
						'type' => 'image',									
						'originalContentUrl' => 'https://puu.sh/wG3fD.PNG',
						'previewImageUrl' => 'https://puu.sh/wG3fD.PNG'	
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'image',									
									'originalContentUrl' => 'https://puu.sh/wG5Bw.PNG',
									'previewImageUrl' => 'https://puu.sh/wG5Bw.PNG'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
		/*
		$alt = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Anda memilih menu 2, harusnya gambar muncul.'
									)
							)
						);
		*/
		//$client->replyMessage($alt);
	}
	else
	if($pesan_datang=='!lokasi')
	{
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'location',					
										'title' => 'Desa Pandak Gede, BTN Luhur Damai Blok K nomor 7, Kediri, Tabanan, Bali',					
										'address' => 'Bali',					
										'latitude' => '-8.5838915',					
										'longitude' => '115.1218289' 
									)
							)
						);
	}
}
else if($message['type']=='sticker')
{	
	$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Terimakasih stikernya... '										
									
									)
							)
						);
						
}
 
$result =  json_encode($balas);
//$result = ob_get_clean();

file_put_contents('./balasan.json',$result);


$client->replyMessage($balas);

