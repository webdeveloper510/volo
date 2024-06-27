<?php
$logo = \App\Models\Utility::get_file('uploads/logo/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        p {
            margin-bottom: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
            /* Adjust margin as needed */
        }

        .button-container form {
            display: inline-block;
        }

        .button-container button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .button-accept {
            background-color: #5cb85c;
            cursor: pointer;
            color: white;
        }

        .button-decline {
            background-color: #d9534f;
            cursor: pointer;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Dear {{ ucfirst($userDetails->name) }}, an event has been assigned to you by {{ ucfirst($assigned_by) }}. The details are provided below. Please accept or decline the event by clicking the button below.</p>
        <h1>Event Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Link</th>
                    <th>Notes/Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $meeting->name ?? '--' }}</td>
                    <td>{{ $meeting->venue_selection ?? '--' }}</td>
                    <td>{{ $meeting->start_date ?? '--' }}</td>
                    <td>{{ $meeting->end_date ?? '--' }}</td>
                    <td><a href="{{ $meeting->link ?? '#' }}">click here</a></td>
                    <td>{{ $meeting->notes ?? '--' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="button-container">
            <form method="POST" action="{{ route('accept_event') }}">
                @csrf
                <input type="hidden" name="event_response" value="1">
                <input type="hidden" name="meeting_id" value="{{ $meetingId }}">
                <button type="submit" class="button-accept">Accept</button>
            </form>

            <form method="POST" action="{{ route('decline_event') }}">
                @csrf
                <input type="hidden" name="event_response" value="0">
                <input type="hidden" name="meeting_id" value="{{ $meetingId }}">
                <button type="submit" class="button-decline">Decline</button>
            </form>
        </div>

        <p>Thank you for your time and collaboration.</p>
        <p><strong>With regards,</strong></p>
        <div class="logo">
            <img src="{{ $logo.'volo-transparent-bg.png' }}" alt="{{ config('app.name', 'The Volo Fleet') }}" height="50" />
        </div>
    </div>
    <div class="footer">
        <p>This email was generated automatically. Please do not reply.</p>
    </div>
</body>

</html>