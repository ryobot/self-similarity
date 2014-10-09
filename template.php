<?php
$template = 0;
if ( isset($_GET['template'] ) ) {
  $template = intval($_GET["template"]);
}
$scale_percent = 100;
if ( isset($_GET['scale'] ) ) {
  $scale_percent = intval($_GET["scale"]);
}

$multi = 2;
$scale = $scale_percent/100*$multi;
$img = imagecreatetruecolor(500*$multi, 500*$multi);
$x_zero = 250*$multi;
$y_zero = 250*$multi;

$blu = imagecolorallocatealpha($img,  50, 50,200, 0);
$trans = imagecolorallocatealpha($img,  0, 0, 0, 127);

imagealphablending($img, false);
imagesavealpha($img, true);
imagefill($img,100,100,$trans);
$poly = array (
    $x_zero - 150*$scale, $y_zero - 100*$scale,
    $x_zero + 100*$scale, $y_zero - 100*$scale,
    $x_zero + 150*$scale, $y_zero + 100*$scale,
    $x_zero - 100*$scale, $y_zero + 100*$scale
);
imagefilledpolygon($img, $poly, 4, $blu);

$smallImg = imagecreatetruecolor( 300, 300 );
imagealphablending($smallImg, false);
imagesavealpha($smallImg, true);
imagecopyresampled( $smallImg, $img, 0, 0, 0, 0, 300, 300, $multi*500, $multi*500 );

header('Content-type: image/png');
imagepng($smallImg);

imagedestroy($img);
imagedestroy($smallImg);
?>
