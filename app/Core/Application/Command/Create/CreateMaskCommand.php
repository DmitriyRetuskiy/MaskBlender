<?php

namespace App\Core\Application\Command\Create;
use Illuminate\Http\UploadedFile;

class CreateMaskCommand
{

    public function __construct(
         public readonly ?string $colorMask1 = null,
         public readonly ?string $colorMask2 = null,
         public readonly ?string $nameMethod1 = null,
         public readonly ?string $nameMethod2 = null,
         public readonly ?UploadedFile $fileBase = null,
         public readonly ?UploadedFile $fileMask1 = null,
         public readonly ?UploadedFile $fileMask2 = null,
         public readonly ?UploadedFile $fileReflection = null,
    )
    {

    }

    public static function fromMaskRequest(object $request): self
    {
        return new self(
            colorMask1: $request->input('colorMask1') ?? null,
            colorMask2: $request->input('colorMask2') ?? null,
            nameMethod1: $request->input('nameMethod1') ?? null,
            nameMethod2: $request->input('nameMethod2') ?? null,
            fileBase: $request->file('fileBase') ?? null,
            fileMask1: $request->file('fileMask1') ?? null,
            fileMask2: $request->file('fileMask2') ?? null,
            fileReflection: $request->file('fileReflection') ?? null
        );
    }


}
