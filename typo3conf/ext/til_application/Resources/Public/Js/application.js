/**
 * Created by manfred on 28.03.16.
 */

$('#addOtherSchool').click(function(event){
    event.preventDefault();
    var template = $('#template-add-school .form-group').clone(true);  // also events are copied
    $(this).before(template);
    $('.removeOtherSchool').bind('click', function(event){
        event.preventDefault();
        var index = $(this).data('iterator');
        var schoolUid = $(this).data('school');
        $('#schoolcareer_school_' + index).remove();
        $('#remove_school_' + schoolUid).val(1);
    });
});

$('.removeOtherSchool').bind('click', function(event){
    event.preventDefault();
    var index = $(this).data('iterator');
    var schoolUid = $(this).data('school');
    $('#schoolcareer_school_' + index).remove();
    $('#remove_school_' + schoolUid).val(1);
});

