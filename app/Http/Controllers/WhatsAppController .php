<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;

class WhatsAppController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function send()
    {
        $recipient = '9360422493';
        $message = 'Hello, this is a test message from Twilio!';

        $response = $this->whatsAppService->sendMessage($recipient, $message);

        return response()->json(['status' => 'Message sent!', 'data' => $response]);
    }
}
