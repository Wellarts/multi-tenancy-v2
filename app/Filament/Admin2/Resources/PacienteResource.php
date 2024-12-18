<?php

namespace App\Filament\Admin2\Resources;

use App\Filament\Admin2\Resources\PacienteResource\Pages;
use App\Filament\Admin2\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cadastros';

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
                    ->deletable(false)
                    ->label('Anexo do RG')
                    ->downloadable(),
                Forms\Components\TextInput::make('cor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('obs')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('team_id')
                    ->numeric(),
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
