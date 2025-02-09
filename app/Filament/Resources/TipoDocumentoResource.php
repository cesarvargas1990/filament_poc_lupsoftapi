<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TipoDocumentoExporter;
use App\Filament\Resources\TipoDocumentoResource\Pages;
use App\Models\TipoDocumento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Illuminate\Support\Facades\Log;
use Filament\Actions\Exports\Models\Export;
class TipoDocumentoResource extends Resource
{
    protected static ?string $model = TipoDocumento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_tipo_documento')
                    ->required(),
                Forms\Components\TextInput::make('abreviatura')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_tipo_documento')
                    ->label('Nombre del Tipo de Documento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('abreviatura')
                    ->label('Abreviatura')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(TipoDocumentoExporter::class) 
                    ->fileName(fn (Export $export): string => "tipos_documento")
                    ->icon('heroicon-o-arrow-down-tray')
                    ->formats([
                        ExportFormat::Xlsx,
                    ]),
                
                    
                   
                   
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
            'index' => Pages\ListTipoDocumentos::route('/'),
            'create' => Pages\CreateTipoDocumento::route('/create'),
            'edit' => Pages\EditTipoDocumento::route('/{record}/edit'),
        ];
    }
}
