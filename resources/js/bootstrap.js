window._ = require("lodash");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    window.moment = require("moment");
    window.daterangepicker = require("daterangepicker");
    window.DataTable = require("datatables.net");
    window.DataTable = require("datatables.net-bs4");
    window.DataTable = require("datatables.net-buttons");

    // https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js
    window.toastr = require("toastr");
    window.select2 = require("select2");
    window.Chart = require("chart.js");

    require("jstree");
    require("bootstrap");
    require("jquery-countup");

    $(document).ready(function() {
        $(".js-category").select2({
            placeholder: "Select a category",
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
        });

        $(".js-term").select2({
            placeholder: "Select a term",
            sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
        });

        // Dashboard Counter
        $(".count").each(function() {
            $(this)
                .prop("Counter", 0)
                .animate(
                    {
                        Counter: $(this).text()
                    },
                    {
                        duration: 4000,
                        easing: "swing",
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    }
                );
        });

        // Menu Toggle
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });

    let picker = $("#daterange");
    picker.daterangepicker();
    picker.on("apply.daterangepicker", function(ev, picker) {
        console.log(picker.startDate.format("YYYY-MM-DD"));
        console.log(picker.endDate.format("YYYY-MM-DD"));
    });

    $.fn.dataTable.moment("DD-MMM-YY HH:mm:ss");
    //$.fn.dataTable.moment("DD.MM.YYYY HH:mm:ss");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
