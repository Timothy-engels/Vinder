<?php

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
            
            // Generate the message
            $htmlMsg = "
                <html>
                <head>
                    <title>" . $title . "</title>
                </head>
                <body>" . $msg . "</body>
                </html>
                ";

        } else {
            
            $htmlMsg = $msg;
            
        }
        
        // Set headers to send HTML mail
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        
        // Send the email
        mail($email, $title, $htmlMsg, implode("\r\n", $headers));
    }
}
