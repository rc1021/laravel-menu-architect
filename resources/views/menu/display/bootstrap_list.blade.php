<li class="{{$item['class']}} {{($item['depth'] >= 1 && isset($item['children'])) ? 'dropdown-submenu' : ''}}">
    @if(isset($item['children']))
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">{{$item['label']}} @if($item['depth'] < 1)<b class="caret"></b>@endif</a>
        <ul class="dropdown-menu multi-level">
            @each('menu_architect::menu.display.bootstrap_list', $item['children'], 'item')
        </ul>
    @else
        <a href="{{$item['render_path']}}">{{$item['label']}} @if($item['depth'] < 1)<b class="caret"></b>@endif</a>
    @endif
</li>