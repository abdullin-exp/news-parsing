<?php

namespace App\Http\Controllers\RSS;

use App\Http\Controllers\Controller;
use App\Services\RSS\RBC\DTO\Storage\ListConditions as ListConditionsDTO;
use App\Services\RSS\RBC\RBC as RBCService;
use Illuminate\Http\Request;

class RBCController extends Controller
{
    private RBCService $rbcService;

    public function __construct(RBCService $rbcService)
    {
        $this->rbcService = $rbcService;
    }

    public function news(Request $request)
    {
        if ($request->method() != 'GET') {
            return json_encode([
                'status' => false,
                'message' => 'HTTP-запрос должен содержать метод GET'
            ]);
        }

        $listConditionsDTO = new ListConditionsDTO();

        if ($request->page) {
            $listConditionsDTO->page = (int) $request->page;
        }

        if ($request->sort) {
            $listConditionsDTO->sort = htmlentities(trim(strtoupper($request->sort)));
        }

        if ($request->fields) {
            $fields = explode(',', htmlentities(trim($request->fields)));
            $listConditionsDTO->fields = $fields;
        }

        $news = $this->rbcService->news($listConditionsDTO);

        return json_encode([
            'status' => true,
            'list' => $news
        ]);
    }
}
