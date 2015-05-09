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

defined('_ZEXEC') or define("_ZEXEC", 1);
require_once '../base.php';
session_start();

if (!isset($_SESSION['MC'])) {
    $_SESSION['MC'] = new McMyAdmin('http://mc.fuckcugb.com/data.json');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Connect McMyAdmin</title>
        <script src="../libraries/jquery.js"></script>
        <script src="../libraries/call.js"></script>
        <script>
            // Global Log Container.
            var log = $('#log');
            function fill() {
                var argsT = $('#fill input]').val().split(" ");
                if (argsT.length > 11) {
                    argsT.push(true);
                }
                exec('Fill', argsT, function (data) {
                    console.log('Fill: ');
                    console.log(data);
                    getMsg();
                }, 'MC', 'session', function (xhr, str) {
                    console.log('Fill Ajax Error:' + str);
                });
            }
            function login() {
                exec('Login', [$('#login input[name=username]').val(), $('#login input[name=password]').val()], function (data) {
                    if (data.status == true) {
                        addMsg('Login success.');
                        getMsg();
                    }
                    console.log('Login: ');
                    console.log(data);
                }, 'MC', 'session', function (xhr, str) {
                    console.log('Login Ajax Error:' + str);
                });
            }
            function chat() {
                exec('SendChat', [$('#chat textarea').val()], function (data) {
                    console.log('SendChat: ');
                    console.log(data);
                    getMsg();
                }, 'MC', 'session', function (xhr, str) {
                    console.log('SendChat Ajax Error:' + str);
                });
            }
            function getMsg() {
                exec('GetChat', [], function (data) {
                    if (Object.prototype.toString.call(data) === '[object Array]') {
                        data.forEach(function (obj) {
                            addMsg(obj.user + " " + obj.message);
                        });
                    } else {
                        addMsg('getMsg return value failed.')
                    }
                }, 'MC', 'session');
            }
            function addMsg(str) {
                var node = $('<p></p>');
                node.html(str);
                log.append((node));
            }
            function test() {
                // console.log('test start.');
                exec('hello', ['EXEC'], function (data) {
                    console.log('hello success.');
                    console.log(data);
                }, null, null, function (xhr, str) {
                    console.log('error: ' + str);
                });
                // console.log('test end.');
            }
        </script>
    </head>
    <body>
        <div id="login">
            <h2>Login:</h2>
            <label>Username:</label>
            <input type="text" name="username">
            <label>Password:</label>
            <input type="password" name="password">
            <button onclick="login()">Login</button>
        </div>
        <div id="chat">
            <h2>Chat:</h2>
            <textarea value=""></textarea>
            <button onclick="chat()">Send</button>
        </div>
        <div id="fill">
            <h2>Fill:</h2>
            <span>/fill &nbsp;<input type="text"></span>
            <button onclick="fill()">Fill</button>
        </div>
        <div id="test" style="disply:none;">
            <button onclick="test()">TEST</button>
        </div>
        <div id="log"></div>
    </body>
    <script>
        $(document).ready(function () {
            setInterval(getMsg, 3000);
            log = $('#log')
        });
    </script>
</html>