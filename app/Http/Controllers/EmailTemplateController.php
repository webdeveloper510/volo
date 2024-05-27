<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\EmailTemplateLang;
use App\Models\Languages;
use App\Models\UserEmailTemplate;
use App\Models\Utility;
use App\Models\Emailcontent;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{

    public function index()
    {
        $usr = \Auth::user();

        if($usr->type == 'super admin' || $usr->type == 'owner')
        {
            $EmailTemplates = EmailTemplate::all();

            return view('email_templates.index', compact('EmailTemplates'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->type == 'owner')
        {
            return view('email_templates.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        $usr = \Auth::user();

        if(\Auth::user()->type == 'owner')
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $EmailTemplate             = new EmailTemplate();
            $EmailTemplate->name       = $request->name;
            $EmailTemplate->slug       = strtolower(str_replace(' ', '_', $request->name));
            $EmailTemplate->from       = env('APP_NAME');
            $EmailTemplate->created_by = $usr->id;
            $EmailTemplate->save();

            return redirect()->route('email_template.index')->with('success', __('Email Template successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(EmailTemplate $emailTemplate)
    {
        //
    }


    public function edit(EmailTemplate $emailTemplate)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'from' => 'required',
                               'subject' => 'required',
                               'content' => 'required',
                           ]
        );

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $emailTemplate       = EmailTemplate::where('id',$id)->first();
        $emailTemplate->from = $request->from;
        $emailTemplate->save();

        $emailLangTemplate = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', '=', $request->lang)->first();

        // if record not found then create new record else update it.
        if(empty($emailLangTemplate))
        {
            $emailLangTemplate            = new EmailTemplateLang();
            $emailLangTemplate->parent_id = $id;
            $emailLangTemplate->lang      = $request['lang'];
            $emailLangTemplate->subject   = $request['subject'];
            $emailLangTemplate->content   = $request['content'];
            $emailLangTemplate->save();
        }
        else
        {
            $emailLangTemplate->subject = $request['subject'];
            $emailLangTemplate->content = $request['content'];
            $emailLangTemplate->save();
        }

        return redirect()->route(
            'manage.email.language', [
                                       $emailTemplate->id,
                                       $request->lang,
                                   ]
        )->with('success', __('Email Template successfully updated.'));
    }


    public function destroy(EmailTemplate $emailTemplate)
    {
        //
    }

    // Used For View Email Template Language Wise
    public function manageEmailLang($id, $lang = 'en')
    {
        // if(\Auth::user()->type == 'owner')
        // {
            $languages         = Utility::languages();
            $emailTemplate     = EmailTemplate::getemailtemplate();
            $currEmailTempLang = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', $lang)->first();
        // //     if(empty($currEmailTempLang))
        // //     {
        // //         return redirect()->back()->with('error', __('Not exists in email template.'));
        // //     }
        //     if(!isset($currEmailTempLang) || empty($currEmailTempLang))
        //     {
        //         $currEmailTempLang       = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', 'en')->first();
        //         $currEmailTempLang->lang = $lang;
        //     }

            if(\Auth::user()->type == 'owner')
			{
				$emailTemplate     = EmailTemplate::where('id', '=', $id)->first();
			}
			else {

				$settings         = Utility::settings();
				$emailTemplate     = $settings['owner_name'];
			}
            $EmailTemplates = EmailTemplate::all();
            return view('email_templates.show', compact('emailTemplate', 'languages', 'currEmailTempLang','EmailTemplates'));
        }
        // else
        // {
        //     return redirect()->back()->with('error', 'Permission denied.');
        // }
    // }

    // Used For Store Email Template Language Wise
    public function storeEmailLang(Request $request, $id)
    {
        if(\Auth::user()->type == 'owner')
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'subject' => 'required',
                                   'content' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $emailLangTemplate = EmailTemplateLang::where('parent_id', '=', $id)->where('lang', '=', $request->lang)->first();
            if(empty($emailLangTemplate))
            {
                $emailLangTemplate            = new EmailTemplateLang();
                $emailLangTemplate->parent_id = $id;
                $emailLangTemplate->lang      = $request['lang'];
                $emailLangTemplate->subject   = $request['subject'];
                $emailLangTemplate->content   = $request['content'];
                $emailLangTemplate->save();
            }
            else
            {
                $emailLangTemplate->subject = $request['subject'];
                $emailLangTemplate->content = $request['content'];
                $emailLangTemplate->save();
            }

            return redirect()->route(
                'manage.email.language', [
                                           $id,
                                           $request->lang,
                                       ]
            )->with('success', __('Email Template Detail successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    // Used For Update Status owner Wise.
    public function updateStatus(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        $usr = \Auth::user();

        if($usr->type == 'super admin' || $usr->type == 'owner')
        {
            UserEmailTemplate::where('user_id', $usr->id)->update([ 'is_active' => 0]);
            foreach ($post as $key => $value) {
                $UserEmailTemplate  = UserEmailTemplate::where('user_id', $usr->id)->where('template_id', $key)->first();
                $UserEmailTemplate->is_active = $value;
                $UserEmailTemplate->save();
            }
            return redirect()->back()->with('success', __('Status successfully updated!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }
    }
    public function email_templates(){
        if(\Auth::user()->type == 'owner')
        {
            $EmailTemplate = Emailcontent::all();
            return view('email_templates.template_index',compact('EmailTemplate'));
        }
    }
    public function email_template_create(){
        return view('email_templates.template');
    }
    public function storeEmailtemplate(Request $request){
        if(\Auth::user()->type == 'owner')
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'subject' => 'required',
                                   'content' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $emailTemplate            = new Emailcontent();
            $emailTemplate->subject   = $request['subject'];
            $emailTemplate->from   = $request['from'];
            $emailTemplate->content   = $request['content'];
            $emailTemplate->save();
            return redirect()->back()->with('success', __('Email Template successfully added.'));
        }
    }
    public function editEmailtemplate($id){
        $EmailTemplate = Emailcontent::where('id',$id)->first();
        return view('email_templates.edittemplate',compact('EmailTemplate'));
    }
    public function updateEmailtemplate(Request $request , $id){
        $validator = \Validator::make(
            $request->all(), [
                               'from' => 'required',
                               'subject' => 'required',
                               'content' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $emailTemplate       = Emailcontent::where('id',$id)->first();
        $emailTemplate->subject   = $request['subject'];
        $emailTemplate->from   = $request['from'];
        $emailTemplate->content   = $request['content'];
        $emailTemplate->save();
        return redirect()->back()->with('success', __('Email Template successfully updated!'));
    }
    public function deleteEmailtemplate($id){
        Emailcontent::find($id)->delete();
        return redirect()->back()->with('success', 'Email Template Deleted!');
    }
}
