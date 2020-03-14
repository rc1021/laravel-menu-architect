@extends('menu_architect::master')

@section('title', 'Edit Menu')

@section('content')
<h1 class="page-title">
    <i class="glyphicon glyphicon-list"></i> Menu Item ({{ $model->data->name }})
</h1>
<div class="alert alert-info">
    <strong>How To Use:</strong>
    <p>
        You can output a menu html anywhere on your site by calling  <code>menu_arct('{{ $model->data->name }}')</code>, <a target="_blank" href="{{route('menu_arct.example')}}">see more examples.</a>
    </p>
</div>

<form method="POST" action="{{ route('menu_arct.update', [$model->data]) }}" class="form-horizontal">
    @csrf
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Menu Form Edit</div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $model->data->name) }}" placeholder="Menu Name" autocomplete="off">
                    @error('name')
                        <div class="text-danger"><i class="glyphicon glyphicon-alert"></i>&nbsp;{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a href="{{ route('menu_arct.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Menu Builder
        <button type="button" class="btn btn-success create" data-toggle="modal" data-target="#addItemModal">
            <i class="glyphicon glyphicon-plus"></i> Add New Item
        </button>
      </h3>
      <div>
        Drag and drop the menu Items below to re-arrange them.&nbsp;&nbsp;<code>#</code>&nbsp;mean&nbsp;"no url available".
      </div>
    </div>
    <div class="box-body">
        <div class="dd" id="nestable" 
            data-json="{{ json_encode(menu_arct($model->data->name)->toJson()) }}" 
            data-sort-url="{{route('menu_arct_item.sort', [$model->data, 'menu_arct_item' => 'replace_id'])}}"
            data-update-url="{{route('menu_arct_item.update', [$model->data, 'menu_arct_item' => 'replace_id'])}}"
            data-destroy-url="{{route('menu_arct_item.destroy', [$model->data, 'menu_arct_item' => 'replace_id'])}}">
        </div>
    </div>
</div>

@include('menu_architect::menu_item.create', compact('model'))
@include('menu_architect::menu_item.edit', compact('model'))

@endsection

@section('js')
<script>
    $(function () {

        // nestable builer
        let $nestable = $('#nestable'),
            opt = $nestable.data();
        $nestable.nestable({
            json: opt.json,
            contentCallback: function(item) { 
                let code = (item.render_path) ? "&nbsp;&nbsp;<code>" + item.render_path + "</code>" : "";
                return item.label + code; 
            },
            itemRenderer: function(item_attrs, content, children, options, item) {
                var item_attrs_string = $.map(item_attrs, function(value, key) {
                    return ' ' + key + '="' + value + '"';
                }).join(' ');

                var html = '<' + options.itemNodeName + item_attrs_string + '>';
                html += this.toolRenderer(item_attrs_string, item);
                html += '<' + options.handleNodeName + ' class="' + options.handleClass + '">';
                html += '<' + options.contentNodeName + ' class="' + options.contentClass + '">';
                html += content;
                html += '</' + options.contentNodeName + '>';
                html += '</' + options.handleNodeName + '>';
                html += children;
                html += '</' + options.itemNodeName + '>';
                return html;
            },
            toolRenderer: function (item_attrs_string, item) {
                var html  = '<div class="pull-right item_actions">';
                    html += '<a href="' + opt.updateUrl.replace('replace_id', item.id) + '" class="btn btn-primary edit"' + item_attrs_string + '>';
                    html += '<i class="glyphicon glyphicon-edit"></i> Edit';
                    html += '</a>';
                    html += '<a href="' + opt.destroyUrl.replace('replace_id', item.id) + '" data-rel="btnConfirm" data-timeout="2" data-confirm-text="Double touch to remove!" class="btn btn-danger delete"' + item_attrs_string + '>';
                    html += '<i class="glyphicon glyphicon-trash"></i> Delete';
                    html += '</a>';
                    html += '</div>';
                return html;
            },
            beforeDragStop: function (root, el, dropEl) {
                let continueExecution = true,
                    nestable = root.data('nestable');
                let data = {
                    parent_id: dropEl.parent(nestable.options.itemNodeName).data('id'),
                    prev_id: this.placeEl.prev(nestable.options.itemNodeName).data('id')
                }
                
                $.ajax({
                    async: false,
                    method: 'POST',
                    url: root.data('sortUrl').replace('replace_id', el.data('id')),
                    context: document.body,
                    data: data
                }).done(function(data) {
                    Toast.fire({
                        icon: 'success',
                        title: data
                    })
                }).fail(function() {
                    continueExecution = false;
                });
                return continueExecution;
            }
        });

        // remove item
        $nestable
            .on('ajax:success', '[data-rel="btnConfirm"]', function (event, data, status, xhr) {
                let nestable = $(event.delegateTarget).data('nestable'),
                    item = nestable._getItemById(data.id),
                    children = item.children(nestable.options.listNodeName).children(nestable.options.itemNodeName);
                item.after(children);
                nestable.remove(data.id);
            })
            .on('ajax:beforeSend', '[data-rel="btnConfirm"]', function (event, xhr, settings) { /*  */ })
            .on('ajax:error', '[data-rel="btnConfirm"]', function (event, xhr, status, error) { /*  */ })
            .on('ajax:complete', '[data-rel="btnConfirm"]', function (event, xhr, status) { /*  */ })
            .on('click', '.edit', function (event) {
                event.preventDefault();
                $('#editItemModal').modal('show', this);
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

        $('.modal[role="dialog"]')
            .on('shown.bs.modal', function (event) {
                event.preventDefault();
                let button = $(event.relatedTarget),
                    recipient = button.data(),
                    action = button.attr('href');
                var modal = $(this);
                modal.find('form').each(function () 
                {
                    this.reset();
                    if(action)
                        $(this).attr('action', action);
                    for(var key in recipient) {
                        $('[name="' + key + '"]').val(recipient[key]).trigger('change');
                    }
                });
            })
            .on('click', '.submit', function (event) {
                $(event.delegateTarget).modal('hide');
                $form = $(event.delegateTarget).find('form');
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: $form.serialize()
                }).done(function(data, status, xhr) {
                    let nestable = $nestable.data('nestable'),
                        item = nestable._getItemById(data.properties.id);
                    if(item.length > 0)
                        nestable.replace(data.properties);
                    else
                        nestable.add(data.properties);
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    })
                }).fail(function(xhr, status, error) {
                    Toast.fire({
                        icon: 'danger',
                        title: error
                    })
                });
            });
    });
</script>
@endsection

@section('css')

@endsection