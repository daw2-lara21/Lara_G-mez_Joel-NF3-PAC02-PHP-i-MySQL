<?php
$db = mysqli_connect(gethostname(), 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
// insert data into the people table
$query  = 'INSERT INTO people
        (people_id, people_fullname, people_isactor, people_isdirector)
    VALUES
        (1, "Dane DeHaan", 1, 0),
        (2, "Luc Besson", 0, 1),
        (3, "Michael Dougherty", 0, 1),
        (4, "Millie Bobby Brown", 1, 0),
        (5, "Ryan Gosling", 1, 0),
        (6, "Denis Villeneuve", 0, 1),
        (7, "Jennifer Lawrence",1,0),
        (9, "Chris Pratt", 1, 0),
        (10, "George Lucas", 1,0)';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Data inserted successfully!';

$query = 'SELECT
        movie_name, movietype_label
    FROM
        movie LEFT JOIN movietype ON movie_type = movietype_id
    WHERE
        movie.movie_type = movietype.movietype_id AND
        movie_year > 1990
    ORDER BY
        movie_type';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// show the results
echo '<table border="1">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

$query = 'SELECT
        m.movie_name, mt.movietype, p1.people, p2.people
    FROM
        movie m, movietype mt, people p1, people p2
    WHERE
        mv.movie_leadactor=p1.people_id AND m.movie_director=p2.people_id AND m.movie_type=mt.movietype_id
    ORDER BY
        movie_type';
$result = mysqli_query($db,$query) or die(mysqli_error($db));

?>

