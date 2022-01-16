<?php
    function getTargetHTML($url = false, $useragent_type = "") {
        if ($url) {
            $site_raw = file_get_contents_curl($url);
            // $site_raw = getPageHTML_curl($url);
            if ($site_raw[0] != "[") {
                $site_raw = htmlspecialchars($site_raw);
                // $site_raw = htmlspecialchars(getPageHTML_curl($url, $useragent_type));
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
    function getPageHTML_curl($url, $useragent_type = "", $http_header = []) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Set compatible useragent according to given type, otherwise use working default
        if ($useragent_type == "nesp") {
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; 008/0.83; http://www.80legs.com/webcrawler.html) Gecko/2008032620');
            curl_setopt($curl, CURLOPT_REFERER, 'https://www.nespresso.com/jp/ja/');
        } else {
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36');
            curl_setopt($curl, CURLOPT_REFERER, '');
        }
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