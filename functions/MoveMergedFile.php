<?php
array_map("unlink", glob("uploads/Excel/*"));
array_map("unlink", glob("uploads/CSV/*"));
rename("uploads/MergedFile.csv", "../MergedFile.csv");
file_put_contents("PopularCourses.csv", "");
