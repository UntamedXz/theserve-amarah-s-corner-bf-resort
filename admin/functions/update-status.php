<?php
session_start();
require_once '../../includes/database_conn.php';
require '../vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

$selected = $_POST['selected_status'];
$order_id = $_POST['order_id'];
$name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];

$update = mysqli_query($conn, "UPDATE orders SET order_status = $selected WHERE order_id = $order_id");

if ($selected == 1) {

    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "capstemp00@gmail.com",
                    'Name' => "Amarah's Pizza Corner",
                ],
                'To' => [
                    [
                        'Email' => "$email",
                        'Name' => "$name",
                    ],
                ],
                'Subject' => "Here is the status your order",
                'HTMLPart' => '<style type="text/css">#outlook a { padding:0; }
                body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
                table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
                img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
                p { display:block;margin:13px 0; }</style><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Poppins);
      @import url(https://fonts.googleapis.com/css?family=Poppins);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
              .mj-column-per-100 { width:100% !important; max-width: 100%; }
            }</style><style media="screen and (min-width:480px)">.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">[owa] .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">@media only screen and (max-width:480px) {
            table.mj-full-width-mobile { width: 100% !important; }
            td.mj-full-width-mobile { width: auto !important; }
          }</style></head><body style="word-spacing:normal;background-color:#F4F4F4;"><div style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">Here is your order update status</div><div style="background-color:#F4F4F4;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 0px 0px 0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mz3o.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><h1 class="text-build-content" data-testid="vk0Hx4d0-4Z" style="margin-top: 10px; margin-bottom: 10px; font-weight: normal;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:20px;"><b>Hi '. $name .'!</b></span></h1></div></td></tr><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="pY8Ws3OXOSt" style="margin: 10px 0; margin-top: 10px; margin-bottom: 10px;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:13px;">Here is the status of your order, as of now it is pending and awaiting the confirmation by one of our staffs. please sit back and relax as we take care of your order.</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:550px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mzgm.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="550"></td></tr></tbody></table></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px 10px 25px;padding-right:25px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tbody><tr><td align="center" bgcolor="#ded527" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#ded527;" valign="middle"><a href="http://localhost/theserve-amarah-s-corner-las-pinas/?tracking" style="display:inline-block;background:#ded527;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"><span style="color:#000000;font-size:14px;"><b>Track your order here!</b></span></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-top: 10px;">Here\'s your order ID: '. $order_id .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">Email address used: '. $email .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">&nbsp;</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-bottom: 10px;"><span style="color:#55575d;font-family:Arial;font-size:13px;">If you have any concerns,&nbsp;</span><br><br><span style="color:#55575d;font-family:Arial;font-size:13px;">you may contact us at "bfresortamarahscorner@gmail.com"</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">This e-mail has been sent to [[EMAIL_TO]], <a href="[[UNSUB_LINK_EN]]" style="color:inherit;text-decoration:none;" target="_blank">click here to unsubscribe</a>.</p></div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">   PH</p></div></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body>',
            ],
        ],
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "a42bfdf767ddb807f6aaf82282a24f7a:c58f5c7f72f66fdea695a4a6ceb4e219");
    $server_output = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NDk1Mjk4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDcxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.bWwiz3zNCvdWopCvhPaFe_RJKa2cvYJzu5HuxHE4Pps');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => 'Hi ' . $name . '!

Here is the status of your order, as of now it is pending and awaiting the confirmation by one of our staffs. please sit back and relax as we take care of your order.

Track Your Order Here -> http://localhost/theserve-amarah-s-corner-las-pinas/?tracking
Your Order ID: '. $order_id .'
Your Email Address: '. $email .'

- Amarah\'s Corner - BF Resort!

