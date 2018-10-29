<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
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
    protected function addAggregation($query, $op, $field, $alias)
    {
        $alias = $alias ?: $field;

        if ($field instanceof Expression) {
            $field = $field->getValue();
        }

        $query->addSelect(DB::raw("{$op}({$field}) as {$alias}"));

        return $query;
    }

    /**
     * Add sum to the query
     *
     * @param $this $query
     * @param string $field
     * @param string $alias
     *
     * @return $this
     */
    public function scopeAddSum($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'SUM', $field, $alias);
    }

    /**
     * Add count to the query
     *
     * @param Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return $this
     */
    public function scopeAddCount($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'COUNT', $field, $alias);
    }

    /**
     * Add max to the query
     *
     * @param Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return $this
     */
    public function scopeAddMax($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'MAX', $field, $alias);
    }

    /**
     * Add min to the query
     *
     * @param Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return $this
     */
    public function scopeAddMin($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'MIN', $field, $alias);
    }

    /**
     * Add avg to the query
     *
     * @param Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return $this
     */
    public function scopeAddAvg($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'AVG', $field, $alias);
    }
}
