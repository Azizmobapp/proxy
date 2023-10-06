<?php

namespace App\Services;

use App\Components\ProxyCheckerHttp;
use App\Models\Loader;
use App\Models\ProxyIp;

class ProxyCheckerService
{
    static private Loader $loader;

    public static function process(array $data, Loader $loader)
    {

        self::$loader = $loader;

        // Разбиваем сроку на массив
        $data = preg_split('/\R/', $data['ips']);

        // валидация
        $pattern = "^(?:[0-9.]+|(?:\[[0-9a-fA-F:]+\]))(:[0-9]+)$";

        foreach ($data as $ip) {
            try {
                // Запуск загрузки данных ip, если соответствует маске ip:port
                if (preg_match("/$pattern/", $ip))  {
                    self::run($ip);
                }

            } catch (\Exception $exception) {

                // при возникновении ошибки, фиксируем сообщение и меняет статус загрузки
                self::$loader->update([
                    'status' => Loader::STATUS_ERROR,
                    'message' => $exception->getMessage()
                ]);
            }
        }

        // при успешном завершении, обновляем статус загрузки
        self::$loader->update([
            'status' => Loader::STATUS_SUCCESS
        ]);
    }

    private static function run($ip)
    {
        // Создание клиента
        $proxyChecker = ProxyCheckerHttp::make();

        // Получение статистики прокси через курл
        $res = $proxyChecker->getProxyStats($ip);
        $url = explode(':', $ip)[0];

        // Получение данных через сервис whois
        $whois = $proxyChecker->whois($url);

        // добавление в бд
        self::create([
            'stats' => $res,
            'whois' => json_decode($whois->getBody()->getContents(), true)
        ]);
    }

    private static function create($data)
    {
        ProxyIp::create([
            'loader_id' => self::$loader->id,
            'ip' => $data['stats']['primary_ip'],
            'real_ip' => $data['whois']['query'],
            'speed' => $data['stats']['total_time'],
            'port' => $data['stats']['primary_port'],
            'type' => '-', // не удалось понять, как определять тип
            'city' => $data['whois']['city'],
            'country' => $data['whois']['country'],
            'is_active' => $data['whois']['hosting'],
        ]);
    }
}
