<?php
    session_start();
    session_destroy();
    header('Location: /AulasWeb/Lab-OAuth/');
?>