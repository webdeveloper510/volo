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
    </style>
</head>

<body>
    <div class="container">
        <p>Dear <?php echo e(ucfirst($userDetails->name)); ?>, an event has been assigned to you by <?php echo e(ucfirst($assigned_by)); ?>. The details are provided below. Please accept or decline the event by clicking the button below.</p>
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
                    <td><?php echo e($meeting->name ?? '--'); ?></td>
                    <td><?php echo e($meeting->venue_selection ?? '--'); ?></td>
                    <td><?php echo e($meeting->start_date ?? '--'); ?></td>
                    <td><?php echo e($meeting->end_date ?? '--'); ?></td>
                    <td><a href="<?php echo e($meeting->link ?? '#'); ?>">click here</a></td>
                    <td><?php echo e($meeting->notes ?? '--'); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="button-container" style="text-align: center; margin-top: 20px;">
            <a href="<?php echo e(url('/accept-event?meeting_id=' . urlencode(Crypt::encrypt($meetingId)) . '&event_response=1')); ?>" style="background-color: #5cb85c; color: white; padding: 10px 20px; border-radius: 4px; font-size: 16px; text-decoration: none; display: inline-block; cursor: pointer;">Accept</a>
            <a href="<?php echo e(url('/decline-event?meeting_id=' . urlencode(Crypt::encrypt($meetingId)) . '&event_response=0')); ?>" style="background-color: #d9534f; color: white; padding: 10px 20px; border-radius: 4px; font-size: 16px; text-decoration: none; display: inline-block; cursor: pointer;">Decline</a>
        </div>

        <p>Thank you for your time and collaboration.</p>
        <p><strong>With regards,</strong></p>
        <div class="logo">
            <img src="<?php echo e($logo.'volo-transparent-bg.png'); ?>" alt="<?php echo e(config('app.name', 'The Volo Fleet')); ?>" height="50" />
        </div>
    </div>
    <div class="footer">
        <p>This email was generated automatically. Please do not reply.</p>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\volo\resources\views/event/mail/event-email.blade.php ENDPATH**/ ?>