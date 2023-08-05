<?php

namespace App\Entity;

use App\Repository\QuestionnaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column]
    private ?int $Code_Postal = null;

    #[ORM\Column]
    private ?int $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_Naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $Sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $Origine = null;

    #[ORM\Column]
    private ?float $Poids = null;

    #[ORM\Column(length: 255)]
    private ?string $Poids_Stable = null;

    #[ORM\Column]
    private ?float $Taille = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Composition_Foyer = null;

    #[ORM\Column(length: 255)]
    private ?string $Stuation_famille = null;

    #[ORM\Column]
    private ?int $Nb_Enfants = null;

    #[ORM\Column]
    private ?int $Proches_Malades = null;

    #[ORM\Column(length: 255)]
    private ?string $Profession = null;

    #[ORM\Column(length: 255)]
    private ?string $Stress = null;

    #[ORM\Column(length: 255)]
    private ?string $Trajet_du_travail = null;

    #[ORM\Column(length: 255)]
    private ?string $Sport = null;

    #[ORM\Column(length: 255)]
    private ?string $Fatigue = null;

    #[ORM\Column(length: 255)]
    private ?array $Lors_Reveil = null;

    #[ORM\Column(length: 255)]
    private ?string $Fumer_Vous = null;

    #[ORM\Column(length: 255)]
    private ?string $Depuis_Age = null;

    #[ORM\Column(length: 255)]
    private ?string $Cosommation_alcool = null;

    #[ORM\Column(length: 255)]
    private ?string $Consommation_Stimulants = null;

    #[ORM\Column(length: 255)]
    private ?string $Manger = null;

    #[ORM\Column(length: 255)]
    private ?array $Alimentaire_Principale = null;

    #[ORM\Column(length: 255)]
    private ?string $Traitement = null;

    #[ORM\Column(length: 255)]
    private ?string $Lequel = null;

    #[ORM\Column(length: 255)]
    private ?string $Hypertension = null;

    #[ORM\Column(length: 255)]
    private ?string $En_An_Debut = null;

    #[ORM\Column(length: 255)]
    private ?string $Diabetique = null;

    #[ORM\Column(length: 255)]
    private ?string $Diabete_Type = null;

    #[ORM\Column(length: 255)]
    private ?string $Traitement_Conteceptif = null;

    #[ORM\Column(length: 255)]
    private ?string $Prener_Tension = null;

    #[ORM\Column(length: 255)]
    private ?string $Dernier_Tension = null;

    #[ORM\Column]
    private ?float $Diastolique = null;

    #[ORM\Column(length: 255)]
    private ?string $Frenquence_Cardiaque = null;

    #[ORM\Column(length: 255)]
    private ?string $Suivi_Cardio = null;

    #[ORM\Column(length: 255)]
    private ?string $Medecin_Traitant = null;

    #[ORM\Column]
    private ?float $IMC = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_Reponse = null;

    #[ORM\OneToOne(mappedBy: 'question', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(?string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->Code_Postal;
    }

    public function setCodePostal(int $Code_Postal): static
    {
        $this->Code_Postal = $Code_Postal;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Téléphone): static
    {
        $this->Telephone = $Téléphone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->Date_Naissance;
    }

    public function setDateNaissance(\DateTimeInterface $Date_Naissance): static
    {
        $this->Date_Naissance = $Date_Naissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): static
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->Origine;
    }

    public function setOrigine(string $Origine): static
    {
        $this->Origine = $Origine;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->Poids;
    }

    public function setPoids(float $Poids): static
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getPoidsStable(): ?string
    {
        return $this->Poids_Stable;
    }

    public function setPoidsStable(string $Poids_Stable): static
    {
        $this->Poids_Stable = $Poids_Stable;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->Taille;
    }

    public function setTaille(float $Taille): static
    {
        $this->Taille = $Taille;

        return $this;
    }

    public function getCompositionFoyer(): ?string
    {
        return $this->Composition_Foyer;
    }

    public function setCompositionFoyer(string $Composition_Foyer): static
    {
        $this->Composition_Foyer = $Composition_Foyer;

        return $this;
    }

    public function getStuationFamille(): ?string
    {
        return $this->Stuation_famille;
    }

    public function setStuationFamille(string $Stuation_famille): static
    {
        $this->Stuation_famille = $Stuation_famille;

        return $this;
    }

    public function getNbEnfants(): ?int
    {
        return $this->Nb_Enfants;
    }

    public function setNbEnfants(int $Nb_Enfants): static
    {
        $this->Nb_Enfants = $Nb_Enfants;

        return $this;
    }

    public function getProchesMalades(): ?int
    {
        return $this->Proches_Malades;
    }

    public function setProchesMalades(int $Proches_Malades): static
    {
        $this->Proches_Malades = $Proches_Malades;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(string $Profession): static
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getStress(): ?string
    {
        return $this->Stress;
    }

    public function setStress(string $Stress): static
    {
        $this->Stress = $Stress;

        return $this;
    }

    public function getTrajetDuTravail(): ?string
    {
        return $this->Trajet_du_travail;
    }

    public function setTrajetDuTravail(string $Trajet_du_travail): static
    {
        $this->Trajet_du_travail = $Trajet_du_travail;

        return $this;
    }

    public function getSport(): ?string
    {
        return $this->Sport;
    }

    public function setSport(string $Sport): static
    {
        $this->Sport = $Sport;

        return $this;
    }

    public function getFatigue(): ?string
    {
        return $this->Fatigue;
    }

    public function setFatigue(string $Fatigue): static
    {
        $this->Fatigue = $Fatigue;

        return $this;
    }

    public function getLorsReveil(): ?array
    {
        return $this->Lors_Reveil;
    }

    public function setLorsReveil(array $Lors_Reveil): static
    {
        $this->Lors_Reveil = $Lors_Reveil;

        return $this;
    }

    public function getFumerVous(): ?string
    {
        return $this->Fumer_Vous;
    }

    public function setFumerVous(string $Fumer_Vous): static
    {
        $this->Fumer_Vous = $Fumer_Vous;

        return $this;
    }

    public function getDepuisAge(): ?string
    {
        return $this->Depuis_Age;
    }

    public function setDepuisAge(string $Depuis_Age): static
    {
        $this->Depuis_Age = $Depuis_Age;

        return $this;
    }

    public function getCosommationAlcool(): ?string
    {
        return $this->Cosommation_alcool;
    }

    public function setCosommationAlcool(string $Cosommation_alcool): static
    {
        $this->Cosommation_alcool = $Cosommation_alcool;

        return $this;
    }

    public function getConsommationStimulants(): ?string
    {
        return $this->Consommation_Stimulants;
    }

    public function setConsommationStimulants(string $Consommation_Stimulants): static
    {
        $this->Consommation_Stimulants = $Consommation_Stimulants;

        return $this;
    }

    public function getManger(): ?string
    {
        return $this->Manger;
    }

    public function setManger(string $Manger): static
    {
        $this->Manger = $Manger;

        return $this;
    }

    public function getAlimentairePrincipale(): ?array
    {
        return $this->Alimentaire_Principale;
    }

    public function setAlimentairePrincipale(array $Alimentaire_Principale): static
    {
        $this->Alimentaire_Principale = $Alimentaire_Principale;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->Traitement;
    }

    public function setTraitement(string $Traitement): static
    {
        $this->Traitement = $Traitement;

        return $this;
    }

    public function getLequel(): ?string
    {
        return $this->Lequel;
    }

    public function setLequel(string $Lequel): static
    {
        $this->Lequel = $Lequel;

        return $this;
    }

    public function getHypertension(): ?string
    {
        return $this->Hypertension;
    }

    public function setHypertension(string $Hypertension): static
    {
        $this->Hypertension = $Hypertension;

        return $this;
    }

    public function getEnAnDebut(): ?string
    {
        return $this->En_An_Debut;
    }

    public function setEnAnDebut(string $En_An_Debut): static
    {
        $this->En_An_Debut = $En_An_Debut;

        return $this;
    }

    public function getDiabetique(): ?string
    {
        return $this->Diabetique;
    }

    public function setDiabetique(string $Diabetique): static
    {
        $this->Diabetique = $Diabetique;

        return $this;
    }

    public function getDiabeteType(): ?string
    {
        return $this->Diabete_Type;
    }

    public function setDiabeteType(string $Diabete_Type): static
    {
        $this->Diabete_Type = $Diabete_Type;

        return $this;
    }

    public function getTraitementConteceptif(): ?string
    {
        return $this->Traitement_Conteceptif;
    }

    public function setTraitementConteceptif(string $Traitement_Conteceptif): static
    {
        $this->Traitement_Conteceptif = $Traitement_Conteceptif;

        return $this;
    }

    public function getPrenerTension(): ?string
    {
        return $this->Prener_Tension;
    }

    public function setPrenerTension(string $Prener_Tension): static
    {
        $this->Prener_Tension = $Prener_Tension;

        return $this;
    }

    public function getDernierTension(): ?string
    {
        return $this->Dernier_Tension;
    }

    public function setDernierTension(string $Dernier_Tension): static
    {
        $this->Dernier_Tension = $Dernier_Tension;

        return $this;
    }

    public function getDiastolique(): ?float
    {
        return $this->Diastolique;
    }

    public function setDiastolique(float $Diastolique): static
    {
        $this->Diastolique = $Diastolique;

        return $this;
    }

    public function getFrenquenceCardiaque(): ?string
    {
        return $this->Frenquence_Cardiaque;
    }

    public function setFrenquenceCardiaque(string $Frenquence_Cardiaque): static
    {
        $this->Frenquence_Cardiaque = $Frenquence_Cardiaque;

        return $this;
    }

    public function getSuiviCardio(): ?string
    {
        return $this->Suivi_Cardio;
    }

    public function setSuiviCardio(string $Suivi_Cardio): static
    {
        $this->Suivi_Cardio = $Suivi_Cardio;

        return $this;
    }

    public function getMedecinTraitant(): ?string
    {
        return $this->Medecin_Traitant;
    }

    public function setMedecinTraitant(string $Medecin_Traitant): static
    {
        $this->Medecin_Traitant = $Medecin_Traitant;

        return $this;
    }

    public function getIMC(): ?float
    {
        return $this->IMC;
    }

    public function setIMC(float $IMC): static
    {
        $this->IMC = $IMC;

        return $this;
    }

    public function getDateReponse(): ?\DateTimeInterface
    {
        return $this->Date_Reponse;
    }

    public function setDateReponse(\DateTimeInterface $Date_Reponse): static
    {
        $this->Date_Reponse = $Date_Reponse;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getQuestion() !== $this) {
            $user->setQuestion($this);
        }

        $this->user = $user;

        return $this;
    }

   
}
