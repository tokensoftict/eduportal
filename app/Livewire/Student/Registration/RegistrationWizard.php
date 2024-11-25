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
            StudentDataPreview::class,
            StudentConfirmation::class
        ];
    }
}
