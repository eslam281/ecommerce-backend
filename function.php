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
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
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
        return $count;
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

function imageUpload($imageRequest)
{
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
        move_uploaded_file($imagetmp,  "../upload/" . $imagename);
        return $imagename;
    } else {
        return "fail";
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


function sendGCM($title, $message, $topic, $pageid, $pagename)
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
    //Access token
    //ya29.c.c0ASRK0GZJA07RAY1TJEdbR1C9yE03ZyQgf38M6MqBPzIixP5EXbffB0giMwBuxI5w91vbqMavHUDrIJJd555-jQdQqWm2xQSjzmydGotTY2iHMANT8_vD3ib7bC79XDScIySPZzoKAguIF7LDCwgWCp7RHFcgAVPGdhji2ywmJMMI8_3tEwLKSBu8_Pwecxo2pbmyLAgW1jzLIBwgFinEvwVOWscWyOTpXoC4l5AV9nvVIg6Rf_bcjsbYBPlOmFXYIWp8szA1O-2UBhlXpyq-FKX-LjMwizL6e8aa8QparU_NaF5nkQrZVhHl0enVNvdfRyvJEZko9IYPZP48AE4CVEO4N9vLYPprSaXbF224srMKd9DKsuO5ux7itigcgAT391DRQlZ0O2874Se_fBdu0wbRZ63b6fasFrBoXnb1_-_xzpdW-J0sJ1IcRnwodFn06ecrj8mYVr7qg4X90f9ufYaFZsevSfx-W7Ym0x4UgX_nUJca08lOj_0MhiyhacBkJdyeQcc1SsyVh4InFvzWjp0ZV12boWghrUg3mYyntQ7rIa3-lyyFlkQ6_Zu9qbiXsbsXq7yO6q00OR4lbn-7J2xZQgV0lBw_XaZny938drbV9rBjIr9UQMn-4chx8lgSx7v6Uq1ze9Qf_kfvUubgkMgIXaF8e_I66z5fMXuuBc_Ujtbh1WZ3z-vBrYfVv508qgUl0dmBQ0zpzlnafUdh3Q3sca-VbUl9j5ZrJ_ZdjoJxyvdnyYcnmmxB_xgb74_Qqo7VgW0ZB8VM6MM7xhBiav-RvZZjS--rVqt86QX4BadwnUy7c49y8ZIn8pB1iUhJw6SjpyB-zan3JBw6kVy660FsiuzjQ92dgfpMeXu_16rs3yf2-hnmOnbMFYinz2oSJJZrIMz35eluIsR-t_zgfUIMv-42xZgmQM1RXn598ObOMqlsiO6F7gy5kR3t4aldhqmXZXp7VSeyIaVOkiWdQzhjjzMBBcWkdX9RfzWF
    
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: Bearer ' . "ya29.c.c0ASRK0GZJA07RAY1TJEdbR1C9yE03ZyQgf38M6MqBPzIixP5EXbffB0giMwBuxI5w91vbqMavHUDrIJJd555-jQdQqWm2xQSjzmydGotTY2iHMANT8_vD3ib7bC79XDScIySPZzoKAguIF7LDCwgWCp7RHFcgAVPGdhji2ywmJMMI8_3tEwLKSBu8_Pwecxo2pbmyLAgW1jzLIBwgFinEvwVOWscWyOTpXoC4l5AV9nvVIg6Rf_bcjsbYBPlOmFXYIWp8szA1O-2UBhlXpyq-FKX-LjMwizL6e8aa8QparU_NaF5nkQrZVhHl0enVNvdfRyvJEZko9IYPZP48AE4CVEO4N9vLYPprSaXbF224srMKd9DKsuO5ux7itigcgAT391DRQlZ0O2874Se_fBdu0wbRZ63b6fasFrBoXnb1_-_xzpdW-J0sJ1IcRnwodFn06ecrj8mYVr7qg4X90f9ufYaFZsevSfx-W7Ym0x4UgX_nUJca08lOj_0MhiyhacBkJdyeQcc1SsyVh4InFvzWjp0ZV12boWghrUg3mYyntQ7rIa3-lyyFlkQ6_Zu9qbiXsbsXq7yO6q00OR4lbn-7J2xZQgV0lBw_XaZny938drbV9rBjIr9UQMn-4chx8lgSx7v6Uq1ze9Qf_kfvUubgkMgIXaF8e_I66z5fMXuuBc_Ujtbh1WZ3z-vBrYfVv508qgUl0dmBQ0zpzlnafUdh3Q3sca-VbUl9j5ZrJ_ZdjoJxyvdnyYcnmmxB_xgb74_Qqo7VgW0ZB8VM6MM7xhBiav-RvZZjS--rVqt86QX4BadwnUy7c49y8ZIn8pB1iUhJw6SjpyB-zan3JBw6kVy660FsiuzjQ92dgfpMeXu_16rs3yf2-hnmOnbMFYinz2oSJJZrIMz35eluIsR-t_zgfUIMv-42xZgmQM1RXn598ObOMqlsiO6F7gy5kR3t4aldhqmXZXp7VSeyIaVOkiWdQzhjjzMBBcWkdX9RfzWF",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
}