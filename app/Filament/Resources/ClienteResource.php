<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Fieldset::make('Datos Personales')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('nombre')
                                            ->label('Nombre del Cliente')
                                            ->required(),
                                        TextInput::make('numero_documento')
                                            ->label('Número Documento')
                                            ->required(),
                                        TextInput::make('email')
                                            ->email()
                                            ->label('Email'),
                                    ]),
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('cobrador')
                                            ->label('Cobrador'),
                                        DatePicker::make('fecha_expedicion')
                                            ->label('Fecha Expedición'),
                                        DatePicker::make('fecha_nacimiento')
                                            ->label('Fecha Nacimiento'),
                                    ]),
                                TextInput::make('tipo_documento')
                                    ->label('Tipo Documento'),
                            ]),
    
                        Fieldset::make('Datos Contacto')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('ciudad')->label('Ciudad'),
                                        TextInput::make('telefono')->label('Teléfono Fijo'),
                                        TextInput::make('celular')->label('Celular'),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('dir_casa')->label('Dir Casa'),
                                        TextInput::make('dir_trabajo')->label('Dir Trabajo'),
                                    ]),
                            ]),
    
                        Fieldset::make('Referencias')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('referencia_1')->label('Referencia 1'),
                                        TextInput::make('referencia_2')->label('Referencia 2'),
                                    ]),
                            ]),
    
                        Fieldset::make('Firma Cliente')
                            ->schema([
                                Textarea::make('firma_cliente')
                                    ->label('Escriba su firma sobre el cuadro de abajo'),
                            ]),
    
                        Fieldset::make('Archivos')
                            ->schema([
                                FileUpload::make('cedula')->label('Cédula ciudadanía'),
                                FileUpload::make('foto')->label('Foto'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cobrador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_expedicion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('celular')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dir_casa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dir_trabajo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referencia_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referencia_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cedula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
