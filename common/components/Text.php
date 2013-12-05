<?php
namespace common\components;

use \yii\base\Component;
use yii\helpers\Html;

/**
 * Contain all needed string modification functionality
 */
class Text extends Component
{

    /**
     * Cut the text, by word or chars count
     *
     * @param        $text
     * @param        $length
     * @param string $delim
     * @param string $tail
     *
     * @return string
     */
    public function cut($text, $length, $tail = "")
    {
        $text = strip_tags($text);
        if (mb_strlen($text, 'utf-8') <= $length) {
            return $text;
        }

        $pos = mb_strpos($text, ' ', $length, 'utf-8');

        if ($pos == false) {
            return $text;
        }
        $substr = mb_substr(html_entity_decode($text, ENT_NOQUOTES, 'utf-8'), 0, $pos, 'utf-8');
        return trim($substr, '., -:;') . $tail;
    }


    /**
     * Convert string to url forman (only EN alphabet and "_")
     *
     * @param $string
     *
     * @return mixed
     */
    public function toUrl($string)
    {
        return str_replace([" ", '"', "'"], ["_", '', ''], self::translit($string));
    }


    protected $layoutMap = array(
        'ru' => array(
            'from' => '`1234567890-=qwertyuiop[]asdfghjkl;\'\\zxcvbnm,./~!@#$%^&*()_+QWERTYUIOP{}ASDFGHJKL:"|ZXCVBNM<>?ё1234567890-=йцукенгшщзхъфывапролджэ\\ячсмитьбю.Ё!"№;%:?*()_+ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭ/ЯЧСМИТЬБЮ,',
            'to' => 'ё1234567890-=йцукенгшщзхъфывапролджэ\\ячсмитьбю.Ё!"№;%:?*()_+ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭ/ЯЧСМИТЬБЮ,`1234567890-=qwertyuiop[]asdfghjkl;\'\\zxcvbnm,./~!@#$%^&*()_+QWERTYUIOP{}ASDFGHJKL:"|ZXCVBNM<>?'
        ),
    );


    public function changeLayout($str, $layout = 'ru')
    {
        $from = $this->layoutMap[$layout]['from'];
        $to = $this->layoutMap[$layout]['to'];

        $result = $this->mb_strtr($str, $from, $to);
        if ($result == $str) {
            $result = $this->mb_strtr($str, $to, $from);
        }

        return $result;
    }


    /**
     * Multibyte strtr
     *
     * @param string $str
     * @param string $from
     * @param string $to
     *
     * @return string
     */
    public function mb_strtr($str, $from, $to)
    {
        return strtr($str, array_combine($this->mb_str_split($from), $this->mb_str_split($to)));
    }


