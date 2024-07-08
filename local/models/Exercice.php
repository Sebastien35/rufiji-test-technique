<?php
class Exercice extends CommonModels
{    
    public function __construct(){   
        parent::__construct();
    }
    
    // public function getPostById($idPost){
    //     $pdo    = $this->pdoConnect();
    //     $result = $pdo->prepare("SELECT *
    //                             FROM `posts` 
    //                             LEFT JOIN `posts_lang` ON `posts`.`id` = `posts_lang`.`post_id`
    //                             WHERE `id_post` = :idPost");
    //     $this->bind($result,':idPost', $idPost);
    //     $result->execute();
    //     return $result->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function getPostById($idPost) {
        $pdo = $this->pdoConnect();
        $result = $pdo->prepare("SELECT *
                                 FROM `posts`
                                 LEFT JOIN `posts_lang` ON `id_post` = `posts_lang`.`post_id`
                                 WHERE `id_post` = :idPost");
        $this->bind($result, ':idPost', $idPost);
        $result->execute();
        if($result->rowCount() == 0){
            throw new Exception("L'article n'existe pas");
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function getAuthorByIdUser($idUser) {
        $pdo    = $this->pdoConnect();
        $result = $pdo->prepare("SELECT *
                                FROM `users`
                                WHERE `id_user` = :idUser");
        $this->bind($result,':idUser', $idUser);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }
   

    public function PlusGrandeValeurPaireTableau($tableau): String{
        // Plus grand prendra la valeur de la plus grande valeur paire, position prendra la position de cette valeur dans le tableau
        $PlusGrand = null;
        $PositionPlusGrand = -1; // Comme c'est un index j'utilise -1 pour dire que je n'ai pas encore trouvé de valeur paire

        foreach($tableau as $Position => $Valeur){
            // Vérifier si pair  ou si plus grand est null 
            if($Valeur % 2 == 0){
                if($PlusGrand ===  null || $Valeur > $PlusGrand){
                    $PlusGrand = $Valeur;
                    $PositionPlusGrand = $Position;
                }
            }
        }
        if($PlusGrand !== null){
            return "La plus grande valeur paire est $PlusGrand et se trouve à la position $PositionPlusGrand";
        }else{
            return "Il n'y a pas de valeur paire dans le tableau";
        }
        
    }   

    
}





