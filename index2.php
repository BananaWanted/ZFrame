<?php

/* 
 * Copyright 2015 master.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

session_start();
if ($_SERVER['REMOTE_ADDR'] != '219.225.40.233')
    die;
?>
<img src="http://mad.daftme.com/preload.php?_=1428910480627&collegeID=CUGB">
<form action="http://mad.daftme.com/load.php" method="POST">
    <input type="text" name="verification">
    <input type="hidden" name="collegeID" value="CUGB">
    <input type="hidden" name="username" value="1004135223">
    <input type="hidden" name="password" value="101314">
    <input type="submit" value="submit">
</form>
<pre>
    <?php
    echo $_SESSION["remote_cookie"];
    echo "\n";
    echo $_SERVER['REMOTE_ADDR']
    ?>
</pre>