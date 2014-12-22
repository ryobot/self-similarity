<?php
  //echo "self similarity drawing context."
?>

<html lang="ja">
<head>
<meta charset="utf-8" />
<title>Self Similarity - Drawing Context</title>
<!--
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
-->
<link rel="stylesheet" href="../jquery/jquery-ui.css" />
<script src="../jquery/jquery-1.8.3.js"></script>
<script src="../jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="ss.css" />
<script>
var template = 0;
var template_size = 40;
var scaling = 0.5;
var distance = 140;
var distribution = 0;
var rotate = 45;
var dist_rotate = 0;
var pos_x = 0;
var pos_y = 0;
var steps = 10;

var resultImg = new Image();
resultImg.src = "step.php?step=10";
resultImg.onload = function () { resultLoaded(); }

$(function() {
    //template:
    $( "#slider_template" ).slider({
        range: "min", min: 0, max: 8, value: 0,
        slide: function( event, ui ) {
            $( "#template" ).val( ui.value );
            if ( ui.value != template ) {
                template = ui.value;
                updateImg();
            }
        }
    });
    $( "#template" ).val( $( "#slider_template" ).slider( "value" ) );

     //template_size:
    $( "#slider_template_size" ).slider({
        range: "min", min: 10, max: 100, value: 40, step: 5,
        slide: function( event, ui ) {
            $( "#template_size" ).val( ui.value );
            if ( ui.value != template_size ) {
                template_size = ui.value;
                updateImg();
            }
        }
    });
    $( "#template_size" ).val( $( "#slider_template_size" ).slider( "value" ) );

    //scaling:
    $( "#slider_scaling" ).slider({
        range: "min", min: 0.3, max: 0.8, value: 0.5, step: 0.1,
        slide: function( event, ui ) {
            $( "#scaling" ).val( ui.value );
            if ( ui.value != scaling ) {
                scaling = ui.value;
                updateImg();
            }
        }
    });
    $( "#scaling" ).val( $( "#slider_scaling" ).slider( "value" ) );

    //distribution:
    $( "#slider_distribution" ).slider({
        range: "min", min: 0, max: 10, value: 0,
        slide: function( event, ui ) {
            $( "#distribution" ).val( ui.value );
            if ( ui.value != distribution ) {
                distribution = ui.value;
                updateImg();
            }
        }
    });
    $( "#distribution" ).val( $( "#slider_distribution" ).slider( "value" ) );

    //distance:
    $( "#slider_distance" ).slider({
        range: "min", min: 0, max: 200, value: 140, step: 5,
        slide: function( event, ui ) {
            $( "#distance" ).val( ui.value );
            if ( ui.value != distance ) {
                distance = ui.value;
                updateImg();
            }
        }
    });
    $( "#distance" ).val( $( "#slider_distance" ).slider( "value" ) );

    //rotate:
    $( "#slider_rotate" ).slider({
        range: "min", min: -90, max: 90, value: 0, step: 3,
        slide: function( event, ui ) {
            $( "#rotate" ).val( ui.value );
            if ( ui.value != rotate ) {
                rotate = ui.value;
                updateImg();
            }
        }
    });
    $( "#rotate" ).val( $( "#slider_rotate" ).slider( "value" ) );

    //dist rotate:
    $( "#slider_dist_rotate" ).slider({
        range: "min", min: -90, max: 90, value: 45, step: 3,
        slide: function( event, ui ) {
            $( "#dist_rotate" ).val( ui.value );
            if ( ui.value != dist_rotate ) {
                dist_rotate = ui.value;
                updateImg();
            }
        }
    });
    $( "#dist_rotate" ).val( $( "#slider_dist_rotate" ).slider( "value" ) );

    //pos_x:
    $( "#slider_pos_x" ).slider({
        range: "min", min: -100, max: 100, value: 0, step: 2,
        slide: function( event, ui ) {
            $( "#pos_x" ).val( ui.value );
            if ( ui.value != pos_x ) {
                pos_x = ui.value;
                updateImg();
            }
        }
    });
    $( "#pos_x" ).val( $( "#slider_pos_x" ).slider( "value" ) );

    //pos_y:
    $( "#slider_pos_y" ).slider({
        range: "min", min: -100, max: 100, value: 0, step: 2,
        slide: function( event, ui ) {
            $( "#pos_y" ).val( ui.value );
            if ( ui.value != pos_y ) {
                pos_y = ui.value;
                updateImg();
            }
        }
    });
    $( "#pos_y" ).val( $( "#slider_pos_y" ).slider( "value" ) );

    //steps:
    $( "#slider_steps" ).slider({
        range: "min", min: 2, max: 20, value: 10,
        slide: function( event, ui ) {
            $( "#steps" ).val( ui.value );
            if ( ui.value != steps ) {
                steps = ui.value;
                //updateResult();
            }
        }
    });
    $( "#steps" ).val( $( "#slider_steps" ).slider( "value" ) );
});
function updateImg() {
    document.getElementById("step_img").src = "step.php?template=" + template + 
            "&template_size=" + template_size + 
            "&scaling=" + scaling + 
            "&distribution=" + distribution + 
            "&distance=" + distance + 
            "&rotate=" + rotate + 
            "&dist_rotate=" + dist_rotate + 
            "&pos_x=" + pos_x + 
            "&pos_y=" + pos_y + 
            "&layer=yes";
}
function resultLoaded() {
    document.getElementById("result_img").src = resultImg.src;
    document.getElementById("result_div").className = "result";
}
function updateResult() {
    resultImg.src = "step.php?step=" + steps + 
            "&template=" + template + 
            "&scaling=" + scaling + 
            "&template_size=" + template_size + 
            "&distribution=" + distribution + 
            "&distance=" + distance + 
            "&rotate=" + rotate + 
            "&pos_x=" + pos_x + 
            "&pos_y=" + pos_y + 
            "&dist_rotate=" + dist_rotate;
    document.getElementById("result_img").src = "loader.gif"
    document.getElementById("result_div").className = "loader";
}
</script>
</head>
<body>
<div class="contents">
<table>
    <!-- title -->
    <tr>
    <td><div class="board" style="background: #667; text-align: center;"><b>Self-Similarity Drawing Script</b></div></td>
    <!-- render -->
    <td><div class="board" style="background: #eee; width:620px;"><table class="sliders">
        <tr>
            <td><b>render</b></td>
            <td class="label"><label for="steps">Steps:</label></td>
            <td class="value"><input type="text" id="steps" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_steps" style="width: 300px;"></div></td>
            <td><button onclick="updateResult()">Update</button></td>
        </tr>
        </table>
        </div>
    </td>
    </tr>
    <!-- source -->
    <tr>
    <td><div class="board" style="background: #baa;"><b>source</b><table class="sliders">
        <tr>
            <td class="label"><label for="template">Source:</label></td>
            <td class="value"><input type="text" id="template" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_template"></div></td>
        </tr><tr>
            <td class="label"><label for="template_size">Size:</label></td>
            <td class="value"><input type="text" id="template_size" style="border: 0; color: #931ff6; font-weight: bold;" size="3" />%</td>
            <td><div id="slider_template_size"></div></td>
        </tr>
    </table></div></td>
    <!-- result -->
    <td rowspan="4">
        <div id="result_div" class="loader">
        <img id="result_img" src="loader.gif">
        </div>
    </td>
    </tr>
    <!-- scaling -->
    <tr>
    <td><div class="board" style="background: #aba;"><b>scaling</b><table class="sliders">
        <tr>
            <td class="label"><label for="scaling">Scaling:</label></td>
            <td class="value"><input type="text" id="scaling" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_scaling"></div></td>
        </tr><tr>
            <td class="label"><label for="distribution">Distribution:</label></td>
            <td class="value"><input type="text" id="distribution" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_distribution"></div></td>
        </tr><tr>
            <td class="label"><label for="distance">Distance:</label></td>
            <td class="value"><input type="text" id="distance" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_distance"></div></td>
        </tr><tr>
            <td class="label"><label for="dist_rotate">Rotate 1:</label></td>
            <td class="value"><input type="text" id="dist_rotate" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_dist_rotate"></div></td>
        </tr><tr>
            <td class="label"><label for="rotate">Rotate 2:</label></td>
            <td class="value"><input type="text" id="rotate" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_rotate"></div></td>
        </tr><tr>
            <td class="label"><label for="pos_x">Pos. X:</label></td>
            <td class="value"><input type="text" id="pos_x" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_pos_x"></div></td>
        </tr><tr>
            <td class="label"><label for="pos_y">Pos. Y:</label></td>
            <td class="value"><input type="text" id="pos_y" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_pos_y"></div></td>
        </tr>
    </table></div></td>
    </tr>
    <!-- task window -->
    <tr><td>
        <div class="board" style="background: #abb;"><b>the task</b><center>
        <img id="step_img" src="step.php?layer=yes"></center>
        </div>
    </td></tr>
</table>

</div></body>
</html>
