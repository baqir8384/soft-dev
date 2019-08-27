$(document).ready(function () {
    $('#btn_print_reports').click(function () {
        var printContents = document.getElementById('report_print_area').innerHTML;
        w = window.open();
        w.document.write('<html><head><title>' + document.title  + '</title>');
        w.document.write("<link rel=\"stylesheet\" href=\"css/bootstrap.css\" type=\"text/css\"/>");
        w.document.write("<link rel=\"stylesheet\" href=\"css/bootstrap-theme.css\" type=\"text/css\"/>");
        w.document.write("<link rel=\"stylesheet\" href=\"css/styles.css\" type=\"text/css\"/>");
        w.document.write('</head><body onload="window.print();window.close()">');
        // w.document.write('<h1>' + document.title  + '</h1>');
        w.document.write(printContents);
        w.document.write('</body></html>');
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        setTimeout(function () {
            w.print();
        }, 500);
        return false;
     });

     /* =================================== ANALYTICS in dashboard =================================== */
    $('#analytic').change(function () {
       var t = $(this).val();
       $.ajax({
           type: "GET",
           url: "/dashboard/" + t,
           data: {'time':t},
           dataType: "json",
           success: function (response) {
               $('#atc_title').text(response.schedule + ' Sales');
               $('#atc_total').text('$' + response.total);
               $('#atc_recieved').text('$' + response.recieved);
               $('#atc_cash').text('$' + response.cash);
               $('#atc_master').text('$' + response.master);
               $('#atc_debit').text('$' + response.debit);
               $('#atc_recievable').text('$' + response.recievable);
           }
       });
     });
     /* ===================================/. ANALYTICS in dashboard =================================== */
});
