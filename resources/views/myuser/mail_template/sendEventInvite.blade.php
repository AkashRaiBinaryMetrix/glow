<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Event Invitation</title>
</head>

<body style="margin: 0 auto;background: #fff">
    <table style="margin: auto;padding:0px 0 20px; width: 750px; border:1px solid #333333;" cellpadding="0" cellspacing="0"
        border="0">
        <tbody>
            <tr>
                <td align="center" valign="middle" style="margin: 0; padding: 0;">
                    <table width="750" border="0" cellpadding="0" cellspacing="0"
                        style="width: 750px; margin: auto">
                        <tbody>
                            <tr bgcolor="#000000;" height="100">
                                <td align="left" valign="middle">
                                    <a href="javascript:void(0)" style="margin-left:20px;">
                                        <img src="{{ asset('images/emailer-logo.png') }}" alt="">
                                    </a>
                                </td>

                                <td align="right" valign="middle" style="padding-right:20px;">
                                    <a href="javascript:void(0)"><img src="{{ asset('images/fb-icon.png') }}"
                                            alt=""></a>
                                    <a href="javascript:void(0)" style="margin:0px 5px;"><img
                                            src="{{ asset('images/twitter-icon.png') }}" alt=""></a>
                                    <a href="javascript:void(0)" style="margin-right:5px;"><img
                                            src="{{ asset('images/instagram-icon.png') }}" alt=""></a>
                                    <a href="javascript:void(0)"><img src="{{ asset('images/youtube-icon.png') }}"
                                            alt=""></a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <table width="750" border="0" cellpadding="0" cellspacing="0"
                        style="width: 750px;margin: auto;">

                        <tbody>

                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#eee"
                                        style="margin-bottom:10px">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="text-decoration:none;padding:0px 20px 0px;font-family:Arial;">
                                                    <h4
                                                        style="padding:0px 25px 0; font-weight: 400; font-size:26px; margin:20px 0;">
                                                        Hello
                                                        {{ $invited_to }},
                                                    </h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="text-decoration:none;padding:0px 30px 10px;font-family:Arial">

                                                    <p
                                                        style="font-size:14px;font-family:Arial;padding:0px 15px;line-height:22px">
                                                        <b style="font-size:16px;">
                                                        You have been invited by your friend
                                                            {{ $inviting_person_name }} to join the event {{$event_name}}</b></p>

                                                    <br/><p><a href="{{ url('event-detail/'.$event_id) }}">Click here to join and view event details</a></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="text-decoration:none;padding:10px 30px 10px;font-family:Arial">
                                                    <p
                                                        style="font-size:14px;font-family:Arial;padding:0px 15px;line-height:22px">
                                                        In case you
                                                        face any issues, please reach out to <a
                                                            href="mailto:alessia.domanico@cnhind.com"
                                                            style="color:#282525;" target="_blank">alessia@glow.com</a>
                                                        or call on +1 12345 67890 </p>
                                                    <br>

                                                    <p
                                                        style="font-size:18px;font-family:Arial;padding:0px 15px;line-height:22px; margin-bottom:0px;">
                                                        Thank you</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="padding:0px 0px 10px 35px">
                                                    <p
                                                        style="font-size:14px;font-family:Arial;padding:0px 15px;line-height:22px">
                                                        Regards, <br>
                                                        <strong style="color:#66CBFE">Support {{ SITE_NAME }}
                                                            Team</strong>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" width="750"
                        style="width: 750px; margin: auto">
                        <tbody>
                            <tr>
                                <td align="left" valign="top"
                                    style="padding:0px 0px 0px 50px; margin:0px; color: #666;font-size: 13px;font-family: sans-serif;">
                                    <br>© {{ SITE_NAME }}. • 427 Bryant Street, San Francisco, CA 94107
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
