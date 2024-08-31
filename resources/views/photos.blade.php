    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Semua Gambar</title>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body>
        <p class="text-center py-5 text-2xl font-bold">
            SEMUA GAMBAR YANG TERSIMPAN
        </p>

        <button class="bg-orange-500 py-2 px-4 rounded-xl text-white font-bold ml-5">
            <a href="/camera">Kamera</a>
        </button>
        <p class="mt-3 ml-5">
            <u>
                Semua Gambar ( {{ $total }} )
            </u>
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mt-4">
            @foreach ($photos as $photo)
                <div class="p-1 border-2 border-black mx-1">
                    <img src="{{ asset('images/' . $photo->name) }}" alt="{{ $photo->name }}" width="320"
                        height="240" class="w-full">
                    <p class="text-center">{{ $photo->name }}</p>
                </div>
            @endforeach
        </div>

    </body>

    </html>
