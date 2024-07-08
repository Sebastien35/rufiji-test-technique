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

        $exercice = new Exercice();
        for($i = 0; $i < 10; $i++){
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

        parent::setViewInLayout('modules/' . $this->module .'/views/exercice-coingecko.php');
    }

    public function exercicearticleAction(){
        $this->layout['title']       = "Page article exercice";
        $this->layout['description'] = '';
        $this->layout['canonical']   = WEBSITE_URL . '/exercice';
        $this->layout['selected']    = 'exercice';

        $idPost = 1;

        $modelExercice = new Exercice();
        $getInfosPost = $modelExercice->getPostById($idPost)[0];

        $getInfosPost['author'] = $modelExercice->getAuthorByIdUser(30);

        $this->view['post'] = $getInfosPost;

        parent::setViewInLayout('modules/' . $this->module .'/views/exercice-article.php');
    }
}
