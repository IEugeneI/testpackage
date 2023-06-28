<?php

namespace Abss\Sending_subscribe_mails\Services;


use Abss\Sending_subscribe_mails\Services\MailchimpService;
use Abss\Sending_subscribe_mails\Services\BrevoService;
use Abss\Sending_subscribe_mails\Services\CampaignMonitorService;
use Abss\Sending_subscribe_mails\Traits\Response;


class NewsLetterService
{
    use Response;

    const ProvidersArray=['Mailchimp','Brevo','CampaignMonitor'];



    //Campaigns

    /**
     * @return array
     */
    public static function getCampaigns(): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getCampaigns"));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function createCampaign($attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "createCampaign"),
                array($attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function updateCampaign($campaign_id, $attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "updateCampaign"),
                array($campaign_id,$attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function deleteCampaign($campaign_id): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "deleteCampaign"),
                array($campaign_id));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function sendCampaign($campaign_id): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "sendCampaign"),
                array($campaign_id));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public static function getStatusForCampaign($campaign_id): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getStatusForCampaign"),
                array($campaign_id));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setHTMLForCampaign($campaign_id, $attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "setHTMLForCampaign"),
                array($campaign_id,$attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setTextForCampaign($campaign_id, $attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "setTextForCampaign"),
                array($campaign_id,$attributes));
        }
        return self::error("Pls set right provider");
    }






    //Lists

    /**
     * @return array
     */
    public static function getLists(): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getLists"));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function createLists($attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "createLists"),
                array($attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $attribute
     * @return array
     */
    public static function getSegments($attribute): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getSegments"),
                array($attribute));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function createSegment($list_id, $attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "createSegment"),
                array($list_id, $attributes));
        }
        return self::error("Pls set right provider");
    }







    //Subscribers

    /**
     * @param $list_id
     * @return array
     */
    public static function getSubscribersForList($list_id): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getSubscribersForList"),
                array($list_id));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function addSubscriberToList($list_id, $attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "addSubscriberToList"),
                array($list_id,$attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $list_id
     * @param $subscriber_hash
     * @return array
     */
    public static function removeSubscriberFromList($list_id, $subscriber_hash): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "removeSubscriberFromList"),
                array($list_id,$subscriber_hash));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $email
     * @return array
     */
    public static function subscriberValidateEmailAddress($email): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "subscriberValidateEmailAddress"),
                array($email));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $list_id
     * @return array
     */
    public static function subscriberIsOnList($list_id): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "subscriberIsOnList"),
                array($list_id));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function getListsForSubscriber($attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getListsForSubscriber"),
                array($attributes));
        }
        return self::error("Pls set right provider");
    }

    /**
     * @param $attributes
     * @return array
     */
    public static function getSubscriberStatusForList($attributes): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return call_user_func_array(array('\\Abss\\Sending_subscribe_mails\\Services\\'.$provider, "getSubscriberStatusForList"),
                array($attributes));
        }
        return self::error("Pls set right provider");
    }


}