<?php

class InspecteurPermisConduire {
    private $_candidat;
     
    public function __construct(ConducteurInterface $conducteur)
    {
        $this->_candidat = $conducteur;
    }
    public function changerCandidat(ConducteurInterface $conducteur)
    {
        $this->_candidat = $conducteur;
    }
    public function fairePasserExamen()
    {
        $this->_candidat->demarrer();
        $this->_candidat->accelerer();
        $this->_candidat->tournerDroite();
        $this->_candidat->accelerer();
        $this->_candidat->tournerGauche();
        $this->_candidat->ralentir();
        $this->_candidat->reculer();
        $this->_candidat->immobiliser();
    }
}

interface ConducteurInterface {
	public function demarrer();
	public function tournerGauche();
	public function tournerDroite();
	public function accelerer();
	public function ralentir();
	public function reculer();
	public function immobiliser();
}

class Automobiliste implements ConducteurInterface
{
	public function demarrer() {
		echo "tourner la clé de contact ou mettre la carte";
    }
    public function tournerGauche() {
        echo "tourner le volant vers la gauche";
    }
    public function tournerDroite() {
        echo "tourner le volant vers la droite";
    }
    public function accelerer() {
        echo "appuyer sur la pédale d'accélération";
    }
    public function ralentir() {
        echo "relâcher la pédale d'accélération et/ou", 
                      "appuyer sur la pédale de frein";
    }
    public function reculer() {
        echo "passer la marche arrière et accélérer";
    }
    public function immobiliser() {
        echo "mettre le frein à main";
    }
}

interface NavigateurInterface {
	public function demarrer();
	public function tournerBabord();
	public function tournerTribord();
	public function accelerer();
	public function ralentir();
	public function reculer();
	public function jeterAncre();
}

abstract class Marin implements NavigateurInterface {
	public function jeterAncre() {
		echo "jeter l'ancre à la mer";
	}
} 

class UnsupportedMethodException extends Exception {}
 
class MarinVoile extends Marin
{
	public function demarrer() {
		throw new UnsupportedMethodException
			("Cette fonctionnalité n'est pas disponible");
	}
	public function tournerBabord() {
        echo "diriger les voiles et la barre pour aller à babord";
    }
    public function tournerTribord() {
        echo "diriger les voiles et la barre pour aller à tribord";
    }
    public function accelerer() {
        echo "positionner les voiles et déterminer l'allure";
    }
    public function ralentir() {
        echo "positionner les voiles et déterminer l'allure";
    }
    public function reculer() {
        echo "positionner les voiles et manœuvrer pour reculer";
    }
}

class MarinMoteur extends Marin
{
	public function demarrer() {
        echo "démarrer le moteur";
    }
    public function tournerBabord() {
        echo "manoeuvrer la barre ou le volant pour aller à babord";
    }
    public function tournerTribord() {
        echo "manoeuvrer la barre ou le volant pour aller à tribord";
    }
    public function accelerer() {
        echo "augmenter la vitesse du moteur";
    }
    public function ralentir() {
        echo "dimininuer la vitesse du moteur ou le couper";
    }
    public function reculer() {
        echo "passer la marche arrière";
    }
}

class AdapateurMarin implements ConducteurInterface {
	private $_marin;

	public function __construct(Marin $marin) {
		$this->_marin = $marin;
	}

	public function demarrer() {
		$this->_marin->demarrer();
	}
  
  	public function tournerGauche() {
		$this->_marin->tournerBabord();
	}

	public function tournerDroite() {
		$this->_marin->tournerTribord();
	}
	public function accelerer() {
        $this->_marin->accelerer();
    }
    public function ralentir() {
        $this->_marin->ralentir();
    }
    public function reculer() {
        $this->_marin->reculer();
    }
    public function immobiliser() {
        $this->_marin->jeterAncre();
    }
}

$adaptateur = new AdaptateurMarin(new MarinMoteur());
$inspecteur->changerCandidat($adaptateur);
$inspecteur->fairePasserExamen();