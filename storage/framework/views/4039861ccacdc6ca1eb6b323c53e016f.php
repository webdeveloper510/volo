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
    </style>
</head>
<body>
    <p>Dear <?php echo e(ucfirst($lead->name)); ?></p>
    <p><?php echo e($content); ?></p>
    <p>Thank you for your time and collaboration.</p>
    <p><strong>With regards,</strong></p>
    <p>This email was generated automatically. Please do not reply.</p>
</body>

</html><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/mail/opportunity-email.blade.php ENDPATH**/ ?>