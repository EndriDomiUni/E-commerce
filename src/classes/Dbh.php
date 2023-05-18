<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

include("./config/AppConstants.php");
include("./src/utility/UtilsFunctions.php");
include("./src/classes/Session.php");

class Dbh
{
    protected mysqli $connection;

    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = 'e-commerce', $charset = 'utf8')
    {
        try {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                echo "Connection failed: " . $this->connection->connect_error;
            }
            $this->connection->set_charset($charset);
        } catch (Exception $e) {
            echo "[Dbh:26] Sono qui";
            echo "Connection failed: " . mysqli_connect_error();
        }
    }

    /**
     * It returns a string that represents the type of the variable passed to it
     *
     * @param $var
     * @return string The type of the variable.
     */
    private function getType($var): string
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    /**
     * It executes a query and returns the result
     *
     * @param $sql
     * @param ...$params
     * @return array|int|string The result of the query.
     */
    public function execute($sql, ...$params): array|int|string
    {
        $types = "";
        foreach ($params as $par) {
            $types .= $this->getType($par);
        }

        if ($stmt = $this->connection->prepare($sql)) {
            if ($types != "")
                if (!$stmt->bind_param($types, ...$params)) {
                    return "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                }
            if (!$stmt->execute()) {
                return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            if ($stmt->errno == 0) {
                $result = $stmt->get_result();
                if (!$result) {
                    return $this->connection->insert_id; // here -> no error
                }
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return "Errore" . $stmt->errno;
            }
        } else {
            return 'Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error;
        }
    }

    public function isInsertSuccessful($tableName, $recordId): bool
    {
        $query = "SELECT COUNT(*) AS count FROM $tableName WHERE Id = " . $recordId;
        $result = $this->execute($query);
        if ($result && $result['count'] > 0) {
            return true;
        }
        return false;
    }

    /**
     * Check mail validity
     *
     * @param $email
     * @return bool true if ok
     */
    private function checkEmail($email): bool
    {
        return count($this->execute("SELECT * FROM `Utente` WHERE `Email` = '$email' ")) == 0;
    }

    /**
     * Get dimension id by x, y, z
     *
     * @param $dim_x
     * @param $dim_y
     * @param $dim_z
     * @return array
     */
    public function getDimensionIdByParameters($dim_x, $dim_y, $dim_z): array
    {
        return $this->execute("SELECT Id FROM `Dimensione` 
            WHERE `Dim_X` = $dim_x AND `Dim_Y` = $dim_y AND `Dim_Z` = $dim_z");
    }

    /**
     * Get variations by category id
     *
     * @param $categoryId
     * @return array
     */
    public function getVariationsByCategoryId($categoryId): array
    {
        return $this->execute("SELECT * FROM `Variazione`
            WHERE `Categoria_id` = '$categoryId'");
    }

    /**
     * Get options by variations id
     *
     * @param $variationId
     * @return array
     */
    public function getOptionsByVariationId($variationId): array
    {
        return $this->execute("SELECT * FROM `Opzione_variazione`
            WHERE `Variazione_Id` = '$variationId'");
    }

    /**
     * It takes an array of parameters, checks if they are all set, then checks if the email is already
     * in use, and if not, it inserts the data into the database
     *
     * @param $params
     * @return array|int|string|null result of the query, if the query is successful, otherwise it returns null.
     */
    public function register($params): array|int|string|null
    {
        if (UtilsFunctions::checkParams($params)) {
            if (!$this->checkEmail($params["Email"])) {
                return "Esiste già un account con le stesse credenziali";
            } else {
                $claimType = $params[CLAIM_TYPE];
                $claimId = $this->generateClaim($claimType);

                $query = "INSERT INTO Utente (Nome, Cognome, Email, Password, Claim_id, Indirizzo_id, Status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $resp = $this->insertData($query,
                    $params[NOME],
                    $params[COGNOME],
                    $params[EMAIL],
                    $params[PASSWORD],
                    $claimId,
                    $params[INDIRIZZO_ID],
                    $params[STATUS]);
                if (UtilsFunctions::checkResponse($resp)) {
                    return $resp;
                }
            }
        }
        return null;
    }

    /**
     * Generate claim for new user
     *
     * @param $claimType
     * @return int
     */
    private function generateClaim($claimType): int
    {
        $query = "INSERT INTO Claim (Descrizione, Conto, Status) VALUES (?, ?, ?)";
        return $this->insertData($query,
            $claimType,
            0.00,
            STATUS_INTACT_DATA
        );
    }

    /**
     * It checks if the user exists, if it does, it returns the user's ID
     *
     * @param $params
     * @return mixed|string|void|null ID of the user if the login is successful, null otherwise.
     */
    public function logIn($params)
    {
        if (UtilsFunctions::checkParams($params)) {
            if ($this->checkEmail($params["Email"])) {
                return "L'utente non esiste";
            } else {
                $email = $params[EMAIL];
                $pass = $params[PASSWORD];
                $where = "Email = '$email' AND Password = '$pass'";
                $response = $this->execute("SELECT * FROM `Utente` WHERE $where");
                return UtilsFunctions::checkResponse($response[0][ID]) ? $response[0][ID] : null;
            }
        }
    }

    /**
     * @param int $id current user -> $_SESSION["Id"];
     * @param string $tableName table name
     * @param string $fieldName table column name to update
     * @param string $toUpdate
     * @return int|array|null
     */
    public function updateData(int $id, string $tableName, string $fieldName, string $toUpdate): int|array|null
    {
        $where = "`Id` = $id";
        $res = $this->execute("UPDATE `$tableName` SET $fieldName = '$toUpdate' WHERE $where");
        return UtilsFunctions::checkResponse($res) ? $res : null;
    }

    /**
     * Update a field in a table with a given value
     *
     * @param string $tableName
     * @param string $fieldName
     * @param string $toUpdate
     * @param string $where
     * @return array|int|string|null
     */
    public function updateDateWithWhere(string $tableName, string $fieldName, string $toUpdate, string $where): array|int|string|null
    {
        $res = $this->execute("UPDATE `$tableName` SET $fieldName = '$toUpdate' WHERE $where");
        return UtilsFunctions::checkResponse($res) ? $res : null;
    }

    /**
     * It takes a query and an array of parameters, checks if the parameters are valid, and if they
     * are, it executes the query and returns the response
     *
     * @param $query
     * @param ...$params
     * @return array|int|string
     */
    public function insertData($query, ...$params): int|array|string
    {
        return $this->execute($query, ...$params);
    }

    /**
     * Check always !== null
     *
     * @param string $tableName
     * @param string $field
     * @param string $where
     * @return int|string|array|null
     */
    public function selectSpecificField(string $tableName, string $field, string $where): int|string|array|null
    {
        $query = "SELECT `$field` FROM `$tableName` WHERE $where";
        $response = $this->execute($query);
        return !empty($response) && $response[0] !== null && $response[0][$field] !== null
            ? $response[0][$field]
            : null;
    }

    /**
     * //TODO: DA FIXARE
     * Check always !== null
     *
     * @param string $tableName
     * @param string $where
     * @return mixed|string|null
     */
    public function getRecord(string $tableName, string $where): mixed
    {
        $response = $this->execute("SELECT * FROM `$tableName` WHERE $where");
        return !empty($response) && $response[0] !== null
            ? $response[0]
            : null;
    }

    /**
     * Get all records
     * @param string $tableName
     * @param string $where
     * @return mixed
     */
    public function getAllRecords(string $tableName, string $where): mixed
    {
        $response = $this->execute("SELECT * FROM `$tableName` WHERE $where");
        return !empty($response)
            ? $response
            : null;
    }

    /**
     * Delete record of given table, filtered by where condition
     *
     * @param string $tableName
     * @param string $where
     * @return void
     */
    public function deleteRecord(string $tableName, string $where): void
    {
        $this->execute("DELETE FROM $tableName WHERE $where");
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function getCategories() : array
    {
        return $this->execute("SELECT * FROM Categoria");
    }

    /**
     * Get product by id
     *
     * @param $id
     * @return array
     */
    public function getProductById($id) : array
    {
        return $this->execute("SELECT * FROM Prodotto 
            WHERE `Id` = $id");
    }

    /*
     * Upload image in db
     * @return
     */
    function uploadImage($path, $image) : array
    {
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;

        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }

        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
            echo "full path: ".$fullPath."</br>";
        }

        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], getcwd().$fullPath)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }

    public function getProductImg($productId): array|int|string
    {
        $query = "SELECT Immagine FROM Prodotto WHERE 'Id' = $productId";
        return $this->execute($query);
    }

    /**
     * Get all warehouses
     *
     * @return string|int|array
     */
    public function getWarehouses(): string|int|array
    {
        return $this->execute("SELECT * FROM `Magazzino`");
    }

    /**
     * Get all variations
     *
     * @return string|int|array
     */
    public function getVariations(): string|int|array
    {
        return $this->execute("SELECT * FROM `Variazione`");
    }

    /**
     * Get all products
     *
     * @return array|int|string
     */
    public function getProducts(): array|int|string
    {
        return $this->execute("SELECT * FROM `Prodotto` WHERE Id != 1");
    }

    /**
     * Get all products sorted by sortingMode
     *
     * @param $sortingMode
     * @return array|int|string
     */
    public function getProductsWithSortingMode($sortingMode): array|int|string
    {
        $query = "";
        if (empty($sortingMode)) {
            $sortingMode = SORT_MODE_DEFAULT;
        }
        switch ($sortingMode) {
            case SORT_MODE_DEFAULT:
                $query = "SELECT * FROM `Prodotto` WHERE Id != 1";
                break;
            case SORT_MODE_PRICE_ASC:
                $query = "SELECT p.*
                            FROM Prodotto p
                            JOIN Articolo a ON p.Id = a.Prodotto_id
                          ORDER BY a.prezzo ASC;";
                break;
            case SORT_MODE_PRICE_DESC:
                $query = "SELECT p.*
                            FROM Prodotto p
                            JOIN Articolo a ON p.Id = a.Prodotto_id
                          ORDER BY a.prezzo DESC;";
                break;
            case SORT_MODE_NAME_ASC:
                $query = "SELECT * FROM `Prodotto` WHERE Id != 1 ORDER BY Nome ASC";
                break;
            case SORT_MODE_NAME_DESC:
                $query = "SELECT * FROM `Prodotto` WHERE Id != 1 ORDER BY Nome DESC";
                break;
        }
        return $this->execute($query);
    }

    /**
     * Get articles by product id
     *
     * @param $productId
     * @return array|int|string
     */
    public function getArticlesByProductId($productId): array|int|string
    {
        $query = "SELECT * FROM `".ARTICOLO."` WHERE `".PRODOTTO_ID."` = ".$productId;
        return $this->execute($query);
    }

    /**
     * Get articles by product id
     *
     * @param $articleId
     * @return array|int|string
     */
    public function getArticleConfigurations($articleId): array|int|string
    {
        $query = "SELECT * FROM `".CONFIGURAZIONE_VARIAZIONE."` WHERE `".ARTICOLO_ID."` = ".$articleId;
        return $this->execute($query);
    }

    /**
     * Add article in cart
     *
     * @param $quantity
     * @param $cartId
     * @param $articleId
     * @return array|int|string
     */
    public function addArticleInCart($quantity, $cartId, $articleId): array|int|string
    {
        $queryInsertArticleInCart = "INSERT INTO `Articolo_in_carrello` (Quantità, Carrello_id, Articolo_id, Status)
                                VALUES (?, ?, ?, ?) ";
        return $this->insertData($queryInsertArticleInCart,
            $quantity,
            $cartId,
            $articleId,
            STATUS_MODIFIED_DATA);
    }

    public function removeArticleInCart($quantity, $cartId, $articleId): array|int|string
    {
        $res = 0;
        $where = "Carrello_id = ' . $cartId . 'AND Articolo_id = " . $articleId;
        if ($quantity == 1) {
            $output = $this->execute("DELETE FROM `Articolo_in_carrello` WHERE " . $where);
            if ($output > 0) {
                $res = 1;
            }
        } else if ($quantity > 1) {
            $output = $this->updateDateWithWhere(ARTICOLO_IN_CARRELLO, QUANTITA, $quantity-1, $where);
            if ($output > 0) {
                $res = 1;
            }
        } else {
            echo "Error";
        }
        return $res;
    }

    /**
     * Add product in wishlist
     *
     * @param $wishlistId
     * @param $productId
     * @return array|int|string
     */
    public function addProductInWishlist($wishlistId, $productId): array|int|string
    {
        $queryInsertProductInWishlist= "INSERT INTO `Prodotto_in_raccolta` (Raccolta_id, Prodotto_id, Status)
                                VALUES (?, ?, ?) ";
        return $this->insertData($queryInsertProductInWishlist,
            $wishlistId,
            $productId,
            STATUS_MODIFIED_DATA);
    }

    /**
     * Get all product by seller
     *
     * @param $userId
     * @return array
     */
    public function getAllProductsBySeller($userId) : array
    {
        $queryProductsIds = "SELECT DISTINCT `".PRODOTTO_ID."` FROM `".ARTICOLO."` WHERE `".UTENTE_ID."` = ".$userId;
        $productIds = $this->execute($queryProductsIds);
        $products = array();
        foreach ($productIds as $productId){
            $queryProducts = "SELECT * FROM `".PRODOTTO."` WHERE `".ID."` = ".array_values($productId)[0];
            $product = $this->execute($queryProducts);
            $products[array_values($productId)[0]] = $product;
        }
        return $products;
    }

    public function getProductCategory($productId) {
        $query = "`Id` = " . $productId;
        $product = $this->getRecord(PRODOTTO, $query);
        if ($product !== null){
            return $product[CATEGORIA_ID];
        } else {
            return null;
        }
    }

    /**
     * Get all articles by seller id
     * @param $sellerId
     * @return array
     */
    public function getArticlesBySellerId($sellerId): array
    {
        $query = UTENTE_ID . " = " . $sellerId;
        $articles = $this->getAllRecords(ARTICOLO, $query);
        if ($articles !== null){
            return $articles;
        } else {
            return [];
        }
    }

    /**
     * Get warehouse's article by article id
     * @param $articleId
     * @param $warehouseId
     * @return mixed|string|null
     */
    public function getWarehouseArticle($articleId, $warehouseId): mixed
    {
        $query = ARTICOLO_ID . " = " . $articleId . " AND " . MAGAZZINO_ID . " = " . $warehouseId;
        $warehouseArticle = $this->getRecord(ARTICOLO_IN_MAGAZZINO, $query);
        //var_dump($warehouseArticle);
        if ($warehouseArticle !== null){
            return $warehouseArticle;
        } else {
            return null;
        }
    }
}
