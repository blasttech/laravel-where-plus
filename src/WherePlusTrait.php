<?php

namespace Blasttech\WherePlus;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait WherePlusTrait
 *
 * @method Builder whereOrEmptyOrNull($field_name, $value = '', $ignore = null)
 *
 * @package Blasttech\WherePlus
 */
trait WherePlusTrait
{
    /**
     * Add ticks to a table and column
     *
     * @param string $column
     * @return string
     */
    private function addTicks($column)
    {
        if (preg_match('/^[0-9a-zA-Z\.]*$/', $column)) {
            return '`' . str_replace(['`', '.'], ['', '`.`'], $column) . '`';
        } else {
            return $column;
        }
    }

    /**
     * If $value = '' add where ($column is null or column = '') statement
     * If $value != '' add where $column = $value statement
     *
     * @param Builder $query
     * @param string|array $column
     * @param string $value
     * @param string $ignore - if value = ignore, don't search on this column
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhereOrEmptyOrNull(Builder $query, $column, $value = '', $ignore = null)
    {
        if (is_array($column)) {
            foreach ($column as $where_col => $where_val) {
                $query->whereOrEmptyOrNull($where_col, $where_val, $ignore);
            }
        } else {
            if (!is_null($ignore) && $value != $ignore) {
                if ($value == '') {
                    $query->where(function ($query) use ($column) {
                        /** @var Builder $query */
                        $query->where($column, '')
                            ->orWhereNull($column);
                    });
                } else {
                    $query->where($column, $value);
                }
            }
        }

        return $query;
    }

    /**
     * Scope a query to only include records where $value in $column
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereInColumn(Builder $query, $column, $value)
    {
        return $query->whereRaw('CONCAT(\',\', ' . $this->addTicks($column) . ', \',\') LIKE \'%,' . $value . ',%\'');
    }

    /**
     * Scope a query to exclude records where $value in $column
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     * @return Builder
     */
    public function scopeWhereNotInColumn(Builder $query, $column, $value)
    {
        return $query->whereRaw(
            'CONCAT(\',\', ' . $this->addTicks($column) . ', \',\') NOT LIKE \'%,' . $value . ',%\''
        );
    }
}