<?php

namespace App\Jobs;

use App\Services\ProxyCheckerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProxyCheckerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $loader;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $loader)
    {
        $this->data = $data;
        $this->loader = $loader;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ProxyCheckerService::process($this->data, $this->loader);
    }
}
