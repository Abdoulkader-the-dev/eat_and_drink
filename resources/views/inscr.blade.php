<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription - Eat & Drink</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="hero min-h-screen">
        <div class="hero-content flex-col">
            <!-- Brand Logo/Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold text-primary">Eat & Drink</h1>
                <p class="py-4 text-lg">Rejoignez notre communauté d'entrepreneurs</p>
            </div>

            <!-- Registration Card -->
            <div class="card w-full max-w-md shadow-2xl bg-base-100">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4 justify-center">Demande d'entreprenariat</h2>

                    <form action="/register" method="POST">
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nom de l'entreprise</span>
                            </label>
                            <input type="text" name="nom-entreprise"
                                   class="input input-bordered"
                                   placeholder="laVilla"
                                   value="{{ old('nom-entreprise') }}"
                                   required />
                            @error('nom-entreprise')
                            <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" name="email"
                                   class="input input-bordered"
                                   placeholder="exemple@gmail.com"
                                   value="{{ old('email') }}"
                                   required />
                            @error('email')
                            <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Mot de passe</span>
                            </label>
                            <input type="password" name="mot_de_passe"
                                   class="input input-bordered"
                                   placeholder="********"
                                   minlength="8"
                                   required />
                            <label class="label">
                                <span class="label-text-alt">Minimum 8 caractères</span>
                            </label>
                            @error('mot_de_passe')
                            <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-accent">
                                S'inscrire
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <div class="divider">Déjà membre?</div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline btn-primary">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
