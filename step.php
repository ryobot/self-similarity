<?php
$template = "0";
if ( isset($_GET['template'] ) ) {
  $template = $_GET["template"];
}
$scale_percent = "100";
if ( isset($_GET['scale'] ) ) {
  $scale_percent = $_GET["scale"];
}
$step = 0;
if ( isset($_GET['step'] ) ) {
  $step = intval($_GET["step"]) - 1;
}

if ( $step == 0 ) {
    $copy_url = "http://localhost/ss/template.php?template=".$template."&scale=".$scale_percent;
} else {
    $copy_url = "http://localhost/ss/step.php?step=".strval($step)."&template=".$template."&scale=".$scale_percent;
}
$copy_img = imagecreatefrompng($copy_url);

$base_url = "http://localhost/ss/template.php?template=".$template."&scale=".$scale_percent;
$img = imagecreatefrompng($base_url);
$width = imagesx($img);
$height = imagesy($img);

imagealphablending($img, true);

$scale = 0.5;
$dx = $scale*$width;
$dy = $scale*$height;

imagecopyresampled( $img, $copy_img, 0, 0, 0, 0, $scale*$width, $scale*$height, $width, $height);
imagecopyresampled( $img, $copy_img, $dx, 0, 0, 0, $scale*$width, $scale*$height, $width, $height);
imagecopyresampled( $img, $copy_img, 0, $dy, 0, 0, $scale*$width, $scale*$height, $width, $height);
imagecopyresampled( $img, $copy_img, $dx, $dy, 0, 0, $scale*$width, $scale*$height, $width, $height);

imagealphablending($img, false);
imagesavealpha($img, true);

header('Content-type: image/png');
imagepng($img);

imagedestroy($img);
imagedestroy($copy_img);
?>
