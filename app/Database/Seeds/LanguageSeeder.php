<?php
/**
 * Class LanguageSeeder
 * Inserts values in languages table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * From https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 * (cc) Creative Commons Attribution-ShareAlike 3.0
 * 2020-06-07
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['code' => 'aa', 'name' => 'Afar', 'native_name' => 'Afaraf'],
            [
                'code' => 'ab',
                'name' => 'Abkhazian',
                'native_name' => 'аҧсуа бызшәа, аҧсшәа',
            ],
            ['code' => 'ae', 'name' => 'Avestan', 'native_name' => 'avesta'],
            [
                'code' => 'af',
                'name' => 'Afrikaans',
                'native_name' => 'Afrikaans',
            ],
            ['code' => 'ak', 'name' => 'Akan', 'native_name' => 'Akan'],
            ['code' => 'am', 'name' => 'Amharic', 'native_name' => 'አማርኛ'],
            [
                'code' => 'an',
                'name' => 'Aragonese',
                'native_name' => 'aragonés',
            ],
            ['code' => 'ar', 'name' => 'Arabic', 'native_name' => 'العربية'],
            ['code' => 'as', 'name' => 'Assamese', 'native_name' => 'অসমীয়া'],
            [
                'code' => 'av',
                'name' => 'Avaric',
                'native_name' => 'авар мацӀ, магӀарул мацӀ',
            ],
            ['code' => 'ay', 'name' => 'Aymara', 'native_name' => 'aymar aru'],
            [
                'code' => 'az',
                'name' => 'Azerbaijani',
                'native_name' => 'azərbaycan dili',
            ],
            [
                'code' => 'ba',
                'name' => 'Bashkir',
                'native_name' => 'башҡорт теле',
            ],
            [
                'code' => 'be',
                'name' => 'Belarusian',
                'native_name' => 'беларуская мова',
            ],
            [
                'code' => 'bg',
                'name' => 'Bulgarian',
                'native_name' => 'български език',
            ],
            [
                'code' => 'bh',
                'name' => 'Bihari languages',
                'native_name' => 'भोजपुरी',
            ],
            ['code' => 'bi', 'name' => 'Bislama', 'native_name' => 'Bislama'],
            [
                'code' => 'bm',
                'name' => 'Bambara',
                'native_name' => 'bamanankan',
            ],
            ['code' => 'bn', 'name' => 'Bengali', 'native_name' => 'বাংলা'],
            ['code' => 'bo', 'name' => 'Tibetan', 'native_name' => 'བོད་ཡིག'],
            ['code' => 'br', 'name' => 'Breton', 'native_name' => 'brezhoneg'],
            [
                'code' => 'bs',
                'name' => 'Bosnian',
                'native_name' => 'bosanski jezik',
            ],
            [
                'code' => 'ca',
                'name' => 'Catalan, Valencian',
                'native_name' => 'català, valencià',
            ],
            [
                'code' => 'ce',
                'name' => 'Chechen',
                'native_name' => 'нохчийн мотт',
            ],
            ['code' => 'ch', 'name' => 'Chamorro', 'native_name' => 'Chamoru'],
            [
                'code' => 'co',
                'name' => 'Corsican',
                'native_name' => 'corsu, lingua corsa',
            ],
            ['code' => 'cr', 'name' => 'Cree', 'native_name' => 'ᓀᐦᐃᔭᐍᐏᐣ'],
            [
                'code' => 'cs',
                'name' => 'Czech',
                'native_name' => 'čeština, český jazyk',
            ],
            [
                'code' => 'cu',
                'name' =>
                    'Church Slavic, Old Slavonic, Church Slavonic, Old Bulgarian, Old Church Slavonic',
                'native_name' => 'ѩзыкъ словѣньскъ',
            ],
            [
                'code' => 'cv',
                'name' => 'Chuvash',
                'native_name' => 'чӑваш чӗлхи',
            ],
            ['code' => 'cy', 'name' => 'Welsh', 'native_name' => 'Cymraeg'],
            ['code' => 'da', 'name' => 'Danish', 'native_name' => 'dansk'],
            ['code' => 'de', 'name' => 'German', 'native_name' => 'Deutsch'],
            [
                'code' => 'dv',
                'name' => 'Divehi, Dhivehi, Maldivian',
                'native_name' => 'ދިވެހި',
            ],
            ['code' => 'dz', 'name' => 'Dzongkha', 'native_name' => 'རྫོང་ཁ'],
            ['code' => 'ee', 'name' => 'Ewe', 'native_name' => 'Eʋegbe'],
            [
                'code' => 'el',
                'name' => 'Greek, Modern (1453–)',
                'native_name' => 'ελληνικά',
            ],
            ['code' => 'en', 'name' => 'English', 'native_name' => 'English'],
            [
                'code' => 'eo',
                'name' => 'Esperanto',
                'native_name' => 'Esperanto',
            ],
            [
                'code' => 'es',
                'name' => 'Spanish, Castilian',
                'native_name' => 'Español',
            ],
            [
                'code' => 'et',
                'name' => 'Estonian',
                'native_name' => 'eesti, eesti keel',
            ],
            [
                'code' => 'eu',
                'name' => 'Basque',
                'native_name' => 'euskara, euskera',
            ],
            ['code' => 'fa', 'name' => 'Persian', 'native_name' => 'فارسی'],
            [
                'code' => 'ff',
                'name' => 'Fulah',
                'native_name' => 'Fulfulde, Pulaar, Pular',
            ],
            [
                'code' => 'fi',
                'name' => 'Finnish',
                'native_name' => 'suomi, suomen kieli',
            ],
            [
                'code' => 'fj',
                'name' => 'Fijian',
                'native_name' => 'vosa Vakaviti',
            ],
            ['code' => 'fo', 'name' => 'Faroese', 'native_name' => 'føroyskt'],
            [
                'code' => 'fr',
                'name' => 'French',
                'native_name' => 'français, langue française',
            ],
            [
                'code' => 'fy',
                'name' => 'Western Frisian',
                'native_name' => 'Frysk',
            ],
            ['code' => 'ga', 'name' => 'Irish', 'native_name' => 'Gaeilge'],
            [
                'code' => 'gd',
                'name' => 'Gaelic, Scottish Gaelic',
                'native_name' => 'Gàidhlig',
            ],
            ['code' => 'gl', 'name' => 'Galician', 'native_name' => 'Galego'],
            ['code' => 'gn', 'name' => 'Guarani', 'native_name' => 'Avañe\'ẽ'],
            ['code' => 'gu', 'name' => 'Gujarati', 'native_name' => 'ગુજરાતી'],
            [
                'code' => 'gv',
                'name' => 'Manx',
                'native_name' => 'Gaelg, Gailck',
            ],
            [
                'code' => 'ha',
                'name' => 'Hausa',
                'native_name' => '(Hausa) هَوُسَ',
            ],
            ['code' => 'he', 'name' => 'Hebrew', 'native_name' => 'עברית'],
            [
                'code' => 'hi',
                'name' => 'Hindi',
                'native_name' => 'हिन्दी, हिंदी',
            ],
            [
                'code' => 'ho',
                'name' => 'Hiri Motu',
                'native_name' => 'Hiri Motu',
            ],
            [
                'code' => 'hr',
                'name' => 'Croatian',
                'native_name' => 'hrvatski jezik',
            ],
            [
                'code' => 'ht',
                'name' => 'Haitian, Haitian Creole',
                'native_name' => 'Kreyòl ayisyen',
            ],
            ['code' => 'hu', 'name' => 'Hungarian', 'native_name' => 'magyar'],
            ['code' => 'hy', 'name' => 'Armenian', 'native_name' => 'Հայերեն'],
            ['code' => 'hz', 'name' => 'Herero', 'native_name' => 'Otjiherero'],
            [
                'code' => 'ia',
                'name' =>
                    'Interlingua (International Auxiliary Language Association)',
                'native_name' => 'Interlingua',
            ],
            [
                'code' => 'id',
                'name' => 'Indonesian',
                'native_name' => 'Bahasa Indonesia',
            ],
            [
                'code' => 'ie',
                'name' => 'Interlingue, Occidental',
                'native_name' =>
                    '(originally:) Occidental, (after WWII:) Interlingue',
            ],
            ['code' => 'ig', 'name' => 'Igbo', 'native_name' => 'Asụsụ Igbo'],
            [
                'code' => 'ii',
                'name' => 'Sichuan Yi, Nuosu',
                'native_name' => 'ꆈꌠ꒿ Nuosuhxop',
            ],
            [
                'code' => 'ik',
                'name' => 'Inupiaq',
                'native_name' => 'Iñupiaq, Iñupiatun',
            ],
            ['code' => 'io', 'name' => 'Ido', 'native_name' => 'Ido'],
            [
                'code' => 'is',
                'name' => 'Icelandic',
                'native_name' => 'Íslenska',
            ],
            ['code' => 'it', 'name' => 'Italian', 'native_name' => 'Italiano'],
            ['code' => 'iu', 'name' => 'Inuktitut', 'native_name' => 'ᐃᓄᒃᑎᑐᑦ'],
            [
                'code' => 'ja',
                'name' => 'Japanese',
                'native_name' => '日本語 (にほんご)',
            ],
            [
                'code' => 'jv',
                'name' => 'Javanese',
                'native_name' => 'ꦧꦱꦗꦮ, Basa Jawa',
            ],
            ['code' => 'ka', 'name' => 'Georgian', 'native_name' => 'ქართული'],
            ['code' => 'kg', 'name' => 'Kongo', 'native_name' => 'Kikongo'],
            [
                'code' => 'ki',
                'name' => 'Kikuyu, Gikuyu',
                'native_name' => 'Gĩkũyũ',
            ],
            [
                'code' => 'kj',
                'name' => 'Kuanyama, Kwanyama',
                'native_name' => 'Kuanyama',
            ],
            ['code' => 'kk', 'name' => 'Kazakh', 'native_name' => 'қазақ тілі'],
            [
                'code' => 'kl',
                'name' => 'Kalaallisut, Greenlandic',
                'native_name' => 'kalaallisut, kalaallit oqaasii',
            ],
            [
                'code' => 'km',
                'name' => 'Central Khmer',
                'native_name' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
            ],
            ['code' => 'kn', 'name' => 'Kannada', 'native_name' => 'ಕನ್ನಡ'],
            ['code' => 'ko', 'name' => 'Korean', 'native_name' => '한국어'],
            ['code' => 'kr', 'name' => 'Kanuri', 'native_name' => 'Kanuri'],
            [
                'code' => 'ks',
                'name' => 'Kashmiri',
                'native_name' => 'कश्मीरी, كشميري‎',
            ],
            [
                'code' => 'ku',
                'name' => 'Kurdish',
                'native_name' => 'Kurdî, کوردی‎',
            ],
            ['code' => 'kv', 'name' => 'Komi', 'native_name' => 'коми кыв'],
            ['code' => 'kw', 'name' => 'Cornish', 'native_name' => 'Kernewek'],
            [
                'code' => 'ky',
                'name' => 'Kirghiz, Kyrgyz',
                'native_name' => 'Кыргызча, Кыргыз тили',
            ],
            [
                'code' => 'la',
                'name' => 'Latin',
                'native_name' => 'latine, lingua latina',
            ],
            [
                'code' => 'lb',
                'name' => 'Luxembourgish, Letzeburgesch',
                'native_name' => 'Lëtzebuergesch',
            ],
            ['code' => 'lg', 'name' => 'Ganda', 'native_name' => 'Luganda'],
            [
                'code' => 'li',
                'name' => 'Limburgan, Limburger, Limburgish',
                'native_name' => 'Limburgs',
            ],
            ['code' => 'ln', 'name' => 'Lingala', 'native_name' => 'Lingála'],
            ['code' => 'lo', 'name' => 'Lao', 'native_name' => 'ພາສາລາວ'],
            [
                'code' => 'lt',
                'name' => 'Lithuanian',
                'native_name' => 'lietuvių kalba',
            ],
            [
                'code' => 'lu',
                'name' => 'Luba-Katanga',
                'native_name' => 'Kiluba',
            ],
            [
                'code' => 'lv',
                'name' => 'Latvian',
                'native_name' => 'latviešu valoda',
            ],
            [
                'code' => 'mg',
                'name' => 'Malagasy',
                'native_name' => 'fiteny malagasy',
            ],
            [
                'code' => 'mh',
                'name' => 'Marshallese',
                'native_name' => 'Kajin M̧ajeļ',
            ],
            [
                'code' => 'mi',
                'name' => 'Maori',
                'native_name' => 'te reo Māori',
            ],
            [
                'code' => 'mk',
                'name' => 'Macedonian',
                'native_name' => 'македонски јазик',
            ],
            ['code' => 'ml', 'name' => 'Malayalam', 'native_name' => 'മലയാളം'],
            [
                'code' => 'mn',
                'name' => 'Mongolian',
                'native_name' => 'Монгол хэл',
            ],
            ['code' => 'mr', 'name' => 'Marathi', 'native_name' => 'मराठी'],
            [
                'code' => 'ms',
                'name' => 'Malay',
                'native_name' => 'Bahasa Melayu, بهاس ملايو‎',
            ],
            ['code' => 'mt', 'name' => 'Maltese', 'native_name' => 'Malti'],
            ['code' => 'my', 'name' => 'Burmese', 'native_name' => 'ဗမာစာ'],
            [
                'code' => 'na',
                'name' => 'Nauru',
                'native_name' => 'Dorerin Naoero',
            ],
            [
                'code' => 'nb',
                'name' => 'Norwegian Bokmål',
                'native_name' => 'Norsk Bokmål',
            ],
            [
                'code' => 'nd',
                'name' => 'North Ndebele',
                'native_name' => 'isiNdebele',
            ],
            ['code' => 'ne', 'name' => 'Nepali', 'native_name' => 'नेपाली'],
            ['code' => 'ng', 'name' => 'Ndonga', 'native_name' => 'Owambo'],
            [
                'code' => 'nl',
                'name' => 'Dutch, Flemish',
                'native_name' => 'Nederlands, Vlaams',
            ],
            [
                'code' => 'nn',
                'name' => 'Norwegian Nynorsk',
                'native_name' => 'Norsk Nynorsk',
            ],
            ['code' => 'no', 'name' => 'Norwegian', 'native_name' => 'Norsk'],
            [
                'code' => 'nr',
                'name' => 'South Ndebele',
                'native_name' => 'isiNdebele',
            ],
            [
                'code' => 'nv',
                'name' => 'Navajo, Navaho',
                'native_name' => 'Diné bizaad',
            ],
            [
                'code' => 'ny',
                'name' => 'Chichewa, Chewa, Nyanja',
                'native_name' => 'chiCheŵa, chinyanja',
            ],
            [
                'code' => 'oc',
                'name' => 'Occitan',
                'native_name' => 'occitan, lenga d’òc',
            ],
            ['code' => 'oj', 'name' => 'Ojibwa', 'native_name' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ'],
            [
                'code' => 'om',
                'name' => 'Oromo',
                'native_name' => 'Afaan Oromoo',
            ],
            ['code' => 'or', 'name' => 'Oriya', 'native_name' => 'ଓଡ଼ିଆ'],
            [
                'code' => 'os',
                'name' => 'Ossetian, Ossetic',
                'native_name' => 'ирон æвзаг',
            ],
            [
                'code' => 'pa',
                'name' => 'Punjabi, Panjabi',
                'native_name' => 'ਪੰਜਾਬੀ, پنجابی‎',
            ],
            ['code' => 'pi', 'name' => 'Pali', 'native_name' => 'पालि, पाळि'],
            [
                'code' => 'pl',
                'name' => 'Polish',
                'native_name' => 'język polski, polszczyzna',
            ],
            [
                'code' => 'ps',
                'name' => 'Pashto, Pushto',
                'native_name' => 'پښتو',
            ],
            [
                'code' => 'pt',
                'name' => 'Portuguese',
                'native_name' => 'Português',
            ],
            [
                'code' => 'qu',
                'name' => 'Quechua',
                'native_name' => 'Runa Simi, Kichwa',
            ],
            [
                'code' => 'rm',
                'name' => 'Romansh',
                'native_name' => 'Rumantsch Grischun',
            ],
            ['code' => 'rn', 'name' => 'Rundi', 'native_name' => 'Ikirundi'],
            [
                'code' => 'ro',
                'name' => 'Romanian, Moldavian, Moldovan',
                'native_name' => 'Română',
            ],
            ['code' => 'ru', 'name' => 'Russian', 'native_name' => 'русский'],
            [
                'code' => 'rw',
                'name' => 'Kinyarwanda',
                'native_name' => 'Ikinyarwanda',
            ],
            [
                'code' => 'sa',
                'name' => 'Sanskrit',
                'native_name' => 'संस्कृतम्',
            ],
            ['code' => 'sc', 'name' => 'Sardinian', 'native_name' => 'sardu'],
            [
                'code' => 'sd',
                'name' => 'Sindhi',
                'native_name' => 'सिन्धी, سنڌي، سندھی‎',
            ],
            [
                'code' => 'se',
                'name' => 'Northern Sami',
                'native_name' => 'Davvisámegiella',
            ],
            [
                'code' => 'sg',
                'name' => 'Sango',
                'native_name' => 'yângâ tî sängö',
            ],
            [
                'code' => 'si',
                'name' => 'Sinhala, Sinhalese',
                'native_name' => 'සිංහල',
            ],
            [
                'code' => 'sk',
                'name' => 'Slovak',
                'native_name' => 'Slovenčina, Slovenský Jazyk',
            ],
            [
                'code' => 'sl',
                'name' => 'Slovenian',
                'native_name' => 'Slovenski Jezik, Slovenščina',
            ],
            [
                'code' => 'sm',
                'name' => 'Samoan',
                'native_name' => 'gagana fa\'a Samoa',
            ],
            ['code' => 'sn', 'name' => 'Shona', 'native_name' => 'chiShona'],
            [
                'code' => 'so',
                'name' => 'Somali',
                'native_name' => 'Soomaaliga, af Soomaali',
            ],
            ['code' => 'sq', 'name' => 'Albanian', 'native_name' => 'Shqip'],
            [
                'code' => 'sr',
                'name' => 'Serbian',
                'native_name' => 'српски језик',
            ],
            ['code' => 'ss', 'name' => 'Swati', 'native_name' => 'SiSwati'],
            [
                'code' => 'st',
                'name' => 'Southern Sotho',
                'native_name' => 'Sesotho',
            ],
            [
                'code' => 'su',
                'name' => 'Sundanese',
                'native_name' => 'Basa Sunda',
            ],
            ['code' => 'sv', 'name' => 'Swedish', 'native_name' => 'Svenska'],
            ['code' => 'sw', 'name' => 'Swahili', 'native_name' => 'Kiswahili'],
            ['code' => 'ta', 'name' => 'Tamil', 'native_name' => 'தமிழ்'],
            ['code' => 'te', 'name' => 'Telugu', 'native_name' => 'తెలుగు'],
            [
                'code' => 'tg',
                'name' => 'Tajik',
                'native_name' => 'тоҷикӣ, toçikī, تاجیکی‎',
            ],
            ['code' => 'th', 'name' => 'Thai', 'native_name' => 'ไทย'],
            ['code' => 'ti', 'name' => 'Tigrinya', 'native_name' => 'ትግርኛ'],
            [
                'code' => 'tk',
                'name' => 'Turkmen',
                'native_name' => 'Türkmen, Түркмен',
            ],
            [
                'code' => 'tl',
                'name' => 'Tagalog',
                'native_name' => 'Wikang Tagalog',
            ],
            ['code' => 'tn', 'name' => 'Tswana', 'native_name' => 'Setswana'],
            [
                'code' => 'to',
                'name' => 'Tonga (Tonga Islands)',
                'native_name' => 'Faka Tonga',
            ],
            ['code' => 'tr', 'name' => 'Turkish', 'native_name' => 'Türkçe'],
            ['code' => 'ts', 'name' => 'Tsonga', 'native_name' => 'Xitsonga'],
            [
                'code' => 'tt',
                'name' => 'Tatar',
                'native_name' => 'татар теле, tatar tele',
            ],
            ['code' => 'tw', 'name' => 'Twi', 'native_name' => 'Twi'],
            [
                'code' => 'ty',
                'name' => 'Tahitian',
                'native_name' => 'Reo Tahiti',
            ],
            [
                'code' => 'ug',
                'name' => 'Uighur, Uyghur',
                'native_name' => 'ئۇيغۇرچە‎, Uyghurche',
            ],
            [
                'code' => 'uk',
                'name' => 'Ukrainian',
                'native_name' => 'Українська',
            ],
            ['code' => 'ur', 'name' => 'Urdu', 'native_name' => 'اردو'],
            [
                'code' => 'uz',
                'name' => 'Uzbek',
                'native_name' => 'Oʻzbek, Ўзбек, أۇزبېك‎',
            ],
            ['code' => 've', 'name' => 'Venda', 'native_name' => 'Tshivenḓa'],
            [
                'code' => 'vi',
                'name' => 'Vietnamese',
                'native_name' => 'Tiếng Việt',
            ],
            ['code' => 'vo', 'name' => 'Volapük', 'native_name' => 'Volapük'],
            ['code' => 'wa', 'name' => 'Walloon', 'native_name' => 'Walon'],
            ['code' => 'wo', 'name' => 'Wolof', 'native_name' => 'Wollof'],
            ['code' => 'xh', 'name' => 'Xhosa', 'native_name' => 'isiXhosa'],
            ['code' => 'yi', 'name' => 'Yiddish', 'native_name' => 'ייִדיש'],
            ['code' => 'yo', 'name' => 'Yoruba', 'native_name' => 'Yorùbá'],
            [
                'code' => 'za',
                'name' => 'Zhuang, Chuang',
                'native_name' => 'Saɯ cueŋƅ, Saw cuengh',
            ],
            [
                'code' => 'zh',
                'name' => 'Chinese',
                'native_name' => '中文 (Zhōngwén), 汉语, 漢語',
            ],
            ['code' => 'zu', 'name' => 'Zulu', 'native_name' => 'isiZulu'],
        ];

        $this->db->table('languages')->insertBatch($data);
    }
}
