<?php

namespace App\Core\Application\Service;

use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickPixel;

class MaskService extends Imagick
{
    public string $dir;      // директория с файлами
    public array $images;    // массив файлов
    public string $base;     // база
    public array $colors;    // цвета
    public array $methods;   // массив методов

    //массив названий фотошоп файлов
    public array $photoshopMethods = [
        "Normal" => Imagick::COMPOSITE_NO,
        "Dissolve" => Imagick::COMPOSITE_DISSOLVE,
        "Darken" => Imagick::COMPOSITE_DARKEN,
        "Multiply" => Imagick::COMPOSITE_MULTIPLY,
        "Color Burn" => Imagick::COMPOSITE_COLORBURN,
        "Linear Burn" => Imagick::COMPOSITE_LINEARBURN,
        "Darker Color" => Imagick::COMPOSITE_DARKEN,
        "Lighten" => Imagick::COMPOSITE_LIGHTEN,
        "Screen" => Imagick::COMPOSITE_SCREEN,
        "Color Dodge" => Imagick::COMPOSITE_COLORDODGE,
        "Linear Dodge (Add)" => Imagick::COMPOSITE_LINEARDODGE,
        "Lighter Color" => Imagick::COMPOSITE_LIGHTEN,
        "Overlay" => Imagick::COMPOSITE_OVERLAY,
        "Solf Light" => Imagick::COMPOSITE_SOFTLIGHT,
        "Hard Light" => Imagick::COMPOSITE_HARDLIGHT,
        "Vivid Light" => Imagick::COMPOSITE_VIVIDLIGHT,
        "Linear Light" => Imagick::COMPOSITE_LINEARLIGHT,
        "Pin Light" => Imagick::COMPOSITE_PINLIGHT,
        "Difference" => Imagick::COMPOSITE_DIFFERENCE,
        "Exclusion" => Imagick::COMPOSITE_EXCLUSION,
        "Subtract" => Imagick::COMPOSITE_SATURATE,
        "Hue" => Imagick::COMPOSITE_HUE,
        "Saturation" => Imagick::COMPOSITE_SATURATE,
        "Color" => Imagick::COMPOSITE_COLORIZE,
        "Luminosity" => Imagick::COMPOSITE_LUMINIZE

    ];

    // заменяем методы из фотошопа аналогами из PHP
    public function changeArrayMethods(): void
    {
        foreach ($this->methods as $key => $method) {
            foreach ($this->photoshopMethods as $keyPh => $methodPh) {
                if ($method == $keyPh) {
                    $this->methods[$key] = $methodPh;
                }
            }
        }
    }


    // заменяем пути на полные пути до storage
    public function createPath(): void
    {
        $this->base = $this->dir . $this->base;     // путь для базы

        foreach ($this->images as $i => $image) {   // пути для масок
            $this->images[$i] = $this->dir . $image;
        }
    }

    // создает изображение
    public function createImage(): void
    {
        $base = new Imagick($this->base);
        foreach ($this->images as $i => $imagPath) {
            $mask = new Imagick($this->images[$i]);
            if ($this->colors[$i] != "") {
                $clut = new Imagick();                                                            // создаем background
                $clut->newImage(1500, 1500, new ImagickPixel($this->colors[$i]));       // заливаем
                $mask->compositeImage($clut, Imagick::COMPOSITE_MULTIPLY, 0, 0,);
                $fuzz = 0.1;
                $max = $mask->getQuantumRange();
                $max = $max["quantumRangeLong"];
                $mask->transparentPaintImage($mask->getImagePixelColor(0, 0), 0, $fuzz * $max, false); //
            }
            $base->compositeImage($mask, $this->methods[$i], 0, 0);
        }

        $this->newImage(100, 100, new ImagickPixel('green')); // transparent
        $this->setImage($base);
    }

    // закидываем файлы масок в сторедж ["имя файла"=>"объект"]
    public function putMaskFilesToStorage(array $files): void
    {
        foreach ($files as $name => $obj) {
            Storage::disk('public')->putFileAs("", $obj, $name);
        }
    }

}
