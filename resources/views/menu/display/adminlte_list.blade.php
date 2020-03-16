@if(isset($item['children']))
    <li class="treeview {{$item['class']}}">
        <a href="{{$item['render_path']}}" style="{{empty($item['color'])?:'color:'.$item['color']}}">
            <i class="far fa-fw fa-circle"></i> {{$item['label']}}
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @each('menu_architect::menu.display.adminlte_list', $item['children'], 'item')
        </ul>
    </li>
@else
    <li class="{{$item['class']}}">
        <a href="{{$item['render_path']}}" style="{{empty($item['color'])?:'color:'.$item['color']}}">
            <i class="far fa-fw fa-circle"></i> {{$item['label']}}
        </a>
    </li>
@endif