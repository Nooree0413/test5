<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .userInvEmailContainer .userInvEmail{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 13px;
            overflow: auto;
            margin-bottom: 6%;
        }
        .userInvEmailContainer .userInvGenEmail{
            font-style: italic;
            font-weight:200;
    
        }
        .userInvEmailContainer .userInvEmail .userInvImgEmail{
            max-width:36.5%;     
        }
        .mainUserInvEmail{
            float:left;
            margin-right: 16%;
        }

    </style>
</head>
<body>
    <div class="userInvEmailContainer">
        <div class="userInvEmail">
            <div class="mainUserInvEmail">
                <strong>Hello <?php echo $firstname; ?> <?php echo $lastname; ?>, </strong> <br><br>

                You are invited to event <?php echo $name; ?>. <br><br>

                <u>Event Details:</u><br><br>

                Event Name: <?php echo $name; ?> <br> 
                Event Description: <?php echo $description; ?> <br> 
                Event Status: <?php echo $status; ?> <br>
                Event Duration: <?php echo $duration; ?> days<br>
                Starting date of Event: <?php echo $date_start; ?> <br> 
                Ending date of Event: <?php echo $date_end; ?> <br> 
                Event Type: <?php echo $type; ?> <br>
                <?php if(isset($paid_activity)): ?>
                    Paid Activity: Yes
                <?php else: ?>
                    Paid Activity: No
                <?php endif; ?>
                <br> 
                Event Deadline: <?php echo $deadline; ?> <br><br>

                Click on either link below whether you are participating or not.<br><br>
                <a href="http://127.0.0.1:8000/eventform/userstatus/<?php echo $uid; ?><?php echo $eid; ?>/?status=going">Participating to event</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://127.0.0.1:8000/eventform/userstatus/<?php echo $uid; ?><?php echo $eid; ?>/?status=not_going">Not participating to event</a>
                <br><br>
            </div>
            <img class="userInvImgEmail" src="<?php echo e($message->embed(('images/'.$image_path))); ?>">      
        </div>
        <small class="userInvGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html> 
