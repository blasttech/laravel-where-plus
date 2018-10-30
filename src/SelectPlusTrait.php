<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

/**
 * Trait SelectPlusTrait
 *
 * @method $this addSum(string $fields, string $alias = '')
 * @method $this addCount(string $fields, string $alias = '')
 * @method $this addMax(string $fields, string $alias = '')
 * @method $this addMin(string $fields, string $alias = '')
 * @method $this addAvg(string $fields, string $alias = '')
 *
 * @package Blasttech\WherePlus
 */
trait SelectPlusTrait
{
    /**
     * Common method for adding aggregation to the query
     *
     * @param static|Builder $query
     * @param string $op
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    protected function addAggregation($query, $op, $field, $alias)
    {
        if ($field instanceof Expression) {
            $field = $field->getValue();
            if (empty($alias)) {
                $alias = preg_replace('/\W*/', '', $field);
            }
        } else {
            //When passed field use table alias and alias is empty we need to explode
            if (empty($alias)) {
                $alias = $field;
                if (strpos($field, '.') !== false) {
                    list(, $alias) = explode('.', $field);
                }
            }
        }

        $query->addSelect(DB::raw("{$op}({$field}) as {$alias}"));

        return $query;
    }

    /**
     * Add sum to the query
     *
     * @param static|Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    public function scopeAddSum($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'SUM', $field, $alias);
    }

    /**
     * Add count to the query
     *
     * @param static|Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    public function scopeAddCount($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'COUNT', $field, $alias);
    }

    /**
     * Add max to the query
     *
     * @param static|Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    public function scopeAddMax($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'MAX', $field, $alias);
    }

    /**
     * Add min to the query
     *
     * @param static|Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    public function scopeAddMin($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'MIN', $field, $alias);
    }

    /**
     * Add avg to the query
     *
     * @param static|Builder $query
     * @param string $field
     * @param string $alias
     *
     * @return static
     */
    public function scopeAddAvg($query, $field, $alias = '')
    {
        return $this->addAggregation($query, 'AVG', $field, $alias);
    }
}
