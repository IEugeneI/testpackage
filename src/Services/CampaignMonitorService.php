<?php

namespace Abss\Sending_subscribe_mails\Services;


use Abss\Sending_subscribe_mails\Services\Interfaces\CampaignsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\ListsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\SubscribersInterface;
use Abss\Sending_subscribe_mails\Traits\Response;

class CampaignMonitorService implements CampaignsInterface, ListsInterface, SubscribersInterface
{
    use Response;

    const CAMPAIGNS_URL = 'https://api.createsend.com/api/v3.3/campaigns';
    const CAMPAIGNS_URL_SEND = '/send';
    const LIST_URL = 'https://api.createsend.com/api/v3.3/lists';
    const LIST_URL_SEGMENT = '/segments';
    const SUBSCRIBERS_URL = 'https://api.createsend.com/api/v3.3/subscribers';
    const USER_CAMPAIGN_URL = 'https://api.createsend.com/api/v3.3/clients/';
    const CAMPAIGN_SCHEDULE = 'scheduled.json';
    const TEMPLATE_URL = 'https://api.createsend.com/api/v3.3/templates/';

    //Campaigns

    /**
     * @return array
     */
    public static function getCampaigns(): array
    {
        $response = HttpService::get(self::USER_CAMPAIGN_URL . '/' . config('subscribe_mail.campaignmonitor.client_id') . '/' . self::CAMPAIGN_SCHEDULE);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get segment");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function createCampaign($attributes): array
    {
        $response = HttpService::post(self::CAMPAIGNS_URL . '/' . config('subscribe_mail.campaignmonitor.client_id'), $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create campaigns");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function updateCampaign($campaign_id, $attributes): array
    {
        // TODO: Implement updateCampaign() method.
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function deleteCampaign($campaign_id): array
    {
        $response = HttpService::delete(self::CAMPAIGNS_URL . '/' . $campaign_id);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't delete campaigns");
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function sendCampaign($campaign_id): array
    {
        $response = HttpService::post(self::CAMPAIGNS_URL . '/' . $campaign_id . self::CAMPAIGNS_URL_SEND);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't send campaigns");
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function getStatusForCampaign($campaign_id): array
    {
        // TODO: Implement getStatusForCampaign() method.
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setHTMLForCampaign($campaign_id, $attributes): array
    {
        $response = HttpService::post(self::TEMPLATE_URL . '/' . $campaign_id, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create campaigns");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setTextForCampaign($campaign_id, $attributes): array
    {
        //create campaign with text
        $response = HttpService::post(self::CAMPAIGNS_URL . '/' . config('subscribe_mail.campaignmonitor.client_id'), $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create campaigns");
    }


    //Lists

    /**
     * @param $client_id
     * @return array
     */
    public static function getLists(): array
    {
        $response = HttpService::get(self::USER_CAMPAIGN_URL . '/' . config('subscribe_mail.campaignmonitor.client_id') . '/lists.json');
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get segment");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function createLists($attributes): array
    {
        $response = HttpService::post(self::LIST_URL, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create list");
    }

    /**
     * @param $list_id
     * @return array
     */
    public static function getSegments($list_id): array
    {
        $response = HttpService::get(self::LIST_URL . '/' . $list_id . self::LIST_URL_SEGMENT);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get segment");
    }

    public static function createSegment($list_id, $attributes): array
    {
        // TODO: Implement createSegment() method.
    }


    //Subscribers

    /**
     * @param $list_id
     * @return array
     */
    public static function getSubscribersForList($list_id): array
    {
        $response = HttpService::get(self::LIST_URL . '/' . $list_id . '/active.json');
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get segment");
    }

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function addSubscriberToList($list_id, $attributes): array
    {
        $response = HttpService::post(self::SUBSCRIBERS_URL . '/' . $list_id);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't added subscriber");
    }

    /**
     * @param $list_id
     * @param $subscriber_hash
     * @return array
     */
    public static function removeSubscriberFromList($list_id,  $subscriber_hash=null): array
    {
        $response = HttpService::delete(self::SUBSCRIBERS_URL . '/' . $list_id);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't delete subscriber");
    }

    /**
     * @param $email
     * @return array
     */
    public static function subscriberValidateEmailAddress($email): array
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return self::success("Email is valid");
        }
        return self::error("Email is not valid");
    }

    /**
     * @param $list_id
     * @return array
     */
    public static function subscriberIsOnList($list_id): array
    {
        $response = HttpService::get(self::LIST_URL . '/' . $list_id);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get subscribers");
    }

    public static function getListsForSubscriber($subscriber_id): array
    {
        // TODO: Implement getListsForSubscriber() method.
    }

    public static function getSubscriberStatusForList($list_id,  $subscriber_hash=null): array
    {
        // TODO: Implement getSubscriberStatusForList() method.
    }
}