<?php
/*
    验证码
    宽 高 字母 数字 字母数字混合 干扰线 干扰点 背景色（要比字体颜色浅） 字体的颜色
*/
/**
  * @param $width：宽
  * @param $height：高
  * @param $num：显示多少位
  * @param $type：类型 1数字，2字母，3数字大小写字母
*/
session_start();
$_SESSION['vcode'] = verify();
function verify($width = 100,$height = 40,$num = 5,$type = 3){
    // 1. 准备画布
    $image = imagecreatetruecolor($width, $height); // 设置验证码图片大小的函数
    // 2. 生成颜色（背景填充颜色，字体颜色）
    imagefilledrectangle($image, 0, 0, $width, $height, lightColor($image));// 画一矩形并填充
    // 3. 你需要什么样的字符
    $string = '';
    switch($type){
        case 1:
            $str = '0123456789';
            $string = substr(str_shuffle($str), 0 ,$num);
            break;
        case 2:
            $arr = range('a','z');
            shuffle($arr);
            $tmp = array_slice($arr,0,5);
            $string = join('', $tmp);
            break;
        case 3:
            // 0-9 a-z A-Z 
            $str = '0123456789abcdefghizklmnopqrstuvwxyzABCDEFGHIZKLMNOPQRSTUVWXYZ'; // 也可取出类似的0il
            $string = substr(str_shuffle($str),0,$num);
            break;
    }
    // 4. 开始写字
    $fontsize = 20; // 字大小
    for($i = 0;$i < $num;$i++){
        $x = floor($width / $num) * $i + 4;
        $y = mt_rand(10, $height - 20);
        imagechar($image, $fontsize, $x, $y, $string[$i], deepColor($image));// 水平低画一个字符
    }
    // 5. 干扰线（点）
    for($i = 0;$i < $num;$i++){
        imagearc($image, mt_rand(10, $width), mt_rand(10, $height), mt_rand(10, $width), mt_rand(10, $height), mt_rand(0, 10), mt_rand(0, 120), deepColor($image));// 画椭圆弧
    }
    for($i = 0;$i < 60;$i++){
        imagesetpixel($image, mt_rand(10, $width), mt_rand(10, $height), deepColor($image));// 画一个单一像素
    }
    // 6. 指定输出的类型
    header('Content-type:image/png');
    // 7. 准备输出图片
    imagepng($image);
    // 8. 销毁
    imagedestroy($image); // 结束图形函数 销毁$image

    return $string;
}
// 浅色
function lightColor($image){
    return imagecolorallocate($image, mt_rand(130, 255),mt_rand(130, 255), mt_rand(130, 255)); // 为一幅图像分配颜色
}
// 深色
function deepColor($image){
    return imagecolorallocate($image, mt_rand(0, 120),mt_rand(0, 120), mt_rand(0, 120));
}