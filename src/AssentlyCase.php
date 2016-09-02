<?php

namespace Assently;

use Exception;
use GuzzleHttp\Client;

class AssentlyCase 
{
    /**
     * Create a new AssentlyCase instance.
     *
     * @param  Assently  $assently
     * @return void
     */
    public function __construct($assently)
    {
        $this->client   = new Client();
        $this->assently = $assently;
    }

    /**
     * Get the request URL.
     *
     * @param  string  $uri
     * @return string
     */
    public function url($uri = '')
    {
        $domain = (env('ASSENTLY_DEBUG')) ? 'test.assently.com' : 'app.assently.com' ;

        return 'https://'.$domain.'/api/v2/'.$uri;
    }

    /**
     * Create a new case.
     *
     * @return $this
     */
    public function create($data)
    {
        $default = [
            'Id' => '5a0e0869-'.rand(1111, 9999).'-4b79-'.rand(1111, 9999).'-466ea5cca5ce'
        ];

        $json = array_merge($default, $data);

        $response = $this->client->post($this->url('createcase'), [
            'auth' => $this->assently->auth(),
            'json' => $json
        ]);

        $this->id = $json['Id'];

        return $this;
    }

    /**
     * Send the new case request.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public function send($id = null)
    {
        if (! isset($id) && ! isset($this->id)) {
            throw new Exception('No case ID found.');
        }

        $response = $this->client->post($this->url('sendcase'), [
            'auth' => $this->assently->auth(),
            'json' => [
                'Id' => ($id) ? $id : $this->id 
            ]
        ]);

        return $response;
    }
}