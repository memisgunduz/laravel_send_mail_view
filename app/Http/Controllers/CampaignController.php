<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\MailList;
use App\Models\MailLog;
use App\Models\MailTemplate;
use Mail;

class CampaignController extends Controller
{
    public function campaign()
    {
        $mail_list_name=MailList::all();
        $campaigns=Campaign::all();
        return view('campaign', compact('campaigns','mail_list_name'));
    }

    public function campaign_view(Campaign $campaign)
    {
        $mailLists=MailList::all();
        $mailTemplates=MailTemplate::all();
        return view('campaign-view', compact('campaign','mailLists','mailTemplates'));
    }

    public function campaign_delete(Campaign $campaign)
    {
        $campaign->delete();
        return redirect('campaign')->with('status', 'Successfuly deleted.');
    }

    public function campaign_start(Campaign $campaign)
    {
        if(!$campaign->mailTemplate) return "Template id null";

        foreach($campaign->mails as $mail) {
            $mailLog = MailLog::create([
                'campaign_id' => $campaign->id,
                'mail' => $mail
            ]);
            SendEmailJob::dispatch($mailLog->id, $campaign->mailTemplate->subject, $mail,$campaign->mailTemplate->html, $campaign->mailTemplate->attachment);
        }

        return redirect('campaign')->with('status', 'Successfuly started.');
    }

    public function store(Request $request, $campaign_id = null)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $campaign = Campaign::updateOrCreate(
        [
            'id' => $campaign_id
        ],
        [
            'name' => $request->name,
            'mail_template_id' => $request->mail_template_id,
            'status' => $request->status,
        ]);

        $campaign->mailLists()->attach($request->mail_list);
        //return $request->mail_template_id." --- ".$campaign_id;
        return redirect('campaign')->with('status', 'Successfuly updated.');
    }
}
