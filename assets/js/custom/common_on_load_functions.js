$(document).ready(function() {
    // Set initial date
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);
    $('#to_date').val(today);
    $('#from_date').val(today);

    // Submit default filter
    $('#primary_filter').submit();
    console.log('after submit');
});