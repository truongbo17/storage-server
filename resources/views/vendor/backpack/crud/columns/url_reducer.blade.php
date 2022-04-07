@php $value = data_get($entry, $column['name']); $limit =
\Illuminate\Support\Arr::get($column, 'limit', 15); @endphp
<a
    href="{{ $value }}"
    target="_blank"
    >{{\App\Libs\TextReducer::url($value, $limit)}}</a
>
