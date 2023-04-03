<?php

namespace App\Services;

use App\Models\Address;

function getBirthDayFromBirthInfo($birthDate)
{
    $birthInfo = explode("/", $birthDate);
    return $birthInfo[0];
}

function getBirthMonthFromBirthInfo($birthDate)
{
    $birthInfo = explode("/", $birthDate);
    return $birthInfo[1];
}

function getBirthYearFromBirthInfo($birthDate)
{
    $birthInfo = explode("/", $birthDate);
    return $birthInfo[2];
}

function monthsEng(): array
{
    return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'];
}


function updateUserAddress($userId, $userAddress)
{
    $userAddressInfo = explode(",", $userAddress); //split address into fields
    if (count($userAddressInfo) == 4) {
        $userFullAddress = $userAddressInfo[0];
        $userAddressCity = $userAddressInfo[1];
        $userAddressProvince = $userAddressInfo[2];
        $userAddressCountry = $userAddressInfo[3];
    } else if (count($userAddressInfo) == 3) {
        $userFullAddress = $userAddressInfo[0];
        $userAddressCity = $userAddressInfo[1];
        $userAddressCountry = $userAddressInfo[2];
        $userAddressProvince = "";
    } else if (count($userAddressInfo) == 2) {
        $userFullAddress = $userAddressInfo[0];
        $userAddressCountry = $userAddressInfo[1];
        $userAddressCity = "";
        $userAddressProvince = "";
    }
    //$userPostalCode = $request->input('postalCode');
    //update or create address in address table
    // If there is address information update if not create one with data from form.

    #there are some address invalid
    try {
        $addUserAddressInfo = Address::updateOrCreate(
            ['user_id' => $userId],  //check for an existing record
            ['user_id' => $userId,   //if does not exist create one
                'address_info' => $userFullAddress,
                'city' => $userAddressCity,
                'province' => $userAddressProvince,
                'country' => $userAddressCountry,
                //'postal_code' => $userPostalCode,
            ]);
    } catch (\Exception $exception) {
        return false;
    }
    if (!$addUserAddressInfo) {
        return false;
    }
    return true;
}


