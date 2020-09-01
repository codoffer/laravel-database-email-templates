<?php

namespace Codoffer\EmailTemplates;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Codoffer\EmailTemplates\Models\EmailTemplate;

class BuildTemplate extends Mailable
{
    use Queueable, SerializesModels;

    private $email_html_body = '';
    private $email_subject = '';
    private $cc_recepients = '';
    private $bcc_recepients = '';

    public function __construct($email_key = '', $email_replacement_values = [])
    {
        $this->init_config($email_key, $email_replacement_values);
    }

    public function build()
    {
        $email_from = config('email_template.email_from');
        $email_from_name = config('email_template.email_from_name');

        if ($email_from !== '' && $email_from_name !== '') {
            $this->from($email_from, $email_from_name);
        }

        if ($this->cc_recepients != '') {
            $cc = explode(",", $this->cc_recepients);
            $cc = array_map('trim', $cc);
            if (is_array($cc) && count($cc)) {
                $this->cc($cc);
            }
        }

        if ($this->bcc_recepients != '') {
            $bcc = explode(",", $this->bcc_recepients);
            $bcc = array_map('trim', $bcc);
            if (is_array($bcc) && count($bcc)) {
                $this->bcc($bcc);
            }
        }

        return $this->subject($this->email_subject)
            ->view('emails.codoemails')
            ->with(['html' => $this->email_html_body])
            ->priority(3);
    }

    private function init_config($email_key, $replacement_values)
    {

        $find_values = $replace_values = [];

        if ($email_key != '' && count($replacement_values)) {
            $replace_values = array_values($replacement_values);

            foreach (array_keys($replacement_values) as $key) {
                $find_values[] = '{' . $key . '}';
            }
        }

        $email_template = EmailTemplate::where('key', $email_key)->first();

        $this->email_subject = str_replace($find_values, $replace_values, $email_template->subject);
        $this->email_html_body = str_replace($find_values, $replace_values, $email_template->body);
    }
}
