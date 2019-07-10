<?php
class forgotpassword_model extends model{
    public function __construct(){
        parent::__construct();
    }
     public function verifyEmail($data){
         
        $email = $data['email'];
        $exists = $this->db->getRowCounts("SELECT * FROM users WHERE email LIKE '%$email%'");
        if($exists > 0){
            $userinfo = $this->db->getItem("SELECT * FROM users WHERE email LIKE '%$email%'");
        //send email
                //send mail to the newly registered contestant
                try{
                    $name = $userinfo['name'];
                    $username = $userinfo['username'];
                    $email = $userinfo['email'];
                    $hash_email = base64_encode($email);
                    $mail = new PHPMailer;
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.zima.com.ng';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'admin@zima.com.ng';// SMTP username
                    $mail->Password = 'D03dp3Laf9';// SMTP password
                    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted (if you have ssl use ssl else use false)
                    $mail->Port = 465; // TCP port to connect to
            
                    $mail->setFrom("admin@zima.com.ng", "Zima");
                    $mail->addAddress($email);     // Add a recipient
                    //$mail->addReplyTo($email, $name);
                    $mail->isHTML(true);        // Set email format to HTML
                    $mail->Subject = 'Password Reset';
                    $mail->Body    = '
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    
                    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
                    <title>Zima</title>
                    
                    <style type="text/css">
                    
                    	    body{width: 100%; background-color: #F1F2F3; margin:0; padding:0; -webkit-font-smoothing: antialiased;mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;}
                            
                            p,h1,h2,h3,h4{margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;}
                            
                            span.preheader{display: none; font-size: 1px;}
                            
                            html{width: 100%;}
                            
                            table{font-size: 12px;border: 0;}
                    		
                    		.menu-space{padding-right:25px;}
                    		
                    		a,a:hover { text-decoration:none; color:#FFF;}
                    
                    
                    @media only screen and (max-width:640px)
                    
                    {
                    	body {width:auto!important;}
                    	table [class=main] {width:440px !important;}
                    	table [class=two-left] {width:420px !important; margin:0px auto;}
                    	table [class=full] {width:100% !important; margin:0px auto;}
                    	table [class=two-left-inner] {width:400px !important; margin:0px auto;}
                    	table [class=menu-icon] { display:none;}
                    
                    	}
                    
                    @media only screen and (max-width:479px)
                    {
                    	body {width:auto!important;}
                    	table [class=main]  {width:310px !important;}
                    	table [class=two-left] {width:300px !important; margin:0px auto;}
                    	table [class=full] {width:100% !important; margin:0px auto;}
                    	table [class=two-left-inner] {width:280px !important; margin:0px auto;}
                    	table [class=menu-icon] { display:none;}
                    
                    	
                    }
                    
                    
                    
                    </style>
                    
                    </head>
                    
                    <body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                    
                    <!--Main Table Start-->
                    
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F1F2F2">
                      <tr>
                        <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
                      <tr>
                        <td height="60" align="center" valign="top" style="font-size:60px; line-height:60px;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="660" align="center" valign="top" bgcolor="#00a3ff" style="background: url(https://zima.com.ng/public/images/mail-images/note13-image.png) #00a3ff center top; -moz-border-radius: 4px; border-radius: 4px; box-shadow:5px 0px 18px 0px #0175a7;"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                          <tr>
                            <td height="45" align="left" valign="top" style="font-size:45px; line-height:45px;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top">
                            
                            <table width="105" border="0" align="left" cellpadding="0" style="margin-left: 5px;" cellspacing="0" class="full">
                              <tr>
                                <td align="center" valign="top"><a href="#"><img editable="true" mc:edit="bm1-01" src="https://zima.com.ng/public/images/zima-logo.png" width="105" height="40" alt="" /></a></td>
                              </tr>
                            </table>
                            
                            <table width="105" border="0" align="right" cellpadding="0" cellspacing="0" class="full">
                      <tr>
                        <td align="center" valign="top"><table width="105" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                        <td height="8" colspan="2" align="left" valign="top" style="font-size:8px; line-height:8px;">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="20" align="left" valign="top"><img editable="true" mc:edit="bm1-02" src="https://zima.com.ng/public/images/mail-images/account-icon.png" width="20" height="20" alt="" /></td>
                        <td width="85" align="center" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#FFF; padding-top:0px; margin-right: 5px;" mc:edit="bm1-03"><multiline><a href="#" style="text-decoration:none; color:#FFF;">Hi '.$username.'</a></multiline></td>
                      </tr>
                    </table></td>
                      </tr>
                    </table>
                    
                    
                            
                            </td>
                          </tr>
                          <tr>
                            <td height="100" align="center" valign="top" style="font-size:100px; line-height:100px;">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="100" align="center" valign="middle" bgcolor="#FFFFFF" style="-moz-border-radius: 100px; border-radius: 100px;"><img editable="true" mc:edit="bm1-04" src="https://zima.com.ng/public/images/mail-images/lock-icon.png" width="45" height="60" alt="" /></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td height="20" align="center" valign="top" style="font-size:20px; line-height:20px;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="center" valign="top"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                                  <tr>
                                    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:normal; color:#FFF; text-transform: uppercase; line-height:30px;" mc:edit="bm1-05"><multiline>Activate Your Account</multiline></td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#FFF; line-height:24px;" mc:edit="bm1-06"><multiline>Welcome '.$name.', Your Zima account has been successfully created, all you need to do is click on the button below to activate your account and take your products to the public.<br><strong>Happy Posting!</strong></multiline></td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="40" align="center" valign="middle" bgcolor="#133d55" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; color:#FFF; -moz-border-radius: 40px; border-radius: 40px;" mc:edit="bm1-07"><multiline><a href="https://www.zima.com.ng/resetpassword/index/'.$email.'?zima='.$hash_email.'" style="text-decoration:none; color:#FFF;">Reset Password</a></multiline></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                 <td align="center" valign="top" style="font-size:13px; line-height:23px;">&nbsp;If you cannot click on the button, copy the link below and paste it directly to the browser address bar <h4><a href="https://www.zima.com.ng/resetpassword/index/'.$email.'?zima='.$hash_email.'">https://www.zima.com.ng/resetpassword/index/'.$email.'?zima='.$hash_email.'</a></h4></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><table width="86" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td align="center" valign="middle"><a href="#"><img editable="true" mc:edit="bm1-08" src="https://zima.com.ng/public/images/mail-images/facebook.png" width="23" height="23" alt="" /></a></td>
                                <td align="center" valign="middle"><a href="#"><img editable="true" mc:edit="bm1-09" src="https://zima.com.ng/public/images/mail-images/twitter.png" width="23" height="23" alt="" /></a></td>
                                <td align="center" valign="middle"><a href="#"><img editable="true" mc:edit="bm1-10" src="https://zima.com.ng/public/images/mail-images/google.png" width="23" height="23" alt="" /></a></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                              <tr>
                                <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#FFF; line-height:24px;" mc:edit="bm1-11"><multiline></multiline></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color:#FFF; line-height:32px;" mc:edit="bm1-12"><multiline>Copyright &copy; 2018 zima.com.ng </multiline></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; line-height:24px;" mc:edit="bm1-13"><unsubscribe></unsubscribe></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                         <td height="60" align="center" valign="top" style="font-size:60px; line-height:60px;">&nbsp;</td>
                      </tr>
                        </table>
                    </td>
                      </tr>
                    </table>
                    
                    <!--Main Table End-->
                    
                    </body>
                    </html>
                    ';

                    $mail->send();
                
                }catch(Exception $ex){ echo $ex->getMesssage(); }
             return "success";
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
        
        }else{
            return "invalid";
        }
     }
}