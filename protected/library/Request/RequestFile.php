<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 01.02.16
 * Time: 9:33
 */

/**
 * Action functions for folders and files
 * Class RequestFile
 */
class RequestFile
{
    const FOLDER_UPLOAD = "upload";

    /**
     * Save uploaded file
     *
     * @param $requestId
     * @return string relative path to saved file
     * @throws ExceptionUpload
     * @throws \Exception
     */
    public static function fileUpload($requestId)
    {
        if (!is_writable(self::getUploaderFolder())) {
            throw new \Exception('Upload: server error. Write in a directory: ' . self::getUploaderFolder() . ' is impossible!');
        }

        $source = $_FILES['files']['tmp_name'];
        $filename = urldecode($_FILES['files']['name']);

        $target = self::getUploaderFolder() . "/" . $requestId;

        if (!move_uploaded_file($source, $target)) {
            throw new \Exception('Upload: save file error.');
        }

        return $filename;
    }

    /**
     * Get file as streem
     *
     * @param $requestId
     * @param $filename
     * @throws Exception
     */
    public static function streaming($requestId, $filename)
    {
        $filepath = self::getUploaderFolder() . "/" . $requestId;

        if (!file_exists($filepath)) {
            throw new \Exception('Файл не найден');
        }

        $fsize = filesize($filepath);
        $ftime = date('D, d M Y H:i:s T', filemtime($filepath));
        $fd = @fopen($filepath, 'rb');
        if (isset($_SERVER['HTTP_RANGE'])) {
            $range = $_SERVER['HTTP_RANGE'];
            $range = str_replace('bytes=', '', $range);
            list($range, $end) = explode('-', $range);
            if (!empty($range)) {
                fseek($fd, $range);
            }
        } else {
            $range = 0;
        }
        if ($range) {
            header($_SERVER['SERVER_PROTOCOL'].' 206 Partial Content');
        } else {
            header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
        }

        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Last-Modified: '.$ftime);
        header('Accept-Ranges: bytes');
        header('Content-Length: '.($fsize - $range));
        if ($range) {
            header("Content-Range: bytes $range-".($fsize - 1).'/'.$fsize);
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $content_type = finfo_file($finfo, $filepath);
        header('Content-Type: '.$content_type);
        $downloaded = 0;
        while (!feof($fd) && !connection_status() && ($downloaded < $fsize)) {
            echo fread($fd, 512000);
            $downloaded += 512000;
            flush();
        }
        fclose($fd);
        exit;
    }

    /**
     * Get full (absolute) path to file
     * @return string
     */
    private static function getUploaderFolder()
    {
        return __DIR__ . "/../../../" . self::FOLDER_UPLOAD;
    }
}
