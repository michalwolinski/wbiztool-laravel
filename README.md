# WbizTool Client Laravel Library

A WbizTool API Client Laravel integration

---
## Installation by Composer
1. Run
    ```php   
    composer require michalwolinski/wbiztool-laravel
    ``` 
    in console to install this library.
2. Run
    ```
    php artisan vendor:publish --provider="Haxmedia\WbizToolLaravel\Providers\WbizToolServiceProvider"
    ```
    in your console to publish default configuration files

3. Open .env and add your configuration:

    `WBIZTOOL_CLIENT_ID` - Your Client Id (Given on Dashboard in API Setting Section)
    
    `WBIZTOOL_API_KEY` - Your Api Key (Given on Dashboard in API Setting Section)
    
    `WBIZTOOL_WHATSAPP_CLIENT_ID` - Your WhatsApp Client Id (Given on Whatsapp Setting Page) (Given on Dashboard in API Setting Section)

---

## Usage

I propose to use Dependency Injection to inject `Client` class.

Example implementation in service class:
```

use Haxmedia\WbizTool\Client;
use Haxmedia\WbizTool\Dto\Receiver;
use Haxmedia\WbizTool\MessageType\Text;
use Haxmedia\WbizTool\Method\SendMessage;

class Service {

    private Client $wbizToolClient;

    public function __construct(Client $wbizToolClient)
    {
        $this->wbizToolClient = $client;
    }

    public sendMessage(int $phoneNumber, string $message): void
    {
        $receiver = new Receiver($phoneNumber);
        $type = new Text('message content');
        $this->wbizToolClient->push(
            new SendMessage(),
            $receiver,
            $type
        );
    }
}
```

Usage examples are at library repository - [WbizTool PHP](https://github.com/michalwolinski/wbiztool-php)

## Authors

* **Michal Wolinski** - [Haxmedia](https://haxmedia.pl)

## License

This project is licensed under the MIT License.