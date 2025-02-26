<?php
define("MB", 1048576);

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function getAllData($table, $where = null, $values = null, $json = true)
{
    global $con;
    $data = array();
    if($where == null){
        $stmt = $con->prepare("SELECT  * FROM $table");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json){
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }
    else{
        if ($count > 0){
        return  array("status" => "success", "data" => $data);
        }else{
        return array("status" => "failure");
        }
    }
}

function getData($table, $where = null, $values = null,$json=true)
{
    global $con;
    $data = array();
    if($where == null){
        $stmt = $con->prepare("SELECT  * FROM $table");
    }else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE $where ");
    }
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json){
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    elseif ($count > 0){
        return  $data;
    }else{
        return json_encode(array("status" => "failure"));
    }
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure update"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($dir,$imageRequest)
{
    if(isset($_FILES[$imageRequest])){
        global $msgError;
        $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
        $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
        $imagesize  = $_FILES[$imageRequest]['size'];
        $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
        $strToArray = explode(".", $imagename);
        $ext        = end($strToArray);
        $ext        = strtolower($ext);

        if (!empty($imagename) && !in_array($ext, $allowExt)) {
            $msgError = "EXT";
        }
        if ($imagesize > 2 * MB) {
            $msgError = "size";
        }
        if (empty($msgError)) {
            move_uploaded_file($imagetmp,  $dir . $imagename);
            return $imagename;
        } else {
            return "fail";
        }
    }else{
        return "empty";
    }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "eslam" ||  $_SERVER['PHP_AUTH_PW'] != "eslam123456") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}

function result($count,$data =[]){
    if($count>0){
        printSuccess($data);
     }else{
         printFailure();
     }
     return;
}

function  printSuccess($data=null) 
{
    echo json_encode(array("status" => "success", "data" => $data));
}
function  printFailure($data=null) 
{
    echo json_encode(array("status" => "failure" , "data" => $data));
}



function sendEmail($to , $title , $body){
$header = "From: support@aslam.com " . "\n" . "CC:aslam@gmail.com" ; 
mail($to , $title , $body , $header) ; 
echo "Success" ; 
}


function sendGCM($title, $message, $topic, $pageid, $pagename,$accesstoken)
{


    $url = 'https://fcm.googleapis.com/v1/projects/ecommerce-d0db2/messages:send';

    

    $fields = array(
        "message"=> array(
          "topic"=> "$topic",
        
        //   "token"=>"fP36dkT9T6OAIfMVwyEonQ:APA91bF7-s1uFpcXjf8zoiC-Ky6Ujbr2DVjhm9XxVDJTeV-YcJBRAGvJZ7HtPxWpjAkEPbH_jft6lzqNNvWWqWZVUsMvrXg5tfYbVszQn_2Ium0h_ydMWwg",
          "notification" => array(
            "body" =>  $message,
            "title" =>  $title,
            ),

          'data' => array(
            "pageid" => $pageid,
            "pagename" => $pagename),

          "android" => array(
            "notification"=> array(
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default"
            )
          )
        )
    );
    
    //token
    //fP36dkT9T6OAIfMVwyEonQ:APA91bF7-s1uFpcXjf8zoiC-Ky6Ujbr2DVjhm9XxVDJTeV-YcJBRAGvJZ7HtPxWpjAkEPbH_jft6lzqNNvWWqWZVUsMvrXg5tfYbVszQn_2Ium0h_ydMWwg
    
    
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: Bearer ' . $accesstoken,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function insertNofiy($title,$body,$topic,$userid,$accesstoken,$pageid,$pagename){
    global $con;
    $stmt = $con->prepare("INSERT INTO `notification`(`notification_title`, `notification_body`, `notification_userid`) VALUES ('$title','$body',$userid)");
    $stmt->execute();

    sendGCM($title,$body,$topic,$pageid,$pagename,$accesstoken);
    return $stmt->rowCount();
}