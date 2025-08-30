<?php

namespace app\domain\Subcription\SmsPilot;

use app\domain\Subcription\SubscriptionInterface;
use HttpResponseException;
use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class SmsPilotService implements SubscriptionInterface
{
    private const MESSAGE = 'У автора вышла новая книга';

    /**
     * @throws HttpResponseException
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function send(array $phones): void
    {
        $data = [
            'apikey' => Yii::$app->params['sms_pilot']['apikey'],
            'send' => $this->formatSend($phones),
        ];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(Yii::$app->params['sms_pilot']['url'])
            ->setData($data)
            ->setFormat(Client::FORMAT_JSON)
            ->send();

        if (!$response->isOk) {
            throw new HttpResponseException('Подписка не удалась');
        }
    }

    /**
     * @param array<string> $phones
     * @return array<array<string,string>
     */
    private function formatSend(array $phones): array
    {
        $send = [];

        foreach ($phones as $phone) {
            $send[] = ['to' => $phone, 'text' => self::MESSAGE];
        }

        return $send;
    }
}