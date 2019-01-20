# laravel-where-plus
Extra where scopes for Laravel Models

Functions:
* whereOrEmptyOrNull($column, $value, $ignore)
* whereInColumn($column, $value)
* whereNotInColumn($column, $value)
* whereIfNull($column, $ifNull, $operator = null, $value = null, $boolean = 'and')

## whereOrEmptyOrNull
This adds a where condition for when a $column should be equal to $value, but not equal to a $ignore
```php
  $query->whereOrEmptyOrNull('Country', $input['country'], '');
```
If $input['country'] is not equal to '' then this will be the equivalent of:
```php
  $query->where('Country', $input['country']);
```
Otherwise if $input['country'] === '' then a where statement isn't added. 

Likewise, a default value could be added, eg. 
```php
$query->whereOrEmptyOrNull('Country', $input['country'], 'Australia');
```
If you wanted to only add a where statement when $input['country'] isn't 'Australia'.

This can also be run with an array of columns, e.g.:
```php
  $query->whereOrEmptyOrNull([
          'Country' => $input['country'],
          'State' => $input['state'],
          'Locality' => $input['locality']
      ], '', '');
```
which would add where statements for Country, State and Locality if the input fields weren't empty.

## whereInColumn
This adds a where condition to only include records where $value is in $column. The value of $column should be a comma delimited list.

For example:
```php
  $query->whereInColumn('Country', 'Australia');
```
In SQL, this would be the equivalent of:
```sql
  WHERE CONCAT(',', `Country`, ',') LIKE '%,Australia,%'
```

## whereNotInColumn
This adds a where condition to only include records where $value is not in $column. The value of $column should be a comma delimited list.

For example:
```php
  $query->whereNotInColumn('Country', 'Australia');
```
In SQL, this would be the equivalent of:
```sql
  WHERE CONCAT(',', `Country`, ',') NOT LIKE '%,Australia,%'
```

## whereIfNull($column, $ifNull, $operator = null, $value = null, $boolean = 'and')
This adds a where condition with the column wrapped in an SQL 'IFNULL' with the column as the first parameter and $ifNull as the second parameter. 

For example:
```php
  $query->whereIfNull('Country', 'Australia', '=', 'New Zealand');
```
In SQL, this would be the equivalent of:
```sql
  WHERE IFNULL(`Country`, 'Australia') = 'New Zealand'
```

## Aggregates

### Available scopes
- addCount
- addSum
- addAvg
- addMin
- addMax

### Example
```php
Calls::make()
  ->select(['calltype'])
  ->addCount('id')
  ->addSum('seconds')
  ->addSum('seconds', 'seconds2')
  ->groupBy('calltype');
```
In SQL, this would be the equivalent of:
```sql
  select calltype, count(id), sum(seconds), sum(charge) 
    from calls 
   group by calltype
```

## Group and Order

### Available scopes
- groupByIndex
- orderByIndex

### Example
```php
Calls::make()
  ->select(['calltype', 'description'])
  ->addSum('charge')
  ->groupByIndex(1, 2);
  ->orderByIndex(1);
```
```sql
  select calltype, description, sum(charge) 
    from calls 
   group by 1, 2
   order by 1
```
