<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->truncate();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Andorra',
                'code' => 'ad',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'United Arab Emirates',
                'code' => 'ae',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Afghanistan',
                'code' => 'af',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Antigua and Barbuda',
                'code' => 'ag',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Anguilla',
                'code' => 'ai',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Albania',
                'code' => 'al',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Armenia',
                'code' => 'am',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Netherlands Antilles',
                'code' => 'an',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Angola',
                'code' => 'ao',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Argentina',
                'code' => 'ar',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Austria',
                'code' => 'at',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Australia',
                'code' => 'au',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Aruba',
                'code' => 'aw',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Azerbaijan',
                'code' => 'az',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Bosnia and Herzegovina',
                'code' => 'ba',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Barbados',
                'code' => 'bb',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Bangladesh',
                'code' => 'bd',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Belgium',
                'code' => 'be',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Burkina Faso',
                'code' => 'bf',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Bulgaria',
                'code' => 'bg',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Bahrain',
                'code' => 'bh',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Burundi',
                'code' => 'bi',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Benin',
                'code' => 'bj',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Bermuda',
                'code' => 'bm',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Brunei Darussalam',
                'code' => 'bn',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Bolivia',
                'code' => 'bo',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Brazil',
                'code' => 'br',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Bahamas',
                'code' => 'bs',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Bhutan',
                'code' => 'bt',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Botswana',
                'code' => 'bw',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Belarus',
                'code' => 'by',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Belize',
                'code' => 'bz',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Canada',
                'code' => 'ca',
            ),
            33 => 
            array (
                'id' => 34,
            'name' => 'Cocos (Keeling) Islands',
                'code' => 'cc',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Democratic Republic of the Congo',
                'code' => 'cd',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Central African Republic',
                'code' => 'cf',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Congo',
                'code' => 'cg',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Switzerland',
                'code' => 'ch',
            ),
            38 => 
            array (
                'id' => 39,
            'name' => 'Cote D\'Ivoire (Ivory Coast)',
                'code' => 'ci',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Cook Islands',
                'code' => 'ck',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Chile',
                'code' => 'cl',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Cameroon',
                'code' => 'cm',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'China',
                'code' => 'cn',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Colombia',
                'code' => 'co',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Costa Rica',
                'code' => 'cr',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Cuba',
                'code' => 'cu',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Cape Verde',
                'code' => 'cv',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Christmas Island',
                'code' => 'cx',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Cyprus',
                'code' => 'cy',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Czech Republic',
                'code' => 'cz',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Germany',
                'code' => 'de',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Djibouti',
                'code' => 'dj',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Denmark',
                'code' => 'dk',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Dominica',
                'code' => 'dm',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Dominican Republic',
                'code' => 'do',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Algeria',
                'code' => 'dz',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Ecuador',
                'code' => 'ec',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Estonia',
                'code' => 'ee',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Egypt',
                'code' => 'eg',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Western Sahara',
                'code' => 'eh',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Eritrea',
                'code' => 'er',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Spain',
                'code' => 'es',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Ethiopia',
                'code' => 'et',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Finland',
                'code' => 'fi',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Fiji',
                'code' => 'fj',
            ),
            65 => 
            array (
                'id' => 66,
            'name' => 'Falkland Islands (Malvinas)',
                'code' => 'fk',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Federated States of Micronesia',
                'code' => 'fm',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Faroe Islands',
                'code' => 'fo',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'France',
                'code' => 'fr',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Gabon',
                'code' => 'ga',
            ),
            70 => 
            array (
                'id' => 71,
            'name' => 'Great Britain (UK)',
                'code' => 'gb',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Grenada',
                'code' => 'gd',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Georgia',
                'code' => 'ge',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'French Guiana',
                'code' => 'gf',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'NULL',
                'code' => 'gg',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Ghana',
                'code' => 'gh',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Gibraltar',
                'code' => 'gi',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Greenland',
                'code' => 'gl',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Gambia',
                'code' => 'gm',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Guinea',
                'code' => 'gn',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Guadeloupe',
                'code' => 'gp',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Equatorial Guinea',
                'code' => 'gq',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Greece',
                'code' => 'gr',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'S. Georgia and S. Sandwich Islands',
                'code' => 'gs',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Guatemala',
                'code' => 'gt',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Guinea-Bissau',
                'code' => 'gw',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Guyana',
                'code' => 'gy',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Hong Kong',
                'code' => 'hk',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Honduras',
                'code' => 'hn',
            ),
            89 => 
            array (
                'id' => 90,
            'name' => 'Croatia (Hrvatska)',
                'code' => 'hr',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Haiti',
                'code' => 'ht',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Hungary',
                'code' => 'hu',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Indonesia',
                'code' => 'id',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Ireland',
                'code' => 'ie',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Israel',
                'code' => 'il',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'India',
                'code' => 'in',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Iraq',
                'code' => 'iq',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Iran',
                'code' => 'ir',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Iceland',
                'code' => 'is',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Italy',
                'code' => 'it',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Jamaica',
                'code' => 'jm',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Jordan',
                'code' => 'jo',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Japan',
                'code' => 'jp',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Kenya',
                'code' => 'ke',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Kyrgyzstan',
                'code' => 'kg',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Cambodia',
                'code' => 'kh',
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Kiribati',
                'code' => 'ki',
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Comoros',
                'code' => 'km',
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Saint Kitts and Nevis',
                'code' => 'kn',
            ),
            109 => 
            array (
                'id' => 110,
            'name' => 'Korea (North)',
                'code' => 'kp',
            ),
            110 => 
            array (
                'id' => 111,
            'name' => 'Korea (South)',
                'code' => 'kr',
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Kuwait',
                'code' => 'kw',
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Cayman Islands',
                'code' => 'ky',
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Kazakhstan',
                'code' => 'kz',
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Laos',
                'code' => 'la',
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Lebanon',
                'code' => 'lb',
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Saint Lucia',
                'code' => 'lc',
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Liechtenstein',
                'code' => 'li',
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Sri Lanka',
                'code' => 'lk',
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Liberia',
                'code' => 'lr',
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Lesotho',
                'code' => 'ls',
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Lithuania',
                'code' => 'lt',
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Luxembourg',
                'code' => 'lu',
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Latvia',
                'code' => 'lv',
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Libya',
                'code' => 'ly',
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Morocco',
                'code' => 'ma',
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Monaco',
                'code' => 'mc',
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Moldova',
                'code' => 'md',
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Madagascar',
                'code' => 'mg',
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Marshall Islands',
                'code' => 'mh',
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Macedonia',
                'code' => 'mk',
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Mali',
                'code' => 'ml',
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Myanmar',
                'code' => 'mm',
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Mongolia',
                'code' => 'mn',
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Macao',
                'code' => 'mo',
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'Northern Mariana Islands',
                'code' => 'mp',
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'Martinique',
                'code' => 'mq',
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'Mauritania',
                'code' => 'mr',
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'Montserrat',
                'code' => 'ms',
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'Malta',
                'code' => 'mt',
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'Mauritius',
                'code' => 'mu',
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'Maldives',
                'code' => 'mv',
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Malawi',
                'code' => 'mw',
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Mexico',
                'code' => 'mx',
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Malaysia',
                'code' => 'my',
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Mozambique',
                'code' => 'mz',
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Namibia',
                'code' => 'na',
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'New Caledonia',
                'code' => 'nc',
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'Niger',
                'code' => 'ne',
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'Norfolk Island',
                'code' => 'nf',
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'Nigeria',
                'code' => 'ng',
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'Nicaragua',
                'code' => 'ni',
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Netherlands',
                'code' => 'nl',
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Norway',
                'code' => 'no',
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Nepal',
                'code' => 'np',
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'Nauru',
                'code' => 'nr',
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Niue',
                'code' => 'nu',
            ),
            157 => 
            array (
                'id' => 158,
            'name' => 'New Zealand (Aotearoa)',
                'code' => 'nz',
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'Oman',
                'code' => 'om',
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'Panama',
                'code' => 'pa',
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'Peru',
                'code' => 'pe',
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'French Polynesia',
                'code' => 'pf',
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'Papua New Guinea',
                'code' => 'pg',
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'Philippines',
                'code' => 'ph',
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Pakistan',
                'code' => 'pk',
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'Poland',
                'code' => 'pl',
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Saint Pierre and Miquelon',
                'code' => 'pm',
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Pitcairn',
                'code' => 'pn',
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Palestinian Territory',
                'code' => 'ps',
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'Portugal',
                'code' => 'pt',
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'Palau',
                'code' => 'pw',
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Paraguay',
                'code' => 'py',
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Qatar',
                'code' => 'qa',
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Reunion',
                'code' => 're',
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'Romania',
                'code' => 'ro',
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'Russian Federation',
                'code' => 'ru',
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'Rwanda',
                'code' => 'rw',
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'Saudi Arabia',
                'code' => 'sa',
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'Solomon Islands',
                'code' => 'sb',
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'Seychelles',
                'code' => 'sc',
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'Sudan',
                'code' => 'sd',
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'Sweden',
                'code' => 'se',
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'Singapore',
                'code' => 'sg',
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'Saint Helena',
                'code' => 'sh',
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'Slovenia',
                'code' => 'si',
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'Svalbard and Jan Mayen',
                'code' => 'sj',
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'Slovakia',
                'code' => 'sk',
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'Sierra Leone',
                'code' => 'sl',
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'San Marino',
                'code' => 'sm',
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'Senegal',
                'code' => 'sn',
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'Somalia',
                'code' => 'so',
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'Suriname',
                'code' => 'sr',
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'Sao Tome and Principe',
                'code' => 'st',
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'El Salvador',
                'code' => 'sv',
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'Syria',
                'code' => 'sy',
            ),
            195 => 
            array (
                'id' => 196,
                'name' => 'Swaziland',
                'code' => 'sz',
            ),
            196 => 
            array (
                'id' => 197,
                'name' => 'Turks and Caicos Islands',
                'code' => 'tc',
            ),
            197 => 
            array (
                'id' => 198,
                'name' => 'Chad',
                'code' => 'td',
            ),
            198 => 
            array (
                'id' => 199,
                'name' => 'French Southern Territories',
                'code' => 'tf',
            ),
            199 => 
            array (
                'id' => 200,
                'name' => 'Togo',
                'code' => 'tg',
            ),
            200 => 
            array (
                'id' => 201,
                'name' => 'Thailand',
                'code' => 'th',
            ),
            201 => 
            array (
                'id' => 202,
                'name' => 'Tajikistan',
                'code' => 'tj',
            ),
            202 => 
            array (
                'id' => 203,
                'name' => 'Tokelau',
                'code' => 'tk',
            ),
            203 => 
            array (
                'id' => 204,
                'name' => 'Turkmenistan',
                'code' => 'tm',
            ),
            204 => 
            array (
                'id' => 205,
                'name' => 'Tunisia',
                'code' => 'tn',
            ),
            205 => 
            array (
                'id' => 206,
                'name' => 'Tonga',
                'code' => 'to',
            ),
            206 => 
            array (
                'id' => 207,
                'name' => 'Turkey',
                'code' => 'tr',
            ),
            207 => 
            array (
                'id' => 208,
                'name' => 'Trinidad and Tobago',
                'code' => 'tt',
            ),
            208 => 
            array (
                'id' => 209,
                'name' => 'Tuvalu',
                'code' => 'tv',
            ),
            209 => 
            array (
                'id' => 210,
                'name' => 'Taiwan',
                'code' => 'tw',
            ),
            210 => 
            array (
                'id' => 211,
                'name' => 'Tanzania',
                'code' => 'tz',
            ),
            211 => 
            array (
                'id' => 212,
                'name' => 'Ukraine',
                'code' => 'ua',
            ),
            212 => 
            array (
                'id' => 213,
                'name' => 'Uganda',
                'code' => 'ug',
            ),
            213 => 
            array (
                'id' => 214,
                'name' => 'Uruguay',
                'code' => 'uy',
            ),
            214 => 
            array (
                'id' => 215,
                'name' => 'Uzbekistan',
                'code' => 'uz',
            ),
            215 => 
            array (
                'id' => 216,
                'name' => 'Saint Vincent and the Grenadines',
                'code' => 'vc',
            ),
            216 => 
            array (
                'id' => 217,
                'name' => 'Venezuela',
                'code' => 've',
            ),
            217 => 
            array (
                'id' => 218,
            'name' => 'Virgin Islands (British)',
                'code' => 'vg',
            ),
            218 => 
            array (
                'id' => 219,
            'name' => 'Virgin Islands (U.S.)',
                'code' => 'vi',
            ),
            219 => 
            array (
                'id' => 220,
                'name' => 'Viet Nam',
                'code' => 'vn',
            ),
            220 => 
            array (
                'id' => 221,
                'name' => 'Vanuatu',
                'code' => 'vu',
            ),
            221 => 
            array (
                'id' => 222,
                'name' => 'Wallis and Futuna',
                'code' => 'wf',
            ),
            222 => 
            array (
                'id' => 223,
                'name' => 'Samoa',
                'code' => 'ws',
            ),
            223 => 
            array (
                'id' => 224,
                'name' => 'Yemen',
                'code' => 'ye',
            ),
            224 => 
            array (
                'id' => 225,
                'name' => 'Mayotte',
                'code' => 'yt',
            ),
            225 => 
            array (
                'id' => 226,
                'name' => 'South Africa',
                'code' => 'za',
            ),
            226 => 
            array (
                'id' => 227,
                'name' => 'Zambia',
                'code' => 'zm',
            ),
            227 => 
            array (
                'id' => 228,
            'name' => 'Zaire (former)',
                'code' => 'zr',
            ),
            228 => 
            array (
                'id' => 229,
                'name' => 'Zimbabwe',
                'code' => 'zw',
            ),
            229 => 
            array (
                'id' => 230,
                'name' => 'United States of America',
                'code' => 'us',
            ),
        ));

        
    }
}