<li data-id="{{$item['id']}}" data-sort="{{$item['sort']}}" class="dd-item {{$item['class']}}">
    <div class="dd-handle">
        <span class="dd-content" style="{{ $item['color'] ? 'color: '.$item['color'] : '' }}">
            <a href="{{$item['render_path']}}" target="{{ $item['target'] }}">{{$item['label']}}</a>
        </span>
    </div>
    @if(isset($item['children']))
    <ol class="dd-list">
        @each('menu_architect::menu.display.nestable_list', $item['children'], 'item')
    </ol>
    @endif
</li>