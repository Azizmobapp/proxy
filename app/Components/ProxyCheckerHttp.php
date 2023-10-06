<?php
namespace App\Components;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ProxyCheckerHttp
{
    private Client $client;

    // закрываем создание объекта через new
    private function __construct()
    {
        $this->client = new Client([
            RequestOptions::TIMEOUT => 30,
        ]);
    }

    // создание экземпляра
    static public function make() {
        return new self();
    }

    // получение статистики proxy
    public function getProxyStats($proxy)
    {
        $ch = curl_init($proxy);

        curl_setopt($ch,CURLOPT_TIMEOUT,1000);

        curl_exec($ch);
        curl_close($ch);
        return curl_getinfo($ch);
    }

    // получение данных через червис whois
    public function whois($ip)
    {
        return $this->client->request('get', 'http://demo.ip-api.com/json/' . $ip . '?fields=66842623&lang=en');
    }
}
