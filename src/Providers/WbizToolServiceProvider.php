<?php


namespace Haxmedia\WbizToolLaravel\Providers;

use Haxmedia\WbizTool\Client;
use Haxmedia\WbizTool\Dto\Credentials;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\ServiceProvider;

class WbizToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configFile(), 'wbiztool');

        $this->publishes(
            [
                $this->configFile() => $this->app['path.config'] . DIRECTORY_SEPARATOR . 'wbiztool.php',
            ],
            'config'
        );

        /** @var Repository $config */
        $config = $this->app->get('config');

        $this->app->bind(Client::class, function () use ($config) {

            $credentials = new Credentials(
                $config->get('wbiztool.clientId'),
                $config->get('wbiztool.apiKey'),
                $config->get('wbiztool.whatsappClientId'),
            );

            return new Client(new \GuzzleHttp\Client(), $credentials);
        });
    }

    /**
     * Get module config file.
     *
     * @return string
     */
    protected function configFile()
    {
        return realpath(__DIR__ . '/../../config/wbiztool.php');
    }
}