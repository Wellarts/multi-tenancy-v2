<?php

namespace App\Filament\Admin2\Resources;

use App\Filament\Admin2\Resources\EncaminhamentoResource\Pages;
use App\Filament\Admin2\Resources\EncaminhamentoResource\RelationManagers;
use App\Models\Encaminhamento;
use App\Models\Paciente;
use App\Models\Team;
use App\Models\TipoEncaminhamento;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EncaminhamentoResource extends Resource
{
    protected static ?string $model = Encaminhamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('paciente_id')
                    ->label('Paciente')
                    ->relationship(
                        name: 'Paciente',
                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('nome'),
                    )
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->nome}")
                    ->searchable()
                    ->editOptionForm([

                        Fieldset::make()
                            ->columns([
                                'sm' => 3,
                                'xl' => 3,
                            ])->schema([
                            Forms\Components\TextInput::make('nome')
                                ->readOnly()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\DatePicker::make('data_nascimento')
                                ->readOnly()
                                ->required(),
                            Forms\Components\Textarea::make('endereco')
                                ->readOnly()
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('profissão')
                                ->readOnly()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('telefone')
                                ->readOnly()
                                ->tel()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('anexo_rg')
                                ->disabled()
                                ->label('Anexo do RG')
                                ->downloadable(),
                            Forms\Components\TextInput::make('cor')
                                ->readOnly()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('obs')
                                ->readOnly()
                                ->required()
                                ->columnSpanFull(),
                            ]),
                    ]),

                Forms\Components\Select::make('tipoEncaminhamento_id')
                    ->label('Tipo de Encaminhamento')
                    ->options(TipoEncaminhamento::all()->pluck('nome', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('team_id')
                    ->label('UBS')
                    ->options(Team::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('status')
                    ->options([
                        '1' => 'Cadastrada na UBS',
                        '2' => 'Encaminhada para Regulação',
                        '3' => 'Recebida na Regulação',
                        '4' => 'Autorizada pela Regulação',
                        '5' => 'Recebida na UBS',
                        '6' => 'Paciente Notificado',
                        '7' => 'Concluído na UBS',
                    ])
                 ->native(false),
                Forms\Components\FileUpload::make('anexos')
                    ->downloadable()
                    ->multiple(),
                Forms\Components\Textarea::make('descricao')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paciente.nome')
                    ->label('Paciente')
                   /* ->getStateUsing(function(Encaminhamento $record){
                        dd($record->paciente->nome);
                    }) */
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipoEncaminhamento.nome')
              /*  ->getStateUsing(function(Encaminhamento $record){
                     dd($record->tipoEncaminhamento->id);
                 }) */
                    ->label('Tipo de Encaminhamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('team.name')
                    ->alignCenter()
                    ->label('UBS')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->alignCenter()
                    ->label('Status')
                    ->disabled()
                    ->options([
                        '1' => 'Cadastrada na UBS',
                        '2' => 'Encaminhada para Regulação',
                        '3' => 'Recebida na Regulação',
                        '4' => 'Autorizada pela Regulação',
                        '5' => 'Recebida na UBS',
                        '6' => 'Paciente Notificado',
                        '7' => 'Concluído na UBS',
                    ]),
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
            'index' => Pages\ManageEncaminhamentos::route('/'),
        ];
    }
}
