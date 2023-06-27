<?php

namespace Abss\Sending_subscribe_mails\Services;


use Abss\Sending_subscribe_mails\Services\HttpService;
use Abss\Sending_subscribe_mails\Services\Interfaces\CampaignsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\ListsInterface;
use Abss\Sending_subscribe_mails\Services\Interfaces\SubscribersInterface;
use Abss\Sending_subscribe_mails\Traits\Response;


class MailchimpService implements CampaignsInterface, ListsInterface, SubscribersInterface
{
    use Response;

    const START_URL = 'https://';
    const CAMPAIGN_URL = '.api.mailchimp.com/3.0/campaigns';
    const CAMPAIGN_SEND_URL = '/actions/send';
    const CAMPAIGN_CONTENT_URL = '/content';
    const LIST_URL = '.api.mailchimp.com/3.0/lists';
    const LIST_SEGMENT = '/segments';
    const LIST_MEMBERS = '/members';
    const LIST_DELETE_MEMBERS = '/actions/delete-permanent';
    const SUBSCRIBE_SEARCH_URL = '.api.mailchimp.com/3.0/search-members?list_id=';


    //Campaigns

    /**
     * @return array
     */
    public static function getCampaigns(): array
    {
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL);
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
        $response = HttpService::post(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL,
            $attributes);
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
        $response = HttpService::patch(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL .
            '/' . $campaign_id, $attributes);
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
        $response = HttpService::delete(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL .
            '/' . $campaign_id);
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
        $response = HttpService::post(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL .
            '/' . $campaign_id . self::CAMPAIGN_SEND_URL);
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
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') .
            self::CAMPAIGN_URL . '/' . $campaign_id);
        if ($response['status'] == 'Success') {
            return self::success(['status' => $response['body']->json()['status']]);
        }
        return self::error("Can't get campaigns");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setHTMLForCampaign($campaign_id, $attributes): array
    {
        //$attributes=['html'=>'<p>123</p>']. Not working if type=plaintext,working if type=regular
        $response = HttpService::put(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL .
            '/' . $campaign_id . self::CAMPAIGN_CONTENT_URL, $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't set html campaigns");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setTextForCampaign($campaign_id, $attributes): array
    {
        //$attributes=['plain_text'=>'text']. Not working if type=plaintext,working if type=regular
        $response = HttpService::put(self::START_URL . config('subscribe_mail.mailchimp.server') . self::CAMPAIGN_URL .
            '/' . $campaign_id . self::CAMPAIGN_CONTENT_URL, $attributes);
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
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL);
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
        $response = HttpService::post(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL,
            $attributes);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create least");
    }

    /**
     * @param $list_id
     * @return array
     */
    public static function getSegments($list_id): array
    {
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL . '/' .
            $list_id . self::LIST_SEGMENT);
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
        $response = HttpService::post(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL . '/' .
            $list_id . self::LIST_SEGMENT);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't create segment");
    }







    //Subscribers

    /**
     * @param $list_id
     * @return array
     */
    public static function getSubscribersForList($list_id): array
    {
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL . '/' .
            $list_id . self::LIST_MEMBERS);
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
        $response = HttpService::post(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL . '/' .
            $list_id . self::LIST_MEMBERS, $attributes);
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
    public static function removeSubscriberFromList($list_id, $subscriber_hash): array
    {
        $response = HttpService::delete(self::START_URL . config('subscribe_mail.mailchimp.server') . self::LIST_URL .
            '/' . $list_id . '/' . self::LIST_MEMBERS . '/' . $subscriber_hash . self::LIST_DELETE_MEMBERS);
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
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') .
            self::SUBSCRIBE_SEARCH_URL . $list_id);
        if ($response['status'] == 'Success') {
            return self::success($response['body']->body());
        }
        return self::error("Can't get subscribers");
    }

    public static function getListsForSubscriber($subscriber_id): array
    {
        // TODO: Implement getListsForSubscriber() method.
    }

    /**
     * @param $list_id
     * @param $subscriber_hash
     * @return array
     */
    public static function getSubscriberStatusForList($list_id,  $subscriber_hash=null): array
    {
        $response = HttpService::get(self::START_URL . config('subscribe_mail.mailchimp.server') .
            self::LIST_URL . '/' . $list_id . self::LIST_MEMBERS . '/' . $subscriber_hash);
        if ($response['status'] == 'Success') {
            return self::success(['status' => $response['body']->body()->status]);
        }
        return self::error("Can't get subscribers");
    }
}

