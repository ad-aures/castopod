<?php

declare(strict_types=1);

/**
 * Class LanguageSeeder Inserts values in languages table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * From https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes (cc) Creative Commons Attribution-ShareAlike 3.0
 * 2020-06-07
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'code'        => 'aa',
                'native_name' => 'Afaraf',
            ],
            [
                'code'        => 'ab',
                'native_name' => 'аҧсуа бызшәа, аҧсшәа',
            ],
            [
                'code'        => 'ae',
                'native_name' => 'Avesta',
            ],
            [
                'code'        => 'af',
                'native_name' => 'Afrikaans',
            ],
            [
                'code'        => 'ak',
                'native_name' => 'Akan',
            ],
            [
                'code'        => 'am',
                'native_name' => 'አማርኛ',
            ],
            [
                'code'        => 'an',
                'native_name' => 'Aragonés',
            ],
            [
                'code'        => 'ar',
                'native_name' => 'العربية',
            ],
            [
                'code'        => 'as',
                'native_name' => 'অসমীয়া',
            ],
            [
                'code'        => 'av',
                'native_name' => 'авар мацӀ, магӀарул мацӀ',
            ],
            [
                'code'        => 'ay',
                'native_name' => 'Aymar aru',
            ],
            [
                'code'        => 'az',
                'native_name' => 'azərbaycan dili',
            ],
            [
                'code'        => 'ba',
                'native_name' => 'башҡорт теле',
            ],
            [
                'code'        => 'be',
                'native_name' => 'беларуская мова',
            ],
            [
                'code'        => 'bg',
                'native_name' => 'български език',
            ],
            [
                'code'        => 'bh',
                'native_name' => 'भोजपुरी',
            ],
            [
                'code'        => 'bi',
                'native_name' => 'Bislama',
            ],
            [
                'code'        => 'bm',
                'native_name' => 'Bamanankan',
            ],
            [
                'code'        => 'bn',
                'native_name' => 'বাংলা',
            ],
            [
                'code'        => 'bo',
                'native_name' => 'བོད་ཡིག',
            ],
            [
                'code'        => 'br',
                'native_name' => 'Brezhoneg',
            ],
            [
                'code'        => 'bs',
                'native_name' => 'Bosanski jezik',
            ],
            [
                'code'        => 'ca',
                'native_name' => 'Català, valencià',
            ],
            [
                'code'        => 'ce',
                'native_name' => 'нохчийн мотт',
            ],
            [
                'code'        => 'ch',
                'native_name' => 'Chamoru',
            ],
            [
                'code'        => 'co',
                'native_name' => 'Corsu, lingua corsa',
            ],
            [
                'code'        => 'cr',
                'native_name' => 'ᓀᐦᐃᔭᐍᐏᐣ',
            ],
            [
                'code'        => 'cs',
                'native_name' => 'čeština, český jazyk',
            ],
            [
                'code'        => 'cu',
                'native_name' => 'ѩзыкъ словѣньскъ',
            ],
            [
                'code'        => 'cv',
                'native_name' => 'чӑваш чӗлхи',
            ],
            [
                'code'        => 'cy',
                'native_name' => 'Cymraeg',
            ],
            [
                'code'        => 'da',
                'native_name' => 'Dansk',
            ],
            [
                'code'        => 'de',
                'native_name' => 'Deutsch',
            ],
            [
                'code'        => 'dv',
                'native_name' => 'ދިވެހި',
            ],
            [
                'code'        => 'dz',
                'native_name' => 'རྫོང་ཁ',
            ],
            [
                'code'        => 'ee',
                'native_name' => 'Eʋegbe',
            ],
            [
                'code'        => 'el',
                'native_name' => 'ελληνικά',
            ],
            [
                'code'        => 'en',
                'native_name' => 'English',
            ],
            [
                'code'        => 'eo',
                'native_name' => 'Esperanto',
            ],
            [
                'code'        => 'es',
                'native_name' => 'Español',
            ],
            [
                'code'        => 'et',
                'native_name' => 'eesti, eesti keel',
            ],
            [
                'code'        => 'eu',
                'native_name' => 'Euskara, euskera',
            ],
            [
                'code'        => 'fa',
                'native_name' => 'فارسی',
            ],
            [
                'code'        => 'ff',
                'native_name' => 'Fulfulde, Pulaar, Pular',
            ],
            [
                'code'        => 'fi',
                'native_name' => 'Suomi, suomen kieli',
            ],
            [
                'code'        => 'fj',
                'native_name' => 'Vosa Vakaviti',
            ],
            [
                'code'        => 'fo',
                'native_name' => 'Føroyskt',
            ],
            [
                'code'        => 'fr',
                'native_name' => 'Français, langue française',
            ],
            [
                'code'        => 'fy',
                'native_name' => 'Frysk',
            ],
            [
                'code'        => 'ga',
                'native_name' => 'Gaeilge',
            ],
            [
                'code'        => 'gd',
                'native_name' => 'Gàidhlig',
            ],
            [
                'code'        => 'gl',
                'native_name' => 'Galego',
            ],
            [
                'code'        => 'gn',
                'native_name' => "Avañe'ẽ",
            ],
            [
                'code'        => 'gu',
                'native_name' => 'ગુજરાતી',
            ],
            [
                'code'        => 'gv',
                'native_name' => 'Gaelg, Gailck',
            ],
            [
                'code'        => 'ha',
                'native_name' => '(Hausa) هَوُسَ',
            ],
            [
                'code'        => 'he',
                'native_name' => 'עברית',
            ],
            [
                'code'        => 'hi',
                'native_name' => 'हिन्दी, हिंदी',
            ],
            [
                'code'        => 'ho',
                'native_name' => 'Hiri Motu',
            ],
            [
                'code'        => 'hr',
                'native_name' => 'Hrvatski jezik',
            ],
            [
                'code'        => 'ht',
                'native_name' => 'Kreyòl ayisyen',
            ],
            [
                'code'        => 'hu',
                'native_name' => 'Magyar',
            ],
            [
                'code'        => 'hy',
                'native_name' => 'Հայերեն',
            ],
            [
                'code'        => 'hz',
                'native_name' => 'Otjiherero',
            ],
            [
                'code'        => 'ia',
                'native_name' => 'Interlingua',
            ],
            [
                'code'        => 'id',
                'native_name' => 'Bahasa Indonesia',
            ],
            [
                'code'        => 'ie',
                'native_name' => 'Interlingue, formerly Occidental',
            ],
            [
                'code'        => 'ig',
                'native_name' => 'Asụsụ Igbo',
            ],
            [
                'code'        => 'ii',
                'native_name' => 'ꆈꌠ꒿ Nuosuhxop',
            ],
            [
                'code'        => 'ik',
                'native_name' => 'Iñupiaq, Iñupiatun',
            ],
            [
                'code'        => 'io',
                'native_name' => 'Ido',
            ],
            [
                'code'        => 'is',
                'native_name' => 'Íslenska',
            ],
            [
                'code'        => 'it',
                'native_name' => 'Italiano',
            ],
            [
                'code'        => 'iu',
                'native_name' => 'ᐃᓄᒃᑎᑐᑦ',
            ],
            [
                'code'        => 'ja',
                'native_name' => '日本語 (にほんご)',
            ],
            [
                'code'        => 'jv',
                'native_name' => 'ꦧꦱꦗꦮ, Basa Jawa',
            ],
            [
                'code'        => 'ka',
                'native_name' => 'ქართული',
            ],
            [
                'code'        => 'kg',
                'native_name' => 'Kikongo',
            ],
            [
                'code'        => 'ki',
                'native_name' => 'Gĩkũyũ',
            ],
            [
                'code'        => 'kj',
                'native_name' => 'Kuanyama',
            ],
            [
                'code'        => 'kk',
                'native_name' => 'қазақ тілі',
            ],
            [
                'code'        => 'kl',
                'native_name' => 'Kalaallisut, kalaallit oqaasii',
            ],
            [
                'code'        => 'km',
                'native_name' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
            ],
            [
                'code'        => 'kn',
                'native_name' => 'ಕನ್ನಡ',
            ],
            [
                'code'        => 'ko',
                'native_name' => '한국어',
            ],
            [
                'code'        => 'kr',
                'native_name' => 'Kanuri',
            ],
            [
                'code'        => 'ks',
                'native_name' => 'कश्मीरी, كشميري‎',
            ],
            [
                'code'        => 'ku',
                'native_name' => 'Kurdî, کوردی‎',
            ],
            [
                'code'        => 'kv',
                'native_name' => 'коми кыв',
            ],
            [
                'code'        => 'kw',
                'native_name' => 'Kernewek',
            ],
            [
                'code'        => 'ky',
                'native_name' => 'Кыргызча, Кыргыз тили',
            ],
            [
                'code'        => 'la',
                'native_name' => 'Latine, lingua latina',
            ],
            [
                'code'        => 'lb',
                'native_name' => 'Lëtzebuergesch',
            ],
            [
                'code'        => 'lg',
                'native_name' => 'Luganda',
            ],
            [
                'code'        => 'li',
                'native_name' => 'Limburgs',
            ],
            [
                'code'        => 'ln',
                'native_name' => 'Lingála',
            ],
            [
                'code'        => 'lo',
                'native_name' => 'ພາສາລາວ',
            ],
            [
                'code'        => 'lt',
                'native_name' => 'Lietuvių kalba',
            ],
            [
                'code'        => 'lu',
                'native_name' => 'Kiluba',
            ],
            [
                'code'        => 'lv',
                'native_name' => 'Latviešu valoda',
            ],
            [
                'code'        => 'mg',
                'native_name' => 'Fiteny malagasy',
            ],
            [
                'code'        => 'mh',
                'native_name' => 'Kajin M̧ajeļ',
            ],
            [
                'code'        => 'mi',
                'native_name' => 'Te reo Māori',
            ],
            [
                'code'        => 'mk',
                'native_name' => 'македонски јазик',
            ],
            [
                'code'        => 'ml',
                'native_name' => 'മലയാളം',
            ],
            [
                'code'        => 'mn',
                'native_name' => 'Монгол хэл',
            ],
            [
                'code'        => 'mr',
                'native_name' => 'मराठी',
            ],
            [
                'code'        => 'ms',
                'native_name' => 'Bahasa Melayu, بهاس ملايو‎',
            ],
            [
                'code'        => 'mt',
                'native_name' => 'Malti',
            ],
            [
                'code'        => 'my',
                'native_name' => 'ဗမာစာ',
            ],
            [
                'code'        => 'na',
                'native_name' => 'Dorerin Naoero',
            ],
            [
                'code'        => 'nb',
                'native_name' => 'Norsk Bokmål',
            ],
            [
                'code'        => 'nd',
                'native_name' => 'isiNdebele',
            ],
            [
                'code'        => 'ne',
                'native_name' => 'नेपाली',
            ],
            [
                'code'        => 'ng',
                'native_name' => 'Owambo',
            ],
            [
                'code'        => 'nl',
                'native_name' => 'Nederlands, Vlaams',
            ],
            [
                'code'        => 'nn',
                'native_name' => 'Norsk Nynorsk',
            ],
            [
                'code'        => 'no',
                'native_name' => 'Norsk',
            ],
            [
                'code'        => 'nr',
                'native_name' => 'isiNdebele',
            ],
            [
                'code'        => 'nv',
                'native_name' => 'Diné bizaad',
            ],
            [
                'code'        => 'ny',
                'native_name' => 'Chicheŵa, chinyanja',
            ],
            [
                'code'        => 'oc',
                'native_name' => 'Occitan, lenga d’òc',
            ],
            [
                'code'        => 'oj',
                'native_name' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
            ],
            [
                'code'        => 'om',
                'native_name' => 'Afaan Oromoo',
            ],
            [
                'code'        => 'or',
                'native_name' => 'ଓଡ଼ିଆ',
            ],
            [
                'code'        => 'os',
                'native_name' => 'ирон æвзаг',
            ],
            [
                'code'        => 'pa',
                'native_name' => 'ਪੰਜਾਬੀ, پنجابی‎',
            ],
            [
                'code'        => 'pi',
                'native_name' => 'पालि, पाळि',
            ],
            [
                'code'        => 'pl',
                'native_name' => 'język polski, polszczyzna',
            ],
            [
                'code'        => 'ps',
                'native_name' => 'پښتو',
            ],
            [
                'code'        => 'pt',
                'native_name' => 'Português',
            ],
            [
                'code'        => 'qu',
                'native_name' => 'Runa Simi, Kichwa',
            ],
            [
                'code'        => 'rm',
                'native_name' => 'Rumantsch Grischun',
            ],
            [
                'code'        => 'rn',
                'native_name' => 'Ikirundi',
            ],
            [
                'code'        => 'ro',
                'native_name' => 'Română',
            ],
            [
                'code'        => 'ru',
                'native_name' => 'Pусский',
            ],
            [
                'code'        => 'rw',
                'native_name' => 'Ikinyarwanda',
            ],
            [
                'code'        => 'sa',
                'native_name' => 'संस्कृतम्',
            ],
            [
                'code'        => 'sc',
                'native_name' => 'Sardu',
            ],
            [
                'code'        => 'sd',
                'native_name' => 'सिन्धी, سنڌي، سندھی‎',
            ],
            [
                'code'        => 'se',
                'native_name' => 'Davvisámegiella',
            ],
            [
                'code'        => 'sg',
                'native_name' => 'Yângâ tî sängö',
            ],
            [
                'code'        => 'si',
                'native_name' => 'සිංහල',
            ],
            [
                'code'        => 'sk',
                'native_name' => 'Slovenčina, Slovenský Jazyk',
            ],
            [
                'code'        => 'sl',
                'native_name' => 'Slovenski Jezik, Slovenščina',
            ],
            [
                'code'        => 'sm',
                'native_name' => "Gagana fa'a Samoa",
            ],
            [
                'code'        => 'sn',
                'native_name' => 'chiShona',
            ],
            [
                'code'        => 'so',
                'native_name' => 'Soomaaliga, af Soomaali',
            ],
            [
                'code'        => 'sq',
                'native_name' => 'Shqip',
            ],
            [
                'code'        => 'sr',
                'native_name' => 'српски језик',
            ],
            [
                'code'        => 'ss',
                'native_name' => 'SiSwati',
            ],
            [
                'code'        => 'st',
                'native_name' => 'Sesotho',
            ],
            [
                'code'        => 'su',
                'native_name' => 'Basa Sunda',
            ],
            [
                'code'        => 'sv',
                'native_name' => 'Svenska',
            ],
            [
                'code'        => 'sw',
                'native_name' => 'Kiswahili',
            ],
            [
                'code'        => 'ta',
                'native_name' => 'தமிழ்',
            ],
            [
                'code'        => 'te',
                'native_name' => 'తెలుగు',
            ],
            [
                'code'        => 'tg',
                'native_name' => 'тоҷикӣ, toçikī, تاجیکی‎',
            ],
            [
                'code'        => 'th',
                'native_name' => 'ไทย',
            ],
            [
                'code'        => 'ti',
                'native_name' => 'ትግርኛ',
            ],
            [
                'code'        => 'tk',
                'native_name' => 'Türkmen, Түркмен',
            ],
            [
                'code'        => 'tl',
                'native_name' => 'Wikang Tagalog',
            ],
            [
                'code'        => 'tn',
                'native_name' => 'Setswana',
            ],
            [
                'code'        => 'to',
                'native_name' => 'Faka Tonga',
            ],
            [
                'code'        => 'tr',
                'native_name' => 'Türkçe',
            ],
            [
                'code'        => 'ts',
                'native_name' => 'Xitsonga',
            ],
            [
                'code'        => 'tt',
                'native_name' => 'татар теле, tatar tele',
            ],
            [
                'code'        => 'tw',
                'native_name' => 'Twi',
            ],
            [
                'code'        => 'ty',
                'native_name' => 'Reo Tahiti',
            ],
            [
                'code'        => 'ug',
                'native_name' => 'ئۇيغۇرچە‎, Uyghurche',
            ],
            [
                'code'        => 'uk',
                'native_name' => 'Українська',
            ],
            [
                'code'        => 'ur',
                'native_name' => 'اردو',
            ],
            [
                'code'        => 'uz',
                'native_name' => 'Oʻzbek, Ўзбек, أۇزبېك‎',
            ],
            [
                'code'        => 've',
                'native_name' => 'Tshivenḓa',
            ],
            [
                'code'        => 'vi',
                'native_name' => 'Tiếng Việt',
            ],
            [
                'code'        => 'vo',
                'native_name' => 'Volapük',
            ],
            [
                'code'        => 'wa',
                'native_name' => 'Walon',
            ],
            [
                'code'        => 'wo',
                'native_name' => 'Wollof',
            ],
            [
                'code'        => 'xh',
                'native_name' => 'isiXhosa',
            ],
            [
                'code'        => 'yi',
                'native_name' => 'ייִדיש',
            ],
            [
                'code'        => 'yo',
                'native_name' => 'Yorùbá',
            ],
            [
                'code'        => 'za',
                'native_name' => 'Saɯ cueŋƅ, Saw cuengh',
            ],
            [
                'code'        => 'zh',
                'native_name' => '中文 (Zhōngwén), 汉语, 漢語',
            ],
            [
                'code'        => 'zu',
                'native_name' => 'isiZulu',
            ],
        ];

        foreach ($data as $languageLine) {
            $this->db
                ->table('languages')
                ->ignore(true)
                ->insert($languageLine);
        }
    }
}
