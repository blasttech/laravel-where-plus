<?php

namespace Blasttech\WherePlus;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

/**
 * Trait SelectPlusTrait.
 *
 * @method Builder addSum(string|string[] $fields)
 * @method Builder addCount(string|string[] $fields)
 * @method Builder addMax(string|string[] $fields)
 * @method Builder addMin(string|string[] $fields)
 * @method Builder addAvg(string|string[] $fields)
 */
trait SelectPlusTrait
{
    /**
     * @param Builder $query
     * @param string|string[] $fields
     * @return Builder
     */
    public function scopeAddSum($query, $fields)
    {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("SUM({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string|string[] $fields
     * @return Builder
     */
    public function scopeAddCount($query, $fields)
    {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("COUNT({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string|string[] $fields
     * @return Builder
     */
    public function scopeAddMax($query, $fields)
    {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("MAX({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string|string[] $fields
     * @return Builder
     */
    public function scopeAddMin($query, $fields)
    {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("MIN({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param string|string[] $fields
     * @return Builder
     */
    public function scopeAddAvg($query, $fields)
    {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("AVG({$field}) as {$field}"));
        }

        return $query;
    }
}
