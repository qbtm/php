<?php
require 'db/queries/queries.php';

echo "<h2>Ćwiczenie 1: Uczniowie z klasy 3 TI</h2>";
listStudentsFrom3TI($conn);

echo "<h2>Ćwiczenie 2: Lista nauczycieli</h2>";
showTeachersTable($conn);

echo "<h2>Ćwiczenie 3: Liczba osób z imieniem kończącym się na 'a'</h2>";
countNamesEndingWithA($conn);

echo "<h2>Ćwiczenie 4: Zwiększenie wszystkich ocen o 1</h2>";
increaseGrades($conn);

echo "<h2>Ćwiczenie 5: Usunięcie nauczycieli urodzonych przed 1950 rokiem</h2>";
deleteOldTeachers($conn);

$conn->close();
?>
