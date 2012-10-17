function bytesToSize(bytes){
    var Times=0,
        Letters=['b', 'kb', 'mb'];
    while(bytes>1024){
        bytes/=1024;
        Times++;
    }

    return precisionRound(bytes, 2)+Letters[Times];
}

function precisionRound(x, precision){
    if (precision==undefined)
        precision=0;
    return Math.round(x*Math.pow(10, precision))/Math.pow(10, precision);
}

$(function(){
    var $upload=$('#upload');
    
    $upload.uploadify({
        debug               : false,
        auto                : false,
        uploader            : 'php/uploadify.php',
        swf                 : 'php/uploadify.swf',
        fileTypeExts        : '*.js; *.css',
        fileTypeDesc        : 'JavaScript, CSS',
        multi               : true,
        onUploadSuccess     : function(file, data, response){
            var r=$.parseJSON(data),
                per=precisionRound((1-(r.end_size/r.start_size))*100, 2);
            console.log(per);
            $('#files').append('<tr><td><a href="/apps/minoptimizr/tmp_files/'+r.filename+'" target="_blank">'+r.filename+'</a></td><td>'+bytesToSize(r.start_size)+'</td><td>'+bytesToSize(r.end_size)+'</td><td>'+per+'%</td></tr>');
        },
        onQueueComplete     : function(queueData){
            $('#local').fadeOut();
            $('#choose_files').fadeOut(function(){
                $('#download').fadeIn();
            });
        }
    });
    
    $('#upload_button').click(function(){
        $upload.uploadify('upload' ,'*');
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