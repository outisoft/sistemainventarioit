<?php
namespace App\Services;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class MicrosoftGraphService
{
    private $graph;

    public function __construct()
    {
        $this->graph = new Graph();
        $this->graph->setAccessToken($this->getAccessToken());
    }

    private function getAccessToken()
    {
        $client = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('GRAPH_CLIENT_ID'),
            'clientSecret'            => env('GRAPH_CLIENT_SECRET'),
            'redirectUri'             => env('GRAPH_REDIRECT_URI'),
            'urlAuthorize'            => 'https://login.microsoftonline.com/' . env('GRAPH_TENANT_ID') . '/oauth2/v2.0/authorize',
            'urlAccessToken'          => 'https://login.microsoftonline.com/' . env('GRAPH_TENANT_ID') . '/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes'                  => 'https://graph.microsoft.com/.default',
        ]);

        $accessToken = $client->getAccessToken('client_credentials');
        return $accessToken->getToken();
    }

    public function getUsers()
    {
        return $this->graph->createRequest('GET', '/users')
            ->setReturnType(Model\User::class)
            ->execute();
    }

    public function getDevices()
    {
        return $this->graph->createRequest('GET', '/devices')
            ->setReturnType(Model\Device::class)
            ->execute();
    }
}

