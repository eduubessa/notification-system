<?php

namespace App\Commands;

use App\Models\Notification;
use App\Notifications\BirthdayNotification;
use App\Helpers\Constants\NotificationInterface;
use App\Services\MailerService;
use App\Services\TwilioService;

class NotificationCommand
{

    public string $name = 'system';
    public string $description = 'Notification.php System Command';

    public function __construct($arg = null)
    {
        //
        switch ($arg) {
            case 'system':
            case 'system:status':
                $this->status();
                break;
            case 'system:clear':
                $this->clear();
                break;
            case 'system:send':
                $this->send();
                break;
        }
    }

    public function send()
    {
        $notifications = Notification::where('status', NotificationInterface::NOTIFICATION_STATUS_PENDING)
            ->limit(30)
            ->get();

        foreach($notifications as $notification) {
            $mailer = new MailerService();
            $mailer->send($notification->email, "Happy birthday!", "Hello world");
            print "Sending Notification: ID: " . $notification->id . "| To: eduubessa@gmail.com" . PHP_EOL;
        }
    }

    public function status(): void
    {
        system("clear");

        $notification_total = Notification::count();
        $notification_pending = Notification::where('status', NotificationInterface::NOTIFICATION_STATUS_PENDING)->count();
        $notification_failed = Notification::where('status', NotificationInterface::NOTIFICATION_STATUS_FAILED)->count();
        $notification_sent = Notification::where('status', NotificationInterface::NOTIFICATION_STATUS_SENT)->count();

        echo "\n\n - Notifications Status - \n\n";
        print "\n \e[1;33m{$notification_pending} Notification.php pending!";
        print "\n \e[0;32m{$notification_sent} notifications sent!";
        print "\n \e[0;31m{$notification_failed} notifications failed!";
        print "\n \e[0;32m{$notification_total} notifications Found\e[0m";
    }

    private function clear(): void
    {
        Notification::query()->delete();

        // Clear system from database
        print "\e[0;32mNotification table on database cleared with success!\e[0m \n";
    }

}