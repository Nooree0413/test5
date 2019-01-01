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
                <strong>Hello {!!$firstname!!} {!!$lastname!!}, </strong> <br><br>

                You are invited to event {!!$name!!}. <br><br>

                <u>Event Details:</u><br><br>

                Event Name: {!!$name!!} <br> 
                Event Description: {!!$description!!} <br> 
                Event Status: {!!$status!!} <br>
                Event Duration: {!!$duration!!} days<br>
                Starting date of Event: {!!$date_start!!} <br> 
                Ending date of Event: {!!$date_end!!} <br> 
                Event Type: {!!$type!!} <br>
                @if(isset($paid_activity))
                    Paid Activity: Yes
                @else
                    Paid Activity: No
                @endif
                <br> 
                Event Deadline: {!!$deadline!!} <br><br>

                Click on either link below whether you are participating or not.<br><br>
                <a href="http://127.0.0.1:8000/eventform/userstatus/{!!$uid!!}{!!$eid!!}/?status=going">Participating to event</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://127.0.0.1:8000/eventform/userstatus/{!!$uid!!}{!!$eid!!}/?status=not_going">Not participating to event</a>
                <br><br>
            </div>
            <img class="userInvImgEmail" src="{{ $message->embed(('images/'.$image_path)) }}">      
        </div>
        <small class="userInvGenEmail">[This is email is generated automatically, please do not reply to this email.]</small>
    </div>
</body>
</html> 
