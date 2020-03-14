+function ($, win) 
{
    function $fnSimonwepColorPicker (element, default_color) 
    {
        if(element.instance) 
        {
            return ;
        }

        this._element = element;
        this._opt = $.extend({
            defaultColor: element.value,
            theme: 'classic',
            saveText: 'save',
            cancelText: 'cancel'
        }, $(element).data());

        Object.defineProperties(element, {
            'instance': {
                value: this,
                writable: false
            }
        });

        this.build();
    }

    let _prototype = $fnSimonwepColorPicker.prototype;

    _prototype.build = function () 
    {
        let newElement = document.createElement('div');
        this._element.after(newElement);
        this._picker = new Pickr({
            el: newElement,
            default: this._opt.defaultColor || '#42445a',
            theme: this._opt.theme,
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 0.95)',
                'rgba(156, 39, 176, 0.9)',
                'rgba(103, 58, 183, 0.85)',
                'rgba(63, 81, 181, 0.8)',
                'rgba(33, 150, 243, 0.75)',
                'rgba(3, 169, 244, 0.7)',
                'rgba(0, 188, 212, 0.7)',
                'rgba(0, 150, 136, 0.75)',
                'rgba(76, 175, 80, 0.8)',
                'rgba(139, 195, 74, 0.85)',
                'rgba(205, 220, 57, 0.9)',
                'rgba(255, 235, 59, 0.95)',
                'rgba(255, 193, 7, 1)'
            ],
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: true,
                    input: true,
                    save: true,
                    cancel: true
                }
            },
            strings: {
                save: this._opt.save,
                cancel: this._opt.cancel
            }
        });

        this._picker
            .on('save', function (color, instance) {
                instance.input.value = color.toHEXA();
                instance.hide();
            })
            .on('cancel', function (instance) {
                instance.hide();
            });

        $(this._element)
            .on('change', function (event) {
                this.instance._picker.setColor(this.value);
            });

        Object.defineProperties(this._picker, {
            'input': {
                value: this._element,
                writable: false
            }
        });
    }

    $.fn.extend({
        sColorPicker: function() {
            return this.each(function() {
                new $fnSimonwepColorPicker(this);
            });
        }
    });
    
    $(function () 
    {
        $('[data-rel="simonwep-picker"]').sColorPicker();
    });

}(jQuery, window);