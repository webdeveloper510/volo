<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Response</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #696b66;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 23px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }

    .checkmark {
        color: green;
    }

    .cross {
        color: red;
    }
</style>

<body>
    <div class="card">
        <div class="icon-container">
            <?php if($event_status): ?>
            <i class="icon checkmark">✓</i>
            <?php else: ?>
            <i class="icon cross">✗</i>
            <?php endif; ?>
        </div>
        <h1><?php echo e($message); ?></h1>
        <p>Thank you for your response.</p>
        <div class="mt-3" style="margin-top: 20px;">
            <a href="<?php echo e(route('login')); ?>" style="background-color: #5e6164; color: white; padding: 10px 20px; border-radius: 4px; font-size: 16px; text-decoration: none; display: inline-block; cursor: pointer;">Go to Login Page</a>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\volo\resources\views/event/mail/response.blade.php ENDPATH**/ ?>