<?php

namespace App\Controllers;

/**
 * Legacy: feedback.php + action.php (OTP by SMTP then mhc_feedback insert).
 * Mail transport is configured in app/Config/Email.php instead of the hard
 * coded PHPMailer credentials previously embedded in action.php.
 */
class Feedback extends BaseController
{
    public function index()
    {
        return view('layouts/main', $this->data)
            . view('cms/feedback', $this->data)
            . view('layouts/footer', $this->data);
    }

    /** Generate + mail an OTP, store it against the address (legacy sendMailOTP). */
    public function sendOtp()
    {
        if (! $this->validate(['email_id' => 'required|valid_email|max_length[100]'])) {
            return $this->response->setJSON(['status' => 'error', 'msg' => 'Invalid e-mail address']);
        }

        $email = (string) $this->request->getPost('email_id');
        $otp   = (string) random_int(100000, 999999);

        model('FeedbackLog')->insert([
            'mail_id'   => $email,
            'mail_otp'  => password_hash($otp, PASSWORD_DEFAULT),
            'created_on'=> date('Y-m-d H:i:s'),
        ]);

        $mailer = service('email');
        $mailer->setTo($email);
        $mailer->setSubject('OTP for MHC Website Feedback');
        $mailer->setMessage('<p>Dear Sir/Madam,</p><p>Your OTP for feedback in highcourt website is: <b>' . $otp . '</b>.</p>');

        if ($mailer->send()) {
            return $this->response->setJSON(['status' => 'ok']);
        }

        log_message('error', 'Feedback OTP mail failed: ' . $mailer->printDebugger());
        return $this->response->setJSON(['status' => 'error', 'msg' => 'Could not send OTP']);
    }

    public function submit()
    {
        if (! $this->validate([
            'otp'      => 'required|integer',
            'email_id' => 'required|valid_email',
            'comments' => 'required|max_length[2000]',
        ])) {
            return redirect()->to('/feedback')->with('error', 'Please complete all fields.');
        }

        $row = db_connect('default')->table('mhc_feedback')
            ->where('mail_id', (string) $this->request->getPost('email_id'))
            ->orderBy('id', 'DESC')
            ->limit(1)->get()->getRowArray();

        if (! $row || ! password_verify((string) $this->request->getPost('otp'), (string) $row['mail_otp'])) {
            return redirect()->to('/feedback')->with('error', 'Invalid OTP.');
        }

        db_connect('default')->table('mhc_feedback')->insert([
            'mail_id'  => (string) $this->request->getPost('email_id'),
            'comments' => (string) $this->request->getPost('comments'),
            'name'     => (string) $this->request->getPost('name'),
            'mobile'   => (string) $this->request->getPost('mobile'),
            'post_date'=> date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/feedback')->with('success', 'Thank you for your feedback.');
    }
}
