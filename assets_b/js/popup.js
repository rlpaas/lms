$(function(){
    
    //campus-create modal
    $('#campusId').click(function(){
        $('#util').modal('show')
        .find('#contentUtil')
        .load($(this).attr('value'));
    });


    //school-college create modal
    $('#scId').click(function(){
        $('#scPop').modal('show')
        .find('#contentSc')
        .load($(this).attr('value'));
    });

    //department-division create modal
    $('#ddId').click(function(){
        $('#ddPop').modal('show')
        .find('#contentDd')
        .load($(this).attr('value'));
    });


    $('.activity-view-link').click(function() {
    $.get(
        'view-ajax',
        {
            id: $(this).closest('tr').data('key')
        },
        function (data) {
            $("#activity-modal").find(".modal-body").html(data);
            $("#activity-modal").modal("show");
        }
    );
    });
});

function ajaxmodal(modal, url) {
    //update utility
    $.get(
        url,
        {
            id: $(this).closest('tr').data('key')
        },
        function (data) {
            $(modal).find(".modal-body").html(data);
            $(modal).modal("show");

        }
    );
}
