<?php
require_once("business/accountService.php");

/**
 * Mail Service
 * 
 * Holds mailing functions
 */
class MailService
{
    /**
     * Send an html email
     * 
     * @param string $email
     * @param string $title
     * @param string $msg
     * 
     * @return void
     */
    public function sendHtmlMail($email, $title, $msg, $addHtmlTags = true)
    {
        if ($addHtmlTags) {
            
            $accountSvc  = new AccountService();
            $currentPath = $accountSvc->getCurrentPath();
            
            // Generate the message
            $htmlMsg = "
                <html>
                <head>
                    <title>" . $title . "</title>
                    <style>
                        *, ::after, ::before {
                            box-sizing: border-box;
                        }

                        body {
                            display: block;
                            background-color: #F6F6F6;
                            font-size: 14px;
                            margin: 0;
                            font-weight: 400;
                            line-height: 1.5;
                            color: #212529;
                            text-align: left;
                            font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
                        }

                        .section {
                            position: relative;
                            z-index: 1;
                        }

                        .container {
                            width: 90%;
                            padding-right: 15px;
                            padding-left: 15px;
                            margin-right: auto;
                            margin-left: auto;
                        }

                        .mt-3 {
                            margin-top: 1rem!important;
                        }

                        .row {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -ms-flex-wrap: wrap;
                            flex-wrap: wrap;
                            margin-right: -15px;
                            margin-left: -15px;
                        }

                        .col-12 {
                            -webkit-box-flex: 0;
                            -ms-flex: 0 0 100%;
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        .login-brand {
                            margin: 20px 0;
                            margin-bottom: 40px;
                            font-size: 24px;
                            text-transform: uppercase;
                            letter-spacing: 4px;
                            color: #666;
                            text-align: center;
                        }

                        .card {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: vertical;
                            -webkit-box-direction: normal;
                            -ms-flex-direction: column;
                            flex-direction: column;
                            min-width: 0;
                            word-wrap: break-word;
                            background-clip: border-box;
                            -webkit-box-shadow: 0 0 40px rgba(0,0,0,.05);
                            box-shadow: 0 0 40px rgba(0,0,0,.05);
                            background-color: #fff;
                            border-radius: 3px;
                            border: none;
                            position: relative;
                            margin-bottom: 30px;
                        }

                        .card.card-primary {
                            border-top: 2px solid #0466A3;
                        }

                        .card-header {
                            padding: .75rem 1.25rem;
                            margin-bottom: 0;
                            background-color: rgba(0,0,0,.03);
                            border-bottom: 1px solid rgba(0,0,0,.125);
                        }

                        .card-header:first-child {
                            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
                        }

                        .card .card-header, .card .card-footer, .card .card-body {
                            background-color: transparent;
                        }

                        .card .card-header {
                            border-bottom-color: #f9f9f9;
                            line-height: 30px;
                            -ms-flex-item-align: center;
                            -ms-grid-row-align: center;
                            align-self: center;
                            width: 100%;
                        }

                        .card-body {
                            -webkit-box-flex: 1;
                            -ms-flex: 1 1 auto;
                            flex: 1 1 auto;
                            padding: 1.25rem;
                        }

                        .card .card-header, .card .card-footer, .card .card-body {
                            background-color: transparent;
                        }

                        .card .card-body {
                            padding-top: 20px;
                            padding-bottom: 20px;
                        }

                        p {
                            margin-top: 0;
                            margin-bottom: 1rem;
                        }

                        a:-webkit-any-link {
                            cursor: pointer;
                        }

                        a {
                            text-decoration: none;
                            background-color: transparent;
                            font-weight: 500;
                            color: #0466A3;
                        }

                        .simple-footer {
                            text-align: center;
                            margin-top: 40px;
                            margin-bottom: 40px;
                            color: #666;
                        }

                        h4 {
                            display: block;
                            margin-block-start: 1.33em;
                            margin-block-end: 1.33em;
                            margin-inline-start: 0px;
                            margin-inline-end: 0px;
                        }

                        .card .card-header h4 {
                            font-size: 10px;
                            font-weight: 700;
                            letter-spacing: 1px;
                            text-transform: uppercase;
                            margin: 2px 0 -2px 0;
                            line-height: 30px;
                        }
                    </style>                        
                </head>
                <body>
                    <section class='section'>
                        <div class='container mt-3'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='login-brand'><a href='" . $currentPath . "logIn.php'><img src='" . $currentPath . "images/logo.png' alt='Vinder' style='width: 8rem;'></a></div>

                                    <div class='card card-primary'>
                                        <div class='card-header'><h4>" . $title . "</h4></div>

                                        <div class='card-body'>" . $msg . "</div>
                                    </div>

                                    <div class='simple-footer'>
                                        Copyright &copy; VDAB 2018
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </body>
                </html>";

        } else {
            
            $htmlMsg = $msg;
            
        }
        
        var_dump($htmlMsg);
        die();
        
        // Set headers to send HTML mail
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        
        // Send the email
        mail($email, $title, $htmlMsg, implode("\r\n", $headers));
    }
}
