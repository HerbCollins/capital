;(function () {
    $.Toast = function(object){
        var _icon = object.icon;
        var _message = object.message;
        var _type = object._type ? object._type : 0;

        this.init = function(){
            var mytime = new Date();
            return 'toast-' + mytime.getTime() + Math.floor(Math.random()*100+1);
        }

        this.destory = function(_id)
        {
            if(!_id)
                return false;

            setTimeout(function() {
                $("#"+_id).fadeOut(2000);
            }, 3000);

            setTimeout(function(){

                $("#"+_id).remove();
            } , 5000);
        }

        this.success=function()
        {
            var _id = this.init();

            var _html = this.html(_id);
            $('body').append(_html);


            _toast_wid = $('.toast-box').innerWidth();
            _toast_position = _toast_wid / 2;
            $('.toast-box').css("margin-left" , -_toast_position);

            this.destory(_id);
        }

        this.error=function()
        {
            var _id = this.init();

            var _html = this.html( _id);
            $('body').append(_html);

            _toast_wid = $('.toast-box').innerWidth();
            _toast_position = _toast_wid / 2;
            $('.toast-box').css("margin-left" , -_toast_position);


            this.destory(_id);
        }

        this.html=function(id)
        {
            if(_type == 0)
                return '<div class="toast-box toast-success" id='+id+'><div class="toast-icon text-center">'+_icon+'</div><div class="toast-content">'+_message+"</div>";
            else
                return '<div class="toast-box  toast-error" id='+id+'><div class="toast-icon text-center">'+_icon+'</div><div class="toast-content">'+_message+"</div>";
        }
    }
})(jQuery);

