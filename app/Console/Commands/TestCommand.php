<?php

namespace App\Console\Commands;

use App\Components\ProxyCheckerHttp;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $proxyChecker = ProxyCheckerHttp::make();

        $res = $proxyChecker->getRealIp('12.186.205.120');
          dd($res); // real ip
//        $res = $proxyChecker->whois('159.65.77.168');
//        dd(json_decode($res->getBody()->getContents(), true));
    }
}
