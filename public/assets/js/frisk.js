var Frisk = Frisk || (function(){
    var _args = {};

    return {
        init : function(Args) {
            _args = Args;
            // some other initialising
        },

        store : function(key, value) {
            _args[key] = value;
        },

        get : function(key) {
            return _args[key];
        }
    };
}());