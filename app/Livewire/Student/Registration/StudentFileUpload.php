<?php

namespace App\Livewire\Student\Registration;


use App\Models\DocumentUpload;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\LivewireWizard\Components\StepComponent;

class StudentFileUpload extends StepComponent
{
    use WithFileUploads;

    public $file;
    public array $documentUploads = [];
    public array $myDocument = [];
    public string $type = "";

    public function render()
    {
        return view('livewire.student.registration.student-file-upload');
    }

    public function mount()
    {
        $user = auth('student')->user();

        $this->documentUploads = DocumentUpload::query()->whereNotNull('created_at')->pluck('name', 'id')->toArray();
        $this->myDocument = $user->document_uploaded ?? [];
    }


    public function uploadFile()
    {
        $this->validate([
            'type' => 'required',
            'file' => 'required'
        ]);

        $name =  $this->file->store('documents', 'public');


        //save it inside database

        $user = auth('student')->user();
        $existingDocument = $user->document_uploaded;
        if ($existingDocument == "[]" || is_null($existingDocument)) {
            $existingDocument = [];
        }

        $count = count($existingDocument);
        $count++;
        $existingDocument[$count] = [
            'type' => $this->type,
            'filename' => $name."&&&&".$this->file->getClientOriginalName(),
        ];

        $user->document_uploaded = $existingDocument;
        $user->save();

        $this->file = NULL;
        $this->type = "";

        $this->myDocument = $user->document_uploaded;
    }

    public function deleteFile($key)
    {
        $user = auth('student')->user();
        if(isset($user->document_uploaded[$key])) {
            $document = $user->document_uploaded[$key];
            $file = explode("&&&&", $document['filename']);
            @unlink(storage_path('app/public/'.$file[0]));

            $upDoc = $user->document_uploaded;
            unset($upDoc[$key]);
            $user->document_uploaded = $upDoc;
        }
        $user->save();

        $this->myDocument = $user->document_uploaded ?? [];
    }

    public function store()
    {
        $this->nextStep();
    }

    public function back()
    {
        $this->previousStep();
    }

}
