<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Node;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Node>
 */
class NodesResource extends ModelResource
{
    protected string $model = Node::class;

    protected string $title = 'Узлы';

    protected string $sortDirection = 'ASC'; // Тип сортировки по умолчанию

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Нас. пункт', 'city', resource: new CityResource()),
                Text::make('Узел', 'node_name'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
