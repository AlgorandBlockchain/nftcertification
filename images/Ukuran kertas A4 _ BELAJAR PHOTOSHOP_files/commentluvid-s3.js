(function($) {
    cl_settings = {
        fetched_it: "0",
        prepend: "",
        badge: "http://comluv.s3.amazonaws.com/images/CL91_White.gif",
        show_text: "CommentLuv Enabled",
        badge_text: "",
        heart_tip: "on",
        default_on: "checked",
        select_text: "click to choose a different post to show",
        cl_version: "id1.1",
        images: "http://comluv.s3.amazonaws.com/images/",
        api_url: "http://api.comluv.com/cl_api/commentluvapi.php"
    }
    $(document).ready(function(){
        // add the gubbins to the div created by ID plugin code
        $('#luv_field_new').html('<div id="all_luv"> Site URL<br><input type="text" id="new_url" class="idc-text"/><br><div id="commentluv"><input type="checkbox" style="width: 25px;" checked="" name="doluv" id="doluv"/><span style="clear: both;" id="mylastpost"><a target="_blank" href="http://comluv.com"><img border="0" title="CommentLuv Enabled" alt="CommentLuv Enabled" src="http://comluv.s3.amazonaws.com/images/CL91_White.gif"/></a></span><img style="display: none;" alt="show more" src="http://comluv.s3.amazonaws.com/images/down-arrow.gif" id="showmore" class="clarrow"/></div><div id="lastposts" style="display: none; position: absolute; margin-top: 5px;"></div></div>');
        // read the cookie and add value to new_url field
        var x = readCookie('commentluv');
        if(x) {
            $("#new_url").val(x);
        }
        set_events();
        function set_events(){
            // set event to dostuff if url changes
            $("#new_url").change(function(){
                $('#lastposts').empty();
                cl_settings['fetched_it'] = 0;
                // populate logged out form url field
                $('#txtURLNewThread').val($('#new_url').val());
                $('#txtURLReply').val($('#new_url').val());
                dostuff();
            });
            // set the event listener for the click of the checkbox
            $('#doluv').click(function(){
                $('#lastposts').hide();
                if($(this).is(":checked")){
                    // was unchecked, now is checked
                    $('#mylastpost').fadeTo("fast",1);
                    dostuff();
                } else {
                    // was checked, user unchecked it so empty hidden fields in form
                    cl_settings['cl_post'] = "" ;
                    cl_settings['cl_type'] = "" ;
                    cl_settings['request_id'] = "";
                    cl_settings['choice_id'] = "" ;
                    $('#mylastpost').fadeTo("slow",0.3);
                }
            });
            // event for the show more arrow (displays more posts to choose from)
            $("#showmore").hover(function(){
                // hide drop down box for click outside
                $(document.body).click(function(){
                    $('#lastposts').hide();
                });
                $("#lastposts").slideDown(1000);
            });
        }
        $('#txtComment').focus(function(){
            // move the whole gubbins div to the div created by plugin code above the reply box
            var all_luv = $('#all_luv').remove();
            $('#luv_field_reply').append(all_luv);
            set_events();
            dostuff();
        })
        $('#IDCommentNewThreadText').focus(function(){
            // move the whole gubbins div to the div created by plugin code above new thread box
            var all_luv = $('#all_luv').remove();
            $('#luv_field_new').append(all_luv);
            set_events();
            dostuff();
        })



        // the do
        function dostuff(){
            if($('#doluv').is(":checked") && $('#new_url').val().length > 0 && cl_settings['fetched_it'] == 0){ 

                var url_val=$('#new_url').val();
                var url=cl_settings['api_url'] + "?type=request&url="+url_val+"&version="+ cl_settings['cl_version'] +"&callback=?";
                $.getJSON(url,function(data){
                    $('#showmore').show();
                    $('#lastposts').empty();
                    // get if is a member and other meta data
                    var ismember = data.meta[0].ismember;
                    cl_settings['request_id'] = data.meta[0].request_id;
                    cl_settings['alert_message'] = data.meta[0].alert_message;
                    // add the returned data to select box (or div)
                    $('#lastposts').append('<span class="choosepost">' + cl_settings['select_text'] + '</span>');
                    $.each(data.items, function(j,item){
                        //get image type for this item
                        var imageurl = '<img class="cl_type_icon" src="' + cl_settings['images'] + data.items[j]['type'] + '.gif"' + ' alt="' + data.items[j]['type'] + '" border=0 />';
                        // construct vars for clchoose function
                        var titlestr = data.items[j]['title'];
                        // replace single and double quotes with backslash versions (to prevent the onclick=".. from getting split)
                        titlestr = titlestr.replace(/\'/g,"\\\'");
                        titlestr = titlestr.replace(/\"/g,"\\\'");
                        $('#lastposts').append("<span style=\"display:block;\" onClick=\"clchoose('" + data.items[j]['type'] + "','" + data.items[j].url + "','" + titlestr + "'," + j + "," + data.meta[0].request_id + ");\"  class=\"choosepost\">" + imageurl + data.items[j]['title'] + "</span>");
                    });
                    cl_settings['typeimage'] = '<img class="cl_type_icon" src="' + cl_settings['images'] + data.items[0]['type'] + '.gif"' + ' alt="' + data.items[0]['type'] + '" border=0 />';
                    $('#mylastpost').html(cl_settings['typeimage'] + ' <a href="' + data.items[0].url +'" title="' + data.items[0]['type'] + '"> ' + data.items[0]['title'] + '</a>').fadeIn(1000);
                    cl_settings['choice_id'] = "0";
                    cl_settings['cl_type'] = data.items[0]['type'];
                    cl_settings['cl_post'] = '<a href="' + data.items[0].url + '">' + data.items[0]['title'] + '</a>';
                    cl_settings['fetched_it'] = 1;
                    if(cl_settings['request_id'] > 0){
                        createCookie('commentluv',url_val,60);
                    }
                });
            }
        }	
    });

})(jQuery);
// functions called with onclick (outside scope of above block)
function clchoose(ptype,purl,pstr,pid,preq){
    (function($) {
        if(purl == "0"){
            return;
        }
        // set hidden fields in form to hold values for identifying this choice
        cl_settings['choice_id'] = pid;
        cl_settings['request_id'] = preq;
        cl_settings['cl_type'] = ptype;
        $('#mylastpost a').attr("href",purl).text(pstr);
        cl_settings['cl_post'] = '<a href="' + purl + '">' + pstr + '</a>';
        $('#mylastpost img').attr({src: cl_settings['images'] + ptype + '.gif',alt: ptype});
        if($('#luv').is(":checked")){
            cl_settings['cl_post'] = '<a href="' + purl + '">' + pstr + '</a>';
        }
    })(jQuery);
}
function confirm_comluv(){
    // confirm to comluv
    (function($){
        var url=cl_settings['api_url'] + "?type=approve&url="+ $('#mylastpost a').attr('href') +"&request_id="+cl_settings['request_id'] + "&post_id=" +cl_settings['choice_id']+ "&version="+ cl_settings['cl_version'] +"&callback=?";
        $.getJSON(url);
    })(jQuery);
}
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else { var expires = ""; }
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {c = c.substring(1,c.length);}
        if (c.indexOf(nameEQ) == 0){ return c.substring(nameEQ.length,c.length);}
    }
    return null;
}
