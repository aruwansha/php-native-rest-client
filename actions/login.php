<?php
$api_url = 'http://localhost/vanilla/taniver-game/api/login.php';
if (!empty(@$_POST['email'] && !empty(@$_POST['password']))) {
    $data = new stdClass();
    $data->email = $_POST['email'];
    $data->password = $_POST['password'];
    $json = json_encode($data);
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => $json
        )
    );
    $context  = stream_context_create($options);
    $result = json_decode(file_get_contents($api_url, false, $context));

    if ($result->success === 1) { /* Handle error */
        session_start();
        $_SESSION['token'] = $result->token;
        $_SESSION['user_id'] = $result->user_id;;
        // Taking current system Time
        $_SESSION['start'] = time(); 
  
        // set session for 1 hours
        $_SESSION['expire'] = $_SESSION['start'] + (1 * 3600) ; 
        header("location: ../", true, 301);
        exit();
    } else {
        echo $result->message;
    }
}
?>
