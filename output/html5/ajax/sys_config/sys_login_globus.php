<?php
header('Content-type: application/json');

date_default_timezone_set("UTC");

session_start(); 
session_regenerate_id(true); 

$results[ '_status' ] = "complete";
$results[ '_project' ] = "";

if ( !sizeof( $_REQUEST ) )
{
    $results[ "error" ] = "PHP code received no \$_REQUEST?";
    echo (json_encode($results));
    exit();
}

if ( isset( $_REQUEST[ '_window' ] ) )
{
   $window = $_REQUEST[ '_window' ];
}
if ( !isset( $_SESSION[ $window ] ) )
{
   $_SESSION[ $window ] = array( "logon" => "", "project" => "" );
}

if ( !is_string( $_REQUEST[ 'userid' ] ) || 
   strlen( $_REQUEST[ 'userid' ] ) < 3 ||
   strlen( $_REQUEST[ 'userid' ] ) > 30 ||
   !filter_var( $_REQUEST[ 'userid' ], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>'/^[A-Za-z][A-Za-z0-9_]+$/') ) ) )
{
    $results[ "error" ] = "empty or invalid user name";
    echo (json_encode($results));
    exit();
}



$userid = $_REQUEST[ 'userid' ];


// connect
try {
     $m = new MongoClient(
         
         
         );
} catch ( Exception $e ) {
    $results[ "error" ] = "Could not connect to the db " . $e->getMessage();
    echo (json_encode($results));
    exit();
}
  
$loginok = 0;

$coll = $m->ses->users;
$current_user = $coll->findOne( array( "name" => $userid ) );

/// FOR GLOBUS ///////////////////////////////////////////////////////////////////////////

