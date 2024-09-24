<?php
namespace App\Repositories\Contracts;

use Facade\FlareClient\Stacktrace\File;

interface IPictureRepository {
    public function UploadImage( $image,$id);


}


