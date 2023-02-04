<?php

namespace App\Services\RSS\RBC\Support;

use App\Services\RSS\RBC\DTO\NewsCollection as NewsCollectionDTO;
use App\Services\RSS\RBC\DTO\NewsItem as NewsItemDTO;
use App\Services\RSS\RBC\DTO\Response as ResponseDTO;

class Creator
{
    private Parser $parser;
    private Image $image;

    public function __construct()
    {
        $this->parser = new Parser();
        $this->image = new Image();
    }

    public function createNewCollection(?ResponseDTO $responseDTO): ?NewsCollectionDTO
    {
        if ($responseDTO === null || !$responseDTO->successful || $responseDTO->body == '') {
            return null;
        }

        $list = $this->parser->convertToArray($responseDTO->body);

        if (!isset($list['channel']['item'])) {
            return null;
        }

        $items = $list['channel']['item'];

        $newCollectionDTO = new NewsCollectionDTO();
        foreach ($items as $item) {
            $newItemDTO = $this->createNewItem($item);
            $newCollectionDTO->add($newItemDTO);
        }

        if ($newCollectionDTO->count() === 0) {
            return null;
        }

        return $newCollectionDTO;
    }

    private function createNewItem(array $item): NewsItemDTO
    {
        $newItemDTO = new NewsItemDTO();
        $newItemDTO->name = $item['title'];
        $newItemDTO->shortDescription = $item['description'];
        $newItemDTO->publicDate = date('Y-m-d H:i:s', strtotime($item['pubDate']));

        if (isset($item['author'])) {
            $newItemDTO->author = $item['author'];
        }

        if (isset($item['enclosure'])) {
            if (isset($item['enclosure']['@attributes'])) {
                $path = $this->image->save($item['enclosure']['@attributes']);
            } else {
                $path = $this->image->save($item['enclosure'][0]['@attributes']);
            }

            $newItemDTO->image = $path;
        }

        return $newItemDTO;
    }
}
