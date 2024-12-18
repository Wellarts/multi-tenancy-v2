<?php

namespace App\Filament\Admin2\Resources\PacienteResource\Pages;

use App\Filament\Admin2\Resources\PacienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePacientes extends ManageRecords
{
    protected static string $resource = PacienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
