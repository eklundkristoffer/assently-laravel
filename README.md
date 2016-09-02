# assently-laravel

### Installation
Install with composer by running ```composer require eklundkristoffer/assently```

Add ```Assently\AssentlyServiceProvider``` to your providers array. 

Add following lines to your .env file and update them with your own keys:
```
ASSENTLY_DEBUG=true
ASSENTLY_KEY=<KEY_HERE>
ASSENTLY_SECRET=<SECRET_HERE>
```

### Examples

```php
$assently = new Assently\Assently;

$assently->authenticate(env('ASSENTLY_KEY'), env('ASSENTLY_SECRET'));

$data = [
    'name' => 'Employmeent agreement '. rand(111, 999),
    'NameAlias' => 'employmeent-agreement-'. rand(111, 999),
    'AllowedSignatureTypes' => [
        'electronicid'
    ],
    'Documents' => [
        $assently->document()->create('path/to/document.pdf')
    ],
    "Parties" => [
        $assently->party()->create([
            'Name'          => 'John Doe',
            'EmailAddress'  => 'johndoe@gmail.com',
            'AnyoneCanSign' => false
        ])
    ],

    // Notify the parties that the document is ready
    // to be signed via email. 
    'SendSignRequestEmailToParties' => true
];

$assently->case()->create($data)->send();
