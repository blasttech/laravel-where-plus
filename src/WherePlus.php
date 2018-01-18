<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface WherePlus
 *
 * @method Builder whereOrEmptyOrNull($column, $value = '', $ignore = null)
 * @method Builder whereInColumn($column, $value)
 * @method Builder whereNotInColumn($column, $value)
 *
 * @package Blasttech\WherePlus
 */
interface WherePlus
{
    /**
     * This function adds a where condition for when a $column should be equal to $value, but not equal to a $ignore
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     * @param null $ignore
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereOrEmptyOrNull(Builder $query, $column, $value = '', $ignore = null);

    /**
     * Scope a query to only include records where $value in $column
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereInColumn(Builder $query, $column, $value);

    /**
     * Scope a query to exclude records where $value in $column
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereNotInColumn(Builder $query, $column, $value);
}