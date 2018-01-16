<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Eloquent\Builder;

interface WherePlus
{
    /**
     * This function adds a where condition for when a $column should be equal to $value, but not equal to a $ignore
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereOrEmptyOrNull(Builder $query, $column, $value = '', $ignore = null);

    /**
     * Scope a query to only include records where $value in $column
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereInColumn(Builder $query, $column, $value);

    /**
     * Scope a query to exclude records where $value in $column
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereNotInColumn(Builder $query, $column, $value);
}