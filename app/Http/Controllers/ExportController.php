<?php

namespace App\Http\Controllers;

use App\Exports\BarangMasukExport;
use App\Exports\BarangKeluarExport;
use App\Models\ExportLog;
use App\Models\Item_in;
use App\Models\Item_out;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    // Barang Masuk - Excel
    public function exportBarangMasukExcel()
    {
        $fileName = 'barang_masuk_' . now()->format('Ymd_His') . '.xlsx';
        ExportLog::create([
            'super_admin_id' => Auth::id(),
            'type' => 'excel',
            'file_path' => 'exports/' . $fileName,
        ]);
        return Excel::download(new BarangMasukExport, $fileName);
    }

    // Barang Masuk - PDF
    public function exportBarangMasukPdf()
    {
        $items = Item_in::with('item')->get();
        $fileName = 'barang_masuk_' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.barang_masuk_pdf', compact('items'))
                  ->setPaper('a4', 'landscape');

        ExportLog::create([
            'super_admin_id' => Auth::id(),
            'type' => 'pdf',
            'file_path' => 'exports/' . $fileName,
        ]);

        return $pdf->download($fileName);
    }

    // Barang Keluar - Excel
    public function exportBarangKeluarExcel()
    {
        $fileName = 'barang_keluar_' . now()->format('Ymd_His') . '.xlsx';
        ExportLog::create([
            'super_admin_id' => Auth::id(),
            'type' => 'excel',
            'file_path' => 'exports/' . $fileName,
        ]);
        return Excel::download(new BarangKeluarExport, $fileName);
    }

    // Barang Keluar - PDF
    public function exportBarangKeluarPdf()
    {
        $items = Item_out::with('item')->get();
        $fileName = 'barang_keluar_' . now()->format('Ymd_His') . '.pdf';

        $pdf = Pdf::loadView('exports.barang_keluar_pdf', compact('items'))
                  ->setPaper('a4', 'landscape');

        ExportLog::create([
            'super_admin_id' => Auth::id(),
            'type' => 'pdf',
            'file_path' => 'exports/' . $fileName,
        ]);

        return $pdf->download($fileName);
    }
}
