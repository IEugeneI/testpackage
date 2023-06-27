<?php

namespace Abss\Sending_subscribe_mails\Services\Interfaces;


interface CampaignsInterface
{
    /**
     * @return array
     */
    public static function getCampaigns(): array;

    /**
     * @param $attributes
     * @return array
     */
    public static function createCampaign($attributes): array;

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function updateCampaign($campaign_id, $attributes): array;

    /**
     * @param $campaign_id
     * @return mixed
     */
    public static function deleteCampaign($campaign_id): array;

    /**
     * @param $campaign_id
     * @return array
     */
    public static function sendCampaign($campaign_id): array;

    /**
     * @param $campaign_id
     * @return array
     */
    public static function getStatusForCampaign($campaign_id): array;

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setHTMLForCampaign($campaign_id, $attributes): array;

    /**
     * @param $campaign_id
     * @param $attributes
     * @return array
     */
    public static function setTextForCampaign($campaign_id, $attributes): array;
}