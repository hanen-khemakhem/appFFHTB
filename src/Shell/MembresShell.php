<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * Membres shell command.
 */
class MembresShell extends Shell
{
     public function initialize()
    {
        parent::initialize();
        $this->loadModel('Membres');
        $this->loadModel('Praticiens');
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $praticien=$this->encodeJsonParticien();
        $membres=$this->encodeJsonMembre();
        $this->out($praticien);
        $this->out($membres);
    }
    public function encodeJsonMembre(){
        $array=array();
        $array['annuaire']=array();
        //liste de tous les membres
        $membres=$this->Membres->find()->toArray();
        foreach ($membres as $membre){
            $array['annuaire'][]=$membre;
        }
         $path = "/web/wp-content/plugins/annuaireFfhtb/files/";

         $conn_id = ftp_connect("psynapse.fr");
         $ftp_user_name = "c3_2018";
         $ftp_user_pass = "XpREf1Ywl6_";
         $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
         ftp_pasv($conn_id, true) ;

         $tmp = WWW_ROOT.'annuaires/annuaireMembre.json';
         @ftp_delete($conn_id, $path."annuaireMembre.json");
         ftp_put($conn_id, $path."annuaireMembre.json", $tmp, FTP_BINARY);
      
    }
    public function encodeJsonParticien(){
        $tab=array();
        $tab['count']=array();
        $tab['annuaire']=array();
        //liste de tous les membres
        $praticiens=$this->Praticiens->find()->toArray();
        $count=count($praticiens);
        $tab['count']=$count;
        foreach ($praticiens as $k => $praticien){
            $tab['annuaire'][$k]['nomPrenom']=$praticien->nom;
            $tab['annuaire'][$k]['formation']=$praticien->niveau;
            $tab['annuaire'][$k]['annee']=$praticien->annee_certif;
            $tab['annuaire'][$k]['pays']=$praticien->pays;
        }
        
         file_put_contents(WWW_ROOT.'annuaires/annuaire_ffhtb.json', json_encode($tab));
        

         $path = "/web/wp-content/plugins/annuaireFfhtb/files/";

         $conn_id = ftp_connect("psynapse.fr");
         $ftp_user_name = "c3_2018";
         $ftp_user_pass = "XpREf1Ywl6_";
         $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
         ftp_pasv($conn_id, true) ;
         $tmp = WWW_ROOT.'annuaires/annuaire_ffhtb.json';

         @ftp_delete($conn_id, $path."praticiens.json");
         ftp_put($conn_id, $path."praticiens.json", $tmp, FTP_BINARY);
        
    }
}
