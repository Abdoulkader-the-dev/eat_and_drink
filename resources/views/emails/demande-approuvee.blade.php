<x-mail::message>
# Félicitations, {{ $entrepreneur->nom_entreprise ?? $entrepreneur->name }} !

Nous avons le plaisir de vous informer que votre demande de statut d'entrepreneur sur notre plateforme a été **approuvée** !

Vous pouvez maintenant vous connecter à votre tableau de bord pour commencer à gérer votre stand et vos produits.

<x-mail::button :url="url('/login')">
Se connecter à votre tableau de bord
</x-mail::button>

Merci de faire partie de notre communauté !

Cordialement,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
