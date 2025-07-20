<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="w-screen h-screen flex items-center justify-center space-between gap-20"  data-theme="cupcake">
    @auth
        <p class="text-4xl">Wlecom back 🥳🥳🥳</p>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-warning btn-wide border border-4 border-secondary m-4">Se deconnecter -></button>
        </form>
    @endauth
    </div>
</body>
</html>
