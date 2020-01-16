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


    //account create modal
    $('#accountId').click(function(){
        $('#accountPop').modal('show')
        .find('#contentAccount')
        .load($(this).attr('value'));
    });

    //entity-type create modal
    $('#entityId').click(function(){
        $('#entityPop').modal('show')
        .find('#contentEntity')
        .load($(this).attr('value'));
    });

    //account-type create modal
    $('#accountId').click(function(){
        $('#accountPop').modal('show')
        .find('#accountEntity')
        .load($(this).attr('value'));
    });


    $('#activity-view-link').click(function() {
    $.get(
        'view',
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
