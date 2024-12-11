<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

use BaconQrCode\Common\ErrorCorrectionLevel;

class QRCodeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $url = url('/activate/qr/' . $request->groupUuid . '/' . $request->numberUuid);

        $renderer = new GDLibRenderer(size: 200, margin: 1);
        $writer = new Writer($renderer);
        $w = $writer->writeString(content: $url, ecLevel: ErrorCorrectionLevel::L());

        return response($w)
            ->header('Content-Type', 'image/png');
    }
}
