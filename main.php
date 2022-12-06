<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'helper.php';
require 'aes_helper.php';

$header = array();
    // print_r($data);die;
    $header = array();
    $header[] = "Cache-Control:no-cache";
    $header[] = "device_type:1";
    $post_data['name'] = $_POST['token'];
    $header[] = "account_id:10001093";
    $header[] = "user_id:".base64_encode('746');
    $header[] = "device_id:".base64_encode('746');
    $header[] = "version:1";
    $header[] = "device_name:Desktop_".session_id();
    $post_data['device_name'] = "Desktop_".session_id();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.videocrypt.in/index.php/rest_api/courses/course/on_request_create_video_link');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    $server_output = aes_cbc_decryption($server_output, '4321576824136875');
    curl_close($ch);
    $data = json_decode($server_output, true);
    if (isset($data['status']) && $data['status'] == true) {
        $api_data = $data['data']['link'];
        echo json_encode(['status' => true, 'message' => 'url listed', 'data' => $api_data]);
        die;
    }else{
        echo json_encode(['status' => false, 'message' => 'Something Went Wrong!!..', 'data' => []]);
        die;    
    }
?>