<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Trait SelectPlusTrait
 *
 * @method $this addSum(string|string[] $fields)
 * @method $this addCount(string|string[] $fields)
 * @method $this addMax(string|string[] $fields)
 * @method $this addMin(string|string[] $fields)
 * @method $this addAvg(string|string[] $fields)
 *
 * @package Blasttech\WherePlus
 */
trait SelectPlusTrait
{
    /**
     * Add sum to the query
     *
     * @param Builder $query
     * @param string|string[] $fields
     *
     * @return Builder
     */
    public function scopeAddSum($query, $fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("SUM({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * Add count to the query
     *
     * @param Builder $query
     * @param string|string[] $fields
     *
     * @return Builder
     */
    public function scopeAddCount($query, $fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("COUNT({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * Add max to the query
     *
     * @param Builder $query
     * @param string|string[] $fields
     *
     * @return Builder
     */
    public function scopeAddMax($query, $fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("MAX({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * Add min to the query
     *
     * @param Builder $query
     * @param string|string[] $fields
     *
     * @return Builder
     */
    public function scopeAddMin($query, $fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("MIN({$field}) as {$field}"));
        }

        return $query;
    }

    /**
     * Add avg to the query
     *
     * @param Builder $query
     * @param string|string[] $fields
     *
     * @return Builder
     */
    public function scopeAddAvg($query, $fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        foreach ($fields as $field) {
            $query->addSelect(DB::raw("AVG({$field}) as {$field}"));
        }

        return $query;
    }
}
