# Installation
Install with composer by running ```composer require eklundkristoffer/assently```

Add ```Assently\AssentlyServiceProvider``` to your providers array. 

Add following lines to your .env file and update them with your own keys:
```
ASSENTLY_DEBUG=true
ASSENTLY_KEY=<KEY_HERE>
ASSENTLY_SECRET=<SECRET_HERE>
```

# Examples

### Create & send a new case. 
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
    ]
];

$assently->case()->create($data)->send();
```

### Send a case reminder

```php
$assently = new Assently\Assently;

$assently->authenticate(env('ASSENTLY_KEY'), env('ASSENTLY_SECRET'));

$assently->case()->find('5a0e0869-6807-4b79-3712-466ea5cca5ce')->remind();
```
