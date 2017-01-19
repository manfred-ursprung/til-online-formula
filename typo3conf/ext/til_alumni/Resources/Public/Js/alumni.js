/**
 * Created by manfred on 16.01.17.
 */
(function ($) {
    function changed(event) {
        //if (typeof event !== 'undefined') {
            event.preventDefault();
        //}

        var $this = $(this);
        var url = 'index.php?type=14545';
        var formValues = Object.create({});
        formValues.city = $('#searchKeyCity').val();
        formValues.zip = $('#searchKeyZip').val();
        formValues.university = $('#searchKeyUniversity').val();
        formValues.universityCourse = $('#searchKeyUniversityCourse').val();

        $.ajax({
            async: 'true',
            url: url,
            type: 'POST',

            data: {
                'tx_tilalumni_alumni[action]': 'search',
                'tx_tilalumni_alumni[controller]': 'Alumni',
                'tx_tilalumni_alumni[alumni-search][city]': formValues.city,
                'tx_tilalumni_alumni[alumni-search][zip]': formValues.zip,
                'tx_tilalumni_alumni[alumni-search][university]': formValues.university,
                'tx_tilalumni_alumni[alumni-search][universityCourse]': formValues.universityCourse,
                'tx_tilalumni_alumni[ajax]': true,

            },
            //dataType: "json",
            dataType: 'html',
            success: function (result) {
                //console.log(result);
                $('#tabs').html(result);
                $('#tabs').tabulous({
                    effect: 'scale'
                });
            },
            error: function (error) {
                console.log(error);
                //$.fancybox.close();
            }
        });
    }
    function init () {
        jQuery('#searchKeyCity').change(changed);
        jQuery('#searchKeyZip').change(changed);
        jQuery('#searchKeyUniversity').change(changed);
        jQuery('#searchKeyUniversityCourse').change(changed);
        //Reiter
        $('#tabs').tabulous({
            effect: 'scale'
        });
    }

    jQuery(document).ready(init);

})(jQuery);

