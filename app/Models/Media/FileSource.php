<?php

namespace App\Models\Media;

interface FileSource {

    public function getClientMimeType() : string;

    public function guessExtension() : string;

    public function getClientOriginalName() : string;

    public function getPathName() : string;

    public function move(string $destination, string $name);

}