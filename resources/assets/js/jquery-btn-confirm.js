+function ($, win) 
{
    function $fnBtnConfirm(element) 
    {
        if(element.instance) 
        {
            return ;
        }

        this._element = element;
        this._contiune = false;
        this._timer = undefined;
        this._opt = $.extend({
            timeout: 3,
            confirmText: 'Double click to remove!'
        }, $(element).data());

        Object.defineProperties(element, {
            'instance': {
                value: this,
                writable: false
            }
        });
    }

    let _prototype = $fnBtnConfirm.prototype;

    _prototype.reset = function (next) 
    {
        let self = this;
        this._contiune = false;
        this._timer = undefined;
        $(this._element).html(self._originHtml);
    }

    _prototype.confirm = function (event) 
    {
        let self = this;
        self._originHtml = $(self._element).html();
        self._contiune = true;
        $(self._element).animate({ opacity: 0.3 }, "fast",function(){
            $(this).text(self._opt.confirmText).animate({ opacity: 1 }, "fast");
        });
        setTimeout(function() {
            self.reset();
        }, parseInt(self._opt.timeout) * 1000);
    }

    _prototype.post = function (event) 
    {
        event.preventDefault();
        let self = this,
            data = $.extend({ _method: 'DELETE' }, $(this._element).data());
        $.ajax({
            method: 'POST',
            url: this._element.href || $(this._element).data('url'),
            context: document.body,
            data: data,
            beforeSend: function () {
                $(self._element).trigger('ajax:beforeSend', arguments);
            }
        }).done(function() {
            $(self._element).trigger('ajax:success', arguments);
        }).fail(function() {
            $(self._element).trigger('ajax:error', arguments);
        }).always(function() {
            $(self._element).trigger('ajax:complete', arguments);
        });
    }

    $.fn.extend({
        btnConfirm: function() {
            return this.each(function() {
                new $fnBtnConfirm(this);
            });
        }
    });
    
    $(function () 
    {
        $(document.body)
            .on('click.confirm', '[data-rel="btnConfirm"]', function (event) {
                new $fnBtnConfirm(this);
                if(this.instance._contiune) 
                {
                    this.instance.post(event);
                    return true;
                }
                event.preventDefault();
                this.instance.confirm(event);
            });
    });
}(jQuery, window);