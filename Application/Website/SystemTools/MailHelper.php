<?php
/**
 * User: andrei
 * Date: 1/24/14
 * Time: 11:47 PM
 */
namespace SystemTools;

class MailHelper {


    /**
     * @param $template [string] the view that we want to send
     * @param $data [array] array of data that we need in email
     * @param $subject [string] the
     * @param $to [string] the email address to which to send
     */
    public static function send($template, $data, $subject, $to)
    {

        \Mail::send($template, $data, function($message) use ($subject, $to)
        {

            $message->to($to)->subject($subject);

        });

    }//send

}//MailHelper