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

// Family and relatives
$('#addOtherSibling').click(function(event){
    event.preventDefault();
    var template = $('#template-add-sibling fieldset').clone(true);  // also events are copied
    $(this).before(template);

    $('.removeOtherSibling').bind('click', function(event){
        event.preventDefault();
        var index = $(this).data('iterator');
        var memberUid = $(this).data('relative');
        $('#family_member_' + index + ' .family-member-information').remove();
        $('#remove_family_member_' + memberUid).val(1);
    });
});


$('.removeOtherSibling').bind('click', function(event){
    event.preventDefault();
    var index = $(this).data('iterator');
    var memberUid = $(this).data('relative');
    $('#family_member_' + index + ' .family-member-information').remove();
    $('#remove_family_member_' + memberUid).val(1);

});


