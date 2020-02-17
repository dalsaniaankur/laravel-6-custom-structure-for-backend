@inject('helper', 'App\Classes\Helpers\HelperCommon')
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="50" bgcolor="">
<table width="600" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>  <td><img src="{{ url('backend/images/emailtop.png') }}"></td> </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" height="100" bgcolor="#FFFFFF">
                <tr>
                    <td style="font-size:30px; color:#ef5023; font-family:Arial Black; text-align:center; font-weight:bold; line-height:20px;">{{ $subject }}</td>
                </tr>
            </table>

            <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center" height="15">
                <tr>
                    <td style=" font-size:14px; font-family:Arial; text-align:left; line-height:20px;">Hello <strong>
                            {{ $name }},</strong><br/><br/></td>
                </tr>
            </table>

            <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center" height="15">
                <tr>
                    <td style=" font-size:14px; font-family:Arial; text-align:left; line-height:20px;">
                        You are receiving this email because we received a password reset request for your account.
                        <br/>
                        <br/>
                        <a href="{{ url('teacher_password/reset', $token) }}" target="_blank" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1">Reset Password</a>
                        <br/>
                        <br/>
                        This password reset link will expire in {{ config('auth.passwords.teacher.expire') }} minutes.
                        <br/>
                        <br/>
                        If you did not request a password reset, no further action is required.
                    </td>
                </tr>
            </table>

            <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center" height="80">
                <tr>
                    <td style=" font-size:14px; text-align:left; line-height:20px; margin-top:5px;">
                        <font face="Arial"
                              style="font-size:14px; line-height:20px; text-align:left; color:#203970; font-weight:bold">
                            <br><a href="https://kidrend.com"> www.kidrend.com </a>
                            {{--  <br/>{!! Common::getMailPhoneFormat($helper->getPhoneNumber()) !!}--}}
                        </font>
                    </td>
                </tr>
                <tr>
                    <td style=" font-size:14px; color:#000000; font-face:arial; text-align:left; line-height:20px; margin-top:0px;"></td>
                </tr>
            </table>
            <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center" height="50">
                <tbody>
                <tr>
                    <td style=" font-size:12px; text-align:left; line-height:20px; margin-top:5px;"></td>
                    <td style="width:200px;">
                        <a target="_blank" href="{{ $helper->getFacebookUrl() }}"><img
                                    src="{{ url('backend/images/facebook-icon.png') }}" width="29" height="28"></a>
                        <a target="_blank" href="{{ $helper->getTwitterUrl() }}"><img
                                    src="{{ url('backend/images/twitter-icon.png') }}" width="29" height="28"></a>
                        <!--a target="_blank" href="#"><img src="backend/images/google-icon.png" width="29" height="28"></a>
                        <a target="_blank" href="#"><img src="backend/images/pintrest-icon.png" width="29" height="28"></a-->
                    </td>
                </tr>
                </tbody>
            </table>
            <table  width="100%" cellpadding="0" cellspacing="0" border="0" align="center"                                                      >
                <tr>
                    <td><img src="{{ url('backend/images/emailbottom.png') }}" width="600" height="auto">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
