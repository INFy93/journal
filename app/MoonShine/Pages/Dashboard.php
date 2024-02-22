<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\City;
use App\Models\Device;
use App\Models\Node;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Text;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Pages\Page;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Управление';
    }

    public function components(): array
	{
		return [
            Grid::make([
                Column::make([
                    ValueMetric::make('Нас. пункты')
                    ->value(City::query()->count())
                ])->columnSpan(4),

                Column::make([
                    ValueMetric::make('Узлы')
                        ->value(Node::query()->count())
                ])->columnSpan(4),

                Column::make([
                    ValueMetric::make('Устройства')
                        ->value(Device::query()->count())
                ])->columnSpan(4),
            ]),
        ];
	}
}
