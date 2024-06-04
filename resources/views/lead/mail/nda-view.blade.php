@php
use Illuminate\Support\Facades\Crypt;

$propinfo = json_decode($proposalinfo->proposal_info, true);

// Base64 encode the values
$encryptedDay = base64_encode($propinfo['aggrement_day']);
$encryptedBy = base64_encode($propinfo['aggrement_by']);
$encryptedReceivingParty = base64_encode($propinfo['aggrement_receiving_party']);
$encryptedTransaction = base64_encode($propinfo['aggrement_transaction']);
$encryptedDisclosing_by = base64_encode($propinfo['disclosing_by']);
$encryptedDisclosing_party_name = base64_encode($propinfo['disclosing_party_name']);
$encryptedDisclosing_party_title = base64_encode($propinfo['disclosing_party_title']);

// URL encode the Base64 encoded values
$day = urlencode($encryptedDay);
$by = urlencode($encryptedBy);
$rec_p = urlencode($encryptedReceivingParty);
$tran = urlencode($encryptedTransaction);
$disc_b = urlencode($encryptedDisclosing_by);
$disc_p_n = urlencode($encryptedDisclosing_party_name);
$disc_p_t = urlencode($encryptedDisclosing_party_title);

// Construct the URL with the encrypted lead id
$encryptedLeadId = urlencode(Crypt::encryptString($lead->id));
$ndaUrl = route('lead.signednda', ['id' => $encryptedLeadId]);

// Append the query parameters
$ndaUrlWithParams = "{$ndaUrl}?day={$day}&by={$by}&rec_p={$rec_p}&tran={$tran}&disc_b={$disc_b}&disc_p_n={$disc_p_n}&disc_p_t={$disc_p_t}&prop={$propid}";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NDA</title>
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
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>
    <p>Dear {{ ucfirst($lead->name) }}</p>
    <div class="container">
        <h1>NDA Details</h1>
        <p>{{ $content }}</p>
        <p>Click the link below to see the NDA details with estimated billing:</p>
        <p><a href="{{ $ndaUrlWithParams }}">{{ $ndaUrlWithParams }}</a></p>
        <p>Thank you for your time and collaboration.</p>
        <p><strong>With regards,</strong></p>
    </div>
    <div class="footer">
        <p>This email was generated automatically. Please do not reply.</p>
    </div>
</body>
</html>
