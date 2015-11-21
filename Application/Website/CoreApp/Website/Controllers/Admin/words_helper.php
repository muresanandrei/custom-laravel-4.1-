<?php

function make_keywords_from_string($string, $dictionar){
    
    $words_temp = explode(' ', $string);
    
    $words = '';
    
    foreach( $words_temp as $w ){
        
                if( !in_array( $w, $dictionar ) ){
                    
                    $words .= $w.',';
                    
                }//if !in_array
        
    }//foreach words
    
    return $words;
    
}//make_keywords_from_string


/**
 * To be used for getting dicrtionar of common words
 * e.g. 'the', 'and'
 */
function get_common_words(){
    
    return array('the', 'my');
    
}//get_common_words



//to remember strtolower
function convert_description($string){
    
    
                $synonyms = array(
                                                    'big'               => array('huge', 'sizable', 'large', 'massive'),
                                                    'huge'           => array('sizable', 'large', 'massive, big'),
                                                    'sizable'        => array('huge', 'large', 'massive, big'),
                                                    'large'           => array('huge', 'sizable', 'massive, big'),
                                                    'massive'      => array('huge', 'sizable', 'large, big'),
                    
                                                    'neat'                    => array('smashing', 'keen', 'nice'),
                                                    'smashing'           => array('neat', 'keen', 'nice'),
                                                    'keen'                   => array('neat', 'smashing', 'nice'),
                                                    'nice'                    => array('neat', 'smashing', 'keen'),
                    
                                                    'cocks'    => array('dicks'),
                                                    'dicks'     => array('cocks'),
                    
                                                    'jammed'    => array('pushed'),
                                                    'pushed'    => array('jammed'),
                    
                                                    'hot'                   => array('sexy', 'cute', 'beautiful', 'pretty', 'gorgeous', 'lovely', 'attractive', 'babe'),
                                                    'sexy'                 => array('hot', 'cute', 'beautiful', 'pretty', 'gorgeous', 'lovely', 'attractive', 'babe'),
                                                    'beautiful'          => array('hot', 'cute', 'sexy', 'pretty', 'gorgeous', 'lovely', 'attractive', 'babe'),
                                                    'pretty'               => array('hot', 'cute', 'sexy', 'beautiful', 'gorgeous', 'lovely', 'attractive', 'babe'),
                                                    'gorgeous'        => array('hot', 'cute', 'sexy', 'beautiful', 'pretty', 'lovely', 'attractive', 'babe'),
                                                    'lovely'               => array('hot', 'cute', 'sexy', 'beautiful', 'pretty', 'gorgeous', 'attractive', 'babe'),
                                                    'attractive'         => array('hot', 'cute', 'sexy', 'beautiful', 'pretty', 'gorgeous', 'lovely', 'babe'),
                                                    'babe'                => array('hot', 'cute', 'sexy', 'beautiful', 'pretty', 'gorgeous', 'lovely', 'attractive'),
                    
                                                    'girl'          => array('chick', 'lady', 'bitch'),
                                                    'chick'      => array('girl', 'lady', 'bitch'),
                                                    'lady'        => array('girl', 'chick', 'bitch'),
                                                    'bitch'      => array('girl', 'chick', 'lady'),
                    
                                                    'prostitute'    => array('whore', 'hooker', 'tramp', 'slut'),
                                                    'whore'          => array('prostitute', 'hooker', 'tramp', 'slut'),
                                                    'hooker'         => array('prostitute', 'whore', 'tramp', 'slut'),
                                                    'tramp'           => array('prostitute', 'whore', 'hooker', 'slut'),
                                                    'slut'               => array('prostitute', 'whore', 'hooker', 'tramp'),
                    
                                                    'wife'               => array('gf', 'girlfriend', 'mistress', 'lover'),
                                                    'gf'                  => array('wife', 'girlfriend', 'mistress', 'lover'),
                                                    'girlfriend'      => array('wife', 'gf', 'mistress', 'lover'),
                                                    'mistress'      => array('wife', 'gf', 'girlfriend', 'lover'),
                                                    'lover'             => array('wife', 'gf', 'girlfriend', 'mistress'),
                    
                                                    'foreign'         => array('overseas', 'exotic'),
                                                    'overseas'     => array('foreign', 'exotic'),
                                                    'exotic'           => array('foreign', 'overseas'),
                    
                                                    'vibrator'        => array('dildo', 'toy'),
                                                    'dildo'            => array('vibrator', 'toy'),
                                                    'toy'               => array('vibrator', 'dildo'),
                    
                                                    'college'       => array('university'),
                                                    'university'   => array('college'),
                    
                                                    'fest'             => array('party', 'festival'),
                                                    'party'           => array('fest', 'festival'),
                                                    'festival'        => array('fest', 'party'),
                    
                                                    'gives'          => array('does', 'performs'),
                                                    'does'          => array('performs'),
                                                    'performs'   => array('does'),
                    
                                                    'cum'           => array('jizz', 'sperm', 'semen'),
                                                    'jizz'             => array('cum', 'sperm', 'semen'),
                                                    'sperm'       => array('cum', 'jizz', 'semen'),
                                                    'semen'      => array('cum', 'jizz', 'sperm'),
                    
                                                    'couple'      => array('lovers'),
                                                    'lovers'       => array('couple'),
                    
                                                    'teen'         => array('young'),
                                                    'young'      => array('teen'),

                                                    'mom'       => array('milf'),
                                                    'milf'          => array('mom'),
                    
                                                    'european'      => array('euro'),
                                                    'euro'               => array('european'),
                    
                );
    
    $words = explode(' ', $string);
    
    //NOW LET'S LOOP THROUGH EACH WORD
    
    $converted_string = '';

    $unknown_words = array();
    
    foreach( $words as $w ){
        
                    if( isset( $synonyms[$w] ) ){
                        
                                 $count = count( $synonyms[$w] ) - 1;
                                 
                                 $converted_string .= $synonyms[$w][rand(0, $count)] . ' ';
                        
                    }//if we have word in dictionar
                    else{
                        
                                $converted_string .= $w.' ';

                                $unknown_words[] = $w;
                            
                    }//else we just pass the word 
        
    }//foreach words
    
    
    return $converted_string;
    
}//convert_description