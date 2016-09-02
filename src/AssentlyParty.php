<?php

namespace Assently;

class AssentlyParty
{
    /**
     * Create a new partie, will return a compatible PartyModel
     * used by the case API endpoint. 
     *
     * @param  array   $options
     * @return array
     */
    public function create($options)
    {
        $filesystem = app('files');

        $json = [
            'Id' => rand(1111, 9999)
        ];

        return array_merge($json, $options);
    }
}