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
        // $user_agent = 'Mozilla/5.0 (compatible; 008/0.83; http://www.80legs.com/spider.html;) Gecko/2008032620';
        $user_agent = 'insomnia/2023.4.0';

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
            CURLOPT_COOKIE => "prod_nc2_ecom_nespresso_com-STICKED-TO=s33; akavpau_general_waiting_room=1691329441~id=c0322698e9d4aa9fa3c3432a9a0e58c9; akacd_www.nespresso.com=3868762722~rv=13~id=f6ea788086299aedc97bd8e5e7e89222; JSESSIONID=2E5DD11D612B18877BB163853E43A853; CKI_LANGUAGE=ja; CKI_MARKET=jp; ak_bmsc=1908B4A4941B9003E8CF0573E919A6B8~000000000000000000000000000000~YAAQTqrBF8fcOYuJAQAAOWENyxQh6E9a4enit3wdN8U3eYoirkasnqi+tAwkEo8cJtCVy8OzaZr5NBd4Q0H3fK71efdhJ2uAneAyXhgJ4/bB80yEL76InT2iOLRqkR6o5dsf5e13Oo9N3FIN4cEdSH8rsP7F/LjD6f/JiBZsNAfX6OU+HDesBk+PHOZo/8BWFcppBDax176hxPku2SQqAfYctIP7w5EvJYhT4KeSie7AEo4i/Ojc0Y+FHdlq3E2MJiqPtf6xzOHpoDbG/3vA/h8RVBucKau1PaCkFTw8lb9gCPoEvTE2kcskTnqdvCJ1f67yv6mtAWMo2pI8xNMqbhDGq6olYxnULL+3nD+Q5ewcSkHuIRxam9ojnR/Zbq7B1oAdDMNrK3FV5X6eUYSq; bm_sv=19782B186B87BE884A32E47F6B0AF874~YAAQTqrBFyUEOouJAQAAS5sSyxS+waWOKeEcdSa5D2aS+EvWmkmxNXFez0QFzVdMFE1iOy1pNvUrabXR1kSTxr/gUvWPS4anyPmpLT/eIz9cf3AdR5Xpi0aVw2u4difJntdraLQHi4ooA49woWcJZB3TfqeThHF/msfTLvNYZ/5HP8t+t7LiwnQj51L3FIyGRQ5F6++L/6Il1z4hRmY2vQOTIR90YullRA54N0syAsxkLgQ8YUhBuh0PKoevCk6exFCY~1; bm_sz=FA0C6BEE87FD0CB5609BB9A147EBA805~YAAQTqrBF8ncOYuJAQAAOWENyxTjpra6Mgzp7D8JNlKDfCnIoG45/Jpb7AYHDIBo6wQLYvJR5WOmlbUAirhxdT7tTMweOrqPhGklKus6QOHGfAL4YT7bdp3jWsEyGjRkvR/qAN4cjYsU6+dRZm/ado8US4vqZK0wRtVTDF8m57t0mxdgFJbxFMYRxEp1GFHitsPEvQ50CN941tAltZ6XGwMQEpPvL8BEr5cQjp+Fb54dnGJ+lS0DCpBmK/jJp1yUJ0G7g7vvtHAEebba4DD2nE/AQMI5aDEzMrikbTF4xXk2JChMlck=~3687489~4276533; bm_mi=D1FD779747D7375987BC619B6185D724~YAAQTqrBFyQEOouJAQAAS5sSyxRmSZGWz6QjQkASL91USrMiojCTHkFF2DiN/qWxVCBslHWEJ+t3uE/dwvcqmnIg1kgDTEx50Yz6ZL3s4eGQDPSLF4CNirJx8owIk8/O6cKsRcTUjhrn8JrzTedi/83Ycr3LRAGX7Fn5iOam4XorgDKOUFa7Lh/+aQmkiioXJkeFtdPybV9PX91ayxZIKmaRQCTXwxqKg7U9YmjTkV8bKkSP5oDnh/+js3gnr6S2iWy4z5zzlM/7nGvj+2aCHSbp+6FQ2eJKYgZZsudTTUW8HtnORH0I8tAcwxkJxt9KX7fRdwzfwY3by6fUPXeKs/YN/ofwdVddJ4cZtd6X~1; _abck=E4D8718D472FC4139E47AA31A8A250E3~-1~YAAQTqrBF8bcOYuJAQAAOWENywrNLARZm77e+t/flyy44GG1rT5jBARhHML3qegLrbe9hXnuG5j/G8KXV/cBS/ZyS1Ry5FjBrminUIgUImxVXt8fthP7kgYEMhtRhjM3jUCCjzN1tLgeYfxXLxxyg1Izxc4X+WO8uT5/cKdmhoRQQ8fgj9b6wj9XKGWFRD/YPfX7hxHucbwQYQCWqWSgE/OnBUnAbb2FHNb5b9fzX/Sv9PeXiTajHh/Y1NBnKVUWURDwOB/LdBetK5aqvcixMHF+QAT50GUK4L3X+9TyZOWL+BJ8hfIHERzYYgd+yWyjxNmGaNSFVcw/4/xz2b98cDMh37kSXDcl0BWen2skvVomi/t4mY3k+sxAA8UH8F2557kQ3QAcucqlpA==~-1~-1~1691313458",
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