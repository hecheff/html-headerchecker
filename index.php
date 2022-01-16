<?php include("./php/common.php"); ?>
<html>
    <head>
        <title>HTML Header Checker</title>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="./js/main.js"></script>
    </head>
    <body>
        <div class="wrapper_main">
            <div class="section">
                <div class="wrapper">
                    A simple application which reads and outputs HTML header data from given target URL. <br>
                    Used for tracking output behavior via CURL.
                </div>
            </div>
            <div class="section main_panel">
                <div class="wrapper">
                    <table>
                        <tr><th colspan="3" class="title">
                            Insert target URL here
                        </th></tr>
                        <tr>
                            <td width="75%"><input type="text" id="target_url" style="width: 100%; padding: 8px;" placeholder="Example: https://haroplanet.online"></td>
                            <td width="15%">
                                <select id="useragent_type">
                                    <option value="">Default</option>
                                    <option value="nesp">Nesp</option>
                                </select>
                            </td>
                            <td width="10%"><button id="button_exec" style="width: 100%;" onclick="getHTML();">Get HTML</button></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="section output_panel">
                <div class="wrapper">
                    <table>
                        <tr><td>
                            <textArea id="output_html"></textArea>
                        </td></tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>