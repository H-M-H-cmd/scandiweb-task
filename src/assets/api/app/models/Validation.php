<?php

interface Validation
{
    // Common validation rules
    public static function required($attr, $args);

    public static function unique($attr, $args);

    public static function digits($attr, $args);
}