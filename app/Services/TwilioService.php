<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $this->from = config('services.twilio.from');
    }

    public function sendSms($to, $message)
    {
        // التحقق من صيغة الرقم E.164
        if (!preg_match('/^\+\d{8,15}$/', $to)) {
            \Log::error("Twilio SMS Error: رقم غير صالح $to");
            return false;
        }

        try {
            $this->client->messages->create(
                $to,
                [
                    'from' => $this->from,
                    'body' => $message
                ]
            );
            return true;
        } catch (\Exception $e) {
            \Log::error('Twilio SMS Error: ' . $e->getMessage());
            return false;
        }
    }
       public function sendWhatsApp($to, $message)
    {
         try {
        $this->client->messages->create(
            "whatsapp:$to",               // رقم المستلم مسبوق بـ whatsapp:
            [
                'from' => '+14155238886:' . $this->from, // رقم Twilio Sandbox WhatsApp
                'body' => $message
            ]
        );
        return true;
        } catch (\Exception $e) {
        \Log::error('Twilio WhatsApp Error: ' . $e->getMessage());
        return false;
        }
    }
}
