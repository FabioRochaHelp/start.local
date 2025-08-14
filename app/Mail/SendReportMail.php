<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $fileName;
    public $userName;

    public function __construct(string $userName, string $filePath, string $fileName)
    {
        $this->userName = $userName;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Relatório de Indicadores',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.report-file',
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromPath($this->filePath),
        ];
    }
}
