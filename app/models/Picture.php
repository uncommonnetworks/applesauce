<?php

class Picture extends Eloquent {

    public function pictureable()
    {
        return $this->morphTo();
    }


    public function __toString()
    {
        return $this->path;
    }

    public function getPath($size='')
    {
        if(!$size)
            return $this->path;

        $path = pathinfo($this->path);
        Log::info( "{$path['dirname']}/" . trim("{$path['filename']} {$size}") . ".{$path['extension']}");

        return "{$path['dirname']}/" . trim("{$path['filename']} {$size}") . ".{$path['extension']}";
    }
}
