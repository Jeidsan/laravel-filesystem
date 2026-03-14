<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storageLocalCreate()
    {
        Storage::put('file1.txt', 'Conteúdo do ficheiro 1');
        Storage::put('file2.txt', 'Conteúdo do ficheiro 2');

        return redirect()->route('home');
    }

    public function storageLocalAppend()
    {
        Storage::append('file3.txt', Str::random(100));
        Storage::append('file3.txt', Str::random(100));

        return redirect()->route('home');
    }

    public function storageLocalRead()
    {
        $content = Storage::get('file1.txt');
        //$content = Storage::disk('local')->get('file1.txt');

        echo $content;
    }

    public function storageLocalReadMulti()
    {
        $lines = Storage::get('file3.txt');
        $lines = explode(PHP_EOL, $lines);

        foreach ($lines as $line) {
            echo "<p>$line</p>";
        }
    }

    public function storageLocalCheckFile()
    {
        $exists = Storage::disk('local')->exists('file1.txt');

        if( $exists ) {
            echo 'O ficheiro existe';
        } else {
            echo 'O ficheiro não existe';
        }
    }

    public function storeJson()
    {
        $data = [
            [ 'name' => 'joão', 'email' => 'joao@gmail.com' ],
            [ 'name' => 'maria', 'email' => 'maria@gmail.com' ],
            [ 'name' => 'rute', 'email' => 'rute@gmail.com' ],
        ];

        Storage::put('data.json', json_encode($data));
        echo 'Ficheiro JSON criado';
    }

    public function readJson()
    {
        $data = Storage::json('data.json');
        echo '<pre>';
        print_r($data);
    }

    public function listFiles()
    {
        //$files = Storage::files('public');
        $files = Storage::files();
        echo '<pre>';
        print_r($files);
    }

    public function deleteFile()
    {
        Storage::delete('file1.json');
        echo 'Arquivo removido com sucesso.';
    }

    public function createFolder()
    {
        Storage::makeDirectory('documents');
        Storage::makeDirectory('documents/test');
        echo 'Pasta criada com sucesso.';
    }

    public function deleteFolder()
    {
        Storage::deleteDirectory('documents/test');
        echo 'Pasta excluída com sucesso.';
    }

    public function listFilesWithMetadata()
    {
        $list_files = Storage::allFiles();

        $files = [];

        foreach($list_files as $file)
        {
            $files[] = [
                'name' => $file,
                'size' => round(Storage::size($file) / 1024, 2) . 'KB',
                'last_modified' => Carbon::createFromTimestamp(Storage::lastModified($file))->format('d/m/Y H:i:s'),
                'mime_type' => Storage::mimeType($file)
            ];
        }

        return view('list-files-with-metadata', compact('files'));
    }

    public function listFilesForDownload()
    {
        $list_files = Storage::allFiles();

        $files = [];

        foreach($list_files as $file)
        {
            $files[] = [
                'name' => $file,
                'size' => round(Storage::size($file) / 1024, 2) . 'KB',
                'file' => basename($file)
            ];
        }

        return view('list-files-for-download', compact('files'));
    }

    public function download($file)
    {
        return response()->download('storage/' . $file);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'arquivo' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        $request->file('arquivo')->store('upload');
        //$request->file('arquivo')->storeAs('upload', $request->file('arquivo')->getClientOriginalName());

        echo 'Arquivo enviado com sucesso';
    }
}
