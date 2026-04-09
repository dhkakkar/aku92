<?php

namespace App\Filament\Resources\OpdForms\Pages;

use App\Filament\Resources\OpdForms\OpdFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOpdForms extends ListRecords
{
    protected static string $resource = OpdFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
