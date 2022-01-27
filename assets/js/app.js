class APP {
    baseUrl         = '';
    api             = '';
    config          = {};
    sessionHooks    = {};
    modalID         = {};
    jsHookParam     = [];

    get jsHooks (){
        return this.jsHookParam
    }

    set jsHooks(data){

        if (Array.isArray(data) && data.length > 0) {

            this.jsHookParam = [...data]
            
        }

    }
    
    moduleHooks = () => {

        $('body').append('<script src="'+ this.baseUrl +'assets/js/helper.js"></script>');
        $('body').append('<script type="text/babel" src="'+ this.baseUrl +'assets/js/components/commons.js"></script>');

        const jsParams = this.jsHookParam;

        if (jsParams.length > 0) {

            for (let index = 0; index < jsParams.length; index++) {
                
                const element = jsParams[index];

                if (element.type === 'stylesheet') {
                    $('body').append(`<link rel="stylesheet" href="${this.baseUrl}${element.file}" />`);
                }else{
                    $('body').append(`<script type="${element.type}" src="${this.baseUrl}${element.file}"></script>`);
                }
                
            }
            
        }      
        
    }

    render = () => {
        this.moduleHooks()
    }
}