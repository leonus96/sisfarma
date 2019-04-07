
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');
// require('admin-lte/plugins/daterangepicker');
require('jquery');

//Date range as a button
// $('#daterange-btn').daterangepicker(
//     {
//         ranges   : {
//             'Today'       : [moment(), moment()],
//             'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//             'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
//             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//             'This Month'  : [moment().startOf('month'), moment().endOf('month')],
//             'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//         },
//         startDate: moment().subtract(29, 'days'),
//         endDate  : moment()
//     },
//     function (start, end) {
//         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
//     },
// );

require('select2');