If you have any concerns, you may contact us at "bfresortamarahscorner@gmail.com"',
            'deviceId' => 128642
        ]);
        
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        if($sendMessageRequest1) {
            $_SESSION['update'] = 'success';
            echo 'success';
        }
    }
} else if($selected == 2) {
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "capstemp00@gmail.com",
                'Name' => "Amarah's Pizza Corner"
            ],
            'To' => [
                [
                    'Email' => "$email",
                    'Name' => "$name"
                ]
            ],
            'Subject' => "HERE IS THE STATUS OF YOUR ORDER",
            'HTMLPart' => '<style type="text/css">#outlook a { padding:0; }
            body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
            table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
            img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
            p { display:block;margin:13px 0; }</style><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Poppins);
  @import url(https://fonts.googleapis.com/css?family=Poppins);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
          .mj-column-per-100 { width:100% !important; max-width: 100%; }
        }</style><style media="screen and (min-width:480px)">.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">[owa] .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">@media only screen and (max-width:480px) {
        table.mj-full-width-mobile { width: 100% !important; }
        td.mj-full-width-mobile { width: auto !important; }
      }</style></head><body style="word-spacing:normal;background-color:#F4F4F4;"><div style="background-color:#F4F4F4;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 0px 0px 0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mz3o.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><h1 class="text-build-content" data-testid="vk0Hx4d0-4Z" style="margin-top: 10px; margin-bottom: 10px; font-weight: normal;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:20px;"><b>Hi '. $name .'!</b></span></h1></div></td></tr><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="pY8Ws3OXOSt" style="margin: 10px 0; margin-top: 10px; margin-bottom: 10px;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:13px;">Here is the status of your order, as of now your order is already confirmed and now being managed by the staffs. please sit back and relax as we take care of your order.</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:550px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0q7/mzhq.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="550"></td></tr></tbody></table></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px 10px 25px;padding-right:25px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tbody><tr><td align="center" bgcolor="#ded527" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#ded527;" valign="middle"><a href="http://localhost/theserve-amarah-s-corner-las-pinas/?tracking" style="display:inline-block;background:#ded527;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"><span style="color:#000000;font-size:14px;"><b>Track your order here!</b></span></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-top: 10px;">Here\'s your order ID: '. $order_id .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">Email address used: '. $email .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">&nbsp;</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-bottom: 10px;"><span style="color:#55575d;font-family:Arial;font-size:13px;">If you have any concerns,&nbsp;</span><br><span style="color:#55575d;font-family:Arial;font-size:13px;">you may contact us at "bfresortamarahscorner@gmail.com"</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">This e-mail has been sent to [[EMAIL_TO]], <a href="[[UNSUB_LINK_EN]]" style="color:inherit;text-decoration:none;" target="_blank">click here to unsubscribe</a>.</p></div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">   PH</p></div></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body>'
            ]
        ]
    ];
      
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "a42bfdf767ddb807f6aaf82282a24f7a:c58f5c7f72f66fdea695a4a6ceb4e219");
    $server_output = curl_exec($ch);
    curl_close ($ch);
      
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NDk1Mjk4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDcxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.bWwiz3zNCvdWopCvhPaFe_RJKa2cvYJzu5HuxHE4Pps');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => 'Hi ' . $name . '!

Here is the status of your order, as of now your order is already confirmed and now being managed by the staffs. please sit back and relax as we take care of your order.

Track Your Order Here -> http://localhost/theserve-amarah-s-corner-las-pinas/?tracking
Your Order ID: '. $order_id .'
Your Email Address: '. $email .'

- Amarah\'s Corner - BF Resort!

