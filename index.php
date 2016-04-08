<?php
include_once 'app/model/TextConvertImg.php';
$tciObj = new TextConvertImg();
$tciObj->done();
include 'app/view/index.php';
