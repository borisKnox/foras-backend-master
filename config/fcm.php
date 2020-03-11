<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAA2iGOG9c:APA91bHBK7L7i2KrCHtStC8wOLdfRPa1Qik6iRiosbD9LdNAfDcOB0gXUBIfv7B0SnCSUVmo9mOBVHeRPS_wNFx8Bb3XvMVesnNK86eD334s4Ey8_lLfbDHAZ6aXt6owqgaV_HyD4dDl'),
        'sender_id' => env('FCM_SENDER_ID', '936865831895'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
