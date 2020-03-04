<?php

namespace App\Traits;

trait DocumentExtensionTrait
{

    public function uploadExtension($extension)
    {

        $imageExtensions = ['tif','tiff','jpg','jpeg','gif','png','nef','cr2','pds','pef','crw','raw','arw','nrw','svg','svgz','ai','eps',''];
        $documentExtensions = ['doc','docx','odt','xls','xlsx','ods','ppt','pptx','txt'];
        $videoExtensions = ['webm','mpg','mp2','mpeg','mpe','mpv','mp4','m4p','m4v','avi','wmv','mov','qt','flv','swf','avchd'];
        $audioExtensions = ['pmc','wav','aiff','mp3','acc','ogg','wma','flac','alac','wma'];
        $pdfExtensions = ['pdf'];

        if (in_array($extension, $imageExtensions)) {
            $type = "image";
            return $type;
        }
        elseif (in_array($extension, $documentExtensions)) {
            $type = "document";
            return $type;
        }
        elseif (in_array($extension, $videoExtensions)) {
            $type = "video";
            return $type;
        }
        elseif (in_array($extension, $audioExtensions)) {
            $type = "audio";
            return $type;
        }
        elseif (in_array($extension, $pdfExtensions)) {
            $type = "pdf";
            return $type;
        }else{
            $type = "unknown";
            return $type;
        }
    }


}
