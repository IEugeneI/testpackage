<?php

namespace Abss\Sending_subscribe_mails\Services\Interfaces;


interface SubscribersInterface
{
    /**
     * @param $list_id
     * @return array
     */
    public static function getSubscribersForList($list_id): array;

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function addSubscriberToList($list_id, $attributes): array;

    /**
     * @param $list_id
     * @param $subscriber_hash
     * @return array
     */
    public static function removeSubscriberFromList($list_id, $subscriber_hash): array;

    /**
     * @param $email
     * @return array
     */
    public static function subscriberValidateEmailAddress($email): array;

    /**
     * @param $list_id
     * @return array
     */
    public static function subscriberIsOnList($list_id): array;

    /**
     * @param $subscriber_id
     * @return array
     */
    public static function getListsForSubscriber($subscriber_id): array;

    /**
     * @param $list_id
     * @param $subscriber_hash
     * @return array
     */
    public static function getSubscriberStatusForList($list_id,  $subscriber_hash=null): array;
}