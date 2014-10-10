<?php
$template = "0";
if ( isset($_GET['template'] ) ) {
  $template = $_GET["template"];
}
$template_size = "100";
if ( isset($_GET['template_size'] ) ) {
  $template_size = $_GET["template_size"];
}
$distribution_str = "0";
if ( isset($_GET['distribution'] ) ) {
  $distribution_str = $_GET["distribution"];
}
$rotate_str = "0";
if ( isset($_GET['rotate'] ) ) {
  $rotate_str = $_GET["rotate"];
}
$step = 0;
if ( isset($_GET['step'] ) ) {
  $step = intval($_GET["step"]) - 1;
}
$layer = "no";
if ( isset($_GET['layer'])) {
  $layer = $_GET['layer'];
}

if ( $step == 0 ) {
    $copy_url = "http://localhost/ss/template.php?template=".$template."&template_size=".$template_size;
} else {
    $copy_url = "http://localhost/ss/step.php?step=".strval($step)."&template=".$template."&template_size=".$template_size."&distribution=".$distribution_str."&rotate=".$rotate_str;
}
$copy_img = imagecreatefrompng($copy_url);

$distribution = intval($distribution_str);
$rotate = intval($rotate_str);

$base_url = "http://localhost/ss/template.php?template=".$template."&template_size=".$template_size."&layer=".$layer;
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
