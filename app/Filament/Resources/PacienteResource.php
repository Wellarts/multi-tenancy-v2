<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $tenantRelationshipName = 'Paciente';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('data_nascimento')
                    ->required(),
                Forms\Components\Textarea::make('endereco')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('profissão')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('anexo_rg')
                   // ->deletable(false)
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file , Get $get): string => (string) str($file->getClientOriginalName())
                            ->prepend('RG - '.$get('nome').' - '. $get('data_nascimento').''),
                    )
                    ->label('Anexo do RG')
                    ->downloadable(),
                Forms\Components\TextInput::make('cor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('obs')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_nascimento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profissão')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cor')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePacientes::route('/'),
        ];
    }
}
