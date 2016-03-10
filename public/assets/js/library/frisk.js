var Frisk = Frisk || (function(){
    var _args = {};

    return {
        init : function(Args) {
            _args = Args;
        },

        store : function(key, value) {
            _args[key] = value;
        },

        get : function(key) {
            return key in _args ? _args[key] : false;
        }
    };
}());