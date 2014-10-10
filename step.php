<?php

function rotateImg($img, $deg) {
    $trans = imagecolorallocatealpha($img,  0, 0, 0, 127);
    $rot = imagerotate($img, $deg, $trans);
    $left = (imagesx($rot) - imagesx($img))/2;
    $top = (imagesy($rot) - imagesy($img))/2;
    $ret = imagecreatetruecolor(imagesx($img), imagesy($img));
    imagealphablending($ret, false);
    imagesavealpha($ret, true);
    imagecopy($ret, $rot, 0, 0, $left, $top, imagesx($img), imagesy($img) );
    return $ret;
}

$template = "1";
if ( isset($_GET['template'] ) ) {
  $template = $_GET["template"];
}
$template_size = "60";
if ( isset($_GET['template_size'] ) ) {
  $template_size = $_GET["template_size"];
}
$distribution_str = "0";
if ( isset($_GET['distribution'] ) ) {
  $distribution_str = $_GET["distribution"];
}
$rotate_str = "30";
if ( isset($_GET['rotate'] ) ) {
  $rotate_str = $_GET["rotate"];
}
$step = 0;
if ( isset($_GET['step'] ) ) {
  $step = intval($_GET["step"]) - 1;
}
$layer = "no";
$mini = false;
if ( isset($_GET['layer'])) {
  $layer = $_GET['layer'];
}
if ($layer == "yes") {
    $mini = true;
}

if ( $step == 0 ) {
    $copy_url = "http://localhost/ss/template.php?template=".$template."&template_size=".$template_size."&layer=".$layer;
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
$dist = 100;
if ($mini) {
    $dist = 50;
}

$dx = $scale*$width;
$dy = $scale*$height;

$x0 = $width / 2;
$y0 = $height / 2;

imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
imagecopyresampled( $img, rotateImg($copy_img, $rotate + 90), $x0 - $dx/2 - $dist, $y0 - $dy/2, 0, 0, $dx, $dy, $width, $height);
imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90), $x0 - $dx/2 + $dist, $y0 - $dy/2,  0, 0, $dx, $dy, $width, $height);
imagecopyresampled( $img, rotateImg($copy_img, $rotate + 180), $x0 - $dx/2, $y0 - $dy/2 + $dist,  0, 0, $dx, $dy, $width, $height);

imagealphablending($img, false);
imagesavealpha($img, true);

header('Content-type: image/png');
imagepng($img);

imagedestroy($img);
imagedestroy($copy_img);
?>
