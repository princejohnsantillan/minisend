<?php

if (! function_exists('avatarUrl')) {
    function avatarUrl(string $name)
    {
        $background = [
            'ef4444', //Red
            'f97316', //Orange
            'f59e0b', //Amber
            'eab308', //Yellow
            '84cc16', //Lime
            '22c55e', //Green
            '10b981', //Emerald
            '14b8a6', //Teal
            '0ea5e9', //Sky
            '3b82f6', //Blue
            '6366f1', //Indigo
            '8b5cf6', //Violet
            'a855f7', //Purple
            'd946ef', //Fuschia
            'ec4899', //Pink
            'f43f5e', //Rose
        ];

        return sprintf(
            'https://ui-avatars.com/api/?background=%s&color=%s&name=%s',
            $background[crc32($name) % count($background)],
            'fff',
            str($name)->replaceMatches('/[^a-zA-Z ]/', '')->slug()->value()
        );
    }
}
