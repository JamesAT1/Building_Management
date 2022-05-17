<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineMessageController extends Controller
{
    public function getLineGroup()
    {
        // $accessToken = ""; 
        // $content = file_get_contents('php://input');
        // $arrayJson = json_decode($content, true);
        // $arrayHeader = array();
        // $arrayHeader[] = "Content-Type: application/json";
        // $arrayHeader[] = "Authorization: Bearer {$accessToken}";
        // $message = $arrayJson['events'][0]['message']['text'];
        // if (isset($arrayJson['events'][0]['source']['userId'])) {
        //    $id = $arrayJson['events'][0]['source']['userId'];
        // } else if (isset($arrayJson['events'][0]['source']['groupId'])) {
        //    $id = $arrayJson['events'][0]['source']['groupId'];
        // } else if (isset($arrayJson['events'][0]['source']['room'])) {
        //    $id = $arrayJson['events'][0]['source']['room'];
        // }
        // if ($message == "สวัสดี") {
        //    $arrayPostData['to'] = $id;
        //    $arrayPostData['messages'][0]['type'] = "text";
        //    $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        //    $arrayPostData['messages'][1]['type'] = "sticker";
        //    $arrayPostData['messages'][1]['packageId'] = "2";
        //    $arrayPostData['messages'][1]['stickerId'] = "34";
        //    pushMsg($arrayHeader, $arrayPostData);
        // }
        // function pushMsg($arrayHeader, $arrayPostData)
        // {
        //    $strUrl = "https://api.line.me/v2/bot/message/push";
        //    $ch = curl_init();
        //    curl_setopt($ch, CURLOPT_URL, $strUrl);
        //    curl_setopt($ch, CURLOPT_HEADER, false);
        //    curl_setopt($ch, CURLOPT_POST, true);
        //    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        //    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //    $result = curl_exec($ch);
        //    curl_close($ch);
        // }

        file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
        /*Return HTTP Request 200*/
        http_response_code(200);
        /*Get Data From POST Http Request*/
        $datas = file_get_contents('php://input');
        /*Decode Json From LINE Data Body*/
        $deCode = json_decode($datas, true);


        $replyToken = $deCode['events'][0]['replyToken'];
        $userId = $deCode['events'][0]['source']['userId'];
        $text = $deCode['events'][0]['message']['text'];

        $messages = [];
        $messages['replyToken'] = $replyToken;
        $messages['messages'][0] = getFormatTextMessage("");

        $encodeJson = json_encode($messages);

        $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
        $LINEDatas['token'] = "MUAbBSceAhfWQAwUeoEM0w2ugTYL3oJseYhpyzrZF7CxWA8j00AXMIDn7TR+SH8Rm7T1p+0M6/QSBknNiQPEy/tRRphUm81+rjqF+MI3PEpaKYROycjntA1W0ZPxIIRBkX3/lqeI5VOgpVNl8IdjWgdB04t89/1O/w1cDnyilFU=";

        $results = sentMessage($encodeJson, $LINEDatas);

        /*Return HTTP Request 200*/
        http_response_code(200);

        function getFormatTextMessage($text)
        {
            $datas = [];
            $datas['type'] = 'text';
            $datas['text'] = $text;

            return $datas;
        }

        function sentMessage($encodeJson, $datas)
        {
            $datasReturn = [];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $datas['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $encodeJson,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer " . $datas['token'],
                    "cache-control: no-cache",
                    "content-type: application/json; charset=UTF-8",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $err;
            } else {
                if ($response == "{}") {
                    $datasReturn['result'] = 'S';
                    $datasReturn['message'] = 'Success';
                } else {
                    $datasReturn['result'] = 'E';
                    $datasReturn['message'] = $response;
                }
            }
            return $datasReturn;
        }
    }
}
