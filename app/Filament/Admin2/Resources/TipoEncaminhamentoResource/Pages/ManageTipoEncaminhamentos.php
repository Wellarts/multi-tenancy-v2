<?php

namespace App\Filament\Admin2\Resources\TipoEncaminhamentoResource\Pages;

use App\Filament\Admin2\Resources\TipoEncaminhamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoEncaminhamentos extends ManageRecords
{
    protected static string $resource = TipoEncaminhamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
