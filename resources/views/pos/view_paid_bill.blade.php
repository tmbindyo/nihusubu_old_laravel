

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice No 1</title>
    <base href="http://127.0.0.1:3000/"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link rel="shortcut icon" href="http://127.0.0.1:3000/themes/default/assets/images/icon.png"/>
    <link href="http://127.0.0.1:3000/themes/default/assets/dist/css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css" media="all">
        body { color: #000; }
        #wrapper { max-width: 520px; margin: 0 auto; padding-top: 20px; }
        .btn { margin-bottom: 5px; }
        .table { border-radius: 3px; }
        .table th { background: #f5f5f5; }
        .table th, .table td { vertical-align: middle !important; }
        h3 { margin: 5px 0; }

        @media print {
            .no-print { display: none; }
            #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
        }
        tfoot tr th:first-child { text-align: right; }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">
        <div class="no-print">
        </div>
        <div id="receipt-data">
            <div>
                <div style="text-align:center;">
                    <img src="http://127.0.0.1:3000/uploads/logo.png" alt="SimplePOS"><p style="text-align:center;"><strong>SimplePOS</strong><br>Address Line 1<br>Petaling Jaya<br>012345678</p><p></p>                                </div>
                <p>
                    Date: Mon 17 Aug 2020 02:13 PM <br>
                    Sale No/Ref: 1<br>
                    Customer: Thomas Mulumbi <br>
                    Sales Person: Admin Admin <br>
                </p>
                <div style="clear:both;"></div>
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Description</th>
                        <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">Quantity</th>
                        <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Price</th>
                        <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr><td>Banana Milkshake</td><td style="text-align:center;">2.00</td><td class="text-right">513.00</td><td class="text-right">1,026.00</td></tr><tr><td>scfvf</td><td style="text-align:center;">1.00</td><td class="text-right">4,343.00</td><td class="text-right">4,343.00</td></tr><tr><td>Water</td><td style="text-align:center;">1.00</td><td class="text-right">120.00</td><td class="text-right">120.00</td></tr>                                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th colspan="2" class="text-right">5,489.00</th>
                    </tr>
                    <tr><th colspan="2">Order Tax</th><th colspan="2" class="text-right">274.45</th></tr>                                            <tr>
                        <th colspan="2">Rounding</th>
                        <th colspan="2" class="text-right">0.00</th>
                    </tr>
                    <tr>
                        <th colspan="2">Grand Total</th>
                        <th colspan="2" class="text-right">5,763.45</th>
                    </tr>
                    </tfoot>
                </table>
                <table class="table table-striped table-condensed" style="margin-top:10px;"><tbody><tr><td class="text-right">Paid by :</td><td>Cash</td><td class="text-right">Amount :</td><td>5,800.00</td><td class="text-right">Change :</td><td>36.55</td></tr></tbody></table>
                <div class="well well-sm"  style="margin-top:10px;">
                    <div style="text-align: center;">This is receipt footer for store</div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>

        <!-- start -->
        <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
            <hr>
            <span class="pull-right col-xs-12">
                                <button onclick="window.print();" class="btn btn-block btn-primary">Print</button>                            </span>
            <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email">Email</a></span>
            <span class="col-xs-12">
                                <a class="btn btn-block btn-warning" href="http://127.0.0.1:3000/pos">Back to POS</a>
                            </span>
            <div style="clear:both;"></div>
        </div>
        <!-- end -->
    </div>
</div>
<!-- start -->
<script type="text/javascript">
    var base_url = 'http://127.0.0.1:3000/';
    var site_url = 'http://127.0.0.1:3000/';
    var dateformat = 'D j M Y', timeformat = 'h:i A';
    var Settings = {"logo":"logo1.png","site_name":"SimplePOS","tel":"0105292122","dateformat":"D j M Y","timeformat":"h:i A","language":"english","theme":"default","mmode":"0","captcha":"0","currency_prefix":"USD","default_customer":"3","default_tax_rate":"5%","rows_per_page":"10","total_rows":"30","header":"<h2><strong>Simple POS<\/strong><\/h2>\r\n       My Shop Lot, Shopping Mall,<br>\r\n                                                                                              Post Code, City<br>","footer":"Thank you for your business!\r\n<br>","bsty":"3","display_kb":"0","default_category":"1","default_discount":"0","item_addition":"1","barcode_symbology":"","pro_limit":"10","decimals":"2","thousands_sep":",","decimals_sep":".","focus_add_item":"ALT+F1","add_customer":"ALT+F2","toggle_category_slider":"ALT+F10","cancel_sale":"ALT+F5","suspend_sale":"ALT+F6","print_order":"ALT+F11","print_bill":"ALT+F12","finalize_sale":"ALT+F8","today_sale":"Ctrl+F1","open_hold_bills":"Ctrl+F2","close_register":"ALT+F7","java_applet":"0","receipt_printer":"","pos_printers":"","cash_drawer_codes":"","char_per_line":"42","rounding":"1","pin_code":"abdbeb4d8dbe30df8430a8394b7218ef","purchase_code":"37e087ac-2c9e-45a5-a955-6dab14559b06","envato_username":"tomulumbi","theme_style":"green","after_sale_page":null,"overselling":"1","multi_store":null,"qty_decimals":"2","symbol":null,"sac":"0","display_symbol":null,"remote_printing":"1","printer":"1","order_printers":null,"auto_print":"0","local_printers":null,"rtl":null,"print_img":null,"selected_language":"english"};
</script>
<script src="http://127.0.0.1:3000/themes/default/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="http://127.0.0.1:3000/themes/default/assets/dist/js/libraries.min.js" type="text/javascript"></script>
<script src="http://127.0.0.1:3000/themes/default/assets/dist/js/scripts.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#print').click(function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            $.get(link);
            return false;
        });
        $('#email').click(function () {
            bootbox.prompt({
                title: "Email Address",
                inputType: 'email',
                value: "tomulumbi@gmail.com",
                callback: function (email) {
                    if (email != null) {
                        $.ajax({
                            type: "post",
                            url: "http://127.0.0.1:3000/pos/email_receipt",
                            data: {spos_token: "5264f5c677ebeac904a771208cd15fd4", email: email, id: 1},
                            dataType: "json",
                            success: function (data) {
                                bootbox.alert({message: data.msg, size: 'small'});
                            },
                            error: function () {
                                bootbox.alert({message: 'Ajax request failed!', size: 'small'});
                                return false;
                            }
                        });
                    }
                }
            });
            return false;
        });
    });
</script>

<!-- end -->
</body>
</html>

