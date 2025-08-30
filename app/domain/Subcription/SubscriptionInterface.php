<?php

namespace app\domain\Subcription;

interface SubscriptionInterface
{
    /**
     * @param array<string> $phones
     */
    public function send(array $phones): void;
}