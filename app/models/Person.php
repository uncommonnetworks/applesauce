<?php

define( 'PERSONTITLE_MR', 'Mr.');
define( 'PERSONTITLE_MRS', 'Mrs.');
define( 'PERSONTITLE_MISS', 'Miss');
define( 'PERSONTITLE_MS', 'Ms.');
define( 'PERSONTITLE_UNKNOWN', ' ' );

abstract class Person {
    public $titleOptions = array(
        PERSONTITLE_MR => PERSONTITLE_MR,
        PERSONTITLE_MISS => PERSONTITLE_MISS,
        PERSONTITLE_MRS => PERSONTITLE_MRS,
        PERSONTITLE_MS => PERSONTITLE_MS,
        PERSONTITLE_UNKNOWN => PERSONTITLE_UNKNOWN
    );
}