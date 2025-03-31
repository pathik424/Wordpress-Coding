<?php 


UPDATE N0uxK4lRK_options SET option_value = replace(option_value, 'http://localhost/projects/qsgen/', 'http://localhost/projects/qs-projects/qsgen/') WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE N0uxK4lRK_posts SET guid = replace(guid, 'http://localhost/projects/qsgen/','http://localhost/projects/qs-projects/qsgen/');

UPDATE N0uxK4lRK_posts SET post_content = replace(post_content, 'http://localhost/projects/qsgen/', 'http://localhost/projects/qs-projects/qsgen/');

UPDATE N0uxK4lRK_postmeta SET meta_value = replace(meta_value, 'http://localhost/projects/qsgen/', 'http://localhost/projects/qs-projects/qsgen/');


?>