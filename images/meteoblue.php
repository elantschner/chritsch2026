<?php
if (isset($_GET["url"])){
	//echo $_GET["url"];
	file_put_contents("imgweather.php",$_GET["url"]);
	die;
	}
?>	


<!DOCTYPE html>
<html lang="de">
<head>
<link href="https://www.meteoblue.com/website/styles.111/main.min.css" media="all" rel="stylesheet" type="text/css"/>
</head>

<body>

<div style="display:none">
<?php
$html = file_get_contents('https://www.meteoblue.com/de/wetter/vorhersage/woche/reutte-in-tirol_%C3%96sterreich_2767511');

$pos1 = stripos($html, '<div class="intro">');
$pos2 = stripos($html, '<div class="flash_outer">');
$bg = substr($html, $pos1, $pos2-$pos1);
$bg = str_replace('class="image"', 'id="bg" class="image"', $bg);

echo $bg."</div>";
?>

</div>

<div id="url">
<script>
var img = document.getElementById('bg');
style = img.currentStyle || window.getComputedStyle(img, false);
console.log(style.backgroundImage);

//document.write(style.backgroundImage.slice(5, -2));
window.location = "meteoblue.php?url="+style.backgroundImage.slice(5, -2);
</script>
</div>

</body>
</html>