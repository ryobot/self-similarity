<?php

function cropImg($img, $left, $top, $width, $height) {
    $ret = imagecreatetruecolor($width, $height);
    imagealphablending($ret, false);
    imagesavealpha($ret, true);
    imagecopy($ret, $img, 0, 0, $left, $top, $width, $height );
    return $ret;
}

function rotateImg($img, $deg) {
    $trans = imagecolorallocatealpha($img,  0, 0, 0, 127);
    $rot = imagerotate($img, $deg, $trans);
    $left = (imagesx($rot) - imagesx($img))/2;
    $top = (imagesy($rot) - imagesy($img))/2;
    return cropImg($rot, $left, $top, imagesx($img), imagesy($img));
}

$template = "0";
if ( isset($_GET['template'] ) ) {
  $template = $_GET["template"];
}
$template_size = "40";
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
$rotate = -intval($rotate_str);

$base_url = "http://localhost/ss/template.php?template=".$template."&template_size=".$template_size."&layer=".$layer;
$img = imagecreatefrompng($base_url);
$width = imagesx($img);
$height = imagesy($img);

imagealphablending($img, true);

$scale = 0.5;
$dist = 140;
if ($mini) {
    $dist = 70;
}

$dx = $scale*$width;
$dy = $scale*$height;

$x0 = $width / 2;
$y0 = $height / 2;

switch($distribution) {
    case 1: // 3/4
        imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 90), $x0 - $dx/2 - $dist, $y0 - $dy/2, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90), $x0 - $dx/2 + $dist, $y0 - $dy/2,  0, 0, $dx, $dy, $width, $height);
        break;
    case 2: // 2/4
        imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90), $x0 - $dx/2 + $dist, $y0 - $dy/2,  0, 0, $dx, $dy, $width, $height);
        break;
    case 3: // 3/3
        $rad = deg2rad(30);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 120), $x0 - $dx/2 - $dist*cos($rad), $y0 - $dy/2 + $dist*sin($rad),  0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 120), $x0 - $dx/2 + $dist*cos($rad), $y0 - $dy/2 + $dist*sin($rad),  0, 0, $dx, $dy, $width, $height);
        break;
    case 4: // 2/3
        $rad = deg2rad(30);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 120), $x0 - $dx/2 + $dist*cos($rad), $y0 - $dy/2 + $dist*sin($rad),  0, 0, $dx, $dy, $width, $height);
        break;
    default: // 4/4
        imagecopyresampled( $img, rotateImg($copy_img, $rotate), $x0 - $dx/2, $y0 - $dy/2 - $dist, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 90), $x0 - $dx/2 - $dist, $y0 - $dy/2, 0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90), $x0 - $dx/2 + $dist, $y0 - $dy/2,  0, 0, $dx, $dy, $width, $height);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 180), $x0 - $dx/2, $y0 - $dy/2 + $dist,  0, 0, $dx, $dy, $width, $height);
        break;
}

imagealphablending($img, false);
imagesavealpha($img, true);
header('Content-type: image/png');
if ($mini) {
    $frame = 30;
    imagepng(cropImg($img, $frame, $frame, $width - 2*$frame, $height - 2*$frame));
} else {
    imagepng($img);
}
imagedestroy($img);
imagedestroy($copy_img);
?>
