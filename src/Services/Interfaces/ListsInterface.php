<?php

namespace Abss\Sending_subscribe_mails\Services\Interfaces;


interface ListsInterface
{
    /**
     * @return array
     */
    public static function getLists(): array;

    /**
     * @param $attributes
     * @return array
     */
    public static function createLists($attributes): array;

    /**
     * @param $list_id
     * @return array
     */
    public static function getSegments($list_id): array;

    /**
     * @param $list_id
     * @param $attributes
     * @return array
     */
    public static function createSegment($list_id, $attributes): array;
}