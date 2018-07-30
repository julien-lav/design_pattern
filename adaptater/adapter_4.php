<?php 

interface IBranchable
{
        public function brancher($p_partenaire);
}

class Rj45 implements IBranchable
{
        private $_partenaire = null;

        public function brancher($p_partenaire)
        {
               $this->_partenaire = $p_partenaire;
               
               if 
               	( 
               		
               	// $p_partenaire->_partenaire == null
               	)
               {
                    $p_partenaire->brancher($this);   
               }
               
        }
}
class Usb implements IBranchable
{
        private $_partenaire = null;

        public function brancher($p_partenaire)
        {
                $this->_partenaire = $p_partenaire;
                
                if ($p_partenaire->_partenaire === null)
                {
                        $p_partenaire->brancher($this);    
                }
        }
}

class AdapterUsbVersRj45 implements IBranchable
{
        private $_usb = null;
        private $_partenaire = null;

        public function __construct(Usb $p_usb)
        {
                $this->_usb = $p_usb;
        }

        public function brancher($p_partenaire)
        {
                $this->_partenaire = $p_partenaire;

                $oRj45 = new Rj45();
                $oRj45->pin1 &= $this->_usb->broche3;
                              
                if ($p_partenaire->_partenaire === null)
                {
                        $p_partenaire->brancher($oRj45);
                }              
        }
}


/* Index.php */

$oCable = new Rj45();
$oPc = new Usb();
$oAdapter = new AdapterUsbVersRj45($oPc);

$oCable->brancher($oAdapter);