<?php
$tmpfile = "/tmp/xmas.json";
$wishdir = "wishes";
$data["counter"] = 0;
$data["wishes"] = 0;

$wishcount = -2;

if(!file_exists($tmpfile)) {
$var = file_get_contents("greetings.txt");
$data["counter"] = 1;
$fh = fopen($tmpfile, 'w') or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
print $var;
exit(1);
}
else
{
$jsondata = file_get_contents($tmpfile);
$data = json_decode($jsondata, true);
}

if($data['counter'] == 0) {
$var = file_get_contents("greetings.txt");
$data["counter"] = 1;
$fh = fopen($tmpfile, 'w') or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
print $var;
exit(1);

}

if ($handle = opendir($wishdir)) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
	$wishcount++;
    }
    closedir($handle);
}

if( ($data["wishes"] < $wishcount) && ($wishcount > 0) )
{
$data["wishes"]++;
$var = file_get_contents($wishdir . "/" . $data["wishes"] . ".txt");
$data["counter"]++;
$fh = fopen($tmpfile, 'w') or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
print("Christkind please bring me " . $var );
exit(1);
}

$var = file_get_contents("info.txt");
$data["counter"] = 0;
$data["wishes"] = 0;
$fh = fopen($tmpfile, 'w') or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
print $var;
exit(1);



?>
