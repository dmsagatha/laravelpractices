<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMessageMail extends Mailable
{
  use Queueable, SerializesModels;

  public $user;
  public $contentMessage;
  public $senderName;
  public $senderEmail;

  /**
   * Crear una nueva instancia de mensaje.
   */
  public function __construct(User $user, string $contentMessage, string $senderName, string $senderEmail)
  {
    $this->user = $user;
    $this->contentMessage = $contentMessage;
    $this->senderName = $senderName;
    $this->senderEmail = $senderEmail;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      // from: new Address('superadmin@superadmin.net', 'Admin'),
      // subject: 'Mensaje de la aplicación',
      from: new Address($this->senderEmail, $this->senderName),  // Remitente dinámico
      subject: 'Mensaje para ' . $this->user->name,
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.user-message',
      with: [
        'contentMessage' => $this->contentMessage,
        'user' => $this->user,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array {
    return [];
  }
}