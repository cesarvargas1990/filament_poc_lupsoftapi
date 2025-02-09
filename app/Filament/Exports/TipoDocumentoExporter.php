<?php

namespace App\Filament\Exports;

use App\Models\TipoDocumento;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class TipoDocumentoExporter extends Exporter
{
    protected static ?string $model = TipoDocumento::class;

    public static function getColumns(): array
    {
        Log::info("Archivo exportado guardado en: ");
        return [
            ExportColumn::make('nombre_tipo_documento')->label('Nombre del Tipo de Documento'),
            ExportColumn::make('abreviatura')->label('Abreviatura'),
            ExportColumn::make('created_at')->label('Creado el'),
            ExportColumn::make('updated_at')->label('Actualizado el'),
        ];
    }

    
 


    /**
     * @inheritDoc
     */
    public static function getCompletedNotificationBody(Export $export): string {

        //xshttp://localhost:8000/exports/filament_exports/123/tipos_documento.xlsx

        Log::info(config('filesystems.disks.export.url'));
        $downloadUrl = config('filesystems.disks.export.url') . '/filament_exports/' . $export->id.'/'.$export->file_name.'.xlsx';
    
        return sprintf(
            '✅ Exportación completada. %s filas exportadas.<br><a href="%s" target="_blank" style="color: #2563EB; text-decoration: underline;">Descargar Archivo</a>',
            number_format($export->total_rows),
            $downloadUrl
        );
    }
}