    /**
     * Multibyte str_split
     *
     * @param string $str
     *
     * @return string
     */
    public function mb_str_split($str)
    {
        assert(is_string($str));

        return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);
    }


    /**
     * Translit
     *
     * @param $string
     *
     * @return string
     */
    public function translit($string)
    {
        $words = array(
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ж" => "J",
            "З" => "Z",
            "И" => "I",
            "Й" => "Y",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "H",
            "Ц" => "TS",
            "Ч" => "CH",
            "Ш" => "SH",
            "Щ" => "SCH",
            "Ъ" => "",
            "Ы" => "YI",
            "Ь" => "",
            "Э" => "E",
            "Ю" => "YU",
            "Я" => "YA",
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ж" => "j",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "y",
            "ы" => "yi",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            " " => "_",
            "." => "",
            "," => "",
            "?" => "",
            "!" => "",
            ":" => ""
        );

        return strtr($string, $words);
    }


    /**
     * Get array of RU alphabet in UTF-8
     *
     * @return array
     */
    public function alphabetRu()
    {
        $res = array();
        foreach (range(chr(0xC0), chr(0xDF)) as $lit) {
            $res[] = iconv('CP1251', 'UTF-8', $lit);
        }
        return $res;
    }


    /**
     * Get array of EN alphabet in UTF-8
     *
     * @return array
     */
    public function alphabetEn()
    {
        $res = array();
        foreach (range("A", "Z") as $lit) {
            $res[] = $lit;
        }
        return $res;
    }


    /**
     * Replace non censuring terms to given string
     *
     * @param $string
     *
     * @return string
     */
    function antimat($string, $return_boolean = false, $replaces = "<font color=red>цетзура</font> ")
    {
        //setlocale (LC_ALL, "ru_RU.UTF8");

        //latin equivalents for russian letters
        $let_matches = array(
            "a" => "а",
            "c" => "с",
            "e" => "е",
            "k" => "к",
            "m" => "м",
            "o" => "о",
            "x" => "х",
            "y" => "у",
            "ё" => "е"
        );
        $bad_words = array(
            ".*ху(й|и|я|е|л(и|е)).*",
            ".*пи(з|с)д.*",
            "бля.*",
            ".*бля(д|т|ц).*",
            "(с|сц)ук(а|о|и).*",
            "еб.*",
            ".*уеб.*",
            "Позитивеб.*",
            ".*еб(а|и)(н|с|щ|ц).*",
            ".*ебу(ч|щ).*",
            ".*пид(о|е)р.*",
            ".*хер.*",
            "г(а|о)ндон",
            ".*Позитивлуп.*"
        );

        $counter = 0;
        $elems = explode(" ", $string); //here we explode string to words
        $count_elems = count($elems);
        for ($i = 0; $i < $count_elems; $i++) {
            $blocked = 0;
            /*formating word...*/
            $str_rep = $this->mb_strtolower($elems[$i]);

            $str_rep = strtr($str_rep, $let_matches);

            /*done*/
            /*here we are trying to find bad word*/
            /*match in the special array*/
            for ($k = 0; $k < count($bad_words); $k++) {
                if (preg_match("/^" . $bad_words[$k] . "/i", $str_rep)) {
                    if ($return_boolean) {
                        return true;
                    }

                    $elems[$i] = $replaces; //можно рандомные замены напихать сюда

                    $counter++;
                    break;
                }

                if ($str_rep == $bad_words[$k]) {
                    $elems[$i] = $this->rand_replace();
                    $counter++;
                    break;
                }
            }
        }
        if ($counter != 0) {
            $string = implode(" ", $elems);
        } //here we implode words in the whole string
        return $string;
    }

    public function mb_strtolower($str)
    {
        $chars_hi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯЁЂЃЄЅІЇЈЉЊЋЌЎЏҐ';
        $chars_lo = 'abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъыьэюяёђѓєѕіїјљњћќўџґ';
        return $this->mb_strtr($str, $chars_hi, $chars_lo);
    }

    public function mb_strtoupper($str)
    {
        $chars_hi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯЁЂЃЄЅІЇЈЉЊЋЌЎЏҐ';
        $chars_lo = 'abcdefghijklmnopqrstuvwxyzабвгдежзийклмнопрстуфхцчшщъыьэюяёђѓєѕіїјљњћќўџґ';
        return $this->mb_strtr($str, $chars_lo, $chars_hi);
    }

    /**
     * Parse template file content using {@link TextComponent::parseTemplate}
     *
     * @see parseTemplate
     *
     * @param $file
     * @param $data
     *
     * @return string
     */
    public function parseTemplateFile($file, $data)
    {
        return $this->parseTemplate(file_get_contents($file), $data);
    }


    /**
     * Parse template string. Template syntax is {{SOME_VAR}}
     *
     * @param $str
     * @param $data array( SOME_VAR => 'value', ... )
     *
     * @return string
     */
    public function parseTemplate($str, $data)
    {
        $formatted_data = array();
        foreach ($data as $key => $val) {
            $formatted_data['{{' . strtoupper($key) . '}}'] = $val;
        }
        return strtr($str, $formatted_data);
    }


    /**
     * Convert Underscore coding style to Camelcase
     *
     * @param $string
     *
     * @return string
     */
    public static function underscoreToCamelcase($string)
    {
        $result = '';

        $string = explode('_', $string);
        foreach ($string as $i => $sub_string) {
            if ($i != 0) {
                $sub_string = ucfirst($sub_string);
            }

            $result .= $sub_string;
        }

        return $result;
    }


    /**
     * Convert Camelcase coding style to Underscore
     *
     * @param $string
     *
     * @return string
     */
    public static function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }
}