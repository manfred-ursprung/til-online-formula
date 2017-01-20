/**
 * Created by manfred on 16.01.17.
 */
(function ($) {
    function changed(event) {
        //if (typeof event !== 'undefined') {
            event.preventDefault();
        //}

        var $this = $(this),
            data,
            url = 'index.php?type=',
            formValues = Object.create({});
        formValues.city = $('#searchKeyCity').val();
        formValues.zip = $('#searchKeyZip').val();
        formValues.university = $('#searchKeyUniversity').val();
        formValues.universityCourse = $('#searchKeyUniversityCourse').val();
        formValues.plugin = $('#searchKeyPlugin').val();
        formValues.typeNum = $('#searchKeyTypeNum').val();
        url = url + $('#searchKeyTypeNum').val();
        switch (formValues.plugin){
            case 'alumni':
                data = {
                    'tx_tilalumni_alumni[action]': 'search',
                    'tx_tilalumni_alumni[alumni-search][city]': formValues.city,
                    'tx_tilalumni_alumni[alumni-search][zip]': formValues.zip,
                    'tx_tilalumni_alumni[alumni-search][university]': formValues.university,
                    'tx_tilalumni_alumni[alumni-search][universityCourse]': formValues.universityCourse,
                    'tx_tilalumni_alumni[alumni-search][plugin]': formValues.plugin,
                    'tx_tilalumni_alumni[ajax]': true,
                };
                break;
            case 'studentCounseilling':
                data = {
                    'tx_tilalumni_counseilling[action]': 'search',
                    'tx_tilalumni_counseilling[alumni-search][city]': formValues.city,
                    'tx_tilalumni_counseilling[alumni-search][zip]': formValues.zip,
                    'tx_tilalumni_counseilling[alumni-search][university]': formValues.university,
                    'tx_tilalumni_counseilling[alumni-search][universityCourse]': formValues.universityCourse,
                    'tx_tilalumni_counseilling[alumni-search][plugin]': formValues.plugin,
                    'tx_tilalumni_counseilling[ajax]': true,
                };
                break;
            case 'network':
                data = {
                    'tx_tilalumni_network[action]': 'search',
                    'tx_tilalumni_network[alumni-search][city]': formValues.city,
                    'tx_tilalumni_network[alumni-search][zip]': formValues.zip,
                    'tx_tilalumni_network[alumni-search][university]': formValues.university,
                    'tx_tilalumni_network[alumni-search][universityCourse]': formValues.universityCourse,
                    'tx_tilalumni_network[alumni-search][plugin]': formValues.plugin,
                    'tx_tilalumni_network[ajax]': true,
                };
                break;
        }

        $.ajax({
            async: 'true',
            url: url,
            type: 'POST',

            data: data,
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

