<?php
    class DBAccess {
        private const HOST = "localhost";
        private const USERNAME = "root";
        private const PASSWORD = "";
        private const NAME = "Ricette";
        private $connection;

        //Funzione di connessione
        public function openDBConnection() {
            $this->connection = mysqli_connect(DBAccess::HOST, DBAccess::USERNAME, DBAccess::PASSWORD, DBAccess::NAME);
            if (mysqli_error($this->connection)) {
                return false;
            }
            else {
                return true;
            }
        }

        //Funzione generale di estrazione dati
        public function getFile() {
            $querySelect = "SELECT * FROM Ricette ORDER BY ID DESC";
            $queryResult = mysqli_query($this->connection, $querySelect);
            if (!$queryResult || mysqli_num_rows($queryResult)==0) {
                return null;
            }
            else {
                $list = array();
                while($row = mysqli_fetch_assoc($queryResult)) {
                    $cell = array(
                        "ID" => $row["ID"],
                        "Nome" => $row["Nome"],
                        "Difficolta" => $row["Difficolta"],
                        "Tempo" => $row["Tempo"],
                        "Immagine" => $row["Immagine"],
                        "AltImmagine" => $row["AltImmagine"],
                        "Ingredienti" => $row["Ingredienti"],
                        "Testo" => $row["Testo"],
                    );
                    array_push($list,$cell);
                    }
                return $list;
            }
        }

        public function getFileID($ID) {
            $querySelect = "SELECT * FROM Ricette WHERE ID=".$ID;
            $queryResult = mysqli_query($this->connection, $querySelect);
            if (!$queryResult || mysqli_num_rows($queryResult)==0) {
                return null;
            }
            else {
                $queryResult = mysqli_fetch_array($queryResult);
                $cell = array(
                    "ID" => $queryResult["ID"],
                    "Nome" => $queryResult["Nome"],
                    "Difficolta" => $queryResult["Difficolta"],
                    "Tempo" => $queryResult["Tempo"],
                    "Immagine" => $queryResult["Immagine"],
                    "AltImmagine" => $queryResult["AltImmagine"],
                    "Ingredienti" => $queryResult["Ingredienti"],
                    "Testo" => $queryResult["Testo"],
                );   
                return $cell;
            }
        }

        //Funzione per l'inserimento dei dati
        public function insertFile($Nome,$Difficolta,$Tempo,$Immagine,$AltImmagine,$Ingredienti,$Testo) {
            $table = "Ricette(Nome,Difficolta,Tempo,Immagine,AltImmagine,Ingredienti,Testo)";
            $value ="(\"$Nome\",\"$Difficolta\",\"$Tempo\",\"$Immagine\",\"$AltImmagine\",\"$AltImmagine\",\"$Testo\")";
            $queryInsert = "INSERT INTO $table VALUES $value";
            $queryResult = mysqli_query($this->connection,$queryInsert);
            if(mysqli_affected_rows($this->connection) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        /*//Funzione modifica dati
        public function updateFile($table,$Titolo,$Immagine,$AltImmagine,$Testo,$ID) {
            $list = $this->getFile($table);
            foreach ($list as $cell) {
                if($ID == $cell['ID']) {
                    if($Immagine != $cell['Immagine']) {
                        $directory = $_SERVER['DOCUMENT_ROOT'] . str_replace('./','/TecWeb/',$cell['Immagine']);
                        unlink($directory);
                    }
                    if($Titolo==$cell['Titolo'] && $Immagine==$cell['Immagine'] && $AltImmagine==$cell['AltImmagine'] && $Testo==$cell['Testo']) {
                        return true;
                    }
                }
            }
            $queryInsert = "UPDATE $table SET Titolo=\"$Titolo\", Immagine=\"$Immagine\", AltImmagine=\"$AltImmagine\", Testo=\"$Testo\" WHERE $table . ID=\"$ID\"";
            $queryResult = mysqli_query($this->connection,$queryInsert);
            if(mysqli_affected_rows($this->connection) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        //Funzione elimina dati
        public function deleteFile($table,$ID) {
            $list = $this->getFile($table);
            if($list) {
                foreach ($list as $cell) {
                    if($ID == $cell['ID']) {
                        $directory = $_SERVER['DOCUMENT_ROOT'] . str_replace('./','/TecWeb/',$cell['Immagine']);
                        unlink($directory);
                    }
                }
            }
            $queryInsert = "DELETE FROM $table WHERE $table . ID=\"$ID\"";
            $queryResult = mysqli_query($this->connection,$queryInsert);
            if(mysqli_affected_rows($this->connection) > 0) {
                return true;
            }
            else {
                return false;
            }
        }*/

        // Login
        public function getLogin() {
            $querySelect = 'SELECT * FROM Login';
            $queryResult = mysqli_query($this->connection, $querySelect);
            if (!$queryResult || mysqli_num_rows($queryResult)==0) {
                return null;
            }
            else {
                while($row = mysqli_fetch_assoc($queryResult)) {
                    $cell = array(
                        "Username" => $row["Username"],
                        "Password" => $row["Password"],
                    );
                }
                return $cell;
            }
        }
    }
?>