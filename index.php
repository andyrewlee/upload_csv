<?php
session_start();
ini_set('auto_detect_line_endings', true);
$ctual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
    for($i = $start; $i < $start + 50; $i++)
    {
        echo '<tr>';
        foreach($array[$i] as $value)
        {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '<div id=navigation>';
        if(($start - 50) > 0)
        {
            $link_string='<a href="index.php?file_name=' . $_GET['file_name'] . '&row=' . ($start-50) . '">Previous Page</a>';
            echo $link_string;
        }
        if(($start + 50) < count($array))
        {
            $link_string='<a href="index.php?file_name=' . $_GET['file_name'] . '&row=' . ($start+50) . '">Next Page</a>';
            echo $link_string;
        }
    echo '</div>';
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
            if(!empty($_GET["file_name"]) && empty($_SESSION['errors']))
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
                    display_row($names, $_GET['row']);
?>
                </tbody>
            </table>
<?php
            }
            else 
            { ?>
                <p>Please select a file to be processed.</p>
<?php           $_SESSION=array();         
            } ?>
        </div>
    </body>
</html>