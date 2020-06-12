<?php namespace App\Models;

use CodeIgniter\Model;

/**
* IgracModel – klasa za izvrsavanje upita nad tabelom igrac
*
* @version 1.0
*/

class IgracModel extends Model
{
    protected $table      = 'igrac';
    protected $primaryKey = 'idKI';
    protected $returnType     = 'array';
    protected $allowedFields = ['idKI', 'ime','prezime','email','poeni','blokiran'];

    /**
      * postoji_li_email funkcija koja provjerava da li email pripada nekom od registrovanih korisnika
      *
      * @param string $email
      * @return array
    */
    function postoji_li_email($email)
    {
      $this->where('email', $email);
      $query = $this->get();
      $row = $query->getRow();
      if($row!==null)
      {
       return $row;
      }
      else return null;
    }//end_postoji_li_email



    /**
      * dohvati_igrace funkcija koja dohvata sve igrace ciji se username ili neki dio username-a poklapa sa argumentom
      *
      * @param string $tekst
      * @return array
    */
    function dohvati_igrace($tekst)
    {
      $this->select('*');
      $this->join('korisnik', 'igrac.idKI = korisnik.idKorisnika');
      $this->where('obrisan=', '0');
      return $this->like('username', $tekst)->findAll();
    }//end_dohvati_igrace



    /**
      * obrisi_igraca funkcija koja brise igraca tako sto setuje polje obrisan iz korisnika na 1
      *
      * @param int $id
      * @return void
    */
    function obrisi_igraca($id)
    {
      $this->select('*');
      $this->join('korisnik', 'igrac.idKI = korisnik.idKorisnika');
      $sql = "UPDATE korisnik  SET obrisan = ? WHERE idKorisnika = ?";
      $this->query($sql, [1, $id]);
      $sql = "UPDATE igrac  SET blokirani = ? WHERE idKI = ?";
      $this->query($sql, [1, $id]);
    }//end_obrisi_igraca



    /**
      * reset_poeni funkcija koja svima igracima nulira poene
      *
      * @return void
    */
     function reset_poeni()
     {
      $query = $this->query("SELECT * FROM igrac;");
      foreach ($query->getResultArray() as $row)
      {
       $sql = "UPDATE igrac SET poeni = ? WHERE idKI = ?";
       $this->query($sql, [0, $row['idKI']]);
       }
     }//end_reset_poeni


     /**
     * nadji_igraca funkcija koja vraca niz od jednog igraca koristi idIgraca
     *
     *@param int $idIgraca
     *
     * @return array
     */
     public function nadji_igraca($idIgraca) {
         return $this->where('idKI', $idIgraca)->findAll();
     }

     /**
     * cmp funkcija koja uporedjuje vrijednosti dva broja
     *
     *@param int $a
     *@param int $b
     * @return boolean
     */
     static function cmp($a, $b) {
         return ($a['poeni'] < $b['poeni']);
     }


     /**
     * nadji_email funkcija trazi igraca sa odredjenim mailom
     *
     *@param string $email
     *@return array
     */
       public function nadji_email($email)
     {
         return $this->where('email', $email)->findAll();
     }


     /**
     * najbolji funkcija trazi najbolje rangirane igrace
     *
     *@return array
     */
     public function najbolji() {
         $this->join('korisnik', 'igrac.idKI = korisnik.idKorisnika');
         $this->where('obrisan=', '0');
         $svi = $this->findAll();
         usort($svi, array($this, "cmp"));
         return $svi;
     }



}//end_IgracModel
