<?php
function cutStringBetween(string $start_character,string $end_character,string $text):string{
    $start_position=($start_character!=='')?strpos($text,$start_character):false;
    $response=(is_int($start_position))?substr($text,$start_position):$text;
    if($end_character!==''){
        $end_position=strpos($response,$end_character);
        $response=(is_int($end_position))?substr($response,0,$end_position):'';
    }
    $response=str_replace([$start_character,$end_character],'',$response);
    return $response; 
}
function getListFromCutString(string $start_character,string $end_character,string $text,array $response_list=[]):array{
    if($start_character!=='' and $end_character!==''){
        $data_name=cutStringBetween($start_character,$end_character,$text);
        if($data_name!==''){
            array_push($response_list,$data_name);
            $text=str_replace($start_character.$data_name.$end_character,'',$text);
            $response_list=(is_int(strpos($text,$start_character)))?getListFromCutString($start_character,$end_character,$text,$response_list):$response_list;
        }
    }
    return $response_list;
}
