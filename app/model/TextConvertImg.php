<?php
/**
 * 文字列を画像に変換する
 * Enter description here ...
 * @author leonardo
 *
 */
class TextConvertImg
{
    /** フォントリスト */
    public $fonts;

    public function __construct()
    {
        $dir = opendir('/var/www/html/font/NotoSansCJKjp-hinted/');
        $fontList = array();
        while ( $fileName = readdir( $dir ) ) {
    	   if ( preg_match('/\.otf$|\.ttf$/i', $fileName) ) {
    	       $fontList[] = $fileName;
    	   }
        }
        $this->fonts = $fontList;
    }


    /**
     * 文字列画像変換
     */
    public function done()
    {
        if ( !array_key_exists('publish', $_GET) || $_GET['publish'] == '' || $_GET['publish'] == 0 ) return;

        /* 画像サイズ */
        $width  = 240;
        $height = 80;

        /* 文字列定義 */
        $fontSize = 18;
        $angle   = 0;  //傾き
        $strPosX = 8;  //開始位置：横
        $strPosY = 32; //開始位置：縦
        /* 文字色 */
        $strColorR = 255;
        $strColorG = 255;
        $strColorB = 255;
        /* 背景色 */
        $bkColorR = 0;
        $bkColorG = 0;
        $bkColorB = 0;

        /* 画像化文字列 */
        $str = "文字を入力してください";
        if ( array_key_exists('pstr', $_GET) && $_GET['pstr'] != '' ) {
            $str = $_GET['pstr'];
        }
        $str = mb_convert_kana($str,'KC');

        /* 画像ファイル名 */
        $imageName = null;
        if ( array_key_exists('gzn', $_GET) && $_GET['gzn'] != '' ) {
            $imageName = $_GET['gzn'];
        }

        /* フォント */
        $font = "/var/www/html/font/NotoSansCJKjp-hinted/";
        if ( array_key_exists('set_font', $_GET) && $_GET['set_font'] != '' ) {
            $font .=$_GET['set_font'];
        }

        /* 画像生成 */
        $img = imagecreatetruecolor($width, $height);
        $backGroundColor = imagecolorallocate($img, $bkColorR, $bkColorG, $bkColorB);
        imagefilledrectangle($img, 0, 0, $width, $height, $backGroundColor);

        /* 文字列描画 */
        $strColor = imagecolorallocate($img, $strColorR, $strColorG, $strColorB);
        imagettftext($img, $fontSize, $angle, $strPosX, $strPosY, $strColor, $font, $str);

        /* 出力 */
        $this->getPng($img, $imageName);
    }


    /**
     * PNG画像出力
     * @param unknown $img
     * @param unknown $filename ファイル名を指定したら画像ファイルを吐き出す
     */
    public function getPng($img, $filename=null)
    {
        //画像出力
        if ( $filename ) {
            $filename = '/var/www/html/pub_img/' . $filename .'.png';
        }
        else {
            header("Content-type: image/png");
            header("Cache-control: no-cache");
        }
        imagepng($img, $filename);

        //後始末
        imagedestroy($img);
    }
}