if ( $current_user && isset( $current_user[ 'globusid' ] ) || isset( $current_user[ 'googleid' ] ) ) {              // FOR GLOBUS&GOOGLE ///
$email = filter_var( $_REQUEST[ 'email' ], FILTER_SANITIZE_EMAIL );

if ( !is_string( $email ) || 
   !strlen( $email ) ||
   !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
{
  if ( isset( $_REQUEST['globusidlog']) || isset( $_REQUEST['googleidlog'])  )
    {
     $results[ "error" ] = "PHP code received empty or invalid email";
     echo (json_encode($results));
     exit();
    }
}
}
//////////////////////////////////////////////////////////////////////////////////////////

if ( $current_user && !isset( $current_user[ 'globusid' ] ) && !isset( $current_user[ 'googleid' ] ) ) {     // FOR GLOBUS&GOOGLE /// 
if ( isset( $_REQUEST[ 'forgotpassword' ] ) &&
     $_REQUEST[ 'forgotpassword' ] === "on" )
{
    unset( $_REQUEST[ 'password' ] );
} else {
    if ( !isset( $_REQUEST[ 'password' ] ) || 
         !is_string( $_REQUEST[ 'password' ] ) || 
         strlen( $_REQUEST[ 'password' ] ) < 10 || 
         strlen( $_REQUEST[ 'password' ] ) > 100 )
    {
        $results[ "error" ] = "empty or invalid password";
        echo (json_encode($results));
        exit();
    }
    $pw = $_REQUEST[ 'password' ];
}
}



$results[ 'status' ] = "User not found or incorrect password";
if ( isset( $pw ) && $doc = $coll->findOne( array( "name" => $userid ) ) )
{
   if ( PHP_VERSION_ID < 50500 )
   {
      if ( crypt( $pw, $doc[ 'password' ]) == $doc[ 'password' ] )
      {
         $loginok = 1;
      }
   } else {
      if ( password_verify ( $pw , $doc[ 'password' ] ) )
      {  
         $loginok = 1;
      }
   }
}

// FOR GLOBUS ////////////////////////////////////////////////////////////////////
if ( isset( $email ) && $doc = $coll->findOne( array( "name" => $userid ) ) )
{
  if ( $email == $doc[ 'email' ] )
     {	
      $loginok = 1;
     }
}
//////////////////////////////////////////////////////////////////////////////////


$addstat = "";
$did_expiretime              = 0;
$did_expiretimes             = 0;
$did_lastfailedloginattempts = 0;
$now = new MongoDate();

if ( isset( $doc[ 'expiretime' ] ) )
{
   if ( $now > $doc[ 'expiretime' ] )
   {
      $did_expiretime = 1;
   }
}

if ( isset( $doc[ 'expiretimes' ] ) )
{
   if ( $doc[ 'expiretimes' ] <= 0 )
   {
      $did_expiretimes = 1;
   }
}

if ( isset( $doc[ 'lastfailedloginattempts' ] ) )
{
   if ( $doc[ 'lastfailedloginattempts' ] > 4 )
   {
      $did_lastfailedloginattempts = 1;
   }
}

if ( $loginok == 1 && $did_expiretime )
{
    $addstat .= "Password time expired, ";
    $_REQUEST[ 'forgotpassword' ] = "on";
    $loginok = 0;
}

if ( $loginok == 1 && $did_expiretimes )
{
    $addstat .= "Password times used expired, ";
    $_REQUEST[ 'forgotpassword' ] = "on";
    $loginok = 0;
}

if ( $did_lastfailedloginattempts )
{
    $addstat .= "Too many failed login attempts. ";
    $_REQUEST[ 'forgotpassword' ] = "on";
    $loginok = 0;
}

if ( $loginok &&
    isset( $doc[ 'suspended' ] ) ) {
    $results[ 'status' ] = "Your account has been suspended by the administrators. ";
    $results[ '_message' ] = [
        "icon" => "information.png",
        "text" => $results[ 'status' ]
        ];
    echo json_encode( $results );
    exit();
}

if ( $loginok ) {
    if ( 0 &&
         isset( $doc[ "needsemailverification" ] ) &&
         $doc[ "needsemailverification" ] != "verified"
        ) {
        if ( isset( $_REQUEST[ "_cancel" ] ) ) {
            // rename user entry and add cancelled flag and scramble password
                $id = '';
            $email = '';
            if ( $doc = $coll->findOne( array( "name" => $_REQUEST[ 'userid' ] ) ) ) {
                if ( isset( $doc[ '_id' ] ) ) {
                    $id = $doc[ '_id' ];
                }
                if ( isset( $doc[ 'email' ] ) ) {
                    $email = $doc[ 'email' ];
                }
            }
            if ( $id == '' ) {
                $results[ 'status' ] = "Your user id seems to have been removed from the system. ";
                $results[ '_message' ] = [
                    "icon" => "toast.png",
                    "text" => $results[ 'status' ]
                    ];
                echo json_encode( $results );
                exit();
            }
            $orgid = $doc[ '_id' ];
            unset( $doc[ '_id' ] );
            unset( $doc[ 'needsemailverification' ] );
            $doc[ 'password' ] = "xx__1234$2y$10$7vf3p/0VGuSnavu.B/riiuzK938yiN1TgFaX8/LFtlMYQmS0TYyy2";
            $doc[ 'orgname' ] = $doc[ 'name' ];
            $doc[ 'canceled' ] = new MongoDate();
            $orgname = $doc[ 'name' ];

            $ext = 0;
            do {
                $doc[ 'name' ] = "_canceled_" . ( $ext ? "${ext}_" : "" ) . $orgname;
                $ext++;
            } while ( $coll->findOne( array( "name" => $doc[ 'name' ] ) ) );

            try {
                $coll->insert( $doc, array("j" => true ));
            } catch(MongoCursorException $e) {
                $results[ 'status' ] = "Error canceling user id. " . $e->getMessage();
                $results[ '_message' ] = [
                    "icon" => "toast.png",
                    "text" => $results[ 'status' ]
                    ];
                echo json_encode( $results );
                exit();
            }

            try {
                $coll->remove( [ "name" => $orgname ] );
            } catch(MongoCursorException $e) {
                $results[ 'status' ] = "Error canceling user id. " . $e->getMessage();
                $results[ '_message' ] = [
                    "icon" => "toast.png",
                    "text" => $results[ 'status' ]
                    ];
                echo json_encode( $results );
                exit();
            }            
            
            $results[ 'status' ] = "User id canceled.  If you wish to reuse this id, please register again.";
            $results[ '_message' ] = [
                "icon" => "information.png",
                "text" => $results[ 'status' ]
                ];
            echo json_encode( $results );
            exit();
        }
        if ( isset( $_REQUEST[ "_resendverify" ] ) ) {
            $id = '';
            $email = '';
            if ( $doc = $coll->findOne( array( "name" => $_REQUEST[ 'userid' ] ) ) ) {
                if ( isset( $doc[ '_id' ] ) ) {
                    $id = $doc[ '_id' ];
                }
                if ( isset( $doc[ 'email' ] ) ) {
                    $email = $doc[ 'email' ];
                }
            }
            if ( $id == '' ) {
                $results[ 'status' ] = "Your user id seems to have been removed from the system. ";
                $results[ '_message' ] = [
                    "icon" => "toast.png",
                    "text" => $results[ 'status' ]
                    ];
                echo json_encode( $results );
                exit();
            }

            if ( isset( $_REQUEST[ "_changeemail" ] ) ) {
                if ( isset( $_REQUEST[ "_changeemail1" ] ) &&
                     isset( $_REQUEST[ "_changeemail2" ] ) ) {
                    $email1 = filter_var( $_REQUEST[ '_changeemail1' ], FILTER_SANITIZE_EMAIL );
                    $email2 = filter_var( $_REQUEST[ '_changeemail1' ], FILTER_SANITIZE_EMAIL );
                    if ( $email1 != $email2 ) {
                        $results[ 'status' ] = "The emails provided do not match";
                        $results[ '_message' ] = [
                            "icon" => "toast.png",
                            "text" => $results[ 'status' ]
                            ];
                        echo json_encode( $results );
                        exit();
                    }                    
                    if ( !is_string( $email1 ) || 
                         !strlen( $email1 ) ||
                         !filter_var( $email1, FILTER_VALIDATE_EMAIL ) ) {
                        $results[ "status" ] = "Invalid email address provided";
                        $results[ '_message' ] = [
                            "icon" => "toast.png",
                            "text" => $results[ 'status' ]
                            ];
                        echo (json_encode($results));
                        exit();
                    }

                    $update = [];
                    $update[ '$set' ][ 'email' ] = $email1;
                    $update[ '$set' ][ 'emailupdated' ] = new MongoDate();

                    try {
                        $coll->update( array( "name" => $_REQUEST[ 'userid' ] ),
                                       $update, array("j" => true ) );
                    } catch(MongoCursorException $e) {
                        $db_errors = "Error updating the database(). " . $e->getMessage();
                        $results[ 'status' ] = $db_errors;
                        $results[ '_message' ] = [
                            "icon" => "toast.png",
                            "text" => $results[ 'status' ]
                            ];
                        echo (json_encode($results));
                        exit();
                    }
                    $email = $email1;

                } else {
                    $results[ 'status' ] = "Internal error. (change email requested, but no new email address provided.)";
                    $results[ '_message' ] = [
                        "icon" => "toast.png",
                        "text" => $results[ 'status' ]
                        ];
                    echo json_encode( $results );
                    exit();
                }
            }

            if ( $email == '' ) {
                $results[ 'status' ] = "Could not find an email address associated with this user. ";
                $results[ '_message' ] = [
                    "icon" => "toast.png",
                    "text" => $results[ 'status' ]
                    ];
                echo json_encode( $results );
                exit();
            }
            
            require_once "../mail.php";

            $app = json_decode( file_get_contents( "/opt/genapp/ses/appconfig.json" ) );
            if ( 0 ) {
                $results[ 'status' ] = "An additional email has been sent to $email, please click the link in the email to verify and begin the approval process";
            } else {
                $results[ 'status' ] = "An additional email has been resent to $email, please click the link in the email to verify";
            }        
            $body = "Please verify your email address by visiting this link:\n http://" . $app->hostname . "/ses/ajax/sys_config/sys_register_backend.php?_r=$id";
            mymail( $email, "[ses][email verify request]", $body );

            $results[ '_message' ] = [
                "icon" => "information.png",
                "text" => $results[ 'status' ]
                ];
            echo json_encode( $results );
            exit();
        }

        $results[ 'status' ] = "You must first verify your email address";
        $results[ '_loginverify' ] = [ 
            "useroptions" => [
                "resend" => 1, 
                "changeaddress" => 1,
                "cancel" => 1 
            ], 
            "text" => "Your must verify your email address." 
            ];
        //    $results[ "_message" ] = 
        //       array( 
        //           "icon"  => "information.png"
        //           ,"text" => $results[ 'status' ]
        //       );
        echo json_encode( $results );
        exit();
    } else {
        if ( 0 &&
             isset( $doc[ "needsapproval" ] ) ) {
            if ( $doc[ "needsapproval" ] == "denied" ) {
                $results[ "status" ] = "Your account request has been denied";
            } else {
                if ( isset( $_REQUEST[ "_resendapprove" ] ) ) {
                    $id = '';
                    $email = '';
                    if ( isset( $doc[ '_id' ] ) ) {
                        $id = $doc[ '_id' ];
                    }
                    if ( isset( $doc[ 'email' ] ) ) {
                        $email = $doc[ 'email' ];
                    }
                    if ( $id == '' ) {
                        $results[ 'status' ] = "Your user id seems to have been removed from the system. ";
                        $results[ '_message' ] = [
                            "icon" => "toast.png",
                            "text" => $results[ 'status' ]
                            ];
                        echo json_encode( $results );
                        exit();
                    }
                    require_once "../mail.php";

                    $app = json_decode( file_get_contents( "/opt/genapp/ses/appconfig.json" ) );
                    $aid = $doc[ 'approvalid' ];
                    $did = $doc[ 'denyid' ];
                $body = "New user requests approval again
                User     : " . $doc[ 'name' ] . "
                Email    : " . $doc[ 'email' ] . "
                Remote IP: " . $_SERVER['REMOTE_ADDR'] . "
                Approve  : http://" . $app->hostname . "/ses/ajax/sys_config/sys_approvedeny_backend.php?_a=$aid&_r=$id
                Deny     : http://" . $app->hostname . "/ses/ajax/sys_config/sys_approvedeny_backend.php?_d=$did&_r=$id
                ";
                    admin_mail( "[ses][new user repeated approval request] " . $doc[ 'email' ], $body );

                    $results[ 'status' ] = "The approval request email has been resent. ";
                    $results[ '_message' ] = [
                        "icon" => "information.png",
                        "text" => $results[ 'status' ]
                        ];
                    echo json_encode( $results );
                    exit();
                }

                $results[ "status" ] = "Your account request is pending approval";
                $results[ '_loginapprove' ] = [ 
                    "useroptions" => [
                        "resend" => 1, 
                        "cancel" => 1 
                    ], 
                    "text" => $results[ "status" ]
                    ];
                echo json_encode( $results );
                exit();
            }
            $results[ "_message" ] = 
                array( 
                    "icon"  => "information.png"
                    ,"text" => $results[ 'status' ]
                );
            echo json_encode( $results );
            exit();
        }
    }
}

if ( $loginok == 1 )
{
   if ( isset( $doc[ 'expiretime' ] ) || isset( $doc[ 'expiretimes' ] ) )
   {
      $addstat = 'This password will expire.  Please change the password (click the top right configuration icon). ';
   } else {
      $results[ '-close' ] = 1;
   }

   $update[ '$set' ] = array(
                              "lastlogin" => $now,
                              "lastloginip" => $_SERVER[ 'REMOTE_ADDR' ]
                             );
   $update[ '$unset' ] = array(
                                "lastfailedloginattempts" => 0
                              );
   if ( isset( $doc[ 'expiretimes' ] ) )
   {
       $update[ '$inc' ] = array( "expiretimes" => -1 );
   }

   try {
     $coll->update( array( "name" => $userid ), 
                    $update, array("j" => true ) );
   } catch(MongoCursorException $e) {
      $results[ 'error' ]  = "Error updating the database. " . $e->getMessage();
      $results[ 'status' ] = $addstat . "Unable to update user record";
      unset( $results[ '-close' ] );
      echo (json_encode($results));
      exit();
   }

   $results[ 'status' ] = $addstat . "Login successful";
   $results[ '_logon' ] = $userid;
   $_SESSION[ $window ][ 'logon' ] = $userid;
   $_SESSION[ $window ][ 'app'   ] = "ses";
   session_commit();

   if ( isset( $doc[ "groups" ] ) ) {
       $results[ "_usergroups" ] = $doc[ "groups" ];
   } else {
       $results[ "_usergroups" ] = [];
   }
   if ( 0 && isset( $doc[ "color" ] ) ) {
       $results[ "_color" ] = $doc[ "color" ];
   }
   if ( isset( $_REQUEST[ "_switch" ] ) ) {
       $results[ "_switch" ] = $_REQUEST[ "_switch" ];
   }
} else {
   if ( isset( $_REQUEST[ 'forgotpassword' ] ) &&
        $_REQUEST[ 'forgotpassword' ] == "on" )
   {
      $doc = $coll->findOne( array( "name" => $userid ) );

      if ( isset( $doc[ 'email' ] ) ) {
          $email = filter_var( $doc[ 'email' ], FILTER_SANITIZE_EMAIL );
      }

      if ( !is_string( $email ) || 
           !strlen( $email ) ||
           !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
      {
         $results[ 'status' ] = $addstat . 'Could not find valid email address associated with this user';
      } else {
// update password
         $newpw = base_convert(rand(783641640, 28211099074), 10, 36) . base_convert(rand(78364164096, 2821109907455), 10, 36);

         if ( PHP_VERSION_ID < 50500 )
         {
           $doc[ 'password' ] = crypt( $newpw );
         } else {
           $doc[ 'password' ] = password_hash( $newpw, PASSWORD_DEFAULT );
         }

         $expires = new MongoDate();
         $expires->sec += 60 * 60;

         $update[ '$set' ] = array(
                                  "lastforgotlogin" => $now,
                                  "lastforgotloginip" => isset( $_SERVER[ 'REMOTE_ADDR' ] ) ? $_SERVER[ 'REMOTE_ADDR' ] : "not from an ip",
                                  "password" => $doc[ 'password' ], 
                                  "expiretimes" => 1, 
                                  "expiretime" => $expires
                                  );

         $update[ '$unset' ] = array(
                                    "lastfailedloginattempts" => 0
                                    );
         try {
            $coll->update( array( "name" => $userid ),
                           $update, array("j" => true ) );
         } catch(MongoCursorException $e) {
            $results[ 'error' ]  = "Error updating the database." . $e->getMessage();
            $results[ 'status' ] = $addstat . "Unable to reset password";
            echo (json_encode($results));
            unset( $results[ '-close' ] );
            exit();
         }
 
         require_once "../mail.php";
         $body = "Now: " . $newpw . "\nExpires in one hour or one use\nPlease change after login";

         if ( mymail( $email, 'reminder', $body ) )
         {
            $results[ 'error' ]  = "Could not send email, mail server is down or not accepting requests";
            $results[ 'status' ] = $addstat . "Unable to login or send password email";
         } else {
            $results[ 'status' ] = $addstat . "Check your registered email address";
         }
      }
   } else {
      $update[ '$set' ] = array(
                                "lastfailedlogin" => $now,
                                "lastfailedloginip" => $_SERVER[ 'REMOTE_ADDR' ]
                                );
      if ( isset( $doc[ 'lastfailedloginattempts' ] ) )
      {
         $update[ '$inc' ][ 'lastfailedloginattempts' ] = 1;
      } else {
         $update[ '$set' ][ 'lastfailedloginattempts' ] = 1;
      }
      try {
         $coll->update( array( "name" => $userid ),
                        $update, array("j" => true ) );
      } catch(MongoCursorException $e) {
         $results[ 'error' ]  = "Error updating the database. " . $e->getMessage();
         echo (json_encode($results));
         exit();
      }
   }
}

# $results[ 'sessionid' ] = session_id();
echo (json_encode($results));
exit();
?>
