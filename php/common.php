<?php
    function getTargetHTML($url = false, $useragent_type = "") {
        if ($url) {
            if ($useragent_type == 'nesp') {
                $site_raw = getPageHTML_curl_nesp($url);
            } else {
                $site_raw = getPageHTML_curl($url);
            }
            
            // $site_raw = file_get_contents_curl($url);
            if ($site_raw[0] != "[") {
                $site_raw = htmlspecialchars($site_raw);
                $values = ['html' => $site_raw];
                echo json_encode($values);
            } else {
                $values = ['html' => $site_raw];
                echo json_encode($values);
            }
        } else {
            echo false;
        }
    }


    // Get target webpage using customized CURL method
    function getPageHTML_curl($url, $http_header = []) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        if (!empty($http_header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $http_header);
        }
        
        $output = curl_exec($curl);
        $retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($retcode == 200) {
            return $output;
        } else {
            return "[".$retcode."]";
        }
    }

    function getPageHTML_curl_nesp ($url) {
        $curl = curl_init();
        $user_agent = 'Mozilla/5.0 (compatible; 008/0.83; http://www.80legs.com/spider.html;) Gecko/2008032620';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $user_agent, 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_COOKIE => "akacd_www.nespresso.com=3868762722~rv%3D13~id%3Df6ea788086299aedc97bd8e5e7e89222; akavpau_general_waiting_room=1691319171~id%3D7c08b27de9f8074ffe17b7eedf858ec1; _abck=E4D8718D472FC4139E47AA31A8A250E3~-1~YAAQESYHYO8HQZ%2BJAQAAuWDtyQpb%2BTFfcKKJ%2FSdB8799Znb%2BdcCJpuphDMSCAP8Lbl%2BsDkgkRlVOIPO5vKUbgtHkpiC5Xn6KU4Q0lDXBkosS%2BqxrTE5cBRMDGGqJVGf0%2BaxaGhFU%2BLBlT9gx9llrDAYwloXkBcHsqTGcrSMe8Z6A8r6S43VGbUJKrCChBow7l6m1uOshcmbS43%2Fpz6yKQbv2nhDgVCKwWEwdDVUPPdoVWKa9SlzTo2bxhlhicFwfl8sZGwH1SS7XFVJsV%2BcA4NL90FSYD67hY2P6YObUOmoNvDj9j5psjwpLY7GNS4%2F6jSDznSojfdF9kaGUo6s0JEFxqC7C%2FmDk8DBgE%2BT3paJjDNFVNJeVPitpNuM%3D~-1~-1~1691313458; bm_sz=4935BE4367CC036382B5CBA1FFD29598~YAAQESYHYPIHQZ%2BJAQAAuWDtyRTznyG4bEzdXAKYMNqS%2BWMYhl1ltUMGyLUwHIMY4HYGqPe4HIqcQjx5QCVcK%2BBGP%2BYKEVCcRKFpvv8mhOmR%2FzG%2FyA7pVVS7Pfs3XDjn7CydjRHlIMtIjJD8qB13Pl4y2GKEIYgd6%2FUECzEnGX71GZEmpzmTyznB3mJayQ%2BPpBatcHdkMkOJxLnVuxQugWcMpDkEjJ4ueVm33E1AQp%2BqlnWlbreZLEUW07eI8%2FR0PjwYkd5C3YhKVftO8bQxr6CqZVhB54RWX2Q%2FxRFDGveSjkQYU3E%3D~3486260~3753030; JSESSIONID=2E5DD11D612B18877BB163853E43A853; CKI_LANGUAGE=ja; CKI_MARKET=jp; prod_nc2_ecom_nespresso_com-STICKED-TO=s33",
        ]);

        $response = curl_exec($curl);
        $retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($retcode == 200) {
            return $response;
        } else {
            return "[".$retcode."]";
        }
    }

    // Get Contents using CURL method
if (!function_exists('file_get_contents_curl')) {
    function file_get_contents_curl($url, $http_header = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        if (!empty($http_header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        }

        $data = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($retcode == 200) {
            return $data;
        } else {
            return "[".$retcode."]";
        }
    }
}