<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

/**
 * Praticien shell command.
 * @property \App\Model\Table\PraticiensTable $Praticiens
 */
class PraticienShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('Praticiens');

        $tab=array();
        $tab['count']=array();
        $tab['annuaire']=array();
        //liste de tous les membres
        $praticiens=$this->Praticiens->find()
            ->where(['in_annuaire'=>1])
            ->toArray();
        $count=count($praticiens);
        $tab['count']=$count;
        foreach ($praticiens as $k => $praticien){

            $tab['annuaire'][$praticien->id]['nomPrenom']=$praticien->nom;
            $tab['annuaire'][$praticien->id]['adresse']=$praticien->adresse.'<br>'.$praticien->codepostal.'<br>'.$praticien->ville;
            $tab['annuaire'][$praticien->id]['formation']=$praticien->niveau;
            $tab['annuaire'][$praticien->id]['ville']=$praticien->ville;
            $tab['annuaire'][$praticien->id]['tel']=$praticien->telephone;
            $tab['annuaire'][$praticien->id]['email']=$praticien->email;
            $tab['annuaire'][$praticien->id]['specialite']=$praticien->specialite;
            $tab['annuaire'][$praticien->id]['annee']=$praticien->annee_certif;
            $tab['annuaire'][$praticien->id]['pays']=$praticien->pays;
        }
        $tab= "var data = " . json_encode($tab);
        file_put_contents(WWW_ROOT.'annuaires/annuaire_ffhtb.json', $tab);


        $path = "/web/wp-content/plugins/psyclick/data/";

        $conn_id = ftp_connect("psynapse.fr");
        $ftp_user_name = "c3_2018";
        $ftp_user_pass = "XpREf1Ywl6_";
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true) ;
        $tmp = WWW_ROOT.'annuaires/annuaire_ffhtb.json';

        @ftp_delete($conn_id, $path."annuaire1_ffhtb.json");
        if(ftp_put($conn_id, $path."annuaire1_ffhtb.json", $tmp, FTP_BINARY))
         $this->out('C\'est bon');
        else
            $this->out('Ko');
    }
}
