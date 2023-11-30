<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\EmailTemplate;
use App\Models\GeneralSetting;
use App\Models\Template;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function emailConfig()
    {
        $data['title'] = 'Email Configuration';

        return view('backend.email.config')->with($data);
    }

    public function emailConfigUpdate(Request $request)
    {

        $general = Configuration::first();

        $data = $request->validate([
            'email_sent_from' => 'required|email',
            'email_config' => "required_if:email_method,==,smtp",
            'email_config.*' => 'required_if:email_method,==,smtp'
        ]);


        if($request->smtp == 'on'){
            $data = [
                'MAIL_DRIVER' => 'smtp',
                'MAIL_HOST' => $request->email_config['smtp_host'],
                'MAIL_PORT' => $request->email_config['smtp_port'],
                'MAIL_USERNAME' => $request->email_config['smtp_username'],
                'MAIL_PASSWORD' => $request->email_config['smtp_password'],
                'MAIL_ENCRYPTION' => $request->email_config['smtp_encryption'],
                'MAIL_FROM_ADDRESS' =>  $request->email_sent_from
            ];
        }else{
            $data = [
                'MAIL_DRIVER' => 'mail',
                'MAIL_HOST' =>'',
                'MAIL_PORT' =>'',
                'MAIL_USERNAME' =>'',
                'MAIL_PASSWORD' =>'',
                'MAIL_ENCRYPTION' =>'',
                'MAIL_FROM_ADDRESS' =>  $request->email_sent_from
            ];
        }


        $general->email_method = $request->smtp === 'on' ? 'smtp' : 'php';
        $general->email_sent_from = $request->email_sent_from;
       if($request->smtp === 'on'){
            $general->email_config = $data;
        }


        $general->save();


        Helper::setEnv($data);

        return redirect()->back()->with('success', "Email Setting Updated Successfully");
    }

    public function emailTemplates()
    {
        $data['title'] = 'Email Templates';

        $data['emailTemplates'] = Template::latest()->paginate(Helper::pagination());

        return view('backend.email.templates')->with($data);
    }

    public function emailTemplatesEdit(Template $template)
    {
        $title = 'Template Edit';

        return view('backend.email.edit', compact('title', 'template'));
    }

    public function emailTemplatesUpdate(Request $request, Template $template)
    {
        $data = $request->validate([
            'subject' => 'required',
            'template' => 'required'
        ]);

        $data['status'] = $request->status === 'on' ? true : false;

        $template->update($data);

        return redirect()->back()->with('success', "Email Template Updated Successfully");
    }
}
