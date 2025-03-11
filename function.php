<?php
    //Подключение к бд

    function connect(){
        $driver = 'mysql';
        $host = 'localhost';
        $db_name = 'CineCraft';
        $db_user = 'root';
        $db_password = 'root';
        $charset = 'utf8mb4';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_EMULATE_PREPARES => false, 
        ];

        try{
            return new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_password);
        }catch(PDOException $e){
            die('Нет подключения к базе данных, Ошибка - ' . $e->getMessage());
        }
    }

    function query($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql);
        $sth->execute($params);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        if(!$result) return [];
        return $result;
    }

    function make($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql);
        return $sth->execute($params);
    }

    function validate($data) {
        $data = strip_tags($data);
        $data = trim($data);
        $data = preg_replace('/\s+/', ' ', $data);
        $data = htmlspecialchars($data);
        return $data;
    }



    function getMenuItems() {
        $sql = "SELECT url, title FROM menu";
        return query($sql);
    }

    function getProductItems() {
        $sql = "SELECT * FROM products";
        return query($sql);
    }

    function getTotalProducts($maxPrice = null, $selectedCategory = null) {
        $sql = "SELECT COUNT(*) as total FROM products WHERE 1=1";
        $params = [];

        if ($maxPrice !== null) {
            $sql .= " AND price <= :maxPrice";
            $params[':maxPrice'] = $maxPrice;
        }

        if ($selectedCategory !== null && $selectedCategory !== '') {
            $sql .= " AND category = :category";
            $params[':category'] = $selectedCategory;
        }

        $sth = connect();
        $sth = $sth->prepare($sql);
        foreach ($params as $key => &$val) {
            $sth->bindParam($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    function getProductsForPage($page, $perPage = 9, $maxPrice = null, $selectedCategory = null) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if ($maxPrice !== null) {
            $sql .= " AND price <= :maxPrice";
            $params[':maxPrice'] = $maxPrice;
        }
        if ($selectedCategory !== null && $selectedCategory !== '') {
            $sql .= " AND category = :category";
            $params[':category'] = $selectedCategory;
        }

        $sql .= " LIMIT :limit OFFSET :offset";
        $params[':limit'] = $perPage;
        $params[':offset'] = $offset;
        $sth = connect();
        $sth = $sth->prepare($sql);
        foreach ($params as $key => &$val) {
            $sth->bindParam($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }
?>