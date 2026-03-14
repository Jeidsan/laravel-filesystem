<x-main-layout>
    <div class="container">
        <p class="display-6 mt-5">Arquivos com metadados</p>
        <hr />
        <div class="row">
            @foreach ($files as $file)
                <div class="col-12 card-p-2">
                    <ul>
                        <li>Name: <strong>{{$file['name']}}</strong></li>
                        <li>Size: <strong>{{$file['size']}}</strong></li>
                        <li>Last modified: <strong>{{$file['last_modified']}}</strong></li>
                        <li>MIME type: <strong>{{$file['mime_type']}}</strong></li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-main-layout>
