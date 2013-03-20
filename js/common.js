function displayUploadResult(result)
{
    "use strict";
    console.log(result.message);
    //todo
}

function uploadFile()
{
    "use strict";
    var action = $(this).parents('form').attr('action');
    action += '&upload=true';
    $(this).upload(action, displayUploadResult, 'json');
}

function saveForm()
{
    "use strict";
    var form = $('#lbContent form');
    var formData = form.serialize();
    console.log(formData);
    var action = form.attr('action');
    action += '&save=true';
    $.post(action, formData, function (data){
        console.log(data);
        uLightBox.clear();
        location.reload();
    }, 'json');
}

function loadForm()
{
    "use strict";
    var url = $(this).attr('href');
    var title = $(this).html();
    uLightBox.alert({
        width: '400px',
        title: title,
        rightButtons: ['Save'],
        leftButtons: ['Cancel'],
        opened: function() {
            $('<span />').load(url, function() {
                $(this).appendTo('#lbContent');
                //icon file upload
                $('#lbContent input[type="file"]').change(uploadFile);
            });
        },
        onClick: function(button) {
            if(button === 'Save') {
                console.log('save button pressed');
                saveForm();
            }
        }
    });

    return false;
}

$(document).ready(function(){

    //ulightbox
    uLightBox.init({
        override: true,
        background: 'white',
        centerOnResize: true,
        fade: true
    });
    $('.ajaxform').each(function(index) {
        $(this).click(loadForm);
    });

    //tables
    $("#tasklist").tablesorter({
        cancelSelection: false,
        widgets: ['zebra']
	});
    $("#workdonelist").tablesorter({
        cancelSelection: false,
        widgets: ['zebra'],
        headers: { 3: { sorter: false}, 4: { sorter: false} }
	});
    $("#deptlist").tablesorter({
        cancelSelection: false,
        headers: { 2: {sorter: false}, 3: {sorter: false} }
	});
    $("#statuslist").tablesorter({
        cancelSelection: false
	});
    $("#priorlist").tablesorter({
        cancelSelection: false,
        headers: { 1: {sorter: false}, 2: {sorter: false} }
	});
    $("#grouplist").tablesorter({
        cancelSelection: false,
        headers: { 3: {sorter: false}, 4: {sorter: false} }
	});
    $("#bldglist").tablesorter({
        cancelSelection: false,
        headers: { 2: {sorter: false}, 3: {sorter: false} }
	});
    $("#clientlist").tablesorter({
        cancelSelection: false,
        headers: { 8: {sorter: false}, 9: {sorter: false} }
	});
    $("#consultlist").tablesorter({
        cancelSelection: false,
        headers: { 5: {sorter: false}, 6: {sorter: false} }
	});
    $("#addrlist1").tablesorter({
        cancelSelection: false,
        headers: { 2: {sorter: false}, 3: {sorter: false} }
	});
    $("#addrlist2").tablesorter({
        cancelSelection: false,
        headers: { 6: {sorter: false}, 7: {sorter: false} }
	});

    //hiding dl/dt/dd
    //$("dd").slideUp("slow");
    //$("dt.togglesection").hover(function(){
    //    $(this).addClass("hilite");
	//}, function(){
    //    $(this).removeClass("hilite");
	//});
    $("dt.togglesection").click(function(){
        $(this).next("dd").slideToggle("slow");
	});

    //canceling task entry
    $("#taskcancel").click(function(){
        var url = $(this).next("input:hidden[name=cancelurl]").val();
        url = unescape(url);
        window.location.assign(url);
	});

    //hiding editentry
    $("div.editrow").hide();
    $("a.editbutton").click(function(event){
        var row = $(this).next("div.editrow");
        var pos = $(this).parents("tr").offset();
        row.css("top", pos.top);
        row.css("left", pos.left - 2);
        row.toggle("slow");
        event.preventDefault();
	});
    $("[name=cancel_edit]").click(function(event){
        var row = $(this).parents("div.editrow");
        row.toggle("slow", function() {
            row.css("top", "70%");
            row.css("left", "20%");
        });
        event.preventDefault();
	});
});

