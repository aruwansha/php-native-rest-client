<?php
include '../../helpers.php';

function do_post_request($url, $postdata, $files = null, $token)
{
    if ($files['image']['name'] !== "") {
        $data = "";
        $boundary = "---------------------" . substr(md5(rand(0, 32000)), 0, 10);

        //Collect Postdata 
        foreach ($postdata as $key => $val) {
            $data .= "--$boundary\n";
            $data .= "Content-Disposition: form-data; name=\"" . $key . "\"\n\n" . $val . "\n";
        }

        $data .= "--$boundary\n";

        //Collect Filedata 
        foreach ($files as $key => $file) {
            $fileContents = file_get_contents($file['tmp_name']);

            $data .= "Content-Disposition: form-data; name=\"{$key}\"; filename=\"{$file['name']}\"\n";
            $data .= "Content-Type: image/jpeg\n";
            $data .= "Content-Transfer-Encoding: binary\n\n";
            $data .= $fileContents . "\n";
            $data .= "--$boundary--\n";
        }

        $options = array('http' => array(
            'method' => 'POST',
            'header' => "Content-Type: multipart/form-data; boundary=$boundary \r\n" .
                "Authorization: Bearer $token \r\n",
            'content' => $data
        ));

        $ctx = stream_context_create($options);
        $fp = fopen($url, 'rb', false, $ctx);

        if (!$fp) {
            throw new Exception("Problem with $url, $php_errormsg");
        }

        $response = @stream_get_contents($fp);
        if ($response === false) {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }
        return $response;
    } else {
        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/x-www-form-urlencoded;charset=UTF-8\r\n" .
                    "Authorization: Bearer $token \r\n",
                'method'  => 'POST',
                'content' => http_build_query($postdata)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        if ($response === false) {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }
        return $response;
    }
}

session_start();
$base_url = BASE_URL;
$api_url = 'http://localhost/vanilla/taniver-game/api/game/update.php';
$token = $_SESSION['token'];

// Define data object
$data = new stdClass();

// Cast item to data object
$data->id = $_POST['id'];
$data->user_id = $_POST['user_id'];
$data->title = $_POST['title'];
$data->image = $_POST['current_image'];
$data->link = $_POST['link'];
$data->video_link = $_POST['video_link'];
$data->genre_id = $_POST['genre_id'];

$files['image'] = $_FILES['image'];
$request = json_decode(do_post_request($api_url, $data, $files, $token));
if ($request->success === 1) { /* Handle error */
    header("location: ../../", true, 301);
    exit();
} else {
    echo $request->message;
    header("Refresh:0; url=$base_url?menu=detail&id=$data->id");
}
