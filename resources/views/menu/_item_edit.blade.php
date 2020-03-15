<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="editItemModalLabel"><i class="glyphicon glyphicon-edit"></i> Edit Item</h4>
          </div>
          <div class="modal-body">
          <form method="POST" action="{{route('menu_arct_item.update', ['menu_arct' => $model->data->id, 'menu_arct_item' => 'replace_id'])}}">
              @csrf
              @method('PUT')
              <input type="hidden" name="menu_id" value="{{$model->data->id}}" />
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="label" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Link type</label>
                <select class="form-control" name="type" data-rel="ddsh" data-value="link-type">
                    <option value="url" selected="selected">Static URL</option>
                    <option value="route">Dynamic Route</option>
                </select>
              </div>
              <div data-rel="link-type-url" style="display: none;">
                <div class="form-group">
                  <label for="">URL</label>
                  <input type="text" name="link" class="form-control" placeholder="https://something.else">
                </div>
              </div>
              <div data-rel="link-type-route" style="display: none;">
                <div class="form-group">
                  <label for="">Route</label>
                  <input type="text" name="route" class="form-control" placeholder="posts.index">
                </div>
                <div class="form-group">
                  <label for="">Query String or Json(key/value)</label>
                  <textarea rows="3" name="query_string" class="form-control" placeholder='{
  "key": "value"
}'></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="">Text Color</label>
                <input type="hidden" name="color" value="#000000" data-rel="simonwep-picker" data-save="Save" data-cancel="Cancel">
              </div>
              <div class="form-group">
                <label for="">Open In</label>
                <select class="form-control" name="target">
                  <option value="_self" selected="selected">Same Tab/Window</option>
                  <option value="_blank">New Tab/Window</option>
                </select>
              </div>
          </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary marct-submit">Submit</button>
          </div>
    </div>
  </div>
</div>