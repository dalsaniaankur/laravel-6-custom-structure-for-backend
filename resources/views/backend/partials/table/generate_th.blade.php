@if(!empty($tableTh))
    @php($shortClass = ( strtolower($filterList['sorted_order']) == 'asc') ? 'up' : 'down' )
    @php($sortDefault = '<i class="fas fa-sort"></i>')
    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

    @foreach($tableTh as $key => $th)
        @if(!empty($th['sortableField']))
        @php($className = empty($className) ? $th['sortableField'] : $className)
        <th class="updownicon{{ ' '.$th['class'] }}" {{ !empty($th['id']) ? "class=$th[id]": "" }} onclick="sortWithSearch('{{ $th['sortableField'] }}');">{{ $th['label'] }}{!! $filterList['sorted_by'] == $th['sortableField'] ? $sorting : $sortDefault  !!}</th>
        @else
            <th {{ !empty($th['class']) ? "class=$th[class]": "" }} {{ !empty($th['id']) ? "class=$th[id]": "" }} >{{ $th['label'] }}</th>
        @endif
    @endforeach

@endif
