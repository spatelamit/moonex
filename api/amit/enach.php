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
                        'deviceId': 'WEBSH2',	//possible values 'WEBSH1' or 'WEBSH2'
                        'token': '50c7f022ee944cd9e059db1ab19915a7f34404ebd0c9575922bda4d91f557c7ec439ef1e05af88ba230cc914f02690223454076394accaf7a0287911aef1817d',
                        'returnUrl': 'https://www.tekprocess.co.in/MerchantIntegrationClient/MerchantResponsePage.jsp',    //merchant response page URL
                        'responseHandler': handleResponse,
                        'paymentMode': 'all',
                        'merchantLogoUrl': 'https://www.paynimo.com/CompanyDocs/company-logo-vertical-light.png',  //provided merchant logo will be displayed
                        'merchantId': 'L3348',
                        'currency': 'INR',
                        'consumerId': 'c964634',
                        'consumerMobileNo': '9876543210',
                        'consumerEmailId': 'test@test.com',
                        'txnId': '1661145401828',   //Unique merchant transaction ID
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