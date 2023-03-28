<?php

namespace Modules\Contact\Http\Controllers\Guest;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Contact\Emails\ContactMail;
use Modules\Contact\Entities\Contact;
use Throwable;

class ContactController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'subject', 'content']);
        $request->validate([
            'name'    => 'required|max:30',
            'email'   => 'required|email',
            'subject' => 'required|min:10|max:255',
            'content' => 'required|max:500'
        ]);

        Contact::create($data);
        
        if(boolval(config('mail.enable', false))) {
            try {
                $data['subject'] = '[Consultation Request] '.$data['subject'];
                $recipient = config('appearance.theme.email');
                Mail::to($recipient)->send(new ContactMail($data));
            } catch (Throwable $e) {
                Log::error($e);
            }
        }        

        return redirect()->back()->with('success', 'success');
    }
}
