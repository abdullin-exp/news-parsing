<?php

namespace App\Services\RSS\RBC;

use App\Services\RSS\RBC\DTO\NewsCollection as NewsCollectionDTO;
use App\Services\RSS\RBC\DTO\Storage\ListConditions as ListConditionsDTO;
use App\Services\RSS\RBC\Repository\ILog;
use App\Services\RSS\RBC\Repository\IRss;
use App\Services\RSS\RBC\Repository\IStorage;
use App\Services\RSS\RBC\Support\Creator;

class RBC
{
    private IRss $rss;
    private IStorage $storage;
    private ILog $log;
    private Creator $creator;

    public function __construct(IRss $rss, IStorage $storage, ILog $log)
    {
        $this->rss = $rss;
        $this->storage = $storage;
        $this->log = $log;
        $this->creator = new Creator();
    }

    public function rss(): ?NewsCollectionDTO
    {
        return $this->creator->createNewCollection(
            $this->rss->request($this->log)
        );
    }

    public function news(ListConditionsDTO $listConditionsDTO): array
    {
        return $this->storage->get($listConditionsDTO);
    }

    public function save(NewsCollectionDTO $newCollectionDTO): bool
    {
        return $this->storage->save($newCollectionDTO);
    }
}
