<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EncryptAes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class FileEncryptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function viewencrypt()
    {
        $data = EncryptAes::all();
        return view('index', ['data' => $data]);
    }

    public function decrypt()
    {
        $file = EncryptAes::all();
        return view('decrypt', compact(['file']));
    }

    public function encrypt()
    {
        $file = EncryptAes::all();
        return view('encrypt', compact(['file']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
            'enkrip_key' => 'required',
            'description' => 'required',
            'nama_file' => 'required',

        ]);

        $file = $request->file('file');
        $originalFilename = $file->getClientOriginalName();

        try {
            //membuat nama file menjadi 
            $encryptedFilename = Str::random(40) . '.enc';

            //mengambil inputan encrypt_key
            $encryptionKey = $request->input('enkrip_key');

            //melakukan encrypt file pdf
            $encryptedFile = $this->encryptFile($file->getRealPath(), $encryptionKey);

            //mengambil inputan description
            $deskripsiInput = $request->input('description');

            $inputname = $request->input('nama_file');


            //mengirim file ke storage local
            Storage::disk('encrypt_pdf')->put($encryptedFilename, $encryptedFile);

            // Save the file details to the database
            $encryptedFileModel = EncryptAes::create([
                'nama_file' => $inputname,
                'enkrip_file' => $encryptedFilename,
                'enkrip_key' => $encryptionKey,
                'description' => $deskripsiInput,
            ]);

            return redirect()->back();
        } catch (\Exception $exception) {
            //pesan ketika key tidak terisi
            throw ValidationException::withMessages([
                'encryption_key' => 'Unable to encrypt the file.',
            ]);
        }
    }

    /**
     * Decrypt and download the file from the database.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, $id)
    {
        $encryptedFile = EncryptAes::findOrFail($id);

        if ($request->has('dekrip_key')) {

            //mengambil inputan decrypt_key
            $key = $request->input('dekrip_key');

            //melakukan decrypt file
            $decryptedFile = $this->decryptFile($encryptedFile->enkrip_file, $key);

            // mencocokkan encryptFile pada storage dengan filename yang ada di database
            $decryptedFilename = $encryptedFile->nama_file;

            //mengambil file dari storage lokal
            Storage::disk('local')->put($decryptedFilename, $decryptedFile);

            //menjalankan download file
            return response()->download(storage_path('app/' . $decryptedFilename))->deleteFileAfterSend(true);
        } else {
            //pesan error ketika key tidak ada
            return redirect()->back()->withErrors(['Please enter the decryption key.']);
        }
    }

    /**
     * Encrypt a file using AES.
     *
     * @param  string  $path
     * @param  string  $key
     * @return string
     */
    private function encryptFile($path, $key)
    {
        //mengambil path dari function store
        $fileContents = file_get_contents($path);

        //melakukan encrypt dengan AES menggunakan bit 256 dan mode CBC
        $iv = random_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $encryptedData = openssl_encrypt($fileContents, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        //menjalankan encryptData
        return $iv . $encryptedData;
        Session::flash('success', 'File encrypted and stored successfully.');
    }

    /**
     * Decrypt a file using AES.
     *
     * @param  string  $filename
     * @param  string  $key
     * @return string
     */
    private function decryptFile($nama_file, $key)
    {
        //mengambil file pdf dari storage dengan mencocokkan nama file
        $fileContents = Storage::disk('encrypt_pdf')->get($nama_file);

        //melakukan decrypt file dengan AES menggunakan bit 256 dan mode CBC
        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($fileContents, 0, $ivLength);
        $encryptedData = substr($fileContents, $ivLength);

        //menjalankan decryptdata
        return openssl_decrypt($encryptedData, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }
}
