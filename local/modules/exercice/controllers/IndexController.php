<?php
class IndexController extends CommonController{

    public function __construct(){
        parent::__construct();
        $this->module = 'exercice';
    }

    

    public function exerciceAction(){
        $this->layout['title']       = "Page exercice";
        $this->layout['description'] = '';
        $this->layout['canonical']   = WEBSITE_URL . '/exercice';
        $this->layout['selected']    = 'exercice';

        parent::setViewInLayout('modules/' . $this->module .'/views/exercice.php');
    }

    public function exercicealgoAction(){
        $this->layout['title']       = "Page exercice algo";
        $this->layout['description'] = '';
        $this->layout['canonical']   = WEBSITE_URL . '/exercice';
        $this->layout['selected']    = 'exercice';
        //Je créer un array pour utiliser la fonction
        $exercice = new Exercice();
        for($i = 0; $i < 20; $i++){
            $tableau[] = rand(0, 100);
        }
        $ProcessedTableau = $exercice->PlusGrandeValeurPaireTableau($tableau);

        $this->view['tableau'] = $tableau;
        $this->view['ProcessedTableau'] = $ProcessedTableau;
        parent::setViewInLayout('modules/' . $this->module .'/views/exercice-algo.php');
    }

    public function exercicecoingeckoAction(){
        $this->layout['title']       = "Page exercice coingecko";
        $this->layout['description'] = '';
        $this->layout['canonical']   = WEBSITE_URL . '/exercice';
        $this->layout['selected']    = 'petitioncoingecko';
        

        // Retrieve coingecko infos
        try{
        $coingecko = new Coingecko();
        $this->view['cryptos'] = $coingecko->getTop100Cryptos();
        $this->view['rate'] = $coingecko->getCurrentEurToUsdRate();
        } catch(Exception $e){
            $this->view['error'] = $e->getMessage();
        }

        

        parent::setViewInLayout('modules/' . $this->module .'/views/exercice-coingecko.php');
    }

    public function exercicearticleAction() {
        $this->layout['title'] = "Page article exercice";
        $this->layout['description'] = '';
        $this->layout['canonical'] = WEBSITE_URL . '/exercice';
        $this->layout['selected'] = 'exercice';
    
        $idPost = 1;
        
        $modelExercice = new Exercice();
        try{
        $InfosPost = $modelExercice->getPostById($idPost);
        $article = $InfosPost[0];
        $this->view['post'] = $article;
        } catch(Exception $e){
            $this->view['error'] = $e->getMessage();
        }
        try{
            $authorId = $article['id_author'];
            $infosAuthor = $modelExercice->getAuthorByIdUser($authorId);
        $this->view['post']['author'] = $infosAuthor;
        $this->view['post']['author']['first_name'] = $infosAuthor['firstname'];
        $this->view['post']['author']['last_name'] = $infosAuthor['lastname'];

        $CommentairesArticle=$modelExercice->getCommentOnArticle($idPost);
        $this->view['commentaires'] = $CommentairesArticle;
        
        } catch(Exception $e){
            $this->view['error'] = $e->getMessage();
        }
    

    
        parent::setViewInLayout('modules/' . $this->module . '/views/exercice-article.php');
    }
}
