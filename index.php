<?php

session_start();

ini_set('auto_detect_line_endings', true);

if(isset($_GET["file_name"]))
{
    $handle = fopen($_GET["file_name"], "r");
    $names = array();

    while(($data = fgetcsv($handle))) {
        $names[] = $data;
    }

    $csv_length = count($names);
}

function display_row($array, $start)
{
    for($i = $start; $i <= $start + 50; $i++)
    {
        echo '<tr>';
        foreach($array[$i] as $value)
        {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
}


?>


<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="container">
            <form id="csv_upload" enctype="multipart/form-data" action="process.php" method="post">
                <input type="hidden" name="action" value="file_upload">
                <input type="file" name="file_upload">
                <input type="submit" value="Submit">
            </form>
<?php
            if(isset($_GET["file_name"]))
            {  ?>
            <table>
                <thead>
                    <tr>
<?php
                        foreach($names[0] as $value)
                        {  ?>
                        <th><?= $value ?></th>
<?php                   }  ?>
                    </tr>
                </thead>
                <tbody>
<?php
                        display_row($names, 1);
?>
                </tbody>
            </table>
<?php
            }  ?>
        </div>
    </body>
</html>
