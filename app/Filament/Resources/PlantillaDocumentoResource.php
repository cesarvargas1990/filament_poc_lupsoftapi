<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantillaDocumentoResource\Pages;
use App\Filament\Resources\PlantillaDocumentoResource\RelationManagers;
use App\Models\PlantillaDocumento;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlantillaDocumentoResource extends Resource
{
    protected static ?string $model = PlantillaDocumento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nombre')
                ->required()
                ->maxLength(255),

            Select::make('codtipodocumento')
                ->options([
                    '1' => 'Factura',
                    '2' => 'Recibo',
                    '3' => 'Contrato',
                ])
                ->required(),

            RichEditor::make('plantilla_html')
                ->label('Plantilla HTML')
                ->required()
                ->columnSpanFull(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nombre')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('codtipodocumento')->sortable(),
            Tables\Columns\TextColumn::make('plantilla_html')
                ->label('Vista Previa')
                ->limit(30), 
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
            'index' => Pages\ListPlantillaDocumentos::route('/'),
            'create' => Pages\CreatePlantillaDocumento::route('/create'),
            'edit' => Pages\EditPlantillaDocumento::route('/{record}/edit'),
        ];
    }
}
