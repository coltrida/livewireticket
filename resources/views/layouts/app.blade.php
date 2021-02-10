<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Ticket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <livewire:styles/>
    <livewire:scripts/>

    <script src="{{asset('js/app.js')}}"></script>

</head>
<body class="flex flex-wrap justify-center">
<div class="flex w-full justify-between px-4 bg-purple-900 text-white">
    <a class="mx-3 py-4" href="/">Home</a>
    @auth
        <livewire:logout/>
    @endauth
    @guest
        <div class="py-4">
            <a class="mx-3" href="/login">Login</a>
            <a class="mx-3" href="/register">Register</a>
        </div>
    @endguest
</div>

<div class="my-10 w-full flex justify-center">
    {{ $slot }}
</div>

<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false">

    Livewire.on('fileChoosen', () => {
        let inputField = document.getElementById('image');
        let file = inputField.files[0];
        let reader = new FileReader();
        reader.onloadend = () => {
            Livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })
</script>
</body>
</html>

