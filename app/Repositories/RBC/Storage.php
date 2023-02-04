<?php

namespace App\Repositories\RBC;

use App\Models\RBCNew as RBCNewModel;
use App\Services\RSS\RBC\DTO\NewsCollection as NewsCollectionDTO;
use App\Services\RSS\RBC\DTO\Storage\ListConditions as ListConditionsDTO;
use App\Services\RSS\RBC\Repository\IStorage;

class Storage implements IStorage
{
    public function save(NewsCollectionDTO $newsCollectionDTO): bool
    {
        $data = [];
        foreach ($newsCollectionDTO as $newItemDTO) {
            $data[] = [
                'name' => $newItemDTO->name,
                'short_description' => $newItemDTO->shortDescription,
                'public_date' => $newItemDTO->publicDate,
                'author' => $newItemDTO->author,
                'image' => $newItemDTO->image
            ];
        }

        if (empty($data)) {
            return false;
        }

        if (!RBCNewModel::insert($data)) {
            return false;
        }

        return true;
    }

    public function get(ListConditionsDTO $listConditionsDTO): array
    {
        $count = RBCNewModel::query()->count();
        $countPages = (int) ceil($count / $listConditionsDTO->limit);

        if ($countPages < $listConditionsDTO->page) {
            return [];
        }

        $query = RBCNewModel::query();

        if (empty($listConditionsDTO->fields)) {
            $query->select();
        } else {
            $query->select($listConditionsDTO->fields);
        }

        if ($listConditionsDTO->sort !== null && in_array($listConditionsDTO->sort, ['ASC', 'DESC'])) {
            $query->orderBy('public_date', $listConditionsDTO->sort);
        }

        $rows = $query
            ->skip($listConditionsDTO->limit * ($listConditionsDTO->page - 1))
            ->take($listConditionsDTO->limit)
            ->get()
            ->toArray();

        if (count($rows) === 0) {
            return [];
        }

        return $rows;
    }
}