If you have any concerns, you may contact us at "bfresortamarahscorner@gmail.com"',
            'deviceId' => 128642
        ]);
        
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        if($sendMessageRequest1) {
            $_SESSION['update'] = 'success';
            echo 'success';
        }
    }
} else if($selected == 3) {
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "capstemp00@gmail.com",
                'Name' => "Amarah's Pizza Corner"
            ],
            'To' => [
                [
                    'Email' => "$email",
                    'Name' => "$name"
                ]
            ],
            'Subject' => "HERE IS THE STATUS OF YOUR ORDER",
            'HTMLPart' => '<style type="text/css">#outlook a { padding:0; }
            body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
            table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
            img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
            p { display:block;margin:13px 0; }</style><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Poppins);
  @import url(https://fonts.googleapis.com/css?family=Poppins);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
          .mj-column-per-100 { width:100% !important; max-width: 100%; }
        }</style><style media="screen and (min-width:480px)">.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">[owa] .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">@media only screen and (max-width:480px) {
        table.mj-full-width-mobile { width: 100% !important; }
        td.mj-full-width-mobile { width: auto !important; }
      }</style></head><body style="word-spacing:normal;background-color:#F4F4F4;"><div style="background-color:#F4F4F4;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 0px 0px 0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mz3o.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><h1 class="text-build-content" data-testid="vk0Hx4d0-4Z" style="margin-top: 10px; margin-bottom: 10px; font-weight: normal;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:20px;"><b>Hi '. $name .'!</b></span></h1></div></td></tr><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="pY8Ws3OXOSt" style="margin: 10px 0; margin-top: 10px; margin-bottom: 10px;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:13px;">Here is the status of your order, as of now your order is being prepared by our staffs and it should be handed to the delivery rider soon.</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:550px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0ro/mzh7.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="550"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px 10px 25px;padding-right:25px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tbody><tr><td align="center" bgcolor="#ded527" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#ded527;" valign="middle"><a href="http://localhost/theserve-amarah-s-corner-las-pinas/?tracking" style="display:inline-block;background:#ded527;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"><span style="color:#090909;font-size:14px;"><b>Track your order here!</b></span></a></td></tr></tbody></table></td></tr><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-top: 10px;">Here\'s your order ID: '. $order_id .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">Email address used: '. $email .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">&nbsp;</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-bottom: 10px;"><span style="color:#55575d;font-family:Arial;font-size:13px;">If you have any concerns,&nbsp;</span><br><br><span style="color:#55575d;font-family:Arial;font-size:13px;">you may contact us at "bfresortamarahscorner@gmail.com"</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">This e-mail has been sent to [[EMAIL_TO]], <a href="[[UNSUB_LINK_EN]]" style="color:inherit;text-decoration:none;" target="_blank">click here to unsubscribe</a>.</p></div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">   PH</p></div></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body>'
            ]
        ]
    ];
      
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "a42bfdf767ddb807f6aaf82282a24f7a:c58f5c7f72f66fdea695a4a6ceb4e219");
    $server_output = curl_exec($ch);
    curl_close ($ch);
      
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NDk1Mjk4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDcxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.bWwiz3zNCvdWopCvhPaFe_RJKa2cvYJzu5HuxHE4Pps');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => 'Hi ' . $name . '!

Here is the status of your order, as of now your order is being prepared by our staffs and it should be handed to the delivery rider soon.

Track Your Order Here -> http://localhost/theserve-amarah-s-corner-las-pinas/?tracking
Your Order ID: '. $order_id .'
Your Email Address: '. $email .'


- Amarah\'s Corner - BF Resort!

