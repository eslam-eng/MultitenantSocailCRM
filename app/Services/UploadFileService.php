<?php

namespace App\Services;

use App\Models\Tenant\TempFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UploadFileService
{
    /**
     * @throws UploadMissingFileException
     * @throws UploadFailedException
     */
    public function handleChunkUpload(Request $request): array
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        // Check if the upload is successful
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException;
        }

        // Receive the file
        $save = $receiver->receive();

        // Check if the upload is finished
        if ($save->isFinished()) {
            return $this->saveFile($save->getFile());
        }

        // In chunk mode, send the current progress
        $handler = $save->handler();

        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ];
    }

    protected function saveFile($file): array
    {
        $fileName = $this->createFilename($file);
        $originalMimeType = $file->getMimeType();
        $mime = str_replace('/', '-', $originalMimeType);
        $dateFolder = date('Y-m-d');
        $filePath = "temp/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/{$filePath}"); // Non-public storage/app/temp

        // Move the file to temporary storage
        $file->move($finalPath, $fileName);

        // Store file metadata in temp_files table
        $fileId = Uuid::uuid4()->toString();

        TempFile::create([
            'file_id' => $fileId,
            'path' => $filePath.$fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $originalMimeType,
        ]);

        return [
            'file_id' => $fileId,
            'name' => $fileName,
            'mime_type' => $mime,
        ];
    }

    protected function createFilename($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace('.'.$extension, '', $file->getClientOriginalName());

        return $filename.'_'.uniqid().'.'.$extension;
    }

    public function assignMediaToModel(string $media_id, Model $model, string $collection_name = 'default')
    {
        // get temp file by id
        $tempFile = TempFile::query()->where('file_id', $media_id)->first();
        if (! $tempFile) {
            throw new NotFoundHttpException('media not fount please try to upload it again');
        }

        // Associate with the model using Spatie MediaLibrary
        return $model->addMedia($tempFile->path)
            ->toMediaCollection($collection_name);
    }
}
