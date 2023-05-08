//Body Table List Iterator (active page) 
$(function(){
    var pathname = (window.location.pathname.match(/[^\/]+$/)[0]);
    $("[role='tablist-body'] li a").each(function(){
            if ($(this).attr("href") == pathname){	
                $(this).addClass('active');
            }
            if ($(this).attr("class") == 'active'){
                $(this).parents("li").addClass('active');
            }
    });
});


//diseaselist Modal 
