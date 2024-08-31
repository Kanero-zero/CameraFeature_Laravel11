<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1 class="text-3xl my-5 text-center font-bold">Ambil Gambar dengan Kamera</h1>
    <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2">
            <video id="video" class="m-auto mr-1 border-2 border-black" width="320" height="240"
                autoplay></video>
            <canvas id="canvas" class="m-auto ml-1 border-2 border-black" width="320" height="240"
                style="display:none;"></canvas>
        </div>

        <div class="text-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 mt-4">
            <input type="text" class="border-b-2 border-black w-[30%] focus:outline-none m-auto" name="name"
                id="name" placeholder="Insert Your Name">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 mt-5">
            <button type="button" id="snap"
                class="bg-green-700 m-auto w-40 rounded-lg text-white font-bold p-3 mr-0.5">Ambil
                Gambar</button>
            <input type="hidden" name="image" id="image">
            <button type="submit" class="bg-purple-700 m-auto w-40 rounded-lg text-white font-bold p-3 ml-0.5">Simpan
                Gambar</button>
        </div>

        <div class="grid grid-cols-1 w-48 m-auto mt-4">
            <button class="bg-orange-500 p-3 rounded-xl text-white font-bold m-auto">
                <a href="/photos">Lihat Semua Photo</a>
            </button>
        </div>
    </form>



    <script>
        // Akses kamera dan tampilkan video
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var imageInput = document.getElementById('image');

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                video.srcObject = stream;
                video.play();
            })
            .catch(function(err) {
                console.log("Error: " + err);
            });

        // Tangkap gambar saat tombol ditekan
        document.getElementById('snap').addEventListener('click', function() {
            context.drawImage(video, 0, 0, 320, 240);
            var dataURL = canvas.toDataURL('image/png');
            imageInput.value = dataURL; // simpan gambar dalam base64
            canvas.style.display = 'block'; // Tampilkan canvas untuk melihat hasil gambar
            console.log("Gambar diambil: " + dataURL);
        });
    </script>
</body>

</html>
