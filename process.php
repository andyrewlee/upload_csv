<?php
session_start();
if(isset($_POST['action']) && $_POST['action'] == 'file_upload' && empty($_SESSION['errors']))
{
    upload_file($_FILES, $_SESSION);
    header("Location: index.php?file_name=upload/" . $_FILES['file_upload']['name'] . '&row=1');
    exit;
}
else
{
    header("Location: index.php");
    exit;
}
function upload_file($files, $session)
{
    if(($files['file_upload']['error'])==4)
    {
        $_SESSION['errors']['file_upload']='No file selected for upload uploaded';
    }
    elseif($files && !isset($session['errors']))
    {
        move_uploaded_file($files['file_upload']['tmp_name'], 'upload/' . basename($files['file_upload']['name']));
    }
}
//---end of file