<?php
/**
 * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater than 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $minute
 * @return string
 * @throws InvalidArgumentException
 */
function getMinuteQuarter(int $minute)
{
    if($minute<0 or $minute>60){
        throw new InvalidArgumentException('InvalidArgumentException;');
    }else{
        if($minute>=1 and $minute<=15){
            return "first";
        }elseif ($minute>=16 and $minute<=30){
            return "second";
        }elseif($minute>=31 and $minute<=45){
            return "third";
        }elseif($minute>=46 and $minute<=59 or $minute==0){
            return "fourth";
        }
    }

}

/**
 * The $year variable contains a year (i.e. 1995 or 2020 etc).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower than 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $year
 * @return boolean
 * @throws InvalidArgumentException
 */
function isLeapYear(int $year){
    if($year<1900){
        throw new InvalidArgumentException('InvalidArgumentException;');
    }else{
        if($year % 4==0 and $year % 100!=0 or $year % 400== 0){
            return true;
        }else{
            return false;
        }
    }
   }


/**
 * The $input variable contains a string of six digits (like '123456' or '385934').
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more or less than 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  string  $input
 * @return boolean
 * @throws InvalidArgumentException
 */
function isSumEqual(string $input)
{
    $res1=0;
    $res2=0;
    $arr = str_split($input);
    if(count($arr)!=6){
        throw new InvalidArgumentException('InvalidArgumentException;');
    }else{
        for ($i=0;$i<count($arr)/2;$i++){
            $res1+=$arr[$i];
        }
        for ($j=count($arr)-1;$j>=count($arr)/2;$j--){
            $res2+=$arr[$j];

        }
        if($res1==$res2){
            return true;
        }else{
            return false;
        }
    }
}