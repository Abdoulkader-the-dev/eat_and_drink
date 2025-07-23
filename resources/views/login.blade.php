<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - Eat & Drink</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="hero min-h-screen">
        <div class="hero-content flex-col">
            <!-- Brand Logo/Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold text-primary">Eat & Drink</h1>
                <p class="py-4 text-lg">Connectez-vous à votre espace entrepreneur</p>
            </div>

            <!-- Login Card -->
            <div class="card w-full max-w-md shadow-2xl bg-base-100">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4 justify-center">Connexion</h2>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="text" name="loginemail"
                                   class="input input-bordered"
                                   placeholder="exemple@gmail.com"
                                   value="{{ old('loginemail') }}"
                                   required />
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
                                <a href="{{-- {{ route('password.request') }} --}}" class="label-text-alt link link-hover">Mot de passe oublié?</a>
                            </label>
                        </div>

                        <!-- Error Messages -->
                        @error('loginemail')
                        <div class="alert alert-error mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror

                        @error('mot_de_passe')
                        <div class="alert alert-error mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>

                    <div class="text-center">
                        <p class="mb-4">Vous n'avez pas de compte?</p>
                        <a href="{{ route('register') }}" class="btn btn-outline btn-accent">
                            Créer un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
