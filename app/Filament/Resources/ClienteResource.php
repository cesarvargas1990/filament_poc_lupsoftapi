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
use Filament\Forms\Components\Field;
use Filament\Tables\Filters\Filter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
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
                        Fieldset::make('Datos Empresa')
                            ->schema([
                                Forms\Components\Select::make('empresa_id')
                                    ->label('Empresa')
                                    ->relationship('empresa', 'nombre') // Relación con el modelo Empresa
                                    ->preload() // Precarga las opciones
                                    ->searchable() // Habilita la búsqueda
                                    ->createOptionForm([ // Habilita la creación de empresas desde la modal
                                        TextInput::make('nombre')
                                            ->label('Nombre de la Empresa')
                                            ->required(),
                                            
                                        TextInput::make('nit')
                                            ->label('NIT de la Empresa')
                                            ->required(),
                                            TextInput::make('capital_inicial')
                                            ->label('Capital inicial')
                                            ->required()
                                    ]),
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
                                Field::make('firma_cliente')
                                    ->label('Firma del Cliente')
                                    ->view('components.signature-pad') // Usa la vista personalizada
                                    ->columnSpan('full'), // Ocupa todo el ancho
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
                ->label('Nombre')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('numero_documento')
                ->label('Número Documento')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('ciudad')
                ->label('Ciudad')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('telefono')
                ->label('Teléfono')
                ->searchable(),
            Tables\Columns\TextColumn::make('celular')
                ->label('Celular')
                ->searchable(),
            Tables\Columns\TextColumn::make('fecha_nacimiento')
                ->label('Fecha Nacimiento')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Creado')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
       
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
