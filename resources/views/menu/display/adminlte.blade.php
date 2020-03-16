<ul class="sidebar-menu tree" data-widget="tree">
    @foreach ($items as $item)
        <li class="header {{$item['class']}}" style="{{empty($item['color'])?:'color:'.$item['color']}}">{{$item['label']}}</li>
        @if(isset($item['children']))
            @each('menu_architect::menu.display.adminlte_list', $item['children'], 'item')
        @endif
    @endforeach
</ul>