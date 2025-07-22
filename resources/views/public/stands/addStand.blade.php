<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'Entreprenariat - Eat & Drink</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200 flex items-center justify-center min-h-screen" data-theme="retro">

    <div class="card w-full max-w-md bg-base-100 shadow-xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Ajouter un Stand</h1>

        {{-- Success & Error messages --}}
        @if(session('success'))
            <div class="alert alert-success shadow-lg mb-4">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error shadow-lg mb-4">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="/addStand" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="label">
                    <span class="label-text">Nom du stand</span>
                </label>
                <input type="text" name="nom_stand" class="input input-bordered w-full" placeholder="monstand" required>
            </div>

            <div>
                <label class="label">
                    <span class="label-text">Description</span>
                </label>
                <textarea name="description" class="textarea textarea-bordered w-full" placeholder="Décrivez votre stand..." rows="4"></textarea>
            </div>

            <div class="mt-6">
                <button class="btn btn-primary w-full">S'inscrire</button>
            </div>
        </form>
    </div>

</body>
</html>
