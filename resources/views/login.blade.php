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
    @guest
    <!-- --------Inscription----------------_-->
    <div id="register-form" class="flex flex-col justify-center rounded">
        <form action="/register" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4"  data-theme="retro">
            <p class="fieldset-legend text-xl">Demande d'entreprenariat</p>

            <label class="label">Nom</label>
            <input type="text" name="nom" class="input" placeholder="Doe" />

            <label class="label">Prenom</label>
            <input type="text" name="prenom" class="input" placeholder="John" />

            <label class="label">Nom de l'entreprise</label>
            <input type="text" name="nom-entreprise" class="input" placeholder="laVilla" />

            <label class="label">Email</label>
            <input type="email" name="email" class="input" placeholder="exemple@gmail.com" />

            <label class="label">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="input" placeholder="********" min="8"/>
            </fieldset>
            <button class="btn btn-primary btn-wide border border-4 border-secondary m-4">S'inscrire</button>
        </form>
    </div>

    <!-- --------Connexion----------------_-->
    <div id="login-form" class="flex flex-col justify-center">
        <form action="/login" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4"  data-theme="retro">
            <p class="fieldset-legend text-2xl">Se connecter</p>

            <label class="label">Email</label>
            <input type="text" name="loginemail" class="input" placeholder="exemple@gmail.com" />
            <label class="label">Mot de passe</label>
            <input type="password" name="mot_de_passe" class="input" placeholder="*****" min="8"/>
            @error('loginemail')
                <p class="text-red-500 text-sm mt-1 aler aler-warning">{{ $message }}</p>
            @enderror
            @error('mot_de_passe')
                <p class="text-red-500 text-sm mt-1 aler aler-warning">{{ $message }}</p>
            @enderror
            </fieldset>
            <button class="btn btn-primary btn-wide border border-4 border-secondary m-4">Se connecter 🚪</button>
        </form>
    </div>
    @endguest

    </div>
</body>
</html>
