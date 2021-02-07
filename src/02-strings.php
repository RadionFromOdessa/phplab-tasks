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
    for ($i=0;$i<mb_strlen($input);$i++){
        if($input[$i]=='_'){
            $input[$i+1]=ucfirst($input[$i+1]);
        }
        $str=str_replace('_','',$input);
    }
    return $str;
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
    $res=[];
    $arr = explode(' ',$input);
    foreach ($arr as $elem){
        $r = '';
        for ($i = mb_strlen($elem); $i>=0; $i--) {
            $r .= mb_substr($elem, $i, 1);
        }
        $res[]=$r;
    }$str=implode(' ',$res);
    return $str;
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