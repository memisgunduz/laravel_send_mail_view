<?php

namespace App\Http\Controllers;
use App\Http\Requests\TemplateRequest;
use App\Models\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MailTemplateController extends Controller
{
    public function template_list()
    {
        $mailTemplates=MailTemplate::all();
        return view('template-list', compact('mailTemplates'));
    }

    public function template_view(MailTemplate $mailTemplate)
    {
        return view('template-view', compact('mailTemplate'));
    }

    public function template_delete(MailTemplate $mailTemplate)
    {
        $mailTemplate->delete();
        return redirect('template-list')->with('status', 'Successfuly deleted.');
    }

    public function store(Request $request, $template_id = null)
    {

        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'html' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if($request->file){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('FILES', $fileName, '');
        }

        $campaign = MailTemplate::updateOrCreate(
            [
                'id' => $template_id
            ],
            [
                'name' => $request->name,
                'subject' => $request->subject,
                'html' => $request->html,
                'attachment' => $filePath ?? null,
        ]);

        return redirect('template-list')->with('status', 'Successfuly updated.');
    }
}
