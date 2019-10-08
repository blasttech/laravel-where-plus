<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Trait GroupOrderTrait
 *
 * @method $this groupByIndex(string ...$index)
 * @method $this orderByIndex(string ...$index)
 *
 * @package Blasttech\WherePlus
 */
trait GroupOrderTrait
{
    /**
     * Allow group by index
     *
     * @param static|$this|Builder $query
     * @param int|int[] $index
     *
     * @return static|$this|Builder
     */
    public function scopeGroupByIndex($query, ...$index)
    {
        if (!is_array($index)) {
            $index = [$index];
        }

        return $query->groupBy(DB::raw(implode(',', $index)));
    }

    /**
     * Allow order by index
     *
     * @param static|$this|Builder $query
     * @param int|int[] $index
     *
     * @return static|$this|Builder
     */
    public function scopeOrderByIndex($query, ...$index)
    {
        if (!is_array($index)) {
            $index = [$index];
        }

        foreach ($index as $order) {
            $query->orderByRaw($order);
        }

        return $query;
    }
}
