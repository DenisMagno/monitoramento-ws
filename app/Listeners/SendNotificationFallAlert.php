<?php

namespace App\Listeners;

use App\Events\FallAlert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\Client;
use App\Notificacao;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class SendNotificationFallAlert
{
    private $url;
    private $headers;
    private $notificacao;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = "//fcm.googleapis.com/fcm/send";

        $this->headers = [
            "Content-Type" => "application/json",
            "Authorization" => "key=AIzaSyCb_Sa909V70e1EZPuZBLgHQtiNivHh4pI"
        ];
    }

    /**
     * Handle the event.
     *
     * @param  FallAlert  $event
     * @return void
     */
    public function handle(FallAlert $event)
    {
        $this->notificacao = $event->getNotificacao();

        $client = new Client();

        $body = $this->storeBodyHttp();
        $request = new Request('POST', $this->url, $this->headers, $body);
        $promise = $client->sendAsync($request);

        $promise->then(function ($response) {
            $responseJSON = json_decode($response->getBody());
            if($responseJSON->success){
                $this->notificacao->fcm_message_id = $responseJSON->results[0]->message_id;

                $this->notificacao->save();
            }else{
                $this->notificacao->delete();
            }
        }, function ($exception) {
            dump($exception);
        });

        $promise->wait();
    }

    public function storeBodyHttp(){
        $client_token = $this->notificacao->idoso->responsavel->fcm_token;

        $body = [
            "to" => $client_token,
            "data" => [
                "message" => "Mensagem aqui!"
            ],
            "notification" => [
                "title" => $this->notificacao->title,
                "body" => $this->notificacao->body,
                "icon" => $this->notificacao->icon,
                "sound" => $this->notificacao->sound,
                "color" => $this->notificacao->color,
                "clickAction" => $this->notificacao->clickAction,
                "tag" => $this->notificacao->tag,
                "link" => $this->notificacao->link
            ]
        ];

        return json_encode($body);
    }
}