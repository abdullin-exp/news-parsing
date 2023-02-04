<?php

namespace App\Console\Commands\RSS;

use App\Services\RSS\RBC\RBC as RBCService;
use Illuminate\Console\Command;

class RBC extends Command
{
    protected $signature = 'rss:rbc';
    protected $description = 'Команда для получения новостей из RSS страницы ресурса rbc.ru';
    private RBCService $rbcService;

    public function __construct(RBCService $rbcService)
    {
        parent::__construct();
        $this->rbcService = $rbcService;
    }

    public function handle()
    {
        $newsCollection = $this->rbcService->rss();
        $this->rbcService->save($newsCollection);
    }
}
