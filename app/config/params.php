<?php

$smsPilot = require __DIR__ . '/sms_pilot.php';

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'sms_pilot' => $smsPilot,
];
