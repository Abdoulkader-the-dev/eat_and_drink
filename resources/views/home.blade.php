<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="h-screen w-screen">
    @auth
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <h1 class="text-xl font-bold mb-4">EAt&DRINk</h1>
            <ul>
                <li class="btn btn-secondary m-2"><a href="#" class="hover:underline">Home</a></li>
                <li class="btn btn-secondary m-2"><a href="#" class="hover:underline">About</a></li>
                <li class="btn btn-secondary m-2"><a  href="#" class="hover:underline">Contact</a></li>
                <li class="btn btn-secondary m-2"><a id="activeStand" class="hover:underline">Demande de Stand</a></li>
            </ul>
        </aside>

        <main class="flex-1 flex flex-col items-center justify-center gap-10 bg-base-100" data-theme="cupcake">
            @php
                $showStandForm = $errors->any(); // Si erreurs, on montre le formulaire
            @endphp
            @if (session('stand_success'))
                <div class="alert alert-success mb-4">
                    {{ session('stand_success') }}
                </div>
            @endif
            <!-- Contenu principal -->
            <div id="content" @if($showStandForm) hidden @endif>
                <p class="text-4xl text-center">BIENVENU SUR LE PLATFORME EAT&DRINK 🍟🍻</p>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-warning btn-wide border border-4 border-secondary m-4">
                        Se deconnecter ->
                    </button>
                </form>
                <button id="openStand" class="btn btn-primary mt-4">
                    Demander un stand
                </button>
            </div>

            <!-- -------------Demande de Stand--------- -->
            <div id="stand-form" class="flex flex-col justify-center" @unless($showStandForm) hidden @endunless>
              <form action='/stand' method="POST">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend text-2xl">Demande de Stand</legend>

            <label class="label">Nom Stand</label>
            <input type="text" name="nom" class="input rounded-box @error('nom') input-error @enderror" value="{{ old('nom') }}">
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label class="label">Description</label>
            <textarea class="textarea rounded-box @error('description') textarea-error @enderror" name="description" cols="10" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label class="label">Votre email</label>
            <input type="email" name="email" class="input @error('email') input-error @enderror" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </fieldset>

        <button class="btn btn-primary border border-3 border-secondary m-4" type="submit">Envoyer</button>
        <button id="cancelStand" type="button" class="btn btn-neutral border border-3 border-secondary m-4">Retour</button>
    </form>
</div>
        </main>
    </div>
    @endauth
</body>
</html>

