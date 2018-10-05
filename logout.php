<?php
session_start();
  if ( isset( $_COOKIE[session_name()] ) ) {
    //clear cookie off client pc
    setcookie( session_name(), "", time()-3600, "/" );
    unset($_SESSION);
     //clear session from disk
    session_destroy();
    }

    header("Location: ./index.php");




?>