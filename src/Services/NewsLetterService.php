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
     * @param $client_id
     * @return array
     */
    public static function getCampaigns($client_id=null): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return $provider::getCampaigns($client_id);
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
            return $provider::createCampaign($attributes);
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
            return $provider::updateCampaign($campaign_id, $attributes);
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
            return $provider::deleteCampaign($campaign_id);
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
            return $provider::sendCampaign($campaign_id);
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
            return $provider::getStatusForCampaign($campaign_id);
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
            return $provider::setHTMLForCampaign($campaign_id,$attributes);
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
            return $provider::setTextForCampaign($campaign_id,$attributes);
        }
        return self::error("Pls set right provider");
    }






    //Lists

    /**
     * @param $client_id
     * @return array
     */
    public static function getLists($client_id=null): array
    {
        if(in_array(config('subscribe_mail.provider'),self::ProvidersArray)){
            $provider=config('subscribe_mail.provider').'Service';
            return $provider::getLists($client_id);
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
            return $provider::createLists($attributes);
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
            return $provider::getSegments($attribute);
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
            return $provider::createSegment($list_id,$attributes);
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
            return $provider::getSubscribersForList($list_id);
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
            return $provider::addSubscriberToList($list_id,$attributes);
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
            return $provider::removeSubscriberFromList($list_id,$subscriber_hash);
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
            return $provider::subscriberValidateEmailAddress($email);
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
            return $provider::subscriberIsOnList($list_id);
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
            return $provider::getListsForSubscriber($attributes);
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
            return $provider::getSubscriberStatusForList($attributes);
        }
        return self::error("Pls set right provider");
    }


}