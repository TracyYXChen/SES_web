<?php

date_default_timezone_set("UTC");

function db_connect( $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   if ( !isset( $use_db ) )
   {
      try {
         $use_db = new MongoClient(
         
         
         );
      } catch ( Exception $e ) {
         $db_errors = "Could not connect to the db " . $e->getMessage();
         if ( $error_json_exit )
         {
            $results = array( "error" => $db_errors );
            $results[ '_status' ] = 'complete';
            echo (json_encode($results));
            exit();
         }
         return false;
      }
   }

   return true;
}

function logjobstart( $error_json_exit = false, $cache = "" )
{
   global $use_db;
   global $db_errors;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }
   $coll = $use_db->ses->jobs;

   $now = new MongoDate();

   $insert[ '_id'          ] = $_REQUEST[ '_uuid'    ];
   $insert[ 'menu'         ] = $GLOBALS[ 'menu'      ];
   $insert[ 'module'       ] = $GLOBALS[ 'module'    ];
   $insert[ 'project'      ] = $GLOBALS[ 'project'   ];
   $insert[ 'user'         ] = $GLOBALS[ 'logon'     ];
   $insert[ 'directory'    ] = $GLOBALS[ 'dir'       ];
   $insert[ 'directorylog' ] = $GLOBALS[ 'logdir'    ];
   $insert[ 'command'      ] = $GLOBALS[ 'command'   ];
   $insert[ 'resource'     ] = $GLOBALS[ 'resource'  ];
   $insert[ 'jobweight'    ] = $GLOBALS[ 'jobweight' ];
   if ( isset( $GLOBALS[ "numproc" ] ) ) {
       $insert[ 'numprocs'    ] = $GLOBALS[ 'numproc' ];
   }
   if ( isset( $GLOBALS[ "xsedeproject" ] ) ) {
       $insert[ 'xsedeproject'  ] = $GLOBALS[ 'xsedeproject' ];
   }
   $insert[ 'when'         ] = Array( $now );
   $insert[ 'start'        ] = $now;
   $insert[ 'status'       ] = Array( "started" );
   $insert[ 'remoteip'     ] = $GLOBALS[ 'REMOTE_ADDR' ];
   if ( !empty( $cache ) ) {
      $insert[ 'cache'     ] = $cache;
   }
   if ( isset( $GLOBALS[ 'modal' ] ) && $GLOBALS[ 'modal' ] ) {
       $insert[ 'modal' ] = true;
   }
   if ( isset( $GLOBALS[ 'notify' ] ) && $GLOBALS[ 'notify' ] ) {
       $insert[ 'notify' ] = $GLOBALS[ 'notify' ];
   }

   try {
      $coll->insert( $insert, array("j" => true ) );
   } catch(MongoCursorException $e) {
      $db_error = "Error updating the database. " . $e->getMessage();
      if ( $error_json_exit )
      {
         $results[ 'error' ] .= $db_error;
         $results[ '_status' ] = 'complete';
         echo (json_encode($results));
         exit();
      }
      return false;
   }
   return true;
}   

function logjobupdate( $status, $log_end = false, $error_json_exit = false, $uuid = false )
{
   global $use_db;
   global $db_errors;

   $GLOBALS['wascancelled'] = false;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }
   $coll = $use_db->ses->jobs;

   $now = new MongoDate();
   $uuid = $uuid ? $uuid : $_REQUEST[ '_uuid' ];
   

   $update[ '$push' ][ 'when'    ] = $now;
   $update[ '$push' ][ 'status'  ] = $status;
   if ( $log_end )
   {
       $update[ '$set' ][ 'end' ] = $now;
       if ( $doc = $coll->findOne( array( "_id" => $uuid ) ) )
       {
           if ( in_array( "cancelled", $doc[ 'status' ] ) ) {
               
               $GLOBALS['wascancelled'] = true;
               return true;
           }
           $update[ '$set' ][ 'duration' ] = $now->sec + $now->usec * 1.0e-6 - $doc[ 'start' ]->sec - $doc[ 'start' ]->usec * 1.0e-6;
       }
   }
   
   try {
      $coll->update( array( "_id" => $uuid ), 
                            $update, array("j" => true ) );
   } catch(MongoCursorException $e) {
      $db_errors = "Error updating the database in logjobupdate(). " . $e->getMessage();
      if ( $error_json_exit )
      {
         $results[ 'error' ] = $db_errors;
         $results[ '_status' ] = 'complete';
         echo (json_encode($results));
         exit();
      }
      return false;
   }
   return true;
}

