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
var template_size = 100;
var distribution = 0;
var rotate = 0;
var steps = 5;
$(function() {
    //template:
    $( "#slider_template" ).slider({
        orientation: "vertical", range: "min", min: 0, max: 8, value: 0,
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
        orientation: "vertical", range: "min", min: 50, max: 150, value: 100, step: 10,
        slide: function( event, ui ) {
            $( "#template_size" ).val( ui.value );
            if ( ui.value != template_size ) {
                template_size = ui.value;
                updateImg();
            }
        }
    });
    $( "#template_size" ).val( $( "#slider_template_size" ).slider( "value" ) );

    //distribution:
    $( "#slider_distribution" ).slider({
        orientation: "vertical", range: "min", min: 0, max: 10, value: 0,
        slide: function( event, ui ) {
            $( "#distribution" ).val( ui.value );
            if ( ui.value != distribution ) {
                distribution = ui.value;
                updateImg();
            }
        }
    });
    $( "#distribution" ).val( $( "#slider_distribution" ).slider( "value" ) );

    //rotate:
    $( "#slider_rotate" ).slider({
        orientation: "vertical", range: "min", min: 0, max: 11, value: 0,
        slide: function( event, ui ) {
            $( "#rotate" ).val( ui.value );
            if ( ui.value != rotate ) {
                rotate = ui.value;
                updateImg();
            }
        }
    });
    $( "#rotate" ).val( $( "#slider_rotate" ).slider( "value" ) );

    //steps:
    $( "#slider_steps" ).slider({
        orientation: "vertical", range: "min", min: 2, max: 10, value: 5,
        slide: function( event, ui ) {
            $( "#steps" ).val( ui.value );
            if ( ui.value != steps ) {
                steps = ui.value;
                updateResult();
            }
        }
    });
    $( "#steps" ).val( $( "#slider_steps" ).slider( "value" ) );
});
function updateImg() {
    //document.getElementById("src_img").src = "template.php?template=" + template + "&template_size=" + template_size;    
    document.getElementById("step_img").src = "step.php?template=" + template + "&template_size=" + template_size + "&distribution=" + distribution + "&rotate=" + rotate + "&layer=yes";
    document.getElementById("step5_img").style.visibility = "hidden";
}
function updateResult() {
    document.getElementById("step5_img").src = "step.php?step=" + steps + "&template=" + template + "&template_size=" + template_size + "&distribution=" + distribution + "&rotate=" + rotate;    
    document.getElementById("step5_img").style.visibility = "visible";   
}
</script>
</head>
<body>
<table><tr>
    <!-- source -->
    <td><div class="board" style="background: #baa;"><b>source</b><table class="sliders">
        <tr>
            <td><label for="template">Source:</label><br>
                <input type="text" id="template" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />
            </td>
            <td><label for="template_size">Size:</label><br>
                <input type="text" id="template_size" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />%
            </td>
        </tr><tr>
            <td><div id="slider_template" style="height: 150px; margin-left: 20px;"></div></td>
            <td><div id="slider_template_size" style="height: 150px; margin-left: 20px;"></div></td>
        </tr>
    </table></div></td>
    <!-- scaling -->
    <td><div class="board" style="background: #aba;"><b>scaling</b><table class="sliders">
        <tr>
            <td><label for="distribution">Dist.:</label><br>
                <input type="text" id="distribution" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />
            </td>
            <td><label for="rotate">Rotate:</label><br>
                <input type="text" id="rotate" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />
            </td>
        </tr><tr>
            <td><div id="slider_distribution" style="height: 150px; margin-left: 20px;"></div></td>
            <td><div id="slider_rotate" style="height: 150px; margin-left: 20px;"></div></td>
        </tr>
    </table></div></td>
    <!-- render -->
    <td><div class="board" style="background: #aab;"><b>render</b><table class="sliders">
        <tr>
            <td><label for="steps">Steps:</label><br>
                <input type="text" id="steps" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />
            </td>
        </tr><tr>
            <td><div id="slider_steps" style="height: 150px; margin-left: 20px;"></div></td>
        </tr>
    </table></div></td>
</tr></table>

<div style="background: #fff">
<!-- <img id="src_img" src="template.php"> -->
<img id="step_img" src="step.php?layer=yes">
<img id="step5_img" src="step.php?step=5">
</div>
</body>
</html>