If you have any concerns, you may contact us at "bfresortamarahscorner@gmail.com"',
            'deviceId' => 128642
        ]);
        
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        if($sendMessageRequest1) {
            $_SESSION['update'] = 'success';
            echo 'success';
        }
    }
} else if($selected == 4) {
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "capstemp00@gmail.com",
                'Name' => "Amarah's Pizza Corner"
            ],
            'To' => [
                [
                    'Email' => "$email",
                    'Name' => "$name"
                ]
            ],
            'Subject' => "HERE IS THE STATUS OF YOUR ORDER",
            'HTMLPart' => '<style type="text/css">#outlook a { padding:0; }
            body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
            table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
            img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
            p { display:block;margin:13px 0; }</style><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Poppins);
  @import url(https://fonts.googleapis.com/css?family=Poppins);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
          .mj-column-per-100 { width:100% !important; max-width: 100%; }
        }</style><style media="screen and (min-width:480px)">.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">[owa] .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">@media only screen and (max-width:480px) {
        table.mj-full-width-mobile { width: 100% !important; }
        td.mj-full-width-mobile { width: auto !important; }
      }</style></head><body style="word-spacing:normal;background-color:#F4F4F4;"><div style="background-color:#F4F4F4;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 0px 0px 0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mz3o.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><h1 class="text-build-content" data-testid="vk0Hx4d0-4Z" style="margin-top: 10px; margin-bottom: 10px; font-weight: normal;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:20px;"><b>Hi '. $name .'!</b></span></h1></div></td></tr><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="pY8Ws3OXOSt" style="margin: 10px 0; margin-top: 10px; margin-bottom: 10px;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:13px;">Here is the status of your order, as of now your order is on its way to your designated location and we made sure that your orders are complete and ready to go.</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:550px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0rt/mzjw.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="550"></td></tr></tbody></table></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px 10px 25px;padding-right:25px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tbody><tr><td align="center" bgcolor="#ded527" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#ded527;" valign="middle"><a href="http://localhost/theserve-amarah-s-corner-las-pinas/?tracking" style="display:inline-block;background:#ded527;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"><span style="color:#151414;font-size:14px;"><b>Track your order here</b></span></a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-top: 10px;">Here\'s your order ID: '. $order_id .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">Email address used: '. $email .'</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">&nbsp;</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-bottom: 10px;"><span style="color:#55575d;font-family:Arial;font-size:13px;">If you have any concerns,&nbsp;</span><br><br><span style="color:#55575d;font-family:Arial;font-size:13px;">you may contact us at "bfresortamarahscorner@gmail.com"</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">This e-mail has been sent to [[EMAIL_TO]], <a href="[[UNSUB_LINK_EN]]" style="color:inherit;text-decoration:none;" target="_blank">click here to unsubscribe</a>.</p></div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">   PH</p></div></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body>'
            ]
        ]
    ];
      
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "a42bfdf767ddb807f6aaf82282a24f7a:c58f5c7f72f66fdea695a4a6ceb4e219");
    $server_output = curl_exec($ch);
    curl_close ($ch);
      
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NDk1Mjk4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDcxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.bWwiz3zNCvdWopCvhPaFe_RJKa2cvYJzu5HuxHE4Pps');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => 'Hi ' . $name . '!

Here is the status of your order, as of now your order is on its way to your designated location and we made sure that your orders are complete and ready to go.

Track Your Order Here -> http://localhost/theserve-amarah-s-corner-las-pinas/?tracking
Your Order ID: '. $order_id .'
Your Email Address: '. $email .'

- Amarah\'s Corner - BF Resort!