function logcache( $uuid, $error_json_exit = false ) {
    
    global $use_db;
    global $db_errors;

    if ( !db_connect( $error_json_exit ) )
    {
        if ( $error_json_exit )
        {
            $results[ 'error' ] = $db_errors;
            $results[ '_status' ] = 'complete';
            echo (json_encode($results));
            exit();
        }
        return false;
    }
    $coll = $use_db->ses->cache;

    $now = new MongoDate();
    
    $key = $GLOBALS[ 'module' ] . "/" . $GLOBALS[ "getmenumoduleproject" ] . "/" . ( $GLOBALS[ 'cache' ] == "public" ? "_public" : $GLOBALS[ 'logon' ] );

    $update[ '_id'          ] = $key;
    $update[ 'jobid'        ] = $uuid;
    $update[ 'module'       ] = $GLOBALS[ 'module' ];
    $update[ 'menu'         ] = $GLOBALS[ 'menu' ];
    $update[ 'project'      ] = $GLOBALS[ "getmenumoduleproject" ];

    try {
        $coll->update( array( "_id" => $key ), 
                       $update,
                       array( "upsert" => true, "j" => true ) );
    } catch(MongoCursorException $e) {
      $db_errors = "Error updating the database in logcache(). " . $e->getMessage();
      if ( $error_json_exit )
      {
         $results[ 'error' ] = $db_errors;
         $results[ '_status' ] = 'complete';
         echo (json_encode($results));
         exit();
      }
      return false;
   }
   return true;
}

function cache_check( $key, $error_json_exit = false ) {
    
    global $use_db;
    global $db_errors;

    if ( !db_connect( $error_json_exit ) )
    {
        if ( $error_json_exit )
        {
            $results[ 'error' ] = $db_errors;
            $results[ '_status' ] = 'complete';
            echo (json_encode($results));
            exit();
        }
        return false;
    }
    $coll = $use_db->ses->cache;

    if ( $doc = $coll->findOne( array( "_id" => "$key/_public" ) ) ) {
        
        $GLOBALS[ "cached_uuid" ] = $doc[ "jobid" ];
        return true;
    } 
    if ( $doc = $coll->findOne( array( "_id" => "$key/" . $GLOBALS[ 'logon' ] ) ) ) {
        
        $GLOBALS[ "cached_uuid" ] = $doc[ "jobid" ];
        return true;
    } 
    return false;
}

function jqgrid_jobs( $error_json_exit = false, $user = NULL )
{
   global $use_db;
   global $db_errors;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }

   $coll = $use_db->ses->jobs;

   if ( $GLOBALS[ 'jqgrid_jobs' ] = $coll->find( array( "user" => is_null( $user ) ? $GLOBALS[ 'logon' ] : $user, "deleted" => array( '$exists' => false ) ) ) )
   {
       return true;
   }
   return false;
}

function isprojectlocked( $checkproject,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }

   $coll = $use_db->ses->joblock;

   if ( $doc = $coll->findOne( array( "name" => $checkproject ) ) )
   {
       return true;
   }
   return false;
}

function getprojectdir( $jobid,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }

   $coll = $use_db->ses->jobs;

   if ( $doc = $coll->findOne( array( "_id" => $jobid, "user" => $GLOBALS[ 'logon' ] ) ) )
   {
      if ( isset( $doc[ 'directory' ] ) )
      {
         $GLOBALS[ "getprojectdir" ] = $doc[ 'directory' ];
         $GLOBALS[ "getprojectlogdir" ] = isset( $doc[ 'directorylog' ] ) ? $doc[ 'directorylog' ] : $doc[ 'directory' ];
         return true;
      }
      return false;
   }
   return false;
}

