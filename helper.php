<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('pre')) {

    function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}

if (!function_exists('file_curl_contents')) {

    function file_curl_contents($document) {
        //$CI=& get_instance();
        $header = array();
        
        $lang=1;
        $header[] = 'Lang:'.$lang;
        $header[] = 'Jwt:'.$document['jwt'];
        $header[] = 'userid:'.$document['userid'];
        
        $ch = curl_init();                                                             
        curl_setopt($ch, CURLOPT_URL, $document['file_url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
        curl_setopt($ch, CURLOPT_POST, 1);
        unset($document['file_url']); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $document);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //pre($header);
        $server_output = curl_exec($ch);
        //pre($server_output); 
        curl_close($ch);
        $data = json_decode($server_output, true);
//         print_r($data);exit;
//        if(array_key_exists("auth_code",$data)){
//          if($data['auth_code'] == '100100'){
//             //$CI->session->sess_destroy();
//             //redirect('/web/Home');   
//             die;
//          }
//        }
        return $data;
    }
}
function GetMAC(){
    ob_start();
    system('getmac');
    $Content = ob_get_contents();
    ob_clean();
    return substr($Content, strpos($Content,'\\')-20, 17);
}