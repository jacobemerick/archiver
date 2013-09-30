#Archiver
Rather simple PHP archive utility for backing up directories
----------------------------------------------------------
Simple script that recursively loops through a directory and adds all files to a ZIP archive. A few error catches are included as well.


Requirements
------------------
 - PHP (version 5 or better)
 - SPL (usually bundled in PHP5)
 - ZipArchive (another normal extension in PHP5)


Usage
------------------
Plop the archiver.php in or near the directory you want archived. Modify the three parameters as needed...
 - directory = the directory you want to archive, relative to archiver.php
 - ignore_file_list = any files that you want to ignore
 - archive_name = what you want the archived file named


Possible Future Enhancements
------------------
 - wildcard matching for ignore list (pending need)
 - options of what to do with the archived file (mail, curl, etc)


Changelog
------------------
v1.0 (2013-09-28)
 - initial release


------------------
 - Project at GitHub [jacobemerck/archiver](https://github.com/jacobemerick/archiver)
 - Jacob Emerick [@jpemeric](http://twitter.com/jpemeric) [jacobemerick.com](http://home.jacobemerick.com/)
 - Blog post explaining details [archiving a directory](http://blog.jacobemerick.com/web-development/archiving-a-directory/)