function countriesData()
{

    return array(
        'AD' => array('name' => 'ANDORRA', 'code' => '376'),
        'AF' => array('name' => 'AFGHANISTAN', 'code' => '93'),
        'AG' => array('name' => 'ANTIGUA AND BARBUDA', 'code' => '1268'),
        'AI' => array('name' => 'ANGUILLA', 'code' => '1264'),
        'AL' => array('name' => 'ALBANIA', 'code' => '355'),
        'DZ' => array('name' => 'ALGERIA', 'code' => '213'),
        'AM' => array('name' => 'ARMENIA', 'code' => '374'),
        'AO' => array('name' => 'ANGOLA', 'code' => '244'),
        'AQ' => array('name' => 'ANTARCTICA', 'code' => '672'),
        'AR' => array('name' => 'ARGENTINA', 'code' => '54'),
        'AS' => array('name' => 'AMERICAN SAMOA', 'code' => '1684'),
        'AT' => array('name' => 'AUSTRIA', 'code' => '43'),
        'AU' => array('name' => 'AUSTRALIA', 'code' => '61'),
        'AW' => array('name' => 'ARUBA', 'code' => '297'),
        'AZ' => array('name' => 'AZERBAIJAN', 'code' => '994'),
        'BA' => array('name' => 'BOSNIA AND HERZEGOVINA', 'code' => '387'),
        'BB' => array('name' => 'BARBADOS', 'code' => '1246'),
        'BD' => array('name' => 'BANGLADESH', 'code' => '880'),
        'BE' => array('name' => 'BELGIUM', 'code' => '32'),
        'BF' => array('name' => 'BURKINA FASO', 'code' => '226'),
        'BG' => array('name' => 'BULGARIA', 'code' => '359'),
        'BH' => array('name' => 'BAHRAIN', 'code' => '973'),
        'BI' => array('name' => 'BURUNDI', 'code' => '257'),
        'BJ' => array('name' => 'BENIN', 'code' => '229'),
        'BM' => array('name' => 'BERMUDA', 'code' => '1441'),
        'BN' => array('name' => 'BRUNEI DARUSSALAM', 'code' => '673'),
        'BO' => array('name' => 'BOLIVIA', 'code' => '591'),
        'BR' => array('name' => 'BRAZIL', 'code' => '55'),
        'BS' => array('name' => 'BAHAMAS', 'code' => '1242'),
        'BT' => array('name' => 'BHUTAN', 'code' => '975'),
        'BW' => array('name' => 'BOTSWANA', 'code' => '267'),
        'BY' => array('name' => 'BELARUS', 'code' => '375'),
        'BZ' => array('name' => 'BELIZE', 'code' => '501'),
        'CA' => array('name' => 'CANADA', 'code' => '1'),
        'KY' => array('name' => 'CAYMAN ISLANDS', 'code' => '1345'),
        'CC' => array('name' => 'COCOS (KEELING) ISLANDS', 'code' => '61'),
        'CD' => array('name' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'code' => '243'),
        'CF' => array('name' => 'CENTRAL AFRICAN REPUBLIC', 'code' => '236'),
        'CG' => array('name' => 'CONGO', 'code' => '242'),
        'CI' => array('name' => 'COTE D IVOIRE', 'code' => '225'),
        'CK' => array('name' => 'COOK ISLANDS', 'code' => '682'),
        'CL' => array('name' => 'CHILE', 'code' => '56'),
        'CM' => array('name' => 'CAMEROON', 'code' => '237'),
        'CN' => array('name' => 'CHINA', 'code' => '86'),
        'CO' => array('name' => 'COLOMBIA', 'code' => '57'),
        'CR' => array('name' => 'COSTA RICA', 'code' => '506'),
        'KM' => array('name' => 'COMOROS', 'code' => '269'),
        'CU' => array('name' => 'CUBA', 'code' => '53'),
        'CV' => array('name' => 'CAPE VERDE', 'code' => '238'),
        'KH' => array('name' => 'CAMBODIA', 'code' => '855'),
        'CX' => array('name' => 'CHRISTMAS ISLAND', 'code' => '61'),
        'TD' => array('name' => 'CHAD', 'code' => '235'),
        'HR' => array('name' => 'CROATIA', 'code' => '385'),
        'CY' => array('name' => 'CYPRUS', 'code' => '357'),
        'CZ' => array('name' => 'CZECH REPUBLIC', 'code' => '420'),
        'DJ' => array('name' => 'DJIBOUTI', 'code' => '253'),
        'DK' => array('name' => 'DENMARK', 'code' => '45'),
        'DM' => array('name' => 'DOMINICA', 'code' => '1767'),
        'DO' => array('name' => 'DOMINICAN REPUBLIC', 'code' => '1809'),
        'EC' => array('name' => 'ECUADOR', 'code' => '593'),
        'EE' => array('name' => 'ESTONIA', 'code' => '372'),
        'EG' => array('name' => 'EGYPT', 'code' => '20'),
        'ER' => array('name' => 'ERITREA', 'code' => '291'),
        'ET' => array('name' => 'ETHIOPIA', 'code' => '251'),
        'GQ' => array('name' => 'EQUATORIAL GUINEA', 'code' => '240'),
        'SV' => array('name' => 'EL SALVADOR', 'code' => '503'),
        'FI' => array('name' => 'FINLAND', 'code' => '358'),
        'FJ' => array('name' => 'FIJI', 'code' => '679'),
        'FK' => array('name' => 'FALKLAND ISLANDS (MALVINAS)', 'code' => '500'),
        'FO' => array('name' => 'FAROE ISLANDS', 'code' => '298'),
        'FR' => array('name' => 'FRANCE', 'code' => '33'),
        'PF' => array('name' => 'FRENCH POLYNESIA', 'code' => '689'),
        'GA' => array('name' => 'GABON', 'code' => '241'),
        'GD' => array('name' => 'GRENADA', 'code' => '1473'),
        'GE' => array('name' => 'GEORGIA', 'code' => '995'),
        'DE' => array('name' => 'GERMANY', 'code' => '49'),
        'GH' => array('name' => 'GHANA', 'code' => '233'),
        'GI' => array('name' => 'GIBRALTAR', 'code' => '350'),
        'GL' => array('name' => 'GREENLAND', 'code' => '299'),
        'GM' => array('name' => 'GAMBIA', 'code' => '220'),
        'GN' => array('name' => 'GUINEA', 'code' => '224'),
        'GR' => array('name' => 'GREECE', 'code' => '30'),
        'GT' => array('name' => 'GUATEMALA', 'code' => '502'),
        'GU' => array('name' => 'GUAM', 'code' => '1671'),
        'GW' => array('name' => 'GUINEA-BISSAU', 'code' => '245'),
        'GY' => array('name' => 'GUYANA', 'code' => '592'),
        'HK' => array('name' => 'HONG KONG', 'code' => '852'),
        'HN' => array('name' => 'HONDURAS', 'code' => '504'),
        'HT' => array('name' => 'HAITI', 'code' => '509'),
        'HU' => array('name' => 'HUNGARY', 'code' => '36'),
        'VA' => array('name' => 'HOLY SEE (VATICAN CITY STATE)', 'code' => '39'),
        'ID' => array('name' => 'INDONESIA', 'code' => '62'),
        'IE' => array('name' => 'IRELAND', 'code' => '353'),
        'IL' => array('name' => 'ISRAEL', 'code' => '972'),
        'IM' => array('name' => 'ISLE OF MAN', 'code' => '44'),
        'IN' => array('name' => 'INDIA', 'code' => '91'),
        'IQ' => array('name' => 'IRAQ', 'code' => '964'),
        'IR' => array('name' => 'IRAN, ISLAMIC REPUBLIC OF', 'code' => '98'),
        'IS' => array('name' => 'ICELAND', 'code' => '354'),
        'IT' => array('name' => 'ITALY', 'code' => '39'),
        'JM' => array('name' => 'JAMAICA', 'code' => '1876'),
        'JO' => array('name' => 'JORDAN', 'code' => '962'),
        'JP' => array('name' => 'JAPAN', 'code' => '81'),
        'KE' => array('name' => 'KENYA', 'code' => '254'),
        'KG' => array('name' => 'KYRGYZSTAN', 'code' => '996'),
        'KI' => array('name' => 'KIRIBATI', 'code' => '686'),
        'KP' => array('name' => 'KOREA DEMOCRATIC PEOPLES REPUBLIC OF', 'code' => '850'),
        'KR' => array('name' => 'KOREA REPUBLIC OF', 'code' => '82'),
        'KW' => array('name' => 'KUWAIT', 'code' => '965'),
        'KZ' => array('name' => 'KAZAKSTAN', 'code' => '7'),
        'XK' => array('name' => 'KOSOVO', 'code' => '381'),
        'LA' => array('name' => 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'code' => '856'),
        'LB' => array('name' => 'LEBANON', 'code' => '961'),
        'LR' => array('name' => 'LIBERIA', 'code' => '231'),
        'LS' => array('name' => 'LESOTHO', 'code' => '266'),
        'LT' => array('name' => 'LITHUANIA', 'code' => '370'),
        'LU' => array('name' => 'LUXEMBOURG', 'code' => '352'),
        'LV' => array('name' => 'LATVIA', 'code' => '371'),
        'LY' => array('name' => 'LIBYAN ARAB JAMAHIRIYA', 'code' => '218'),
        'LI' => array('name' => 'LIECHTENSTEIN', 'code' => '423'),
        'MA' => array('name' => 'MOROCCO', 'code' => '212'),
        'MC' => array('name' => 'MONACO', 'code' => '377'),
        'MD' => array('name' => 'MOLDOVA, REPUBLIC OF', 'code' => '373'),
        'ME' => array('name' => 'MONTENEGRO', 'code' => '382'),
        'FM' => array('name' => 'MICRONESIA, FEDERATED STATES OF', 'code' => '691'),
        'MG' => array('name' => 'MADAGASCAR', 'code' => '261'),
        'MH' => array('name' => 'MARSHALL ISLANDS', 'code' => '692'),
        'MK' => array('name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'code' => '389'),
        'ML' => array('name' => 'MALI', 'code' => '223'),
        'MM' => array('name' => 'MYANMAR', 'code' => '95'),
        'MN' => array('name' => 'MONGOLIA', 'code' => '976'),
        'MO' => array('name' => 'MACAU', 'code' => '853'),
        'MP' => array('name' => 'NORTHERN MARIANA ISLANDS', 'code' => '1670'),
        'MR' => array('name' => 'MAURITANIA', 'code' => '222'),
        'MS' => array('name' => 'MONTSERRAT', 'code' => '1664'),
        'MT' => array('name' => 'MALTA', 'code' => '356'),
        'MU' => array('name' => 'MAURITIUS', 'code' => '230'),
        'MV' => array('name' => 'MALDIVES', 'code' => '960'),
        'MW' => array('name' => 'MALAWI', 'code' => '265'),
        'YT' => array('name' => 'MAYOTTE', 'code' => '262'),
        'MY' => array('name' => 'MALAYSIA', 'code' => '60'),
        'MX' => array('name' => 'MEXICO', 'code' => '52'),
        'MZ' => array('name' => 'MOZAMBIQUE', 'code' => '258'),
        'NA' => array('name' => 'NAMIBIA', 'code' => '264'),
        'NC' => array('name' => 'NEW CALEDONIA', 'code' => '687'),
        'NE' => array('name' => 'NIGER', 'code' => '227'),
        'NG' => array('name' => 'NIGERIA', 'code' => '234'),
        'NI' => array('name' => 'NICARAGUA', 'code' => '505'),
        'NL' => array('name' => 'NETHERLANDS', 'code' => '31'),
        'NO' => array('name' => 'NORWAY', 'code' => '47'),
        'NP' => array('name' => 'NEPAL', 'code' => '977'),
        'NR' => array('name' => 'NAURU', 'code' => '674'),
        'NU' => array('name' => 'NIUE', 'code' => '683'),
        'NZ' => array('name' => 'NEW ZEALAND', 'code' => '64'),
        'AN' => array('name' => 'NETHERLANDS ANTILLES', 'code' => '599'),
        'OM' => array('name' => 'OMAN', 'code' => '968'),
        'PA' => array('name' => 'PANAMA', 'code' => '507'),
        'PE' => array('name' => 'PERU', 'code' => '51'),
        'PG' => array('name' => 'PAPUA NEW GUINEA', 'code' => '675'),
        'PH' => array('name' => 'PHILIPPINES', 'code' => '63'),
        'PK' => array('name' => 'PAKISTAN', 'code' => '92'),
        'PL' => array('name' => 'POLAND', 'code' => '48'),
        'PN' => array('name' => 'PITCAIRN', 'code' => '870'),
        'PR' => array('name' => 'PUERTO RICO', 'code' => '1'),
        'PT' => array('name' => 'PORTUGAL', 'code' => '351'),
        'PW' => array('name' => 'PALAU', 'code' => '680'),
        'PY' => array('name' => 'PARAGUAY', 'code' => '595'),
        'QA' => array('name' => 'QATAR', 'code' => '974'),
        'RO' => array('name' => 'ROMANIA', 'code' => '40'),
        'RU' => array('name' => 'RUSSIAN FEDERATION', 'code' => '7'),
        'RW' => array('name' => 'RWANDA', 'code' => '250'),
        'RS' => array('name' => 'SERBIA', 'code' => '381'),
        'SA' => array('name' => 'SAUDI ARABIA', 'code' => '966'),
        'LC' => array('name' => 'SAINT LUCIA', 'code' => '1758'),
        'ST' => array('name' => 'SAO TOME AND PRINCIPE', 'code' => '239'),
        'BL' => array('name' => 'SAINT BARTHELEMY', 'code' => '590'),
        'MF' => array('name' => 'SAINT MARTIN', 'code' => '1599'),
        'ES' => array('name' => 'SPAIN', 'code' => '34'),
        'LK' => array('name' => 'SRI LANKA', 'code' => '94'),
        'SB' => array('name' => 'SOLOMON ISLANDS', 'code' => '677'),
        'SC' => array('name' => 'SEYCHELLES', 'code' => '248'),
        'SD' => array('name' => 'SUDAN', 'code' => '249'),
        'SE' => array('name' => 'SWEDEN', 'code' => '46'),
        'SG' => array('name' => 'SINGAPORE', 'code' => '65'),
        'SH' => array('name' => 'SAINT HELENA', 'code' => '290'),
        'SI' => array('name' => 'SLOVENIA', 'code' => '386'),
        'SK' => array('name' => 'SLOVAKIA', 'code' => '421'),
        'SL' => array('name' => 'SIERRA LEONE', 'code' => '232'),
        'SM' => array('name' => 'SAN MARINO', 'code' => '378'),
        'WS' => array('name' => 'SAMOA', 'code' => '685'),
        'SN' => array('name' => 'SENEGAL', 'code' => '221'),
        'SO' => array('name' => 'SOMALIA', 'code' => '252'),
        'ZA' => array('name' => 'SOUTH AFRICA', 'code' => '27'),
        'SR' => array('name' => 'SURINAME', 'code' => '597'),
        'PM' => array('name' => 'SAINT PIERRE AND MIQUELON', 'code' => '508'),
        'SY' => array('name' => 'SYRIAN ARAB REPUBLIC', 'code' => '963'),
        'SZ' => array('name' => 'SWAZILAND', 'code' => '268'),
        'CH' => array('name' => 'SWITZERLAND', 'code' => '41'),
        'KN' => array('name' => 'SAINT KITTS AND NEVIS', 'code' => '1869'),
        'VC' => array('name' => 'SAINT VINCENT AND THE GRENADINES', 'code' => '1784'),
        'TC' => array('name' => 'TURKS AND CAICOS ISLANDS', 'code' => '1649'),
        'TG' => array('name' => 'TOGO', 'code' => '228'),
        'TH' => array('name' => 'THAILAND', 'code' => '66'),
        'TJ' => array('name' => 'TAJIKISTAN', 'code' => '992'),
        'TK' => array('name' => 'TOKELAU', 'code' => '690'),
        'TL' => array('name' => 'TIMOR-LESTE', 'code' => '670'),
        'TM' => array('name' => 'TURKMENISTAN', 'code' => '993'),
        'TN' => array('name' => 'TUNISIA', 'code' => '216'),
        'TO' => array('name' => 'TONGA', 'code' => '676'),
        'TR' => array('name' => 'TURKEY', 'code' => '90'),
        'TT' => array('name' => 'TRINIDAD AND TOBAGO', 'code' => '1868'),
        'TV' => array('name' => 'TUVALU', 'code' => '688'),
        'TW' => array('name' => 'TAIWAN, PROVINCE OF CHINA', 'code' => '886'),
        'TZ' => array('name' => 'TANZANIA, UNITED REPUBLIC OF', 'code' => '255'),
        'AE' => array('name' => 'UNITED ARAB EMIRATES', 'code' => '971'),
        'UA' => array('name' => 'UKRAINE', 'code' => '380'),
        'UG' => array('name' => 'UGANDA', 'code' => '256'),
        'US' => array('name' => 'UNITED STATES', 'code' => '1'),
        'UY' => array('name' => 'URUGUAY', 'code' => '598'),
        'GB' => array('name' => 'UNITED KINGDOM', 'code' => '44'),
        'UZ' => array('name' => 'UZBEKISTAN', 'code' => '998'),
        'VE' => array('name' => 'VENEZUELA', 'code' => '58'),
        'VG' => array('name' => 'VIRGIN ISLANDS, BRITISH', 'code' => '1284'),
        'VI' => array('name' => 'VIRGIN ISLANDS, U.S.', 'code' => '1340'),
        'VN' => array('name' => 'VIET NAM', 'code' => '84'),
        'VU' => array('name' => 'VANUATU', 'code' => '678'),
        'WF' => array('name' => 'WALLIS AND FUTUNA', 'code' => '681'),
        'YE' => array('name' => 'YEMEN', 'code' => '967'),
        'ZM' => array('name' => 'ZAMBIA', 'code' => '260'),
        'ZW' => array('name' => 'ZIMBABWE', 'code' => '263')
    );

}




































