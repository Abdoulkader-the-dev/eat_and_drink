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
    <div id="register-form" class="flex flex-col justify-center">
        <form action="/register" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend text-2xl">Inscription</legend>

            <label class="label">Nom</label>
            <input type="text" name="nom" class="input" placeholder="John Doe" />

            <label class="label">Preom</label>
            <input type="text" name="prenom" class="input" placeholder="John Doe" />

            <label class="label">Email</label>
            <input type="email" name="email" class="input" placeholder="exemple@gmail.com" />

            <label class="label">Password</label>
            <input type="password" name="mot_de_passe" class="input" placeholder="********" min="8"/>
            </fieldset>
            <button class="btn btn-primary btn-wide border border-4 border-secondary m-4">S'inscrire</button>
        </form>
    </div>

    <div id="login-form" class="flex flex-col justify-center">
        <form action="/login" method="POST">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend text-2xl">Login Form</legend>

            <label class="label">Email</label>
            <input type="text" name="loginemail" class="input" placeholder="exemple@gmail.com" />

            <label class="label">Password</label>
            <input type="password" name="mot_de_passe" class="input" placeholder="*****" min="8"/>
            </fieldset>
            <button class="btn btn-primary btn-wide border border-4 border-secondary m-4">Se connecter 🚪</button>
        </form>
    </div>
    @endguest

    </div>
</body>
</html>
