<?php

date_default_timezone_set('Asia/Tehran');

ob_start();

error_reporting(0);

require_once 'functions.php';

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/

$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
    if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
}
if(!$ok){
exit(header("location: https://t.me/DevMrErfi"));
}

$token = '7188864301:AAHjK1cMnSg4HuoHbkXnWB3a5qKJy1hcC3k'; /// توکن ربات

$admin = '6615486839'; /// آیدی عددی ادمین
$userbot = "IdHash_Bot";  ///// آیدی ربات بدون @
define('API_KEY', $token);
define('GROUPS_FILE', 'groups.json');
define('ADMIN_STATE_FILE', 'admin_state.json');

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/

#-----------------------------#


$update = json_decode(file_get_contents("php://input"));
if(isset($update->message)){
    $message = "message";
    $forward_chat_username = $update->message->forward_from_chat->username;
$username = $message->from->username;
$username = $update->message->from->username;
$message = $update->message;
    $from_id    = $update->message->from->id;
    $chat_id    = $update->message->chat->id;
    $tc         = $update->message->chat->type;
    $text       = $update->message->text;
    $first_name = $update->message->from->first_name;
    $message_id = $update->message->message_id;
}elseif (isset($update->inline_query)) {
    $from_id = $update->inline_query->from->id;
    $inline_query_id = $update->inline_query->id;
    
    $query = $update->inline_query->query;
}elseif(isset($update->callback_query)){
    $chat_id    = $update->callback_query->message->chat->id;
    $data       = $update->callback_query->data;
    $query_id   = $update->callback_query->id;
    $message_id = $update->callback_query->message->message_id;
    $in_text    = $update->callback_query->message->text;
    $from_id    = $update->callback_query->from->id;
}





function get($url){
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

return $response;
}

if(!is_dir('data')){
    mkdir('data');
}
if(!is_dir("data/$from_id/")){
    mkdir("data/$from_id/");
}




if (isset($update->my_chat_member)) {
    $chat_id = $update->my_chat_member->chat->id;
    $new_status = $update->my_chat_member->new_chat_member->status;
    $old_status = $update->my_chat_member->old_chat_member->status;

if(in_array($old_status,['left','kicked','member'])){
if($new_status == 'member'){
bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "💎 ربات چکر در این گروه اضافه شد!\n\n🔹برای استفاده از قابلیت های بیشتر از منو داخل گروهت ادمین کن\n🔎 @$userbot",
        ]);
        saveGroupId($chat_id);
}elseif($new_status == 'administrator'){
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "*💎 ربات چکر در این گروه ادمین شد!\n\n🔹 برای استعلام هش تراکنش کافیه لینک هش رو بفرستی 📡 \n\n تازه میدونستی میتونی اطلاعات ولت رو هم بگیری؟
برای گرفتن اطلاعات ولت کافیه 
wallet 
رو تایپ کنی و یه فاصله بزاری و بعدش ولت طرف رو بزاری تا من استعلام ولت شو در بیارم و بهت بفرستم / نمونه :*
`wallet TU4qYMK3uGzBUVa7pxRD1EbJHHTKs33Uow`",
            'parse_mode' => "markdown",
        ]);
        saveGroupId($chat_id);
    }
    
}
}

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/


if($text=="/start" and $tc=="private"){
    bot('sendMessage',[
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' =>"*به ربات چکر خوش آمدید \n\n برای استعلام هش تراکنش کافیه لینک هش رو بفرستی 📡 \n\n تازه میدونستی میتونی اطلاعات ولت رو هم بگیری؟
برای گرفتن اطلاعات ولت کافیه 
wallet 
رو تایپ کنی و یه فاصله بزاری و بعدش ولت طرف رو بزاری تا من استعلام ولت شو در بیارم و بهت بفرستم / نمونه :*
`wallet TU4qYMK3uGzBUVa7pxRD1EbJHHTKs33Uow`

*و اینکه منو میتونی به گروه ات هم اضافه کنی*",
        'parse_mode' => "markdown",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> "عضویت در گروه️", 'url' =>"https://t.me/$userbot?startgroup=new"]]
    ]
    
])
        
        ]);
}




if (preg_match('/^https:\/\/tronscan.org\/#\/transaction\/(.*)/', $text, $match2)) {
    $url = 'http://abarmizban.com/ProjecT/API/tronscan/index.php?hash=' . $match2[1];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $apiResponse = curl_exec($ch);
    curl_close($ch);
    
    if ($apiResponse === false) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $message_id,
            'text' => "❌ خطا در دریافت اطلاعات تراکنش.",
            'parse_mode' => "markdown",
        ]);
        return;
    }

    $info_decode = json_decode($apiResponse);
    
    if (isset($info_decode->result)) {
        $result = $info_decode->result;
        
        $hush = $result->tokeninfo->icon ?? 'N/A';
        $symbol = $result->tokeninfo->symbol ?? 'N/A';
        
        $vaziat = $result->contractRet ?? 'نامشخص';
        $amount = $result->amount ?? 'نامشخص';
        $block = $result->block ?? 'نامشخص';
        $from = $result->from ?? 'نامشخص';
        $to = $result->to ?? 'نامشخص';
        $date = $result->date ?? 'نامشخص';
        $time = $result->time ?? 'نامشخص';
        $hash = $result->hash ?? 'نامشخص';


        bot('sendMessage', [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $message_id,
            'text' => "*✅ وضعیت تراکنش : $vaziat

🔍 هش تراکنش :*`$hash`

*📆 تاریخ تراکنش : $date

⏰ ساعت تراکنش : $time

💰 مقدار ترون تراکنش : $amount

📤 ولت مبدا :*`$from`

*📥 ولت مقصد :*`$to`",
            'parse_mode' => "markdown",
        ]);
    } 
}

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/
if (preg_match('/^chart (.*)/', $text, $match2)){
$url = "https://ok-ex.io/trade/chart/usdt?coin=".$match2[1]."&prov=2&interval&hasVolume=true&isFullScreen=true&fullscreenButton=false";
bot('sendMessage',[
 'chat_id' => $chat_id,
'reply_to_message_id' => $message_id ,
'text' => "Link Chart :".$url,
]);
}

