<?php

namespace App\Livewire\Student\Registration;

use Spatie\LivewireWizard\Components\WizardComponent;

class RegistrationWizard extends WizardComponent
{

    public function steps(): array
    {
        return [
            StudentBioDataPage::class,
            StudentProgramDataPage::class,
            StudentOLevelDataPage::class,
            StudentFileUpload::class,
            StudentAlevelSubjects::class,
            StudentDataPreview::class,
            StudentConfirmation::class
        ];
    }
}
