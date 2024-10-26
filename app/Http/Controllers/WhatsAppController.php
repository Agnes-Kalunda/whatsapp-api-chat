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

    public function sendMessage(Request $request){
        $request->validate([
            'to'=> ' required|string',
            'message'=> 'required|string',
        ]);

        try{
            $response = $this->whatsapp->sendMessage($request->to, $request->message);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    public function webhook(Request $request){
        // handle incoming msgs from whatsapp
        $from =$request->input('From');
        $body =$request->input('Body');

        $responseMessage = $this->processMessage($body);

        return response()->json(['message' => $responseMessage],200);
    }


    private function processMessage($message){
        if(stripos($message,'Hello') !== false){
            return "Hello! How can i help ?";

        }
        return 'Sorry, I did not understand that';
    }


}
