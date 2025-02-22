<?php

namespace App\Filament\Imports;

use App\Models\Cliente;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ClienteImporter extends Importer
{
    protected static ?string $model = Cliente::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nombre')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('numero_documento')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('tipo_documento_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('email')
                ->rules(['email']),
            ImportColumn::make('cobrador'),
            ImportColumn::make('fecha_expedicion')
                ->rules(['date']),
            ImportColumn::make('fecha_nacimiento')
                ->rules(['date']),
            ImportColumn::make('tipo_documento'),
            ImportColumn::make('empresa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('ciudad'),
            ImportColumn::make('telefono'),
            ImportColumn::make('celular'),
            ImportColumn::make('dir_casa'),
            ImportColumn::make('dir_trabajo'),
            ImportColumn::make('referencia_1'),
            ImportColumn::make('referencia_2'),
            ImportColumn::make('firma_cliente'),
            ImportColumn::make('cedula'),
            ImportColumn::make('foto'),
        ];
    }

    public function resolveRecord(): ?Cliente
    {
        // return Cliente::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Cliente();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your cliente import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