If you have any concerns, you may contact us at "bfresortamarahscorner@gmail.com"',
            'deviceId' => 128642
        ]);
        
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        if($sendMessageRequest1) {
            $_SESSION['update'] = 'success';
            echo 'success';
        }
    }
} else if($selected == 5) {
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "capstemp00@gmail.com",
                'Name' => "Amarah's Pizza Corner"
            ],
            'To' => [
                [
                    'Email' => "$email",
                    'Name' => "$name"
                ]
            ],
            'Subject' => "HERE IS THE STATUS OF YOUR ORDER",
            'HTMLPart' => '<style type="text/css">#outlook a { padding:0; }
            body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
            table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
            img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
            p { display:block;margin:13px 0; }</style><link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500,700);
  @import url(https://fonts.googleapis.com/css?family=Poppins);
  @import url(https://fonts.googleapis.com/css?family=Poppins);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
          .mj-column-per-100 { width:100% !important; max-width: 100%; }
        }</style><style media="screen and (min-width:480px)">.moz-text-html .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">[owa] .mj-column-per-100 { width:100% !important; max-width: 100%; }</style><style type="text/css">@media only screen and (max-width:480px) {
        table.mj-full-width-mobile { width: 100% !important; }
        td.mj-full-width-mobile { width: auto !important; }
      }</style></head><body style="word-spacing:normal;background-color:#F4F4F4;"><div style="background-color:#F4F4F4;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 0px 0px 0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y0lu/mz3o.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><h1 class="text-build-content" data-testid="vk0Hx4d0-4Z" style="margin-top: 10px; margin-bottom: 10px; font-weight: normal;"><span style="color:#55575d;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:20px;"><b>Hi '. $name .'!</b></span></h1></div></td></tr><tr><td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="pY8Ws3OXOSt" style="margin: 10px 0; margin-top: 10px; margin-bottom: 10px;">Thank you very much for ordering at Amarah\'s Pizza Corner! We hope you\'d enjoy your order as we\'ve prepared with love and care. stay safe and we hope you\'d order with us again soon!</p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;padding-top:0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:550px;"><img alt="" height="auto" src="https://0owzv.mjt.lu/tplimg/0owzv/b/1y07i/mzj0.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="550"></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tbody><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px; margin-bottom: 10px;" data-testid="jpDALif4c"><span style="color:#55575d;font-family:Arial, Helvetica, sans-serif;font-size:13px;">Please spare us some of your valuable time to rate our service.</span><br><span style="color:#55575d;font-family:Arial, Helvetica, sans-serif;font-size:13px;">Your feedback means a lot to us!</span></p></div></td></tr><tr><td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px 10px 25px;padding-right:25px;padding-left:25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><tbody><tr><td align="center" bgcolor="#ded527" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#ded527;" valign="middle"><a href="http://localhost/theserve-amarah-s-corner-las-pinas/?tracking" style="display:inline-block;background:#ded527;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"><span style="color:#000000;font-size:14px;"><b>Submit your feedback here!</b></span></a></td></tr></tbody></table></td></tr><tr><td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;"><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-top: 10px;"><span style="font-family:Roboto, Helvetica, Arial, sans-serif;">Here\'s your order ID: '. $order_id .'</span></p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;"><span style="font-family:Roboto, Helvetica, Arial, sans-serif;">Email address used: '. $email .'</span></p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0;">&nbsp;</p><p class="text-build-content" data-testid="i_I7yQQAQUQM" style="margin: 10px 0; margin-bottom: 10px;"><span style="color:#55575d;font-family:Roboto, Helvetica, Arial, sans-serif;font-size:13px;">If you have any concerns,&nbsp;</span><br><span style="color:#55575d;font-family:Roboto, Helvetica, Arial, sans-serif;font-size:13px;">you may contact us at "bfresortamarahscorner@gmail.com"</span></p></div></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0px 20px 0px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">This e-mail has been sent to [[EMAIL_TO]], <a href="[[UNSUB_LINK_EN]]" style="color:inherit;text-decoration:none;" target="_blank">click here to unsubscribe</a>.</p></div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;letter-spacing:normal;line-height:22px;text-align:center;color:#000000;"><p style="margin: 10px 0;">   PH</p></div></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body>'
            ]
        ]
    ];
      
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "a42bfdf767ddb807f6aaf82282a24f7a:c58f5c7f72f66fdea695a4a6ceb4e219");
    $server_output = curl_exec($ch);
    curl_close ($ch);
      
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NDk1Mjk4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1MDcxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.bWwiz3zNCvdWopCvhPaFe_RJKa2cvYJzu5HuxHE4Pps');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => 'Hi ' . $name . '!

Thank you very much for ordering at Amarah\'s Corner - BF Resort! We hope you\'d enjoy your order as weve prepared with love and care. stay safe and we hope you\'d order with us again soon!

Track Your Order Here -> http://localhost/theserve-amarah-s-corner-las-pinas/?tracking
Your Order ID: '. $order_id .'
Your Email Address: '. $email .'

- Amarah\'s Corner - BF Resort!

If you have any concerns, you may contact us at "bfresortamarahscorner@gmail.com"',
            'deviceId' => 128642
        ]);
        
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        if($sendMessageRequest1) {
            $_SESSION['update'] = 'success';
            echo 'success';
        }
    }
}