<?php
 $db = mysqli_connect('127.0.0.1:3307', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'scms' ) or die(mysqli_error($db));
        