<?php
require_once("model/Survey.inc.php");
require_once("model/Response.inc.php");

class Database
{

    private $connection;

    /**
     * Ouvre la base de données. Si la base n'existe pas elle
     * est créée à l'aide de la méthode createDataBase().
     */
    public function __construct()
    {
        $dbHost = "localhost";
        $dbBd = "sondages";
        $dbPass = "";
        $dbLogin = "root";

        try {
            $dbh = new PDO("mysql:host=localhost", $dbLogin, $dbPass);

            $dbh->exec("CREATE DATABASE IF NOT EXISTS `$dbBd` ;")
            or die(print_r($dbh->errorInfo(), true));
        } catch (PDOException $e) {
            die("Probleme au niveau de la base de donnee : " . $e->getMessage());
        }

        $url = 'mysql:host=' . $dbHost . ';dbname=' . $dbBd;
        //$url = 'sqlite:database.sqlite';
        $this->connection = new PDO($url, $dbLogin, $dbPass);
        if (!$this->connection) die("impossible d'ouvrir la base de données");
        $this->createDataBase();
    }


    /**
     * Initialise la base de données ouverte dans la variable $connection.
     * Cette méthode crée, si elles n'existent pas, les trois tables :
     * - une table users(nickname char(20), password char(50));
     * - une table surveys(id integer primary key autoincrement,
     *                        owner char(20), question char(255));
     * - une table responses(id integer primary key autoincrement,
     *        id_survey integer,
     *        title char(255),
     *        count integer);
     */
    private function createDataBase()
    {
        $this->connection->exec(
            "CREATE TABLE IF NOT EXISTS users (" .
            " nickname CHAR(20)," .
            " password CHAR(50)" .
            ");" . "CREATE TABLE IF NOT EXISTS surveys (" .
            " id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,	" .
            " owner CHAR(20)," .
            " category CHAR(50)," .
            " question CHAR(250)" .
            ");" . "CREATE TABLE IF NOT EXISTS responses (" .
            " id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,	" .
            " id_survey INTEGER," .
            " title CHAR(255)," .
            "count INTEGER DEFAULT 0 " .
            ");" . "CREATE TABLE IF NOT EXISTS commentaire (" .
            " id_commentaire INT NOT NULL AUTO_INCREMENT PRIMARY KEY ," .
            " id_survey INTEGER, " .
            " commentaire CHAR(250)" .
            ");");
        $this->connection->exec("ALTER TABLE surveys ADD CONSTRAINT FK_users_nickname 
                                              FOREIGN KEY (owner) REFERENCES nickname.users;" .
            "ALTER TABLE responses ADD CONSTRAINT FK_ID_SURVEY 
                                              FOREIGN KEY (id_survey) REFERENCES surveys(id);");
    }

    /**
     * Vérifie si un pseudonyme est valide, c'est-à-dire,
     * s'il contient entre 3 et 10 caractères et uniquement des lettres.
     *
     * @param string $nickname Pseudonyme à vérifier.
     * @return boolean True si le pseudonyme est valide, false sinon.
     */
    private function checkNicknameValidity($nickname)
    {
        /* TODO START */

        $bool = (strlen($nickname) <= 2 || strlen($nickname) >= 10) ? false : true;
        if ($bool) {
            $bool = preg_match("/[0-9]+/", $nickname) ? false : true;
        }

        return $bool;
        /* TODO END */
    }

    /**
     * Vérifie si un mot de passe est valide, c'est-à-dire,
     * s'il contient entre 3 et 10 caractères.
     *
     * @param string $password Mot de passe à vérifier.
     * @return boolean True si le mot de passe est valide, false sinon.
     */
    private function checkPasswordValidity($password)
    {
        /* TODO START */
        $bool = (strlen($password) <= 2 || strlen($password) >= 10) ? false : true;
        return $bool;
        /* TODO END */
    }

    /**
     * Vérifie la disponibilité d'un pseudonyme.
     *
     * @param string $nickname Pseudonyme à vérifier.
     * @return boolean True si le pseudonyme est disponible, false sinon.
     */
    private function checkNicknameAvailability($nickname)
    {
        /* TODO START */

        $nickExist = $this->connection->prepare("SELECT nickname FROM users WHERE nickname = :nickname");
        $nickExist->bindParam(':nickname', $nickname);
        $nickExist->execute();


        $bool = $nickExist->rowCount() ? false : true; // true si pseudo dispo
        return $bool;
        /* TODO END */
    }

    /**
     * Vérifie qu'un couple (pseudonyme, mot de passe) est correct.
     *
     * @param string $nickname Pseudonyme.
     * @param string $password Mot de passe.
     * @return boolean True si le couple est correct, false sinon.
     */
    public function checkPassword($nickname, $password)
    {
        /* TODO START */
        $psdBDD = $this->connection->prepare("SELECT password FROM users WHERE nickname =:nickname");
        $psdBDD->bindParam(':nickname', $nickname);
        $psdBDD->execute();
        $psdBDD = $psdBDD->fetch()['password'];

        $psd = hash("sha1", $password);

        if ($psd === $psdBDD) {
            return true;
        } else {
            return false;
        }

        /* TODO END */
    }

    /**
     * Ajoute un nouveau compte utilisateur si le pseudonyme est valide et disponible et
     * si le mot de passe est valide. La méthode peut retourner un des messages d'erreur qui suivent :
     * - "Le pseudo doit contenir entre 3 et 10 lettres.";
     * - "Le mot de passe doit contenir entre 3 et 10 caractères.";
     * - "Le pseudo existe déjà.".
     *
     * @param string $nickname Pseudonyme.
     * @param string $password Mot de passe.
     * @return boolean|string True si le couple a été ajouté avec succès, un message d'erreur sinon.
     */
    public function addUser($nickname, $password)
    {
        /* TODO START */

        if ($this->checkNicknameValidity($nickname) === false) {
            $result = "Le pseudo doit contenir entre 3 et 10 lettres.";
        } else {
            if ($this->checkNicknameAvailability($nickname) === false) {
                $result = "Le pseudo existe déjà.";
            } else {
                if ($this->checkPasswordValidity($password) === false) {
                    $result = "Le mot de passe doit contenir entre 3 et 10 caractères.";
                } else {
                    $result = true;
                    $crypPsd = hash('sha1', $password);
                    $this->connection->exec("INSERT INTO `users` (`nickname`, `password`) VALUES ('$nickname', '$crypPsd')");
                }
            }
        }
        return $result;
        /* TODO END */

    }

    /**
     * Change le mot de passe d'un utilisateur.
     * La fonction vérifie si le mot de passe est valide. S'il ne l'est pas,
     * la fonction retourne le texte 'Le mot de passe doit contenir entre 3 et 10 caractères.'.
     * Sinon, le mot de passe est modifié en base de données et la fonction retourne true.
     *
     * @param string $nickname Pseudonyme de l'utilisateur.
     * @param string $password Nouveau mot de passe.
     * @return boolean|string True si le mot de passe a été modifié, un message d'erreur sinon.
     */
    public function updateUser($nickname, $password)
    {
        /* TODO START */

        if ($this->checkPasswordValidity($password) === false) {
            $result = "Le mot de passe doit contenir entre 3 et 10 caractères.";
        } else {

            $crypPsd = hash('sha1', $password);
            $ancienMDP = $this->connection->prepare("SELECT password FROM users WHERE nickname = :nickname ");
            $ancienMDP->bindParam('nickname', $nickname);
            $ancienMDP->execute();
            $ancienMDP = $ancienMDP->fetch(PDO::FETCH_ASSOC);


            if ($crypPsd == $ancienMDP['password']) {
                $result = "Votre ancien et nouveau mots de passe sont les mêmes. Veuillez en trouvez un autre.";
            } else {
                $this->connection->exec("UPDATE users SET password = \"$crypPsd\" WHERE nickname = \"$nickname\"");
                $result = true;
            }
        }
        return $result;

        /* TODO END */

    }

    /**
     * Sauvegarde un sondage dans la base de donnée et met à jour les indentifiants
     * du sondage et des réponses.
     *
     * @param Survey $survey Sondage à sauvegarder.
     * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
     */
    public function saveSurvey(array $survey, $category, $nickname)
    {
        /* TODO START */

        $question = trim($survey[0]);
        $postQuestion = $this->connection->exec("INSERT INTO surveys (question, owner, category) VALUES (\"$question\", \"$nickname\", \"$category\") ");
        $idSurvey = $this->connection->query("SELECT id FROM surveys WHERE question = \"$question\" ");
        $id = $idSurvey->fetch()['id'];
        if ($postQuestion) {
            for ($i = 1; $i <= sizeof($survey) - 1; $i++) {
                $this->saveResponse(($survey[$i]), $id);
            }
            return true;
        } else return false;


        /* TODO END */

    }

    /**
     * Sauvegarde une réponse dans la base de donnée et met à jour son indentifiant.
     *
     * @param Response $response Réponse à sauvegarder.
     * @return boolean True si la sauvegarde a été réalisée avec succès, false sinon.
     */
    private function saveResponse($response, $idArray)
    {
        /* TODO START */

        $postQuestion = $this->connection->exec("INSERT INTO responses (id_survey, title)VALUES (\" $idArray \", \" $response\") ");

        if ($postQuestion) return true;
        else return false;

        /* TODO END */
    }

    /**
     * Charge l'ensemble des sondages créés par un utilisateur.
     *
     * @param string $owner Pseudonyme de l'utilisateur.
     * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
     */
    public function loadSurveysByOwner($owner)
    {
        /* TODO START */

        $result = $this->connection->prepare("SELECT * FROM surveys WHERE owner = :nickanme");
        $result->bindParam(':nickanme', $owner);
        $result->execute();

        $sondages = [];

        if ($result->rowCount() == 0) return $sondages;
        else {
            foreach ($result as $row) {
                $resultatQuestion = $this->connection->prepare("SELECT * FROM responses WHERE id_survey = :id_survey");
                $resultatQuestion->bindParam(':id_survey', $row["id"]);
                $resultatQuestion->execute();

                $survey = new Survey($row["owner"], $row["question"]);
                $survey->setId($row["id"]);
                $survey->setResponses($this->loadResponses($survey, $resultatQuestion->fetchAll()));

                $sondages[] = $survey;
            }
            return $sondages;
        }
        /* TODO END */
    }

    public function loadOneSurvey($idSurvey)
    {
        /* TODO START */

        $result = $this->connection->prepare("SELECT * FROM surveys WHERE id = :id");
        $result->bindParam(':id', $idSurvey);
        $result->execute();

        $sondages = [];

        if ($result->rowCount() == 0) return $sondages;
        else {
            foreach ($result as $row) {
                $resultatQuestion = $this->connection->prepare("SELECT * FROM responses WHERE id_survey = :id_survey");
                $resultatQuestion->bindParam(':id_survey', $row["id"]);;
                $resultatQuestion->execute();

                $survey = new Survey($row["owner"], $row["question"]);
                $survey->setId($row["id"]);
                $survey->setResponses($this->loadResponses($survey, $resultatQuestion->fetchAll()));

                $sondages[] = $survey;
            }

            return $sondages;
        }
        /* TODO END */
    }

    /**
     * Charge l'ensemble des sondages dont la question contient un mot clé.
     *
     * @param string $keyword Mot clé à chercher.
     * @return array(Survey)|boolean Sondages trouvés par la fonction ou false si une erreur s'est produite.
     */


    public function loadSurveysByKeyword($keyword = "", $categori = "")
    {
        /* TODO START */

        if ($categori == "") {
            $recherche = $this->connection->prepare("SELECT * FROM surveys WHERE question LIKE :word");
            $recherche->bindParam(':word', $keyword);
            $recherche->execute();
            $sondages = [];

        } elseif ($keyword == "" && $categori != "") {
            $recherche = $this->connection->prepare("SELECT * FROM surveys WHERE category =:word");
            $recherche->bindParam(':word', $categori);
            $recherche->execute();
            $sondages = [];
        } else {
            $recherche = $this->connection->prepare("SELECT * FROM surveys WHERE category = :cat AND question LIKE :word");
            $recherche->bindParam(':cat', $categori);
            $recherche->bindParam(':word', $keyword);
            $recherche->execute();
            $sondages = [];
        }
        if ($recherche->rowCount() == 0) return $sondages;
        else {
            foreach ($recherche as $row) {
                $resultatQuestion = $this->connection->prepare("SELECT * FROM responses WHERE id_survey = :id_survey");
                $resultatQuestion->bindParam(':id_survey', $row["id"]);;
                $resultatQuestion->execute();

                $survey = new Survey($row["owner"], $row["question"]);
                $survey->setId($row["id"]);
                $survey->setResponses($this->loadResponses($survey, $resultatQuestion->fetchAll()));

                $sondages[] = $survey;
            }

            return $sondages;
        }


        /* TODO END */
    }


    /**
     * Enregistre le vote d'un utilisateur pour la réponse d'identifiant $id.
     *
     * @param int $id Identifiant de la réponse.
     * @return boolean True si le vote a été enregistré, false sinon.
     */
    public function vote($id)
    {
//        UPDATE responses SET count = count + 1 WHERE id = 9
        /* TODO START */


        $valueVoteIncremente = $this->connection->prepare("SELECT * FROM responses WHERE id = :id");
        $valueVoteIncremente->bindParam(':id', $id);
        $valueVoteIncremente->execute();

        foreach ($valueVoteIncremente as $item) {
            $idSurvey = $item["id_survey"];
            $valueVoteIncremente = $item["count"] + 1;
        }

        $bdd = $this->connection->prepare("UPDATE responses SET count = " . $valueVoteIncremente . " WHERE id = :id");
        $bdd->bindParam(':id', $id);

        $bool = ($bdd->execute() === true) ? true : false;

        return $bool;

        /* TODO END */
    }

    /**
     * Construit un tableau de sondages à partir d'un tableau de ligne de la table 'surveys'.
     * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
     *
     * @param array $arraySurveys Tableau de lignes.
     * @return array(Survey)|boolean Le tableau de sondages ou false si une erreur s'est produite.
     */
    public function loadSurveys()
    {
        $surveys = array();
        /* TODO START */

        $result = $this->connection->prepare("SELECT * FROM surveys");
        $result->execute();

        if ($result->rowCount() == 0) return $surveys;
        else {
            foreach ($result as $row) {
                $resultatQuestion = $this->connection->prepare("SELECT * FROM responses WHERE id_survey = :id_survey");
                $resultatQuestion->bindParam(':id_survey', $row["id"]);
                $resultatQuestion->execute();

                $survey = new Survey($row["owner"], $row["question"]);
                $survey->setId($row["id"]);
                $survey->setResponses($this->loadResponses($survey, $resultatQuestion->fetchAll()));
                $surveys[] = $survey;
            }
        }
        /* TODO END */
        return $surveys;
    }

    /**
     * Construit un tableau de réponses à partir d'un tableau de ligne de la table 'responses'.
     * Ce tableau a été obtenu à l'aide de la méthode fetchAll() de PDO.
     *
     * @param Survey $survey Le sondage.
     * @param array $arraySurveys Tableau de lignes.
     * @return array(Response)|boolean Le tableau de réponses ou false si une erreur s'est produite.
     */
    private function loadResponses($survey, $arrayResponses)
    {

        $responses = array();
        /* TODO START */
        foreach ($arrayResponses as $keyPDO) {
//            var_dump($keyPDO);
            $rep = new Response($survey, $keyPDO["title"], $keyPDO["count"]);
            $rep->setId($keyPDO["id"]);
            $responses [] = $rep;

        }
        /* TODO END */
//        var_dump($responses);
        return $responses;
    }


    public function deleteSondage($nickname, $idSondage)
    {
        $bddSurvey = $this->connection->prepare("DELETE FROM surveys WHERE id = :id AND owner = :nickname");
        $bddSurvey->bindParam(':id', $idSondage);
        $bddSurvey->bindParam(':nickname', $nickname);

        $bddResponse = $this->connection->prepare("DELETE FROM responses WHERE id_survey = :id");
        $bddResponse->bindParam(':id', $idSondage);

        return $bool = ($bddSurvey->execute() == true) && ($bddResponse->execute() == true) ? true : false;

    }

    public function modiferSondage($rep, $idsurvey)
    {

        $updateQsSondage = $this->connection->prepare("UPDATE surveys SET question = :qs WHERE id = :id ");
        $updateQsSondage->bindParam(':qs', $rep[0]);
        $updateQsSondage->bindParam(':id', $idsurvey);
        $updateQsSondage->execute();


        $idReponse = $this->connection->prepare("SELECT id FROM responses WHERE id_survey = :idsurvey");
        $idReponse->bindParam(':idsurvey', $idsurvey);
        $idReponse->execute();

        $index = $idReponse->fetchAll(PDO::FETCH_ASSOC);

        $max = sizeof($rep);
        for ($i = 0; $i < $max; $i++) {
            $updateResSondage = $this->connection->prepare("UPDATE responses SET title = :rep, count = 0 WHERE id = :id ");
            $updateResSondage->bindParam(':id', $index[$i]['id']);
            $updateResSondage->bindParam(':rep', $rep[$i + 1]);
            $updateResSondage->execute();

        }

        return true;

    }

    public function dropDownListCatagory()
    {

        $list = array();

        $getList = $this->connection->prepare("SELECT DISTINCT category FROM surveys");
        $getList->execute();

        $getList = $getList->fetchAll(PDO::FETCH_ASSOC);


        for ($i = 0; $i < sizeof($getList); $i++) {
            array_push($list, $getList[$i]['category']);
        }

        return $list;
    }

    public function listAllCommentaireForOneSurvey($idSurvey)
    {
        $com = array();
        /* TODO START */
        $commentaire = $this->connection->prepare("SELECT commentaire FROM commentaire WHERE id_survey =:idSurvey");
        $commentaire->bindParam('idSurvey', $idSurvey);
        $commentaire->execute();
        $commentaire = $commentaire->fetchAll(PDO::FETCH_ASSOC);
        $com[] = $commentaire;
        return $com[0];
    }

    public function storeCommentaire($idSurvey, $commentaire) {

        $postCommentaire = $this->connection->prepare("INSERT INTO commentaire (id_survey, commentaire) VALUES (:idSurvey, :commentaire) ");
        $postCommentaire -> bindParam(':idSurvey', $idSurvey);
        $postCommentaire -> bindParam(':commentaire', $commentaire);
        if ($postCommentaire -> execute() === true) {
            return true;
        } else {
            return false;
        }

    }



}

?>
