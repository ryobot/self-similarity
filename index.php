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
var scale = 100;
$(function() {
    $( "#slider_source_template" ).slider({
        orientation: "vertical", range: "min", min: 0, max: 8, value: 0,
        slide: function( event, ui ) {
            $( "#source_template" ).val( ui.value );
            if ( ui.value != template ) {
                template = ui.value;
                updateImg();
            }
        }
    });
    $( "#source_template" ).val( $( "#slider_source_template" ).slider( "value" ) );

    $( "#slider_source_scale" ).slider({
        orientation: "vertical", range: "min", min: 50, max: 150, value: 100, step: 10,
        slide: function( event, ui ) {
            $( "#source_scale" ).val( ui.value );
            if ( ui.value != scale ) {
                scale = ui.value;
                updateImg();
            }
        }
    });
    $( "#source_scale" ).val( $( "#slider_source_scale" ).slider( "value" ) );
});
function updateImg() {
    //window.alert("update image : template=" + template + " scale=" + scale);
    document.getElementById("src_img").src = "template.php?template=" + template + "&scale=" + scale;    
}
</script>
</head>
<body>
<table class="sliders">
    <tr>
        <td><label for="source_template">Template:</label><br>
            <input type="text" id="source_template" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />
        </td>
        <td><label for="source_scale">Src. Scale:</label><br>
            <input type="text" id="source_scale" style="border: 0; color: #931ff6; font-weight: bold;" size="5" />%
        </td>
    </tr><tr>
        <td><div id="slider_source_template" style="height: 150px; margin-left: 20px;"></div></td>
        <td><div id="slider_source_scale" style="height: 150px; margin-left: 20px;"></div></td>
    </tr>
</table>
<div style="background: #fff">
<img id="src_img" src="template.php">
</div>
</body>
</html>
