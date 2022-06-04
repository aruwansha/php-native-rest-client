<?php
session_start();
$api_url = 'http://localhost/vanilla/taniver-game/api/game/delete.php';
if (!empty(@$_POST['id'])) {
    $data = new stdClass();
    $data->id = $_POST['id'];

    $json = json_encode($data);
    // use key 'http' even if you send the request to https://...
    $token = $_SESSION['token'];
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n" .
                "Authorization: Bearer $token \r\n",
            'method'  => 'DELETE',
            'content' => $json
        )
    );
    $context  = stream_context_create($options);
    $result = json_decode(file_get_contents($api_url, false, $context));
    if ($result->success === 1) { /* Handle error */
        header("location: ../../", true, 301);
        // membuat kode di bawah header tidak diproses oleh website sehingga lebih aman
        exit();
    } else {
        echo json_encode($result);
    }
}
