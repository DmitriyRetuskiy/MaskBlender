<?php

namespace App\Http\Controllers;

use App\Core\Application\Command\Create\CreateMaskCommand;
use App\Core\Application\Command\Create\CreateMaskCommandHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class MaskController extends Controller {

    public static function postMaskDate(Request $request): Response
    {
        $command = CreateMaskCommand::fromMaskRequest($request);
        $hendler = new CreateMaskCommandHandler();
        $fileStorageObject = $hendler($command);
        return \response(json_decode($fileStorageObject),200)->header('Content-Type', 'text/json');
    }

    public static function getMaskDate() {
        $diskPath = Storage::path('public/');
        $imgPath = $diskPath . 'result_image.jpg';
        return \response()->file($imgPath);
    }

}




//============================Рисование фигур ImagickDrow============================

//        $img = new Imagick();
//        $width = 600;
//        $height = 510;
//        $img->newImage($width, $height, new ImagickPixel('rgba(100,100,0,0)'));
//        $draw = new ImagickDraw();
//        $draw->setFillColor(new ImagickPixel("red"));
//        $draw->rectangle(0,0,200,200);
//        $img->drawImage($draw);
//        $draw->setFillColor(new ImagickPixel("orange"));
//        $draw->circle(300,300, 330,330);
//        $img->drawImage($draw);
//        $draw->setFillColor('#777bb4');
//        $draw->ellipse($width / 2, $height / 2, $width / 8, $height / 8, 0, 360);
//        $img->drawImage($draw);
//        $img->setImageFormat("png");
//        header('Content-Type: image/png');
//        echo $img->getImageBlob();




// =====================Рабочее попиксильное раскрашивание маски==================================
//

//        $pixelColorBG = "";
//        $color = '#a8b9a8';
//
//        $imageIterator = $src2->getPixelIterator();
//        foreach ($imageIterator as $row => $pixels) {
//            foreach ($pixels as $column => $pixel) {
//
//                // дописать
//                if($column == 3 && $row == 3) {
//                    $pixelColorBG = $pixel->getColorAsString();
//                }
//
//                if($pixelColorBG  != "")
//                {
//                    if($pixel->getColorAsString() != $pixelColorBG ) {
//                        $pixel->setColor($color);
//                    }
//                }
//
//
//
//            }
//            $imageIterator->syncIterator();
//        }
//
//          //   склеивание
//        $src1->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT); //VIRTUALPIXELMETHOD_TRANSPARENT
//        $src1->setImageArtifact('compose:args', "0,1,-0.5,0.3");
//        $src1->compositeImage($src2, Imagick::COMPOSITE_COLORIZE, 0, 0); //COMPOSITE_COLORIZE
//           //  вывод на экран
//        header("Content-Type: image/png");
//        echo $src1->getImageBlob();


?>
