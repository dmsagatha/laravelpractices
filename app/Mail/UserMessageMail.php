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

  /**
   * Create a new message instance.
   */
  public function __construct(User $user, string $contentMessage)
  {
    $this->user = $user;
    $this->contentMessage = $contentMessage;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address('superadmin@superadmin.net', 'Admin'),
      subject: 'Mensaje de la aplicación',
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