<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\MailList;
use Illuminate\Http\Request;

class MailListController extends Controller
{
    public function mail_list()
    {
        $mailLists=MailList::all();
        return view('mail-list', compact('mailLists'));
    }

    public function mail_view(MailList $mailList)
    {
        return view('mail-list-view', compact('mailList'));
    }
    public function mail_list_delete(MailList $mail_list)
    {
        $mail_list->delete();
        return redirect('mail-list')->with('status', 'Successfuly deleted.');
    }

    public function store(Request $request, $mail_list_id = null)
    {
        $request->validate([
            'name' => 'required',
            'mail_list_textarea' => 'required',
        ]);

        $mail_list = MailList::updateOrCreate(
            [
                'id' => $mail_list_id
            ],
            [
                'name' => $request->name,
        ]);

        $text = trim($request->mail_list_textarea);
        $textAr = array_map('trim', explode("\r\n", $text));

        $existingMails = Mail::where('mail_list_id', $mail_list->id)->whereIn('mail', $textAr)->get()->pluck('mail')->toArray();
        Mail::where('mail_list_id', $mail_list->id)->whereNotIn('mail', $textAr)->delete();

        foreach ($textAr as $line) {
            $email = $this->email_control(trim($line));
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(!in_array($line, $existingMails)) {
                    Mail::create(
                        [
                            'mail' => $line,
                            'mail_list_id' => $mail_list->id,
                    ]);
                }
            }
        }

        return redirect('mail-list')->with('status', 'Successfuly updated.');
    }

    function email_control($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
