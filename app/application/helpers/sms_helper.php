<?php
function sendsms($message, $mobile_no, $tempid) {
    $xml_data = '<?xml version="1.0"?>
        <parent>
            <child>
                <user>aipl123</user>
                <key>a8fdcfc6c4XX</key>
                <mobile>+91' . $mobile_no . '</mobile>
                <message>' . $message . '</message>
                <entityid>1701175515408332082</entityid>
                <tempid>'.$tempid.'</tempid>
                <accusage>1</accusage>
                <senderid>ACEAWS</senderid>
            </child>
        </parent>';
    $URL = "https://sms.otechnonix.com/submitsms.jsp?";
    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}
function epinvendorValidator() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $epin = 'V'.substr(str_shuffle($str_result), 0, 5);
    $epinCount = $CI->Crud->ciCount("seller", " `epin` = '$epin'");
    if ($epinCount > 0) {
        epinvendorValidator();
    }  else {
            return $epin;
        }
}

function epinValidator() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $epin = 'D'.substr(str_shuffle($str_result), 0, 10);
    $epinCount = $CI->Crud->ciCount("users", " `epin` = '$epin'");
    if ($epinCount > 0) {
        epinValidator();
    } else {
        $epinCountEpin = $CI->Crud->ciCount("epins", " `epin` = '$epin'");
        if ($epinCountEpin > 0) {
            epinValidator();
        } else {
            return $epin;
        }
    }
}

function generateComboCode() {
    $CI = &get_instance();
    $str_result = '0123456789';
    $comboCode = "C" . substr(str_shuffle($str_result), 0, 8);
    $comboCount = $CI->Crud->ciCount("combos", " `combo_code` = '$comboCode'");
    if ($comboCount > 0) {
        generateComboCode();
    } else {
        $comboCountCombo = $CI->Crud->ciCount("combos", " `combo_code` = '$comboCode'");
        if ($comboCountCombo > 0) {
            generateComboCode();
        } else {
            return $comboCode;
        }
    }
}

function diffInMonths($date1, $date2) {
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);

    $diff = $date1->diff($date2);

    $difference = (int)($diff->format('%y') * 12) + $diff->format('%m');
    return $difference == 0 ? 1 : $difference;
}

function getBadges($epin) {
    $CI = &get_instance();
    $userDetails = $CI->Crud->ciRead('users', " `epin` = '$epin'");
    $badge = '';
    if ($userDetails[0]->is_silver == 1) {
        $badge .= '<span class="badge badge-secondary">Silver</span>';
    }
    if ($userDetails[0]->is_gold == 1) {
        $badge .= '&nbsp;<span class="badge badge-warning">Gold</span>';
    }
    return $badge;
}
