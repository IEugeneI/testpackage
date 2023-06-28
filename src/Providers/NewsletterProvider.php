<?php
namespace Abss\Sending_subscribe_mails\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot():void
    {
        $this->publishes([
            __DIR__.'/../config/subscribe_mail.php' => config_path('subscribe_mail.php'),
        ]);
    }
}