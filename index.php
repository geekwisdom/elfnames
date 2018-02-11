<?
$gender=$_POST["gender"];
$name=$_POST["handle"];
if ($gender == "")
{
$file=file_get_contents("elfhtml.dat");
echo $file;
die();
}
else
{
$elfname=getelfname($gender,$name);
$im=makeimagefromname($elfname,$gender);
header ("Location: " . $im);
}
function makeimagefromname($elfname,$gender)
{
$comp = preg_split('/\s+/', $elfname);
$elfshort=$comp[0];
$elffiles=glob($elfshort . "*" . ".html");
$c=count($elffiles);
$elffiles[0]="";
shuffle($elffiles);
$thefile=$elffiles[0];
if ($thefile == "")
  {
  //make a new file
  $level = rand (1,5);
  $classes=file("classes.dat");
  shuffle($classes);
  $classt=$classes[0];
  $aligns=file("alignment.dat"); 
  shuffle($aligns); 
  $align=$aligns[0]; 
  $bgs=file("bgall.dat");
  shuffle($bgs);
  $bg1=$bgs[0] .  " " . $bgs[1];
  if (strlen(bg1) < 94) $bg1 = $bg1 . " " . $bgs[2];
  $bg1=preg_replace( "/\r|\n/", "", $bg1 );
  $bg=wordwrap($bg1,38);
  $theimage=makeimage($elfname,$classt,$level,$align,$bg,$gender);
  $imagename = $elfshort . $c . ".png";
  $htmlname = $elfshort . $c . ".html";
    imagepng($theimage,$imagename);
   imagedestroy($theimage);
  $htmldata=file_get_contents("elftemplate.dat");
  $htmldata=str_replace("%elfname%",$elfshort,$htmldata);
  $htmldata=str_replace("%elfimage%",$imagename,$htmldata);
  $htmldata=str_replace("%filename%",$htmlname,$htmldata);
  $htmldata=str_replace("%bg%",$bg1,$htmldata);
  file_put_contents($htmlname,$htmldata);
  return ("./" . $htmlname);
}
else
 {
 return ("./" . $thefile);
 }
}
function makeimage($elfname,$classstr,$level,$alignment,$bg,$gender)
{
$font = 20;
$im = ImageCreateFromPng("elf" . $gender . ".png"); 
$elves=array("high elf","Gray Elf","Faerie","Black Elf","Wood Elf","Sea Elf","Dark Elf","Gold Elf");
shuffle($elves);
$elf=$elves[0];
  imagesavealpha($im, true);
   imagealphablending($im, false);
   $white = imagecolorallocatealpha($im, 255, 255, 255, 127);    
$black = imagecolorallocate($im, 255,255, 255);
    $green = imagecolorallocate($im, 0,255,0);
  imagettftext($im, $font,0,420, $font +80, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $classstr);
   imagettftext($im, $font,0,420, $font +120, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $level);
   imagettftext($im, $font,0,420, $font +205, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $race);
    imagettftext($im, $font,0,420, $font +208, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $elf);
    imagettftext($im, $font,0,420, $font +245, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $alignment);
   imagettftext($im, 12,0,420, 320, $black, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $bg);
    imagettftext($im, 14,0,15,345, $green, "/usr/share/fonts/truetype/droid/DroidSansMono.ttf", $elfname);
    return $im;
}

function getelfname($gender,$realname="")
{
$lname=strtolower($realname);
$names=getnamearray("elf" . $gender . "names.dat");
if (trim($lname) != "") 
{
 if (array_key_exists($lname,$names))
  { 
  $elfname=$names[$lname];
  if (strpos($elfname, "see ") !== false)
    {
    $r=explode(" ",$elfname); 
    return getelfname($gender,$r[1]);
    }
 return $elfname; 
  }
}
  shuffle($names);
  $elfname=array_pop($names);
  while ($elfname == "") 
   { 
   $elfname = array_pop($names);
   } 
 
 if (strpos($elfname, "see ") !== false)
    {
    $r=explode(" ",$elfname); 
    return getelfname($gender,$r[1]);
    }
 
return $elfname;
 
}
function getnamearray($filename)
{
$elfnames=file($filename);
$newarray = array();
for ($i=0;$i<count($elfnames);$i++)
 {
  $line=$elfnames[$i];
  $parts=explode(",",$line);
  $realname=trim($parts[0]);
  $elfname=str_replace(" (","\n(",trim($parts[1]));
  $newarray[$realname]=$elfname;
 }
return $newarray;
}

?>

