<?php

namespace App\Http\Controllers;

use App\Libraries\APILibrary;
use App\Libraries\DatabaseLibrary;
use App\Libraries\NotificationLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function fileUploadView() {
        return view('file-upload');
    }

    public function getHistoryView() {
        return view('file-history');
    }

    public function uploadFile(Request $request) {
        $request->validate([
            'file' => 'required|mimes:wav|max:5120',
        ]);

        $fileName = time().'.'.$request->file->extension();
        $jobName = time();
        $request->file->move(public_path('uploads'), $fileName);

        $url = APILibrary::uploadAndConvertFile($jobName, $fileName);
        DatabaseLibrary::saveFileDetails(Auth::user()->email, public_path('uploads').'/'.$fileName, $request->fileName, $url);
        NotificationLibrary::sendNotificationEmail(Auth::user()->email, $request->originalName);

        return back()
            ->with('success', true)
            ->with('out-url', $url);
    }
}
