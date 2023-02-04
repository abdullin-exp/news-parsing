<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="NewsItem",
 *	   @OA\Property(
 *      	description="Идентификатор новости",
 *          property="id",
 *          type="integer",
 *     	    nullable=false,
 *     		example=1
 *     ),
 *     @OA\Property(
 *      	description="Заголовок новости",
 *          property="name",
 *          type="string",
 *     	    nullable=false,
 *     		example="Новость 1"
 *     ),
 *     @OA\Property(
 *      	description="Краткое описание новости",
 *          property="short_description",
 *          type="string",
 *     	    nullable=false,
 *     		example="Краткое описание"
 *     ),
 *     @OA\Property(
 *      	description="Дата публикации новости",
 *          property="public_date",
 *          type="string",
 *     	    nullable=false,
 *     		example="2023-02-04 08:45:51"
 *     ),
 *     @OA\Property(
 *      	description="Автор новости",
 *          property="author",
 *          type="string",
 *     	    nullable=true,
 *     		example="Иван Иваныч"
 *     ),
 *     @OA\Property(
 *      	description="Картинка новости",
 *          property="image",
 *          type="string",
 *     	    nullable=true,
 *     		example="/storage/images/rbc/756460582323479.jpg"
 *     )
 * )
 *
 */
class RBCNew extends Model
{
    use HasFactory;

    protected $table = 'rbc_news';

    protected $fillable = [
        'name',
        'short_description',
        'public_date',
        'author',
        'image'
    ];
}
