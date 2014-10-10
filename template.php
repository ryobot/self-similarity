<?php
$template = 0;
if ( isset($_GET['template'] ) ) {
  $template = intval($_GET['template']);
}
$template_size = 100;
if ( isset($_GET['template_size'] ) ) {
  $template_size = intval($_GET['template_size']);
}
$layer = "no";
if ( isset($_GET['layer'])) {
  $layer = $_GET['layer'];
}

$multi = 2;
$scale = $template_size/100*$multi;
$img = imagecreatetruecolor(500*$multi, 500*$multi);
$x_zero = 250*$multi;
$y_zero = 250*$multi;

$blu = imagecolorallocatealpha($img,  50, 50,200, 0);
if ($layer == "yes") {
    $blu = imagecolorallocatealpha($img,  50, 50,200, 30);
}
$trans = imagecolorallocatealpha($img,  0, 0, 0, 127);

imagealphablending($img, false);
imagesavealpha($img, true);
imagefill($img,100,100,$trans);

switch ($template) {
    case 3: //allow:
        $poly = array (
            $x_zero - 150*$scale, $y_zero - 150*$scale,
            $x_zero - 100*$scale, $y_zero - 150*$scale,
            $x_zero + 150*$scale, $y_zero + 100*$scale,
            $x_zero + 100*$scale, $y_zero + 150*$scale,
            $x_zero - 150*$scale, $y_zero - 100*$scale,
        );
        imagefilledpolygon($img, $poly, 5, $blu);
        break;
    case 2: //parallelogram:
        $poly = array (
            $x_zero - 150*$scale, $y_zero - 100*$scale,
            $x_zero + 100*$scale, $y_zero - 100*$scale,
            $x_zero + 150*$scale, $y_zero + 100*$scale,
            $x_zero - 100*$scale, $y_zero + 100*$scale
        );
        imagefilledpolygon($img, $poly, 4, $blu);
        break;
    case 1: //square:
        $poly = array (
            $x_zero - 100*$scale, $y_zero - 100*$scale,
            $x_zero + 100*$scale, $y_zero - 100*$scale,
            $x_zero + 100*$scale, $y_zero + 100*$scale,
            $x_zero - 100*$scale, $y_zero + 100*$scale
        );
        imagefilledpolygon($img, $poly, 4, $blu);
        break;
    default: //0:circle
        imagefilledellipse($img, $x_zero, $y_zero, 200*$scale, 200*$scale, $blu);
        break;
}
$smallImg = imagecreatetruecolor( 300, 300 );
imagealphablending($smallImg, false);
imagesavealpha($smallImg, true);
imagecopyresampled( $smallImg, $img, 0, 0, 0, 0, 300, 300, $multi*500, $multi*500 );

header('Content-type: image/png');
imagepng($smallImg);

imagedestroy($img);
imagedestroy($smallImg);
?>
