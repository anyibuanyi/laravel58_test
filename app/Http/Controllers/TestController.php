<?php
namespace App\Http\Controllers;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/28 0028
 * Time: 16:30
 */
class TestController extends Controller{
    public function test()
    {
        $file = 'D:\phpstudy\PHPTutorial\WWW\shop\public_html\data\attached\discuss_video\4b5d18dd8e8197c473f678669cc195f0.mp4';
//        $ffmpeg = FFMpeg::create();
//        dd($ffmpeg);
//        $video = $ffmpeg->open('D:\phpstudy\PHPTutorial\WWW\shop\public_html\data\attached\discuss_video\4b5d18dd8e8197c473f678669cc195f0.mp4');
//        $video->filters()->resize(new Dimension(320,240))->synchronize();
//        $video->frame(TimeCode::fromSeconds(1))->save('D:\phpstudy\PHPTutorial\WWW\shop\public_html\data\attached\discuss_video\4b5d18dd8e8197c473f678669cc195f0.png');
        $result = $this->execCommandLine($file);
        return json_encode($result);
    }

    function execCommandLine($file){
        $result = array();

        $pathParts = pathinfo($file);
        $filename = $pathParts['dirname']."/".$pathParts['filename']."_";

        $times = array(1);
        foreach ($times as $k => $v) {
                        $destFilePath = $filename.$v.".jpg";
         $command = "ffmpeg -i {$file} -y -f image2 -ss {$v} -vframes 1 -s 640x360 {$destFilePath}";
           exec($command);
            //chmod($filename.$v."jpg",0644);
           $destUrlPath = str_replace("/data/images/", "http://img.baidu.cn/", $destFilePath);
            $selected = $k == 0 ? "1" : "0";//默认将第一张图片作为封面图
            array_push($result,array($destUrlPath,$selected));
        }

        return $result;
    }

}