function getmenumodule( $jobid,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   if ( !db_connect( $error_json_exit ) )
   {
       return false;
   }

   $coll = $use_db->ses->jobs;

   // reset user to check if cached module & has permissions ?

   // if ( $doc = $coll->findOne( array( "_id" => $jobid, "user" => $GLOBALS[ 'logon' ] ) ) )
   if ( $doc = $coll->findOne( array( "_id" => $jobid ) ) )
   {
      if ( isset( $doc[ 'menu' ] ) && isset( $doc[ 'module' ] ) )
      {
         $GLOBALS[ "getmenumodule"        ] = $doc[ 'menu' ] . "/" . $doc[ 'module' ];
         $GLOBALS[ "getmenumoduleproject" ] = ( isset( $doc[ 'project'      ] ) && strlen( $doc[ 'project'       ] ) ) ? $doc[ 'project' ] : 'no_project_specified';
         $GLOBALS[ "getmenumoduledir"     ] = ( isset( $doc[ 'directory'    ] ) && strlen( $doc[ 'directory'     ] ) ) ? $doc[ 'directory' ] : '_no_project_dir_';
         $GLOBALS[ "getmenumodulelogdir"  ] = ( isset( $doc[ 'directorylog' ] ) && strlen( $doc[ 'directorylog'  ] ) ) ? $doc[ 'directorylog' ] : $GLOBALS[ "getmenumoduledir" ];
         $GLOBALS[ "getmenumodulestatus"  ] = ( isset( $doc[ 'status'       ] ) && count ( $doc[ 'status'        ] ) ) ? end($doc[ 'status' ] ) : '';
         $GLOBALS[ "wascancelled"         ] = $GLOBALS[ "getmenumodulestatus"  ] == "cancelled";
         $GLOBALS[ "cache"                ] =  isset( $doc[ 'cache' ] ) ? $doc[ 'cache' ] : "";
         $GLOBALS[ "module"               ] = $doc[ 'module' ];
         $GLOBALS[ "menu"                 ] = $doc[ 'menu' ];
         $GLOBALS[ "jobweight"            ] = isset( $doc[ 'jobweight' ] ) ? $doc[ 'jobweight' ] : 0;
         $GLOBALS[ "jobstart"             ] = $doc[ 'start' ];
         if ( isset( $doc[ 'notify' ] ) ) {
             $GLOBALS[ "notify"    ] = $doc[ 'notify' ];
         }
         if ( ( isset( $doc[ 'user' ] ) && $doc[ 'user' ] == $GLOBALS[ 'logon' ] ) ||
              $GLOBALS[ "cache" ] == "public"  ) {
             return true;
         } else {
             $appjson = json_decode( file_get_contents( "/opt/genapp/ses/appconfig.json" ) );
             if ( !isset( $appjson->restricted ) ||
                  !isset( $appjson->restricted->admin ) ||
                  !in_array( $GLOBALS[ 'logon' ], $appjson->restricted->admin ) ) {
                 return false;
             }    
             return true;
         }
      }
      return false;
   }
   return false;
}

function clearprojectlock( $projectdir,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   $GLOBALS[ 'lasterror' ] = "";
   $GLOBALS[ 'lastnotice' ] = "";

   $dk = end( explode( "/", $projectdir ) );
   if ( !isprojectlocked( $projectdir, $error_json_exit ) )
   {
      $GLOBALS[ 'lastnotice' ] = "Project '$dk' is not locked. ";
      return false;
   }

   $coll = $use_db->ses->joblock;

   try {
       $coll->remove( array( "name" => $projectdir ), array( "j" => true, "justOne" => true ));
   } catch(MongoCursorException $e) {
       if ( isprojectlocked( $projectdir, $error_json_exit ) )
       {
           $GLOBALS[ 'lasterror' ] = "Could not remove lock on project '$dk'. " . $e->getMessage();
       } else {
           $GLOBALS[ 'lastnotice' ] = "Project '$dk' is no longer locked. " . $e->getMessage();
           return true;
       }
   }
   return true;
}

