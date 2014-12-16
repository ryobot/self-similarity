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
$distance_str = "140";
if ( isset($_GET['distance'] ) ) {
  $distance_str = $_GET["distance"];
}
$rotate_str = "45";
if ( isset($_GET['rotate'] ) ) {
  $rotate_str = $_GET["rotate"];
}
$dist_rotate_str = "0";
if ( isset($_GET['dist_rotate'] ) ) {
  $dist_rotate_str = $_GET["dist_rotate"];
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
    $copy_url = "http://localhost/ss/step.php?step=".strval($step)."&template=".$template;
    $copy_url .= "&template_size=".$template_size;
    $copy_url .= "&distribution=".$distribution_str;
    $copy_url .= "&distance=".$distance_str;
    $copy_url .= "&rotate=".$rotate_str;
    $copy_url .= "&dist_rotate=".$dist_rotate_str;
}
$copy_img = imagecreatefrompng($copy_url);

$distribution = intval($distribution_str);
$distance = intval($distance_str);
$rotate = -intval($rotate_str);
$dist_rotate = intval($dist_rotate_str);

$base_url = "http://localhost/ss/template.php?template=".$template."&template_size=".$template_size."&layer=".$layer;
$img = imagecreatefrompng($base_url);
$width = imagesx($img);
$height = imagesy($img);

imagealphablending($img, true);

$scale = 0.5;
$dist = $distance;
if ($mini) {
    $dist = 0.5*$distance;
}

$dx = $scale*$width;
$dy = $scale*$height;

$x0 = $width / 2;
$y0 = $height / 2;

switch($distribution) {
    case 1: // 3/4
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 90);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 90);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 90 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 2: // 2/4
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 90);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 3: // 3/3
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 120);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 120 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 120);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 120 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 4: // 2/3
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 120);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 120 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 5: // 6/6
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 60);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 60 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 60);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 60 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 120);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 120 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 120);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 120 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 180);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 180 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 6: // 3/6
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 60);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 60 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 60);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 60 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 7: // 2/6
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 60);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 60 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 8: // 5/5
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 72);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 72 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 72);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 72 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 144);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 144 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 144);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 144 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    case 9: // 3/5
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 72);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 72 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 72);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 72 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        break;
    default: // 4/4
        $rad = deg2rad($dist_rotate);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 90);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 90 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate - 90);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate + 90 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
        $rad = deg2rad($dist_rotate + 180);
        imagecopyresampled( $img, rotateImg($copy_img, $rotate - 180 - $dist_rotate), $x0 - $dx/2 + $dist*sin($rad), $y0 - $dy/2 - $dist*cos($rad), 0, 0, $dx, $dy, $width, $height);
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
