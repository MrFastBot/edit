
<?php
ob_start();
define('API_KEY','273817593:AAENji6GmIyTOGw-XruxUfyqCIjazcvwI7w');
$admin = "239607076";
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$file_o = __DIR__.'/users/'.$mid.'.json';
file_put_contents($file_o,json_encode($update->message->text));
chmod($file_o,0777);
if (isset($update->edited_message)){
  //$chat_id1 = $editm->chat->id;
  $eid = $editm->message_id;
  $edname = $editm->from->first_name;
  $jsu = json_decode(file_get_contents(__DIR__.'/users/'.$eid.'.json'));
  $text = "<i>Dear </i><b>".$edname."</b>\n<code>I Saw What You Said</code>
<i>You Said</i>:
<b>".$jsu."</b>";
  $id = $update->edited_message->chat->id;
  bot('sendmessage',[
    'chat_id'=>$id,
    'reply_to_message_id'=>$eid,
    'text'=>$text,
    'parse_mode'=>'html'
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Add To Group','url'=>'https://telegram.me/DoNotEditBot?startgroup=new']
        ],
        [
          ['text'=>'Admin','text_2'=>'@IcePoker']
        ]
      ]
    ])
  ]);
  $file_o = __DIR__.'/users/'.$eid.'.json';
  file_put_contents($file_o,json_encode($update->edited_message->text));
  //$up = file_get_contents(__DIR__.'/users/'.$eid.'.json');
  //str_replace("edited_message","message",$up);
}elseif(preg_match('/^\/([Ss]tart)/',$text1)){
  $text = "<b>Hi,</b>\n<i>Welcome To Don't Edit Bot</i>";
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'Ice Poker','url'=>'https://telegram.me/IcePoker']
        ],
        [
          ['text'=>'Add To Group','url'=>'https://telegram.me/DoNotEditBot?startgroup=new']
        ]
      ]
    ])
  ]);
}elseif( $fadmin == $admin |  $fadmin == $admin2 and $update->message->text == '/stats'){
    $txtt = file_get_contents('member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
  bot('sendMessage',[
      'chat_id'=>$chat_id,     
      'parse_mode'=>'html',
      'text'=>"<code>Users:</code> \n<b>$mmemcount</b>"
    ]);
}elseif(isset($update->message-> new_chat_member )){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      'parse_mode'=>'html',
      'text'=>"<i>Welcome To </i><b>Group</b>!"
    ]);
}
  
  
  
  
  
  
  
$txxt = file_get_contents('member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('member.txt');
      $aaddd .= $chat_id."\n";
      file_put_contents('member.txt',$aaddd);
    }
