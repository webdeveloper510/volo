<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;
    public $subject;
    public $content;
    public $meetingId;
    public $user;
    public $assigned_by;

    /**
     * Create a new message instance.
     */
    public function __construct($meeting, $subject, $content, $meetingId, $user, $assigned_by)
    {
        $this->meeting = $meeting;
        $this->subject = $subject;
        $this->content = $content;
        $this->meetingId = $meetingId;
        $this->user = $user;
        $this->assigned_by = $assigned_by;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('event.mail.event-email')
            ->with([
                'content' => $this->content,
                'meeting_id' => $this->meetingId,
                'userDetails' => $this->user,
                'meeting' => $this->meeting,
                'assigned_by' => $this->assigned_by
            ]);
    }
}
