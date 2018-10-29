<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface WherePlus.
 */
interface WherePlus
{
    /**
     * This function adds a where condition for when a $column should be equal to $value, but not equal to a $ignore.
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
     * Scope a query to only include records where $value in $column.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereInColumn(Builder $query, $column, $value);

    /**
     * Scope a query to exclude records where $value in $column.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereNotInColumn(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column starts with $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereStarts(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column doesn't start with $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereNotStarts(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column ends with $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereEnds(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column doesn't end with $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereNotEnds(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column contains $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereContains(Builder $query, $column, $value);

    /**
     * Scope a query to only include records where $column doesn't contain $value.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereNotContains(Builder $query, $column, $value);
}
