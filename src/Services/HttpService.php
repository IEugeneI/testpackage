<?php

namespace Abss\Sending_subscribe_mails\Services;

use Abss\Sending_subscribe_mails\Traits\Response;
use Illuminate\Support\Facades\Http;

class HttpService
{
    use Response;

    /**
     * @param $url
     * @return array
     */
    public static function get($url): array
    {
        $response = self::setHeaders()->get($url);
        return self::checkResponse($response);
    }

    /**
     * @param $url
     * @param $fields
     * @return array
     */
    public static function post($url, $fields = []): array
    {
        $response = self::setHeaders()->post($url, $fields);
        return self::checkResponse($response);
    }

    /**
     * @param $url
     * @param array $fields
     * @return array
     */
    public static function patch($url, array $fields): array
    {
        $response = self::setHeaders()->patch($url, $fields);
        return self::checkResponse($response);
    }

    /**
     * @param $url
     * @param array $fields
     * @return array
     */
    public static function put($url, array $fields): array
    {
        $response = self::setHeaders()->put($url, $fields);
        return self::checkResponse($response);
    }

    /**
     * @param $url
     * @return array
     */
    public static function delete($url): array
    {
        $response = self::setHeaders()->delete($url);
        return self::checkResponse($response);
    }

    /**
     * @param $response
     * @return array
     */
    public static function checkResponse($response): array
    {
        if ($response->successful() == true) {
            return self::success($response->body());
        }
        return self::error($response);
    }

    /**
     * @return mixed
     */
    public static function setHeaders()
    {
        if(config('subscribe_mail.provider')=='Mailchimp'){
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . config('subscribe_mail.mailchimp.apiKey')
            ]);
        }
        if(config('subscribe_mail.provider')=='Brevo'){
            return Http::withHeaders([
                'content-type' =>  'application/json',
                'api-key' =>  config('subscribe_mail.brevo.apiKey'),
            ]);
        }
        if(config('subscribe_mail.provider')=='CampaignMonitor'){
            return Http::withBasicAuth(config('subscribe_mail.campaignmonitor.apiKey'),'x');
        }

    }
}