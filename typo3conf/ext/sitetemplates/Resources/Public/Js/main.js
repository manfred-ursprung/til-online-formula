/**
 * Created by manfred on 27.02.15.
 */

/* Toggle Login Formular */
$(document).ready(function(){
    $('[data-toggle="login"]').on('click', function(){
        $(this).modal('toggle');
    });

    //hide searchbox
    $('#searchform').toggle();
    $('#searchform-link').on('click', function(){
        $('#searchform').toggle();
    });

});
/*
("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
    var d = a(this), e = d.attr("href"), f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")), g = f.data("bs.modal") ? "toggle" : a.extend({remote: !/#/.test(e) && e}, f.data(), d.data());
    d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
        a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
            d.is(":visible") && d.trigger("focus")
        })
    }), b.call(f, g, this)
})
}
*/