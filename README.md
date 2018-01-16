# eloquent-extended
Extra where scopes for Laravel Models

Functions:
* whereOrEmptyOrNull($column, $value, $ignore)

## whereOrEmptyOrNull
This adds a where condition for when a $column should be equal to $value, but not equal to a $ignore
```
  $query->whereOrEmptyOrNull('Country', $input['country'], '');
```
If $input['country'] is not equal to '' then this will be the equivalent of:
```
  $query->where('Country', $input['country']);
```
Otherwise if $input['country'] === '' then a where statement isn't added. 

Likewise, a default value could be added, eg. 
```
$query->whereOrEmptyOrNull('Country', $input['country'], 'Australia');
```
If you wanted to only add a where statement when $input['country'] isn't 'Australia'.

This can also be run with an array of columns, e.g.:
```
  $query->whereOrEmptyOrNull([
          'Country' => $input['country'],
          'State' => $input['state'],
          'Locality' => $input['locality']
      ], '', '');
```
which would add where statements for Country, State and Locality if the input fields weren't empty.
