<?php


namespace PhpFramework\File;


class File
{

    public static function requireDirectory($path)
    {
        $files = array_diff(scandir(static::path($path)), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $path . static::ds() . $file;
            if (static::exists($filePath)) {
                static::requireFile($filePath);
            }
        }
    }

    public static function path($path)
    {
        $path = static::root() . static::ds() . trim($path, '/');
        $path = str_replace(['/', '\\'], static::ds(), $path);
        return $path;
    }

    public static function root()
    {
        return ROOT;
    }

    public static function ds()
    {
        return DS;
    }

    public static function exists($path)
    {
        return file_exists(static::path($path));
    }

    public static function requireFile($path)
    {
        if (static::exists($path)) {
            return require_once static::path($path);
        }
    }

    public static function includeFile($path)
    {
        if (static::exists($path)) {
            return include static::path($path);
        }
    }


}