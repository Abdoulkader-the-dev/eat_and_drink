<!DOCTYPE html>
<html lang="fr" data-theme="retro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Stand - Eat & Drink</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="hero min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <!-- Branding Section -->
            <div class="text-center lg:text-left lg:ml-12">
                <div class="p-6 bg-base-100 rounded-lg shadow-lg max-w-md">
                    <h1 class="text-5xl font-bold text-primary mb-2">Eat & Drink</h1>
                    <p class="py-4 text-xl">Créez votre espace d'exposition</p>
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-600">Rejoignez notre communauté d'exposants et présentez vos produits aux visiteurs.</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="card flex-shrink-0 w-full max-w-md shadow-2xl bg-base-100">
                <div class="card-body">
                    <h2 class="card-title text-3xl mb-6 justify-center text-primary">Ajouter un Stand</h2>

                    <!-- Success & Error messages -->
                    @if(session('success'))
                        <div class="alert alert-success shadow-lg mb-6">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error shadow-lg mb-6">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="/addStand" method="POST" class="space-y-4">
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Nom du stand</span>
                            </label>
                            <input type="text" name="nom_stand"
                                   class="input input-bordered w-full focus:ring-2 focus:ring-primary"
                                   placeholder="Ex: La Crêperie Bretonne"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Description</span>
                            </label>
                            <textarea name="description"
                                      class="textarea textarea-bordered w-full focus:ring-2 focus:ring-primary"
                                      placeholder="Décrivez votre stand, vos spécialités..."
                                      rows="4"></textarea>
                        </div>

                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Créer mon stand
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>

                    <div class="text-center">
                        <a href="/" class="btn btn-ghost">
                            Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
