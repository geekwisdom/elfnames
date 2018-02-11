<?
//header("Content-Type: image/png");
$im=makeimagefromname("Erumollien\n(Air-oo-moleen)");
header ("Location: " . $im);
function makeimagefromname($elfname)
{
$elffiles=glob($elfname . "*" . ".html");
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
  $bg1=$bgs[0] .  " " . $bgs[1] . $bgs[2]; 
  $bg1=preg_replace( "/\r|\n/", "", $bg1 );
  $bg=wordwrap($bg1,38);
  $theimage=makeimage($elfname,$classt,$level,$align,$bg);
  $imagename = $elfname . $c . ".png";
  $htmlname = $elfname . $c . ".html";
    imagepng($theimage,$imagename);
   imagedestroy($theimage);
  $htmldata=file_get_contents("elftemplate.dat");
  $htmldata=str_replace("%elfname%",$elfname,$htmldata);
  $htmldata=str_replace("%elfimage%",$imagename,$htmldata);
  file_put_contents($htmlname,$htmldata);
  return ("./" . $htmlname);
}
else
 {
 return ("./" . $thefile);
 }
}
function makeimage($elfname,$classstr,$level,$alignment,$bg)
{
$font = 20;
$im = ImageCreateFromPng("elfmale.png"); 
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
?>

