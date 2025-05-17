<?php

namespace App\Http\Controllers;

use App\Models\DigitalItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DigitalItemDownloadController extends Controller
{
    public function __invoke(Request $request, DigitalItem $digitalItem): StreamedResponse
    {
        if (! $digitalItem->es_publico && ! Auth::check()) {
            abort(403);
        }

        $disk = $digitalItem->es_publico ? 'public' : 'local';
        return Storage::disk($disk)->download($digitalItem->archivo_path);
    }
}