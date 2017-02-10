<?php
$request = file_get_contents('php://input');;

// log the request
mkdir('/tmp/webcontrol',0777,true);
file_put_contents("/tmp/webcontrol/log",json_encode($request),FILE_APPEND);
header("Content-type: application/json");


$response="Sorry I can't do that yet";
switch ($request['result']['action']) {
        case 'play.music':
                $response="Playing ";
                if (is_array($request['result']['parameters'])) {
                        if (array_key_exists('playlist',$request['result']['parameters']) && strlen(trim($request['result']['parameters']['playlist'])) > 0) {
                                $response=" songs from the playlist ".$request['result']['parameters']['playlist'];
                        } else {
                                if (array_key_exists('song',$request['result']['parameters']) && strlen(trim($request['result']['parameters']['song'])) > 0) {
                                        $response=" the song ".$request['result']['parameters']['song'];
                                }
                                if (array_key_exists('artist',$request['result']['parameters']) && strlen(trim($request['result']['parameters']['artist'])) > 0) {
                                        $response=" by ".$request['result']['parameters']['artist'];
                                }
                        }
                }
                break;
        case 'play.music':
                $response="Stopped";
                break;
        case 'play.next':
                $response="Sure, next track.";
                break;
        case 'play.previous':
                $response="Sure, going back one.";
                break;
        default :
                $response="Didn't catch that sorry";
}


echo json_encode([
"speech"=> $response,
"displayText"=> $response,
//"data"=> ["stuff"=>"here"],
//"contextOut"=> [],
//"source"=> "DuckDuckGo"
]);

/*
"l\"id\":\"1772a18f-5f70-43f9-9db6-9133850adcee\",\"timestamp\":\"2017-02-10T02:08:29.712Z\",\"lang\":\"en\",\"result\":{\"source\":\"agent\",\"resolvedQuery\":\"play music by Frank Foster\",\"spee
ch\":\"\",\"action\":\"play.music\",\"actionIncomplete\":false,\"parameters\":{\"song\":\"\",\"playlist\":\"\",\"artist\":\"Frank Foster\"},\"contexts\":[],\"metadata\":{\"intentId\":\"0ed9c46c-a24
9-4a88-9cf0-6bea2e88a406\",\"webhookUsed\":\"true\",\"webhookForSlotFillingUsed\":\"false\",\"intentName\":\"play music\"},\"fulfillment\":{\"speech\":\"okydoke, playing some tunes\",\"messages\":[
{\"type\":0,\"speech\":\"okydoke, playing some tunes\"}]},\"score\":1.0},\"status\":{\"code\":200,\"errorType\":\"success\"},\"sessionId\":\"1486692500168\",\"originalRequest\":{\"source\":\"google
\",\"data\":{\"inputs\":[{\"arguments\":[{\"raw_text\":\"play music by Frank Foster\",\"text_value\":\"play music by Frank Foster\",\"name\":\"text\"}],\"intent\":\"assistant.intent.action.TEXT\",\
"raw_inputs\":[{\"query\":\"play music by Frank Foster\",\"input_type\":2}]}],\"user\":{\"user_id\":\"z+XE\/n9gjbspMrXA0Hl1fjpqimZsCEoiu4MM9QaSz\/Y=\"},\"conversation\":{\"conversation_token\":\"[]
\",\"conversation_id\":\"1486692500168\",\"type\":2}}}}"
*
193378590077-gi8d0kdcv3jqdnnjctb9mthj2u3st4fo.apps.googleusercontent.com
UlWD1jXwdR4_SEjgETB1QMQz
 *
 *
 * */
