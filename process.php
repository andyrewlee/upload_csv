<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == 'file_upload')
{
    upload_file($_FILES, $_SESSION);
    header("Location: index.php?file_name=upload/" . $_FILES['file_upload']['name']);
    exit;
}

function upload_file($files, $session)
{
    if(($files['file_upload']['error'])==4)
    {
        $session['errors']['file_upload']='Please select a profile picture';
    }
    elseif($files && !isset($session['errors']))
    {
        move_uploaded_file($files['file_upload']['tmp_name'], 'upload/' . basename($files['file_upload']['name']));
    }
}


?>
