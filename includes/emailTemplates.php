<?php

$layoutStyle = 'padding: 4px 4px 4px 4px; font-family: Arial, Helvetica, sans-serif, Tahoma; font-size: 80%; color: #333333; font-weight: bold; background-color: #ffffff;';

$rightColumnStyle = 'padding:4px 4px 4px 4px; font-family:Arial, Helvetica, sans-serif, Tahoma; font-size:75%; color:#333333; border-bottom: 1px solid #808080;';

$leftColumnStyle = 'padding: 4px 4px 4px 4px; font-family: Arial, Helvetica, sans-serif, Tahoma; font-size: 80%; color: #ffffff; font-weight: bold; background-color: #808080;';

$headerColumnStyle = 'font-family: Arial, Helvetica, sans-serif, Tahoma; font-size: 100%; color: #333333; background-color: #808080; text-align:center; text-decoration: none; font-weight: bold; letter-spacing: 1px;color: #ffffff;';

$emailTemplateArray['invitation']['subject'] = "Invitation From {userName} to join Bandjamit";
$emailTemplateArray['invitation']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Friend Request From {userName} via Bandjamit</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {inviterName},</td>
        	</tr>
         	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
				  <p>{userName} invites you to become a member at bandjamit.com!</p>
				</td>
        	</tr>
			
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"center\">
					<a href=\"{acceptUrl}\" target=\"_blank\">Accept</a>
					<a href=\"{rejectUrl}\" target=\"_blank\">Reject</a>
				</td>                    
        	</tr>
        	
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Thank You.</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['forgotPassword']['subject'] = "Forgot Password";
$emailTemplateArray['forgotPassword']['message'] = "

<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Forgot Password</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					We are sending new password as per your request for Bandjamit
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"center\">
					Your new password is {userPassword}
				</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Thank You.</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['changePassword']['subject'] = "Change Password";
$emailTemplateArray['changePassword']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Change Password</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {userName},</td>
        	</tr>
         	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					Your password has been changed.
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"center\">
					Your new password is {userPassword}
				</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Thank You.</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['contactUs']['subject'] = "New Contact Request - {subject}";
$emailTemplateArray['contactUs']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">New Contact Request</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear Administrator,</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					You have received new contact with following details
				</td>
        	</tr>
			
        	<tr>
				<td height=\"30\" style=\"{$leftColumnStyle} border-top: 1px solid #808080; \" align=\"right\">
					Name:
				</td>
          		<td style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"left\">
					{name}
				</td>                    
        	</tr>
			<tr>
				<td height=\"30\" style=\"{$leftColumnStyle} border-top: 1px solid #808080; \" align=\"right\">
					Email:
				</td>
          		<td style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"left\">
					{email}
				</td>                    
        	</tr>
			<tr>
				<td height=\"30\" style=\"{$leftColumnStyle} border-top: 1px solid #808080; \" align=\"right\">
					Subject:
				</td>
          		<td style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"left\">
					{subject}
				</td>                    
        	</tr>
			<tr>
				<td height=\"30\" style=\"{$leftColumnStyle} border-top: 1px solid #808080; \" align=\"right\">
					Questions or comments:
				</td>
          		<td style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"left\">
					{comments}
				</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";
$emailTemplateArray['inviteReject']['subject'] = "Your Invitation Rejected";
$emailTemplateArray['inviteReject']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Invitation Rejected</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					Your invitation is rejected by {inviteeFirstname} {inviteeLastName}
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['inviteAccept']['subject'] = "Your Invitation Accepted";
$emailTemplateArray['inviteAccept']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Invitation Accepted</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					Your invitation is accepted by {inviteeFirstName} {inviteeLastName}
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['register']['subject'] = "Welcome to Bandjamit";
$emailTemplateArray['register']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Welcome to Bandjamit</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					Welcome to Band Jam It.
				</td>
        	</tr>
			<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					<a href=\"".ROOT_HTTP_PATH."/activationLink.php?id={userId}&key={activationKey}\">Click here</a> to activate your account
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

$emailTemplateArray['newMail']['subject'] = "New Buzz from your Biggies";
$emailTemplateArray['newMail']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">New Buzz from your Biggies</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					You have get new message from your biggies.
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";


$emailTemplateArray['reportVideo']['subject'] = "Report this Video";
$emailTemplateArray['reportVideo']['message'] = "

<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\">Report This video</td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear Admin,</td>
        	</tr>
         	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					A user has reported this video for inappropriate material
				</td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$rightColumnStyle} border-top: 1px solid #808080; \" align=\"center\">
					Video URL Link: {url}
				</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Thank You.</td>                    
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\">Best Regards<br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";


$emailTemplateArray['deleteUser']['subject'] = "Your Profile Deleted";
$emailTemplateArray['deleteUser']['message'] = "
<html>
<head>
</head>
<body>
<table width=\"800\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #808080;\">
  <tr>
    <td align=\"left\" valign=\"top\" style=\"width:346px;{$headerColumnStyle}\" bgcolor=\"#808080\">
      Bandjamit
    </td>
    <td style=\"{$headerColumnStyle}\"></td>
  </tr> 
  <tr>
  	<td height=\"1\" align=\"left\" colspan=\"2\" bgcolor=\"#808080\">&nbsp;</td>  	
  </tr>
  <tr>
    <td colspan=\"2\" valign=\"top\">
      <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  style=\"border: 1px solid #808080;\">
        <tr>
          <td>
            <table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
             <tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle}\" align=\"left\">Dear {firstName} {lastName},</td>
        	</tr>
         	<tr>
          		<td height=\"30\" colspan=\"2\" style=\"{$layoutStyle} \" align=\"left\">
					Your profile has been deleted by the Band Jam It team.  
                </td>
        	</tr>
        	<tr height=\"30\">
          		<td colspan=\"2\" style=\"{$layoutStyle} border-bottom: 1px solid #808080;\" align=\"left\"><br />Bandjamit</td>                    
        	</tr>  
           </table>
          </td>       
        </tr>              
      </table>
    </td>
  </tr>
  <tr><td colspan=\"2\" align=\"center\" bgcolor=\"#808080\"  style=\"{$layoutStyle}\">&copy; All Rights Reserved By Bandjamit</td></tr>
</table>
</body>
</html>
";

?>