<?php

use Config\Services;
use CodeIgniter\Email\Email;

if (!function_exists('sendMail')) {
    function sendMail($id, $object, $path, $dest, $cc, $message, $redirectError, $redirectSent)
    {
        $session = Services::session();
        $settings = new \App\Models\SettingModel();
        $settings = $settings->where('id_vcompanies', $_SESSION['current_company'])->first();

        $from = $settings ? $settings->email : 'default@example.com';
        $obj = explode(' ', $object);
        $object = $obj[0] . ' ' . $obj[1];

        // Configure email
        $email = new Email();
        $config = [
            'protocol'    => 'smtp',
            'SMTPHost'    => getenv('SMTP_HOST'),
            'SMTPUser'    => getenv('SMTP_USER'),
            'SMTPPass'    => getenv('SMTP_PASS'),
            'SMTPPort'    => getenv('SMTP_PORT'),
            'SMTPCrypto'  => getenv('SMTP_CRYPTO'),
            'mailType'    => 'html',
            'charset'     => 'utf-8',
            'wordWrap'    => true,
        ];
        
        $email->initialize($config);
        $email->setFrom($from, $object);
        $email->setTo($dest);
        $email->setCC($cc);
        $email->setSubject($object . ' comme demandé');
        $email->setMessage($message);

        // Attach file if provided
        if ($path) {
            $email->attach($path);
        }

        if (!$email->send()) {
            $session->setFlashdata('message', 'error:' . lang('Email not sent. Check your email settings'));
            return redirect()->to($redirectError);
        } else {
            $session->setFlashdata('message', 'success:' . lang('Test email has been sent. Check your inbox'));
            return redirect()->to($redirectSent);
        }
    }
}

if (!function_exists('forgetPwdMail')) {
    function forgetPwdMail($id, $dest)
    {
        $session = Services::session();
        $email = new Email();

        $config = [
            'protocol'    => 'smtp',
            'SMTPHost'    => getenv('SMTP_HOST'),
            'SMTPUser'    => getenv('SMTP_USER'),
            'SMTPPass'    => getenv('SMTP_PASS'),
            'SMTPPort'    => getenv('SMTP_PORT'),
            'SMTPCrypto'  => getenv('SMTP_CRYPTO'),
            'mailType'    => 'html',
            'charset'     => 'utf-8',
            'wordWrap'    => true,
        ];

        $email->initialize($config);
        $email->setFrom('erpvisionmail@gmail.com', 'ERP Vision'); // Add a name if needed
        $email->setTo($dest);
        $email->setSubject('Réinitialiser votre mot de passe');

        $data = ['id' => $id];
        $email->setMessage(view('blueline/email/email_forgot', $data));

        if (!$email->send()) {
            $session->setFlashdata('message', 'error:' . lang('Email not sent. Check your email settings'));
            return redirect()->to('login');
        } else {
            $session->setFlashdata('message', 'success:' . lang('Email has been sent. Check your inbox'));
            return redirect()->to('login');
        }
    }
}
