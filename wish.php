<?php
$returnpage = "/index.php";

if(empty($_POST['wish']) )
{
   header('Location: '. $returnpage);
}

if(strlen($_POST['wish']) > 65)
{
   header('Location: '. $returnpage . '?error="You entered more than 65 characters"');
}

$wishcount = -2;

if ($handle = opendir('wishes')) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
	$wishcount++;
    }
    closedir($handle);
}

if( $wishcount > 100 ){
   header('Location: '. $returnpage . '?error="We reached the maximum allowed wishes"');
}

$wishcount++;

$text = htmlentities($_POST['wish'], ENT_COMPAT, "UTF-8");

file_put_contents("wishes/$wishcount" . ".txt", $text);
header('Location: '. $returnpage . '?success="The Christkind got your message!"');

?>
