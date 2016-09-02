<?php 

namespace Assently;

use Assently\AssentlyCase;
use Assently\AssentlyParty;
use Assently\AssentlyDocument;

class Assently 
{
    /**
     * Create a new Assently instance.
     *
     * @param  string  $key
     * @param  string  $secret
     * @return void
     */
    public function __construct($key = null, $secret = null)
    {
        if ($key && $secret) {
            $this->authenticate($key, $secret);
        }
    }

    /**
     * Set the authentication keys.
     *
     * @param  string  $key
     * @param  string  $secret
     * @return $this
     */
    public function authenticate($key, $secret)
    {
        $this->key = $key;

        $this->secret = $secret;

        return $this;
    }

    /**
     * Get the authentication keys.
     *
     * @return array
     */
    public function auth()
    {
        return [
            $this->key, 
            $this->secret
        ];
    }

    /**
     * Get a new AssentlyCase instance. 
     *
     * @return AssentlyCase
     */
    public function case()
    {
        return new AssentlyCase($this);
    }

    /**
     * Get a new AssentlyDocument instance.
     *
     * @return AssentlyDocument
     */
    public function document()
    {
        return new AssentlyDocument;
    }

    /**
     * Get a new AssentlyParty instance.
     *
     * @return AssentlyParty
     */
    public function party()
    {
        return new AssentlyParty;
    }
}