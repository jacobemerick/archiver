<?php

/**
 * Archiver - a simple script to zip up a directory
 * @see https://github.com/jacobemerick/archiver
 *
 * @author jacobemerick (http://home.jacobemerick.com/)
 * @version 1.0 (2013-09-28)
**/


/* parameters that you can set */

// directory that you want to archive, relative to the archiver.php file
$directory = 'DIRECTORY';

// list of files that you want to ignore, relative to the archived directory
$ignore_file_list = array();

// final archive name that will be saved, relative to the archiver.php file
$archive_name = 'archive.zip';


/* should not have to change anything below this line */
$directory_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
$archive_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . $archive_name;

$directoryIterator = new RecursiveDirectoryIterator($directory_path);
$iteratorIterator = new RecursiveIteratorIterator($directoryIterator); // giggle at name

$archive = new ZipArchive();
$archive_open_result = $archive->open($archive_path, ZipArchive::OVERWRITE); // overwrite > create

if ($archive_open_result === true)
{
    foreach ($iteratorIterator as $file)
    {
        // local path is handy for ignore sections and easier archive handling
        $local_path = str_replace($directory_path, '', $file->getPathname());
        if (in_array($local_path, $ignore_file_list))
            continue;
        
        if ($archive->addFile($file->getPathname(), $local_path) === true)
            echo "Could not add a file: {$local_path}\n";
    }
    
    $archive->close();
    echo 'Successfully archived your directory.';
}
else
{
    echo 'Unable to archive the directory. Error: ';
    switch ($archive_open_result)
    {
        case ZipArchive::ER_EXISTS :
            echo 'File already exists.';
            break;
        case ZipArchive::ER_INCONS :
            echo 'Zip archive inconsistent.';
            break;
        case ZipArchive::ER_INVAL :
            echo 'Invalid argument.';
            break;
        case ZipArchive::ER_MEMORY :
            echo 'Malloc failure.';
            break;
        case ZipArchive::ER_NOENT :
            echo 'No such file.';
            break;
        case ZipArchive::ER_NOZIP :
            echo 'Not a zip archive.';
            break;
        case ZipArchive::ER_OPEN :
            echo "Can't open file.";
            break;
        case ZipArchive::ER_READ :
            echo 'Read error.';
            break;
        case ZipArchive::ER_SEEK :
            echo 'Seek error.';
            break;
        default :
            echo "Undefined error: {$archive_open_result}";
            break;
    }
}