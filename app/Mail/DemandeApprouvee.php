<?php

namespace App\Mail;

use App\Models\Utilisateur; // N'oubliez pas d'importer votre modèle Utilisateur
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandeApprouvee extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * L'utilisateur (entrepreneur) qui a été approuvé.
     *
     * @var \App\Models\Utilisateur
     */
    public $entrepreneur;

    /**
     * Crée une nouvelle instance de message.
     */
    public function __construct(Utilisateur $entrepreneur)
    {
        $this->entrepreneur = $entrepreneur;
    }

    /**
     * Obtenir l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande d\'entrepreneur a été approuvée !', // Sujet de l'e-mail
        );
    }

    /**
     * Obtenir la définition du contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.demande-approuvee', // Utilise une vue Markdown pour l'e-mail
            // Si vous préférez du HTML pur, utilisez 'view: 'emails.demande-approuvee','
        );
    }

    /**
     * Obtenir les pièces jointes pour le message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
