<?php

namespace App\Livewire\Student\Registration;


use App\Models\DocumentUpload;
use Livewire\Attributes\On;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentFileUpload extends StepComponent
{
    use WithFilePond;

    public $file;
    public array $uploadedFiles = [];
    public array $cacheFiles = [];
    public array $documentUploads = [];

    public array $userdocumentUploaded = [];
    public array $myDocumentUploaded = [];

    public function render()
    {
        return view('livewire.student.registration.student-file-upload');
    }

    public function mount()
    {
        $this->documentUploads = DocumentUpload::query()->pluck('name', 'id')->toArray();
        $user = auth('student')->user();
        $this->userdocumentUploaded = $user->document_uploaded ?? [];

        foreach ($this->userdocumentUploaded as $key => $value) {
            $filename = $this->userdocumentUploaded[$key]['filename'];
            $filename = explode("&&&&", $filename);
            $this->myDocumentUploaded[$key]['name'] = $filename[1];
            $this->uploadedFiles[$filename[0]] =$filename;
        }

    }


    public function deleteFile($file,$key)
    {
        @unlink(storage_path('app/public/'.$file));
        unset($this->userdocumentUploaded[$key]);
        unset($this->uploadedFiles[$file]);

        $user = auth('student')->user();
        $user->document_uploaded = $this->userdocumentUploaded;
        $user->save();

    }

    #[On('filepond-upload-finished')]
    public function uploadFinished($file): void
    {
        $name = $this->file->store('documents', 'public');
        $this->uploadedFiles[$name] = $this->file->getClientOriginalName();
        $this->cacheFiles[$file] = $name;


    }

    #[On('filepond-upload-reverted')]
    public function uploadRemove($file): void
    {
        unset($this->uploadedFiles[$this->cacheFiles[$file]]);
        @unlink(storage_path('app/public/'.$this->cacheFiles[$file]));
    }

    #[On('filepond-upload-file-removed')]
    public function uploadRemoved($file): void
    {
        unset($this->uploadedFiles[$this->cacheFiles[$file]]);
        unset($this->cacheFiles[$file]);
        @unlink(storage_path('app/public/'.$this->cacheFiles[$file]));
    }

    public function back()
    {
        $this->previousStep();
    }

    public function store()
    {
        $user = auth('student')->user();

        if(count($this->userdocumentUploaded) > 0) {
            $user->document_uploaded = $this->userdocumentUploaded;
            $user->save();
        }

        $this->nextStep();
    }
}
