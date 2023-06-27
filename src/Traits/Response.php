<?php

namespace Abss\Sending_subscribe_mails\Traits;


trait Response
{
    /**
     * @param $data
     * @return array
     */
    public static function success($data=''): array
    {
        return [
            'status' => 'Success',
            'body' => $data
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public static function error($message = null): array
    {
        return [
            'status' => 'Error',
            'message' => $message
        ];
    }
}