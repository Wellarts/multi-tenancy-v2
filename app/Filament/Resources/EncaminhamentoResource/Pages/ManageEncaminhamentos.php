<?php

namespace App\Filament\Resources\EncaminhamentoResource\Pages;

use App\Filament\Resources\EncaminhamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEncaminhamentos extends ManageRecords
{
    protected static string $resource = EncaminhamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
