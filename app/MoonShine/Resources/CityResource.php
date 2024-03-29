<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;

use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<City>
 */
class CityResource extends ModelResource
{
    protected string $model = City::class;

    protected string $title = 'Населенные пункты';

    public string $column = 'city_name';

    protected string $sortDirection = 'ASC'; // Тип сортировки по умолчанию

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make("Нас. пункт", 'city_name'),
                HasMany::make('Узлы', 'nodes', resource: new NodesResource())
                ->fields([
                    Text::make('', 'node_name')
                ]),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function redirectAfterSave(): string
    {
        return '/admin/resource/city-resource/index-page';
    }
}