function removejob( $jobid, $error_json_exit = false )
{
    global $use_db;
    global $db_errors;

    $GLOBALS[ 'lasterror' ] = "";

    if ( !db_connect( $error_json_exit ) )
    {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    $coll = $use_db->ses->jobs;

    $now = new MongoDate();

    $update[ '$set' ][ 'deleted'    ] = true;
    try {
        $coll->update( array( "_id" => $jobid ), 
                       $update, array("j" => true ) );
    } catch(MongoCursorException $e) {
        $db_errors = "Error updating the database in removejob(). " . $e->getMessage();
        if ( $error_json_exit )
        {
            $results[ 'error' ] = $db_errors;
            $results[ '_status' ] = 'complete';
            echo (json_encode($results));
            exit();
        }
        return false;
    }

    $coll = $use_db->ses->cache;

    if ( null !== $coll->findOne( array( "jobid" => $jobid ) ) ) {
        try { 
            $coll->remove( array( "jobid" => $jobid ), array("j" => true ) );
        } catch(MongoCursorException $e) {
            $db_errors = "Error updating the database in removejob(). " . $e->getMessage();
            if ( $error_json_exit )
            {
                $results[ 'error' ] = $db_errors;
                $results[ '_status' ] = 'complete';
                echo (json_encode($results));
                exit();
            }
            return false;
        }
    }

    return true;
}

/*
function removejob_old( $jobid,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   $GLOBALS[ 'lasterror' ] = "";

   if ( !db_connect( $error_json_exit ) )
   {
      $GLOBALS[ 'lasterror' ] = $db_errors;
      return false;
   }

   $coll = $use_db->ses->jobs;

   try {
      $coll->remove( array( "_id" => $jobid, "user" => $GLOBALS[ 'logon' ] ) );
   } catch(MongoCursorException $e) {
      $GLOBALS[ 'lasterror' ] = "Could not remove job $v. " . $e->getMessage();
      return false;
   }

   try {
      $use_db->msgs->cache->remove( array( "_id" => $jobid ) );
   } catch(MongoCursorException $e) {
//      $GLOBALS[ 'lasterror' ] = "Could not remove job $v. " . $e->getMessage();
//      return false;
   }
   return true;
}
*/

function cached_msg( $jobid,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   $GLOBALS[ 'lasterror' ] = "";
   $GLOBALS[ 'cached_msg' ] = "";

   if ( !db_connect( $error_json_exit ) )
   {
      $GLOBALS[ 'lasterror' ] = $db_errors;
      return false;
   }

   if ( $doc = $use_db->msgs->cache->findOne( array( "_id" => $jobid ) ) )
   {
       $GLOBALS[ 'cached_msg' ] = $doc[ 'data' ];
       return true;
   } else {
       return false;
   }
}   

function cached_progress( $jobid,  $error_json_exit = false )
{
   global $use_db;
   global $db_errors;

   $GLOBALS[ 'lasterror' ] = "";
   $GLOBALS[ 'cached_progress' ] = "";

   if ( !db_connect( $error_json_exit ) )
   {
      $GLOBALS[ 'lasterror' ] = $db_errors;
      return false;
   }

   if ( $doc = $use_db->msgs->cache->findOne( array( "_id" => $jobid ) ) )
   {
      $json = json_decode( $doc[ 'data' ], true );
      if ( isset( $json[ '_progress' ] ) )
      {
         $GLOBALS[ 'cached_progress' ] = $json[ '_progress' ];
         return true;
      }
   }
   return false;
}

// take an array of files and extract the project directories
function get_projects( $files, $error_json_exit = false )
{
    $uniq = array_flip( preg_replace( '/\/.*/', '', $files ) );
    $base = $GLOBALS[ 'dir' ] . $GLOBALS[ 'logon' ] . "/";
    $result = array();
    foreach ( $uniq as $k => $v )
    {
        $result[] = $base . $k;
    }
    return $result;   
}

function get_projects_locked( $files, $error_json_exit = false )
{
    $uniq = array_flip( preg_replace( '/\/.*/', '', $files ) );
    $base = $GLOBALS[ 'dir' ] . $GLOBALS[ 'logon' ] . "/";
    $result = array();
    foreach ( $uniq as $k => $v )
    {
        $projdir = $base . $k;
        if ( isprojectlocked( $projdir, $error_json_exit ) )
        {
            $result[] = $k;
        }
    }
    return $result;
}

function totalweight( $error_json_exit = false ) {
    global $use_db;
    global $db_errors;
    

    if ( !isset( $GLOBALS[ 'logon' ] ) ) {
        return 0;
    }

    $GLOBALS[ 'lasterror' ] = "";

    if ( !db_connect( $error_json_exit ) ) {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    if ( $doc = $use_db->ses->command( 
             [
              'aggregate' => 'joblock',
              'pipeline' =>
              [ [ '$match' =>  [ 'user' => $GLOBALS[ 'logon' ] ] ], [ '$group' => [ '_id' =>  '', 'totalweight' => [ '$sum' => '$jobweight' ] ] ], [ '$project' => [ '_id' => 0, 'totalweight' => '$totalweight' ] ] ]
             ]
         ) ) {
        
        if ( isset( $doc[ 'result' ] ) &&
             isset( $doc[ 'result' ][ 0 ] ) &&
             isset( $doc[ 'result' ][ 0 ][ 'totalweight' ] ) ) {
            return $doc[ 'result' ][ 0 ][ 'totalweight' ];
        }
    }

    return 0;
}

function logrunning( $error_json_exit = false ) {
    global $use_db;
    global $db_errors;

    $GLOBALS[ 'lasterror' ] = "";

    if ( !db_connect( $error_json_exit ) ) {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    if ( !( $doc = $use_db->global->apps->findOne( array( "_id" => "ses" ) ) ) ) {
        try {
            $use_db->global->apps->insert( array( "_id" => "ses" ), array("j" => true ) );
        } catch(MongoCursorException $e) {
            $db_error = "Error updating the database. " . $e->getMessage();
            if ( $error_json_exit )
            {
                $results[ 'error' ] .= $db_error;
                $results[ '_status' ] = 'complete';
                echo (json_encode($results));
                exit();
            }
            return false;
        }
    }

    $set_array = array( '$push' => array( "pid" => array( "where" => "local", "pid" => getmypid(), "what" => "parent" ) ) );

    if ( 0 && 
         $doc = $use_db->ses->jobs->findOne( 
             array( "_id" => $_REQUEST[ '_uuid' ], "user" => $GLOBALS[ 'logon' ] ),
             array( "xsedeproject" => 1 )
         ) )
    {
        $set_array[ '$set' ] = array( "xsedeproject" =>  $doc[ 'xsedeproject' ] );
    }

    try {
        $use_db->ses->running->update(
            array( "_id" => $_REQUEST[ '_uuid' ], "user" => $GLOBALS[ 'logon' ] ),
            $set_array,
            array( "upsert" => true, "j" => true )
            );
    } catch( MongoCursorException $e ) {
        $GLOBALS[ 'lasterror' ]  = "Error updating. " . $e->getMessage();
        return false;
    }

    return true;
}

function logrunningresource( $uuid, $resource, $nodes, $nodesppn, $error_json_exit = false ) {
    global $use_db;
    global $db_errors;

    $GLOBALS[ 'lasterror' ] = "";

    if ( !db_connect( $error_json_exit ) ) {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    if ( 0 && 
         $doc = $use_db->ses->jobs->findOne(
             array( "_id" => $uuid ),
             array( "xsedeproject" => 1 ) ) ) {

        $update = [];
        $update[ "_id" ] = "ses:$resource:" . $doc[ 'xsedeproject' ];

        try {
            $use_db->global->appresourceproject->update( 
                $update,
                $update,
                array( "upsert" => true, "j" => true ) );
        } catch(MongoCursorException $e) {
            $GLOBALS[ 'lasterror' ]  = "Error updating. " . $e->getMessage();
            return false;
        }
    }

    try {
        $use_db->ses->running->update(
            array( "_id" => $uuid ),
            array( 
                '$set' => array( "resource" => $resource
                                 ,"nodes"   => intval( $nodes )
                                 ,"nodeppn" => intval( $nodesppn ) )
            ),
            array( "upsert" => true, "j" => true ) 
            );
    } catch( MongoCursorException $e ) {
        $GLOBALS[ 'lasterror' ]  = "Error updating. " . $e->getMessage();
        return false;
    }

    try {
        $use_db->ses->jobs->update(
            array( "_id" => $uuid ),
            array( 
                '$set' => array( "numprocs" => intval( $nodes * $nodesppn )
                                 ,"nodes"   => intval( $nodes )
                                 ,"nodeppn" => intval( $nodesppn ) )
            ),
            array( "upsert" => true, "j" => true ) 
            );
    } catch( MongoCursorException $e ) {
        $GLOBALS[ 'lasterror' ]  = "Error updating. " . $e->getMessage();
        return false;
    }

    return true;
}

function logstoprunning( $error_json_exit = false, $uuid = false ) {
    global $use_db;
    global $db_errors;

    $GLOBALS[ 'lasterror' ] = "";

    if ( !db_connect( $error_json_exit ) ) {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    try {
        $use_db->ses->running->remove(
            array( "_id" => $uuid ? $uuid : $_REQUEST[ '_uuid' ] ),
            array( "justOne" => true )
            );
    } catch( MongoCursorException $e ) {
        $GLOBALS[ 'lasterror' ]  = "Error updating. " . $e->getMessage();
        return false;
    }

    return true;
}

function jobcancel( $jobs,  $error_json_exit = false, $is_admin = false ) {
    

    $GLOBALS[ 'lasterror' ] = "";
    $GLOBALS[ 'lastnotice' ] = "";

    global $use_db;
    global $db_errors;

    $appconfig = "/opt/genapp/ses/appconfig.json";
    $appjsona = json_decode( file_get_contents( $appconfig ), true );
    if ( !isset( $appjsona[ 'resources' ] ) ) {
        $GLOBALS[ 'lasterror' ] = "Internal error: could not find resource configuration information in appconfig.json";
        require_once "mail.php";
        error_mail( "[joblog.php jobcancel()] " . $GLOBALS[ 'lasterror' ] );
        return false;
    }
        
    if ( !db_connect( $error_json_exit ) )
    {
        $GLOBALS[ 'lasterror' ] = $db_errors;
        return false;
    }

    $context = new ZMQContext();
    $zmq_socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'ses udp pusher');
    $zmq_socket->connect("tcp://" . $appjsona['messaging']['zmqhostip'] . ":" . $appjsona['messaging']['zmqport'] );

    // $udp_socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    $runs = $use_db->ses->running->find( array( "_id" => array( '$in' => $jobs ) ) );

    $fjobs = array_flip( $jobs );
    $projectdirs  = array();
    $tokillparent = array();
    $tokill       = array();
    $kjobs        = array();

    foreach ( $runs as $v ) {
       $uuid = $v['_id'];
       $job = $use_db->ses->jobs->findOne( array( "_id" => $uuid ) );
       $pids = $v['pid'];
       if ( isset( $v['xsedeproject'] ) ) {
           $xsedeproject = $v['xsedeproject'];
       } else {
           unset( $xsedeproject );
       }

       foreach ( $pids as $k2 => $v2 ) {
           if ( $v2['pid'] < 2 ) {
               require_once "mail.php";
               error_mail( "[joblog.php jobcancel()] invalid pid for kill! " . $v2[ 'pid' ] );
           } else {
               $where = $v2['where'];
               if ( $v2['what'] == "parent" ) {
                   if ( !isset( $tokillparent[ $where ] ) ) {
                       $tokillparent[ $where ] = array( $v2[ 'pid' ] );
                   } else {
                       $tokillparent[ $where ][] = $v2[ 'pid' ];
                   }
               } else {
                   if ( !isset( $tokill[ $where ] ) ) {
                       $tokill[ $where ] = array( $v2[ 'pid' ] );
                   } else {
                       $tokill[ $where ][] = $v2[ 'pid' ];
                   }
               }
           }
       }
       unset( $fjobs[ $uuid ] );
       $kjobs[ $uuid ] = true;
       // send messages also if running about "cancelled"
       // also manually clear job locks and push update to jobs as in jobrun.php

       if ( !logjobupdate( "cancelled", true, $error_json_exit, $uuid ) ) {
           
       }
       logstoprunning( false, $uuid );

       $specmsg = false;

       $cancel_notice = "This job has been cancelled by " . ( $is_admin ? "administrator" : "user" ) . " request";

       if ( isset( $v[ 'resource' ] ) ) {
           if ( $v[ 'resource' ] == "openstack" &&
                isset( $v[ 'nodes' ] ) ) {
               require_once "/var/www/html/ses/openstack/os_delete.php";
               os_delete( $v[ 'nodes' ], $uuid, isset( $xsedeproject ) ? $xsedeproject : $project, true );
               $specmsg = true;
               $zmq_socket->send( json_encode( array( "_uuid" => $uuid,
                                                      "Notice" => $cancel_notice,
                                                      "_cancel" => "true",
                                                      "_status" => "cancelled",
                                                      "_airavata" => ""
                                               ) ) );

           }
       }

       if ( !$specmsg ) {
           $zmq_socket->send( json_encode( array( "_uuid" => $uuid,
                                                  "Notice" => $cancel_notice,
                                                  "_cancel" => "true",
                                                  "_status" => "cancelled" ) ) );
       }

       // $jsonmsg = json_encode( array( "_uuid" => $uuid,
       //                               "Notice" => $cancel_notice,
       //                               "_status" => "cancelled" ) );
       
       // socket_sendto( $udp_socket, $jsonmsg, strlen( $jsonmsg ), 0, $appjsona['messaging'][ 'udphostip' ], $appjsona['messaging']['udpport'] );

       if ( getprojectdir( $uuid ) ) {
           $projectdirs[ $GLOBALS[ 'getprojectdir' ] ] = true;
       }
    }

    foreach ( $tokill as $k => $v ) {
        if ( !isset( $appjsona[ 'resources' ][ $k ] ) ) {
            $GLOBALS[ 'lasterror' ] .= "Resource $k missing from resource configuration information in appconfig.json";
            require_once "mail.php";
            error_mail( "[joblog.php jobcancel()] " . $GLOBALS[ 'lasterror' ] );
        } else {
            $kill = $appjsona[ 'resources' ][ $k ] . " /var/www/html/ses/util/ga_killprocs.pl /var/www/html/ses/log $k all " . implode( ' ', $v );
            
            ob_start();
            exec( $kill, $execout );
            
            ob_end_clean();
        }
    }   

    foreach ( $tokillparent as $k => $v ) {
        if ( !isset( $appjsona[ 'resources' ][ $k ] ) ) {
            $GLOBALS[ 'lasterror' ] .= "Resource $k missing from resource configuration information in appconfig.json";
            require_once "mail.php";
            error_mail( "[joblog.php jobcancel()] " . $GLOBALS[ 'lasterror' ] );
        } else {
            $kill = $appjsona[ 'resources' ][ $k ] . " /var/www/html/ses/util/ga_killprocs.pl /var/www/html/ses/log $k child " . implode( ' ', $v );
            
            ob_start();
            exec( $kill, $execout );
            
            ob_end_clean();
        }
    }   

    // cancel anyway
    foreach ( $fjobs as $k => $v ) {
        $uuid = $k;
        
        if ( !logjobupdate( "cancelled", true, $error_json_exit, $uuid ) ) {
            
        }
    }

    foreach ( $projectdirs as $k => $v ) {
        clearprojectlock( $k );
    }

    $msgs = count( $kjobs ) ? ( "Job id" . ( count( $kjobs ) > 1 ? "s " : " " ) . implode( ",", array_keys( $kjobs ) ) . " cancelled." ) : "";
    $msgs .= count( $fjobs ) ? ( "\nNotice; Job id" . ( count( $fjobs ) > 1 ? "s " : " " ) . implode( ",", array_keys( $fjobs ) ) . " not identified as running, but cancelled anyway." ) : "";

    $GLOBALS[ 'lastnotice' ] = $msgs;
    return true;
}
?>
