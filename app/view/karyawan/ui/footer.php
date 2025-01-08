<?php require_once("../../../config/config.php"); ?>
<script src="<?= baseurl('dist/vendor/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/chart.js/chart.umd.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/echarts/echarts.min.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/quill/quill.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/simple-datatables/simple-datatables.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/tinymce/tinymce.min.js') ?>"></script>
<script src="<?= baseurl('dist/vendor/php-email-form/validate.js') ?>"></script>
<script src="<?= baseurl('dist/js/main.js') ?>"></script>

<!-- Template Main JS File -->
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
</script>
<script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script crossorigin="anonymous">
    /* Settings DataTables */
    $(document).ready(function() {
        $('#datatable1').DataTable({
            "responsive": true,
            "processing": false,
            "ordering": false,
            "columnDefs": [{
                "orderable": false,
                "targets": [0]
            }]
        });
        $("#datatable1_filter").hide(false);
        // $("#datatable1_filter").hide(true);
        $('#datatable1').parent().addClass("table-responsive");
    });

    $(document).ready(function() {
        $("#datatable2").DataTable({
            "responsive": true
        });
        $('#datatable2').parent().addClass("table-responsive");
    });

    $(document).ready(function() {
        $("#datatable3").DataTable({
            "responsive": true,
            "ordering": false
        });
        $("#datatable3_filter").hide(false);
        $("#datatable3_length").hide(false);
        $('#datatable3').parent().addClass("table-responsive");
    });

    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.onload = function() {
                URL.revokeObjectURL(preview.src); // Free memory
            };
        }
    }
</script>
<script type="text/javascript">
    /*
     * jTerbilang Plugin for jQuery JavaScript Library
     * http://www.po3nx.web.id/jterbilang
     *
     * Copyright (c) 2010 Po3nX
     * Dual licensed under the MIT and GPL licenses.
     *  - http://www.opensource.org/licenses/mit-license.php
     *  - http://www.gnu.org/copyleft/gpl.html
     *
     * Author	: Purwanto (Po3nX)
     * Version	: 1.0.0
     * Date		: 13th November 2010
     */
    (function($) {
        $.fn.terbilang = function(options) {
            var opt = {
                style: 4, //style 1=UPPER CASE,2=lower case,3=Title Case,4=Sentence case 
                input_type: "form", //input type (form or text)
                output_div: "output", //element's id to show the output 
                awalan: "", //prefix output
                akhiran: "", //postfix output
                on_error: function(msg) {
                    alert("Error: " + msg);
                }
            };

            if (options) {
                $.extend(opt, options);
            }
            this.each(function() {
                var self = this;
                if (opt.input_type == "form") {
                    $(this).bind("keyup", function(e) {
                        _tobilang(this);
                    });
                }
            });

            var _tobilang = function(self) {
                var hasil = "";
                if (opt.input_type == "form") {
                    var angka = $(self).val();
                } else {
                    var angka = $(self).text();
                }
                if (self < 0) {
                    hasil = opt.awalan + " minus " + _bilang(angka) + " " + opt.akhiran;
                } else {
                    hasil = opt.awalan + " " + _bilang(angka) + " " + opt.akhiran;
                }
                switch (opt.style) {
                    case 1:
                        hasil = hasil.toUpperCase();
                        break;
                    case 2:
                        hasil = hasil.toLowerCase();
                        break;
                    case 3:
                        hasil = _ucwords(hasil);
                        break;
                    default:
                        hasil = _ucfirst(_ltrim(hasil));
                        break;
                }
                $('#' + opt.output_div).html(hasil);
            }

            var _bilang = function(self) {
                var x = Math.abs(self);
                angka = new Array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",
                    "sembilan", "sepuluh", "sebelas");
                var temp = "";
                if (x < 12) {
                    temp = " " + angka[Math.floor(x)];
                } else if (x < 20) {
                    temp = _bilang(x - 10) + " belas";
                } else if (x < 100) {
                    temp = _bilang(x / 10) + " puluh" + _bilang(x % 10);
                } else if (x < 200) {
                    temp = " seratus" + _bilang(x - 100);
                } else if (x < 1000) {
                    temp = _bilang(x / 100) + " ratus" + _bilang(x % 100);
                } else if (x < 2000) {
                    temp = " seribu" + _bilang(x - 1000);
                } else if (x < 1000000) {
                    temp = _bilang(x / 1000) + " ribu" + _bilang(x % 1000);
                } else if (x < 1000000000) {
                    temp = _bilang(x / 1000000) + " juta" + _bilang(x % 1000000);
                } else if (x < 1000000000000) {
                    temp = _bilang(x / 1000000000) + " milyar" + _bilang(x % 1000000000);
                } else if (x < 1000000000000000) {
                    temp = _bilang(x / 1000000000000) + " trilyun" + _bilang(x % 1000000000000);
                }
                return temp;
            }
            var _ltrim = function(str, chars) {
                chars = chars || "\\s";
                return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
            }
            var _ucwords = function(str) {
                return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
                    return $1.toUpperCase();
                });
            }
            var _ucfirst = function(str) {
                var f = str.charAt(0).toUpperCase();
                return f + str.substr(1).toLowerCase();
            }
            _tobilang(this);
        };
    })(jQuery);
</script>
</body>

</html>