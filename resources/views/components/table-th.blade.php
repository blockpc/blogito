@props(['field' => false, 'sortField', 'direction'])

@php
if($field && $field == $sortField)
    $icon = ($direction == "asc") ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
else
    $icon = '<i class="fas fa-sort text-gray-300"></i>';
@endphp

<th {{ $attributes->merge(['class' => 'th']) }}>
    <span class="whitespace-pre"> {!!$icon!!} {{$slot}}</span>
</th>