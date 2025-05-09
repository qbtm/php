<?php
    require 'db/db-connect.php';
function listStudentsFrom3TI($conn) {
    $sql = "
        SELECT s.nazwisko, s.imie
        FROM uczen s
        JOIN klasa c ON s.id_klasa = c.id
        WHERE c.numer = 3 AND c.oznaczenie = 'TI'
        ORDER BY s.nazwisko ASC
    ";
    $result = $conn->query($sql);

    echo "<ol>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['nazwisko']} {$row['imie']}</li>";
    }
    echo "</ol>";
}

function showTeachersTable($conn) {
    $sql = "SELECT imie AS first_name, nazwisko AS last_name, data_urodzenia AS birth_date FROM nauczyciel ORDER BY birth_date DESC";
    $result = $conn->query($sql);

    echo "<table border='1'>
            <tr><th>Imię</th><th>Nazwisko</th><th>Data urodzenia</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['birth_date']}</td>
              </tr>";
    }
    echo "</table>";
}

function countNamesEndingWithA($conn) {
    $sql1 = "SELECT COUNT(*) AS count FROM nauczyciel WHERE imie LIKE '%a'";
    $sql2 = "SELECT COUNT(*) AS count FROM uczen WHERE imie LIKE '%a'";

    $count1 = $conn->query($sql1)->fetch_assoc()['count'];
    $count2 = $conn->query($sql2)->fetch_assoc()['count'];

    $total = $count1 + $count2;

    echo "Liczba osób z imieniem kończącym się na 'a': $total";
}

function increaseGrades($conn) {
    $sql = "UPDATE ocena SET ocena = ocena + 1";
    if ($conn->query($sql) === TRUE) {
        echo "Wszystkie oceny zostały zwiększone o 1.";
    } else {
        echo "Błąd podczas aktualizacji ocen: " . $conn->error;
    }
}

function deleteOldTeachers($conn) {
    $countSql = "SELECT COUNT(*) AS count FROM nauczyciel WHERE YEAR(data_urodzenia) < 1950";
    $count = $conn->query($countSql)->fetch_assoc()['count'];

    $deleteSql = "DELETE FROM nauczyciel WHERE YEAR(data_urodzenia) < 1950";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Usunięto $count nauczycieli urodzonych przed 1950 rokiem.<br>Usunięcie zakończone sukcesem.";
    } else {
        echo "Błąd podczas usuwania nauczycieli: " . $conn->error;
    }
}

?>