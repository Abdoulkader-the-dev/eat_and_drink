<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body>
@auth
<div class="w-screen h-screen" data-theme="cupcake">

    <!-- Header -->
    <header class="navbar bg-base-200 shadow-md px-6">
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-white"><span class="bg-primary rounded-box p-2">Admin Dashboard</span></h2>
        </div>
        <div class="flex-none">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Mon Tableau de Bord</a>
        </div>
    </header>

    <!-- Layout -->
    <div class="flex w-screen h-[calc(100%-4rem)]">

        <!-- Sidebar -->
        <aside class="w-64 bg-base-300 p-4">
            <ul class="menu bg-base-300 rounded-box">
                <li class="menu-title">Navigation</li>
                <li><a href="{{ route('dashboard') }}" class="active">Tableau de bord</a></li>
                <li><a href="{{ route('stand') }}" class="active">List des Stands</a></li>
                <li><a href="{{ url('/') }}">Accueil</a></li> <!-- Link to home page -->
            </ul>
        </aside>

        <!-- Content -->
        <section class="flex-1 p-6 overflow-y-auto">
            <div class="card bg-base-100 shadow-xl p-4">
                <h3 class="text-lg font-semibold mb-4">Liste des demande de stands</h3>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full text-black">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom Entreprise</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->nom_entreprise }}</td>
                                <td>{{ $row->email }}</td>
                                <td class="flex gap-2">
                                    <form action="/approuved" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button class="btn btn-success btn-xs">Accepter</button>
                                    </form><form action="/reject" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button class="btn btn-error btn-xs">Refuser</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</div>
@endauth
</body>
</html>
