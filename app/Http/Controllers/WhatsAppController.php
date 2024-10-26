<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chat\WhatsappIntegration\WhatsApp;

class WhatsAppController extends Controller
{
    //
    protected $whatsapp;

    public function __construct(Whatsapp $whatsapp){
        $this->whatsapp = $whatsapp;

    }

    
}
