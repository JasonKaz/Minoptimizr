$(function(){
    var $upload=$('#upload');
    
    $upload.uploadify({
        debug               : true,
        auto                : false,
        uploader            : 'php/uploadify.php',
        swf                 : 'php/uploadify.swf',
        fileTypeExts        : '*.js; *.css',
        fileTypeDesc        : 'JavaScript, CSS',
        multi               : true,
        onUploadComplete    : function(file){
            console.log(file);
            //var r=$.parseJSON(response);
            //$('#files').append('<tr><td><a href="'+r.File+'" target="_blank">'+r.Filename+'.gz</a></td><td>'+r.SizeStart+'</td><td>'+r.SizeEnd+'</td><td>'+r.SizeSaved+'%</td></tr>')
        },
        onQueueComplete     : function(queueData){
            console.log(queueData);

            $('#local').fadeOut();
            $('#choose_files').fadeOut(function(){
                $('#download').fadeIn();
            });
        }
    });
    
    $('#upload_button').click(function(){
        $upload.uploadify('upload');
    });
    
    jQuery.fn.center=function(){
        this.css({'position':'absolute','top':($(window).height()-this.height())/2+$(window).scrollTop()+"px",'left':($(window).width()-this.width())/2+$(window).scrollLeft()+"px"});
        return this;
    };
    
    $('#htaccess_code').click(function(e){
        $('#popup').center().fadeIn();
        e.stopPropagation();
    });
    
    $('#close').click(function(){
        $('#popup').fadeOut(); 
    });
    
    $(window).click(function(){
        $('#close').click(); 
    });
    
    $('#go_back').click(function(){
        $('#download').fadeOut(function(){
            $('#choose_files').fadeIn();
        }) 
    });
    
    $('#popup').live('click',function(e){
        e.stopPropagation();
    });
    
    $('#downloadme').click(function(){
        $.post('php/download.php'); 
    });
});