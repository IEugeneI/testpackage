<?php

namespace Abss\Sending_subscribe_mails\Services;


use Abss\Sending_subscribe_mails\Services\Interfaces\CampaignsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\ListsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\SubscribersInterface;
use Abss\Sending_subscribe_mails\Traits\Response;

class BrevoService implements CampaignsInterface, ListsInterface, SubscribersInterface
{
    use Response;

    const CAMPAIGNS_URL = 'https://api.brevo.com/v3/emailCampaigns';
    const CAMPAIGNS_SEND_URL = '/sendNow ';
    const LIST_URL = 'https://api.brevo.com/v3/contacts/lists';
    const LIST_SEGMENTS = 'https://api.brevo.com/v3/contacts/segments';
    const CONTACT_URL = 'https://api.brevo.com/v3/contacts/';
    //Campaigns

    /**
     * @return array
     */
    public static function getCampaigns(): array
    {
        $response = HttpService::get(self::CAMPAIGNS_URL);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get campaigns");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function createCampaign($attributes): array
    {
        $response = HttpService::post(self::CAMPAIGNS_URL, $attributes);
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
        $response = HttpService::patch(self::CAMPAIGNS_URL . '/' . $campaign_id, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't update campaigns");
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
        $response = HttpService::post(self::CAMPAIGNS_URL . '/' . $campaign_id . self::CAMPAIGNS_SEND_URL);
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
        $response = HttpService::get(self::CAMPAIGNS_URL . '/' . $campaign_id);
        if ($response['status'] == 'Success') {
            return self::success(['status' => $response['body']->json()['status']]);
        }
        return self::error("Can't get campaigns");
    }

    //added when create company
    public static function setHTMLForCampaign($campaign_id, $attributes): array
    {
        //field htmlContent
        $response = HttpService::put(self::CAMPAIGNS_URL . '/' . $campaign_id, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't set html campaigns");
    }

    //added when create company
    public static function setTextForCampaign($campaign_id, $attributes): array
    {
        //field previewText
        $response = HttpService::put(self::CAMPAIGNS_URL . '/' . $campaign_id, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't set html campaigns");
    }






    //Lists

    /**
     * @return array
     */
    public static function getLists(): array
    {
        $response = HttpService::get(self::LIST_URL);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get list");
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
        $response = HttpService::get(self::LIST_SEGMENTS);
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
    public static function createSegment($list_id, $attributes): array
    {
        // TODO: Implement createSegment($list_id, $attributes) method.
    }







    //Subscribers

    /**
     * @param $list_id
     * @return array
     */
    public static function getSubscribersForList($list_id): array
    {
        $response = HttpService::get(self::LIST_URL . '/' . $list_id . '/contacts');
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get subscribers");
    }

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function addSubscriberToList($list_id, $attributes): array
    {
        $response = HttpService::post(self::LIST_URL . '/' . $list_id . '/contacts/add');
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
    public static function removeSubscriberFromList($list_id, $subscriber_hash=null): array
    {
        $response = HttpService::delete(self::LIST_URL . '/' . $list_id . '/contacts/remove');
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
        $response = HttpService::get(self::LIST_URL . '/' . $list_id . '/contacts');
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get subscribers");
    }

    /**
     * @param $subscriber_id
     * @return array
     */
    public static function getListsForSubscriber($subscriber_id): array
    {
        $response = HttpService::get(self::LIST_URL);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get list");
    }

    public static function getSubscriberStatusForList($list_id, $subscriber_hash=null): array
    {
        // TODO: Implement getSubscriberStatusForList() method.
    }
}