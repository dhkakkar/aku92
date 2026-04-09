<?php

namespace App\Filament\Resources\OpdForms\Pages;

use App\Filament\Resources\OpdForms\OpdFormResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOpdForm extends EditRecord
{
    protected static string $resource = OpdFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
