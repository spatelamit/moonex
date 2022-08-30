<?php 
	if(isset($_REQUEST)){
		print_r($_REQUEST);
	}
?>
<!doctype html>
<html>

<head>
    <title>Checkout Demo</title>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1" />
    <script src="https://www.paynimo.com/paynimocheckout/client/lib/jquery.min.js" type="text/javascript"></script>
</head>

<body>

    <button id="btnSubmit">Make a Payment</button>

    <script type="text/javascript" src="https://www.paynimo.com/paynimocheckout/server/lib/checkout.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            function handleResponse(res) {
                if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0300') {
                    // success block
                } else if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0398') {
                    // initiated block
                } else {
                    // error block
                }
            };

            $(document).off('click', '#btnSubmit').on('click', '#btnSubmit', function(e) {
                e.preventDefault();

                var configJson = {
                    'tarCall': false,
                    'features': {
                        'showPGResponseMsg': true,
                        'enableAbortResponse': true,
                        'enableExpressPay': true,
                        'enableNewWindowFlow': true    //for hybrid applications please disable this by passing false
                    },
                    'consumerData': {
                        'deviceId': 'WEBSH2',   //possible values 'WEBSH1' or 'WEBSH2'
                        'token': '6d157cc1a1cfad39b4f5f124af87d4a263e094837af996a763c4a23fd318f876a0d7e521cabea4e6edc68902b4966ebb75a99371ac38f230e012a73934177902',
                        'returnUrl': 'https://amit.theofficearea.in/eresp.php',    //merchant response page URL
                        'responseHandler': handleResponse,
                        'paymentMode': 'all',
                        'merchantLogoUrl': 'https://www.paynimo.com/CompanyDocs/company-logo-vertical-light.png',  //provided merchant logo will be displayed
                        'merchantId': 'L3348',
                        'currency': 'INR',
                        'consumerId': 'c964634',
                        'consumerMobileNo': '9876543210',
                        'consumerEmailId': 'test@test.com',
                        'txnId': '1661347986120',   //Unique merchant transaction ID
                        'items': [{
                            'itemId': 'test',
                            'amount': '10',
                            'comAmt': '0'
                        }],
                        'customStyle': {
                            'PRIMARY_COLOR_CODE': '#45beaa',   //merchant primary color code
                            'SECONDARY_COLOR_CODE': '#FFFFFF',   //provide merchant's suitable color code
                            'BUTTON_COLOR_CODE_1': '#2d8c8c',   //merchant's button background color code
                            'BUTTON_COLOR_CODE_2': '#FFFFFF'   //provide merchant's suitable color code for button text
                        }
                    }
                };

                $.pnCheckout(configJson);
                if(configJson.features.enableNewWindowFlow){
                    pnCheckoutShared.openNewWindow();
                }
            });
        });
    </script>
</body>

</html>


<?php 
// Merchant Response Page
// msg=0392|User Aborted|Transaction aborted by user|1661347986120|2010|1883869764|10.00|{email:test@test.com}{mob:9876543210}|30-08-2022 12:25:22|NA||9486134402@upi||||020680e666a2f5c8812ddd06d512902d8d146e415fb34bceaf52b1c35c434de87f66c936d59379350385ae8c7a76c3770f4a919a1b500c0d817f2ea2104a06c2&


// Parameter Name 	Parameter Value
// msg 	0392|User Aborted|Transaction aborted by user|1661347986120|2010|1883869764|10.00|{email:test@test.com}{mob:9876543210}|30-08-2022 12:25:22|NA||9486134402@upi||||020680e666a2f5c8812ddd06d512902d8d146e415fb34bceaf52b1c35c434de87f66c936d59379350385ae8c7a76c3770f4a919a1b500c0d817f2ea2104a06c2



?>