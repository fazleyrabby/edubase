<?php

namespace App\Modules\Scraper\Notifications;

use App\Modules\Scraper\Models\ScraperRun;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScraperFailedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ScraperRun $run,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $source = $this->run->source;

        return (new MailMessage)
            ->error()
            ->subject("Scraper Failed: {$source?->name}")
            ->line("Scraper source **{$source?->name}** failed.")
            ->line("URL: {$source?->base_url}")
            ->line("Error: {$this->run->error_message}")
            ->action('View Run', route('admin.scrapers.runs.show', $this->run));
    }
}
