<?php

namespace Bootstrap;

use App\Services\MailerService;
use App\Services\TwilioService;

class Notification
{
    protected string $to;
    protected array $type = [
      'mail', 'message'
    ];

    public function __construct(string $to)
    {
        $this->to = $to;
    }

    private function send_email($to, $message): void {
        $mailer = new MailerService();
        $mailer->to($to)->body($message)->send();
    }

    private function send_message($to, $message): void {
        $twilio = new TwilioService();
        $twilio->send_message($to, $message);
    }

    /**
     * @return void
     */
    public function notify($people, $message)
    {
        dd($people);

        if(in_array('mail', $this->type)) {
            $this->send_mail();
        }

        if(in_array('message', $this->type)) {
            $this->send_message();
        }
    }
}