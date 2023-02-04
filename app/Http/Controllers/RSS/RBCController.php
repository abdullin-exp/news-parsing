<?php

namespace App\Http\Controllers\RSS;

use App\Http\Controllers\Controller;
use App\Services\RSS\RBC\DTO\Storage\ListConditions as ListConditionsDTO;
use App\Services\RSS\RBC\RBC as RBCService;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     title="RBCController",
 *     description="RBCController",
 *     @OA\Xml(
 *         name="RBCController"
 *     )
 * )
 */
class RBCController extends Controller
{
    private RBCService $rbcService;

    public function __construct(RBCService $rbcService)
    {
        $this->rbcService = $rbcService;
    }

    /**
     * @OA\Get (
     *   path="/api/rbc/news",
     *   operationId="/api/rbc/news",
     *   tags={"Новости"},
     *   description="Новости из RSS страницы rbc.ru",
     *
     *  @OA\Parameter(
     *      name="page",
     *      description="Номер страницы",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="integer",
     *           default=1
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="sort",
     *      description="Сортировка по дате публикации новости",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="fields",
     *      description="Список возвращаемых полей новости",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Выведет список новостей из RSS страницы ресурса rbc.ru",
     *     @OA\JsonContent(
     *		@OA\Property(
     *      	description="Статус (success, error)",
     *          property="status",
     *          type="string",
     *     		default="success"
     *      ),
     *		@OA\Property(
     *      	description="Список новостей",
     *          property="list",
     *   		type="array",
     *   		@OA\Items(ref="#/components/schemas/NewsItem")
     *      ),
     *		@OA\Property(
     *      	description="Текст сообщения об ошибке",
     *          property="message",
     *          type="string",
     *          default=""
     *      )
     *      )
     *   )
     *)
     */
    public function news(Request $request)
    {
        if ($request->method() != 'GET') {
            return json_encode([
                'status' => 'error',
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
            'status' => 'success',
            'message' => '',
            'list' => $news
        ]);
    }
}
