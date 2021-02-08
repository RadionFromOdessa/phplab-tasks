<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into a camel-cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
    $arr = str_split($input,1);

    if(!function_exists('filterChars')){
        function filterChars($ars){
            if(in_array('_',$ars)!=false){
                $search =   array_search('_',$ars);
                $ars[$search+1]=ucfirst($ars[$search+1]);
                unset($ars[$search]);
                return filterChars($ars);
            }
            return $ars;
        }
    }
    return implode(filterChars($arr));
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{

    preg_match_all('/./us', $input, $arк);

    $str = join('', array_reverse($arк[0]));

    return join(' ', array_reverse(mb_split(' ', $str)));
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with the first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
    for($i=0;$i<strlen($noun);$i++){
        if($noun[0]==$noun[strlen($noun)-1]){
            $str = ucfirst($noun).substr($noun,1,strlen($noun)-1);
        }else{
            $str='The'.' '.ucfirst($noun);
        }
    }return $str;
}