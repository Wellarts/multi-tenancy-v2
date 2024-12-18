<?php

namespace App\Filament\Admin2\Resources\TeamResource\Pages;

use App\Filament\Admin2\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTeams extends ManageRecords
{
    protected static ?string $title = 'Unidades Básica de Saúde';
    
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
