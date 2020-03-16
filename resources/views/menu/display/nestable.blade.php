<div id="{{ $menu->name }}" class="dd">
    <ol class="dd-list">
        @each('menu_architect::menu.display.nestable_list', $items, 'item')
    </ol>
</div>