if (preg_match('/^نات (.*)/', $text, $match2)){
$mr = json_decode(get("https://sourcearena.ir/api/?token=bbbd947b2003d7516a5d047a0280c53e&crypto_v2=not"),true)["price"];
$data = floatval($mr) * $match2;
bot('sendMessage',[
 'chat_id' => $chat_id,
'reply_to_message_id' => $message_id ,
'text' => "notcoin price :".$data,
]);
}

if (preg_match('/^wallet (.*)/', $text, $match2)) {

 $api = file_get_contents('https://abarmizban.com/ProjecT/API/Tron/tron.php?address=' . $match2[1]);
 $info_decode=json_decode($api);
$balance = $info_decode->balance ?? 'خالی است';



bot('sendMessage',[
 'chat_id' => $chat_id,
'reply_to_message_id' => $message_id ,
'text' => "💎 Mowjudi : $balance",


]);
}


if($chat_id == $admin){

if($text=="/panel"){
    clearAdminState($user_id);
    bot('sendMessage',[
        'chat_id' => $chat_id,
        'text' => "سلام ادمین عزیز \n به پنل مدیریتی خوش آمدید",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'آمار 📊', 'callback_data' =>'amar']],
[['text'=>'📥 پیام همگانی','callback_data'=>"hmg"],['text'=>"📩 فوروارد همگانی",'callback_data'=>"fwd"]],
[['text'=>"ارسال به گروه هایی که عضو است",'callback_data'=>"hmggroups"]],
    ]
    
])
        ]);
}

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/

if($data=="back"){
clearAdminState($user_id);
bot('editMessageText',[
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "سلام ادمین عزیز \n به پنل مدیریتی خوش آمدید",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'آمار 📊', 'callback_data' =>'amar']],
[['text'=>'📥 پیام همگانی','callback_data'=>"hmg"],['text'=>"📩 فوروارد همگانی",'callback_data'=>"fwd"]],
[['text'=>"ارسال به گروه هایی که عضو است",'callback_data'=>"hmggroups"]],

    ]
    
])
        ]);
}

if ($data == "hmggroups") {
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "سلام ادمین عزیز / لطفا پیامی که میخواهید به گپ ها ارسال کنم رو بفرستید",
            'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
        ]);
        saveAdminState($user_id, 'awaiting_message');
    } else {
        $admin_state = getAdminState($user_id);
        if ($admin_state == 'awaiting_message') {
            if (file_exists(GROUPS_FILE)) {
                $groups = json_decode(file_get_contents(GROUPS_FILE), true);
                foreach ($groups as $group_id) {
                    bot('sendMessage', [
                        'chat_id' => $group_id,
                        'text' => $text,
                    ]);
                }
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "پیام شما به تمام گروه‌ها ارسال شد.",
                ]);
            } else {
                bot('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => "هیچ گروهی ذخیره نشده است.",
                ]);
            }
            clearAdminState($user_id);
        }
    }


/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/



if($data=="amar"){
    $scan = scandir('data');
    $amar = count($scan) - 2;
    bot('editMessageText',[
        'chat_id' => $chat_id,
        'message_id' => $message_id ,
        'text'=> "آمار ربات در حال حاضر $amar",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
        ]);
}



if($data == "hmg"){
        bot('editMessageText',[
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        'text'=> "پیام مورد نظر خود را ارسال کنید...", 
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
        ]);
        saveAdminState($user_id, 'send-to-all');

    }
    
    elseif($data == "fwd"){
        bot('editMessageText',[
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        'text'=> "پیام خود را جهت فروارد به تمامی کاربران، به من فروارد کنید...",
        'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
        
        ]);
        saveAdminState($user_id, 'for-to-all');
        
    }

    
    elseif($admin_state == "send-to-all" and $data!="back"){
        
        if($text){
            
            $users_array = scandir('data');
            unset($users_array[0]);
            unset($users_array[1]);
            
            foreach($users_array as $id_to_send){
                
                sendmessage($id_to_send, $text);
                
            }
            
            clearAdminState($user_id);
            bot('sendMessage',[
                'chat_id' => $chat_id,
            'text' => "عملیات ارسال همگانی با موفقیت انجام شد!",
            'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
            ]);
        }else{
            
            sendmessage($from_id, "صزفا میتوانید متن را برای ارسال به کاربران، برای من ارسال کنید.\n\nلطفا مجددا ارسال کنید:");
            
        }
        
    }
    
    elseif($admin_state == "for-to-all" and $data!="back"){
            
        $users_array = scandir('data');
        unset($users_array[0]);
        unset($users_array[1]);
        
        foreach($users_array as $id_to_send){
            
            bot('forwardMessage', [
                'from_chat_id' => $from_id,
                'message_id' => $message_id,
                'chat_id' => $id_to_send
            ]);
            
        }
        
       clearAdminState($user_id);
        bot('sendMessage',[
            'chat_id' =>$chat_id,
            'text' =>" فروارد همگانی با موفقیت انجام شد...",
            'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=> 'برگشت 🔙', 'callback_data' =>'back']],

    ]
    
])
            ]);

    }
    

}

/*
Coded by Erfan RasolPour. @DevMrErfi
Good luck!
*/

?>