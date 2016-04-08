<html>
<head>
<title>テキスト画像生成</title>
</head>
<body>
<h1>テキスト画像変換ツール</h1>
<p>入力シタ文字列カラヲ画像二変換シマス。</p>
<form method="GET" action="">
<select name="set_font">
<?php foreach($tciObj->fonts as $key => $value):?>
<option value="<?=$value?>"><?=$value?></option>
<?php endforeach;?>
</select>
<label for="pstr">文字列</label><input type="text" name="pstr" value="<?=array_key_exists('pstr',$_GET)?$_GET['pstr']:null?>">
<label for="gzn">画像名</label><input type="text" name="gzn" value="<?=array_key_exists('gzn',$_GET)?$_GET['gzn']:null?>">
<input type="hidden" name="publish" value="1">
<input type="submit" value="生成スル">
</form>
<?php if(array_key_exists('publish', $_GET)&&$_GET['publish']!=''&&$_GET['publish']!=0):?>
<img src="/pub_img/<?=$_GET['gzn']?>.png" alt="<?=$_GET['pstr']?>">
<?php endif;?>
</body>
</html>