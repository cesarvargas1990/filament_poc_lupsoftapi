<?php

namespace App\Filament\Resources\PlantillaDocumentoResource\Pages;

use App\Filament\Resources\PlantillaDocumentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlantillaDocumentos extends ListRecords
{
    protected static string $resource = PlantillaDocumentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
