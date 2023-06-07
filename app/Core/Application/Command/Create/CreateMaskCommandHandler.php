<?php

namespace App\Core\Application\Command\Create;

use App\Core\Application\Service\MaskService;
use Illuminate\Support\Facades\Storage;

class CreateMaskCommandHandler
{

    public function __invoke(CreateMaskCommand $command): object
    {

        $objMaskService = new MaskService();

        $objMaskService->putMaskFilesToStorage([
            $command->fileBase->getClientOriginalName() => $command->fileBase,
            $command->fileMask1->getClientOriginalName() => $command->fileMask1,
            $command->fileMask2->getClientOriginalName() => $command->fileMask2,
            $command->fileReflection->getClientOriginalName() => $command->fileReflection
        ]);

        // после создания public Storage получить путь к нему
        $objMaskService->methods = [$command->nameMethod1, $command->nameMethod2, 'Screen'];
        $objMaskService->changeArrayMethods();
        $objMaskService->base = $command->fileBase->getClientOriginalName();
        $objMaskService->images = [$command->fileMask1->getClientOriginalName(), $command->fileMask2->getClientOriginalName(), $command->fileReflection->getClientOriginalName()];
        $objMaskService->colors = [$command->colorMask1, $command->colorMask2, ""]; //   "#e4acb3","#4f332b"

        $diskPath = Storage::path('public/');
        $imgPath = $diskPath . 'result_image.jpg';

        $objMaskService->dir = $diskPath; //
        $objMaskService->createPath();
        $objMaskService->createImage();
        $objMaskService->setImageFormat('jpeg');
        $objMaskService->writeImage($imgPath);

        return $objMaskService;
    }

}
