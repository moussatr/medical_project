<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Entity\User;
use App\Form\QuestionnaireType;
use App\Repository\QuestionnaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

#[Route('/questionnaire')]
class QuestionnaireController extends AbstractController
{
    #[Route('/', name: 'app_questionnaire_index', methods: ['GET'])]
    public function index(QuestionnaireRepository $questionnaireRepository): Response
    {
        
        return $this->render('home/index.html.twig', [
        //   'questionnaires' => $questionnaireRepository->findAll(),
        ]);
    }

    #[Route('/imc', name: 'app_questionnaire_imc', methods: ['GET'])]
    public function imc(): Response
    {
        
        return $this->render('questionnaire/imc.html.twig', [
        //   'questionnaires' => $questionnaireRepository->findAll(),
        ]);
    }
        


    #[Route('/new', name: 'app_questionnaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        // dump($user);

        // Vérifiez si l'utilisateur a déjà répondu au questionnaire
        $questionnaire = $user->getQuestion();

        if (!$questionnaire) {
            $questionnaire = new Questionnaire();
            // $user->setQuestion($questionnaire);
        }
        
        $questionnaire = new Questionnaire();
        
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $bmi = $this->calculateBMI($questionnaire->getPoids(), $questionnaire->getTaille());
            $questionnaire->setUser($this->getUser());
            $questionnaire->setEmail($this->getUser());
            $questionnaire->setDateReponse(new DateTimeImmutable());
            $questionnaire->setIMC($bmi);

            $entityManager->persist($questionnaire);
            $entityManager->flush();

            //Générez le texte de résultat en fonction de l'IMC et du genre de la personne
            // $resultText = $this->generateResultText($questionnaire);
            // $ponderation = $this->ponderer($questionnaire);
            // return $this->render('questionnaire/result.html.twig', [
            //     'resultText' => $resultText,
            //     'ponderation' => $ponderation,
            //     'questionnaire' => $questionnaire,
            //     'form' => $form,
            // ]);
        

             return $this->redirectToRoute('app_questionnaire_reponse', [], Response::HTTP_SEE_OTHER);
        }
          
        
        return $this->render('questionnaire/new.html.twig', [
            'questionnaire' => $questionnaire,
            'form' => $form,
            'user' =>$user,
            
        ]);
    }

    #[Route('/reponse', name: 'app_questionnaire_reponse', methods: ['GET', 'POST'])]
    public function showUserResponse(): Response
    {
        // Vérifiez si l'utilisateur est connecté et entièrement authentifié
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        // Vérifiez si l'utilisateur a déjà répondu au questionnaire
        $questionnaire = $user->getQuestion();

        if (!$questionnaire) {
            // Si l'utilisateur n'a pas encore répondu au questionnaire, redirigez-le vers le formulaire
            return $this->redirectToRoute('app_questionnaire_new');
        }

        // Générez le texte de réponse en fonction des réponses du questionnaire
           $resultText = $this->generateResultText($questionnaire);
            
            return $this->render('questionnaire/rapport.html.twig', [
                'resultText' => $resultText,
                'questionnaire' => $questionnaire,
                
            ]);
    }


    #[Route('/pond', name: 'app_questionnaire_pond', methods: ['GET'])]
    public function pond(): Response
    {
         // Vérifiez si l'utilisateur est connecté et entièrement authentifié
         if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        // Vérifiez si l'utilisateur a déjà répondu au questionnaire
        $questionnaire = $user->getQuestion();

        if (!$questionnaire) {
            // Si l'utilisateur n'a pas encore répondu au questionnaire, redirigez-le vers le formulaire
            return $this->redirectToRoute('app_questionnaire_new');
        }

        $ponderation = $this->ponderer($questionnaire);
        return $this->render('questionnaire/ponderation.html.twig', [
            'ponderation' => $ponderation,
            'questionnaire' => $questionnaire,
        ]);
    }



    private function calculateBMI($weight, $height): float
    {
        // Code pour le calcul de l'IMC
        // $weight en kg, $height en mètres
        return $weight / ($height * $height);
    }


    private function generateResultText(Questionnaire $questionnaire): string
    {
        $gender = $questionnaire->getSexe() === 'Homme' ? 'Monsieur' : 'Madame';
        $date = $questionnaire->getDateReponse()->format('d/m/Y');
        $bmi = $questionnaire->getIMC();
        $gender1 = $questionnaire->getSexe() === 'Homme' ? '21 et 26' : '20 et 25';
        
        $fumer = $questionnaire->getFumerVous();

        $fumerVous = 0;
        if ($fumer == 'NON') {
            $fumerVous = 0;
        } elseif ($fumer == 'OUI UN PEU') {
            $fumerVous = 0.25;
        } elseif ($fumer == 'OUI BEAUCOUP') {
            $fumerVous = 1;
        } elseif ($fumer == 'OUI ENORMEMENT') {
            $fumerVous = 2;
        } 
          

        $fum = '';
        if ($fumerVous == 0) {
            $fum = '';
        }
        elseif($fumerVous == 0.25) {
            $fum='Le tabagisme est l’un des facteur agravant lié aux risques d’hypertension. Votre tabagisme modéré peu par conséquent provoqué une dégradation de votre hypertension.';
        }elseif($fumerVous > 0.26)
        {
          $fum=  'Le tabagisme est l’un des facteur agravant lié aux risques d’hypertension. Votre tabagisme confirmé représente donc un risque élevé, soit de survenance d’une hypertension soit d’une agraavation de celle-ci. Des mesures pour diminuer, voir arrêté de fumer est un point essentiel de votre programme de traitement';
        }

        // Générez le texte de résultat en fonction de l'IMC calculé
        // Utilisez $gender, $date et $bmi pour personnaliser le texte
        // Exemple basé sur les catégories de l'OMS pour l'IMC
        $origine = $questionnaire->getOrigine();
         
        $orig ='';

        if ($origine == 'EUROPE DU NORD') {
            $orig = 1;
        } elseif ($origine == 'EUROPE DU SUD') {
            $orig = 1;
        } elseif ($origine == 'AFRIQUE NOIR') {
            $orig = 1.5;
        } elseif ($origine == 'AFRIQUE DU NORD') {
            $orig = 1.5;
        } elseif ($origine == 'ASIE') {
            $orig = 1.2;
        } elseif ($origine == 'AMERIQUE DU NORD') {
            $orig = 1.5;
        } elseif ($origine == 'AMERIQUE DU SUD') {
            $orig = 1.4;
        } elseif ($origine == 'DOM-TOM') {
            $orig = 1.5;
        } elseif ($origine == 'AUTRE') {
            $orig = 0;
        }
         $sup='';
        if($orig>1){
            $sup = 'Comme le shéla l’indique au verso, il se peut que votre profil régional puisse être un facteur à l’origine d’une augmentation de votre risque d’hypertension. Cette corélation résulte
            fréqquemment des tendances culinnaires de chaque région (alimentation plus ou moins grasse et plus ou moins salée selon les régions.';
        }
         
        $sport = $questionnaire->getSport();
        $spo = "";
        if ($sport == 'NON') {
            $spo = 0;
        } elseif ($sport == 'OUI TRES OCCASIONNELEMENT') {
            $spo = 0.5;
        } elseif ($sport == 'OUI FREQUEMMENT') {
            $spo = 1;
        } elseif ($sport == 'OUI TRES FREQUEMMENT (AU MOINS DEUX FOIS PAR SEMAINE)') {
            $spo = 2;
        } 

        $category = '';
        $category1 = '';

        if ($bmi < 16) {
            $category = 'situation de maigreur extrême';
        } elseif ($bmi >= 16 && $bmi < 18.5) {
            $category = 'situation d’insuffisance pondérale';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $category = 'situation de corpulence normale';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $category = 'situation de surpoids';
        } elseif ($bmi >= 30 && $bmi < 35) {
            $category = 'situation d’obésité';
        } elseif ($bmi >= 35 && $bmi < 40) {
            $category = 'situation d’obésité sévère';
        } elseif ($bmi >= 40) {
            $category = 'situation d’obésité morbide';
        }
        if ($bmi < 25 && $spo< 1) {
            $category1 = 'Compte tenu de votre index IMC, l’absence d’une activité sportive régulière 
            renforce le risque d’agravation de votre hypertension. A ce sujet nous indiquons qu’il 
            serait important que vous puissiez vous organiser afin de pratiquer une activité sportive 
            et qu’il serait bon que celle-ci puisse faire l’objet d’un suivi.';
        }
        $resultText = "Prénom : {$questionnaire->getPrenom()}<br />  " ;
        $resultText .= "Nom : {$questionnaire->getNom()} <br /> <br /><br />";
        $resultText .= "Email : {$questionnaire->getEmail()}<br />";
        $resultText .= "Téléphone : {$questionnaire->getTelephone()}<br /><br /><br />";
        $resultText .= "{$gender},<br /><br /> Vous avez répondu le {$date} à un questionnaire sur les risques d'hypertension artérielle (HTA) en intégrant une série d'informations personnelles.<br /><br />";
        $resultText .= "Votre test fait apparaître un indice de masse corporelle (IMC) de {$bmi}, ce qui vous place en {$category}.<br /><br />
        L’indice de masse corporelle (IMC) est le seul indice validé par l’Organisation mondiale de la santé pour évaluer la corpulence d’un individu et donc les éventuels risques pour la santé
        Selon votre age et votre rapport taille/poid, votre index d'IMC devrait se trouver entre {$gender1}.<br /><br /> 
        {$sup}<br /><br />
        {$category1}<br /><br /> {$fum} ";
        
        return $resultText;
       
    }

    private function ponderer(Questionnaire $questionnaire): array
    {
        $origine = $questionnaire->getOrigine();
        $situation = $questionnaire->getStuationFamille();
        $nbEnfants = $questionnaire->getNbEnfants();
        $prochesMalade = $questionnaire->getProchesMalades();
        $profession = $questionnaire->getProfession();
        $stress = $questionnaire->getStress();
        $tempTrajet = $questionnaire->getTrajetDuTravail();
        $sport = $questionnaire->getSport();
        $fatigue = $questionnaire->getFatigue();
        $reveil = $questionnaire->getLorsReveil();
        $fumer = $questionnaire->getFumerVous();
        $depuis = $questionnaire->getDepuisAge();
        $acool = $questionnaire->getCosommationAlcool();
        $situmilant = $questionnaire->getConsommationStimulants();
        $manger = $questionnaire->getManger();
        $aliment = $questionnaire->getAlimentairePrincipale();
        
        $category =0;

        if ($origine == 'EUROPE DU NORD') {
            $category = 1;
        } elseif ($origine == 'EUROPE DU SUD') {
            $category = 1;
        } elseif ($origine == 'AFRIQUE NOIR') {
            $category = 1.5;
        } elseif ($origine == 'AFRIQUE DU NORD') {
            $category = 1.5;
        } elseif ($origine == 'ASIE') {
            $category = 1.2;
        } elseif ($origine == 'AMERIQUE DU NORD') {
            $category = 1.5;
        } elseif ($origine == 'AMERIQUE DU SUD') {
            $category = 1.4;
        } elseif ($origine == 'DOM-TOM') {
            $category = 1.5;
        } elseif ($origine == 'AUTRE') {
            $category = 0;
        }

        $category1=0;
        if ($situation == 'CELIBATAIRE') {
            $category1 = 0;
        } elseif ($situation == 'MARIE(E)') {
            $category1 = 0.25;
        } elseif ($situation == 'DIVORCE(E)(E)') {
            $category1 = 0.5;
        } elseif ($situation == 'VEUF / VEUVE(E)') {
            $category1 = 0.5;
        } 


        $category2 =0;

        if ($nbEnfants == 0) {
            $category2 = 1;
        } elseif ($nbEnfants == 1) {
            $category2 = 1;
        } elseif ($nbEnfants == 2) {
            $category2 = 1.5;
        } elseif ($nbEnfants == 3) {
            $category2 = 1.5;
        } elseif ($nbEnfants == 4) {
            $category2 = 1.2;
        } elseif ($nbEnfants == 5) {
            $category2 = 1.5;
        } 

        $category3 = 0;
        
        if ($prochesMalade == 0) {
            $category3 = 1;
        } elseif ($prochesMalade == 1) {
            $category3 = 1;
        } elseif ($prochesMalade == 2) {
            $category3 = 1.5;
        } elseif ($prochesMalade == 3) {
            $category3 = 1.5;
        } elseif ($prochesMalade == 4) {
            $category3 = 1.5;
        } elseif ($prochesMalade == 5) {
            $category3 = 1.5;
        } 


        $category4 = 0;
        if ($profession == 'SANS PROFESSION') {
            $category4 = 0;
        } elseif ($profession == 'EN RECHERCHE D\'EMPLOI') {
            $category4 = 0.2;
        } elseif ($profession == 'EMPLOYE(E) / TECHNICIEN(NE)') {
            $category4 = 0.25;
        } elseif ($profession == 'OUVRIER / MAINTENANCE') {
            $category4 = 0.25;
        } elseif ($profession == 'CADRE / CADRE SUPERIEURE') {
            $category4 = 0.75;
        } elseif ($profession == 'PROFESSION LIBERALE') {
            $category4 = 0.75;
        } elseif ($profession == 'ENSEIGNANT(E)') {
            $category4 = 0.2;
        } elseif ($profession == 'RETRAITE') {
            $category4 = 2;
        } 


        $category5 = 0;
        if ($stress == 'OUI') {
            $category5 = 0.75;
        } elseif ($stress == 'NON') {
            $category5 = 0;
        } 


        $category6 = 0;
        if ($tempTrajet == 'SANS DÉPLACEMENT - (RETRAITÉ(E) / TÉLÉTRAVAIL)') {
            $category6 = 0;
        } elseif ($tempTrajet == 'MOINS DE 20 MINUTES') {
            $category6 = 0;
        } elseif ($tempTrajet == 'ENTRE 20 ET 40 MINUTES') {
            $category6 = 0.2;
        } elseif ($tempTrajet == 'ENTRE 40 MINUTES ET 1 HEURE') {
            $category6 = 0.5;
        } elseif ($tempTrajet == 'PLUS QUE 1 HEURE') {
            $category6 = 0.75;
        } 


        $category7 = 0;
        if ($sport == 'NON') {
            $category7 = 1.5;
        } elseif ($sport == 'OUI TRES OCCASIONNELEMENT') {
            $category7 = 0;
        } elseif ($sport == 'OUI FREQUEMMENT') {
            $category7 = 1;
        } elseif ($sport == 'OUI TRES FREQUEMMENT (AU MOINS DEUX FOIS PAR SEMAINE)') {
            $category7 = 3;
        } 



        $category8 = 0;
        if ($fatigue == 'NON') {
            $category8 = 0;
        } elseif ($fatigue == 'OUI AU MATIN') {
            $category8 = 0.5;
        } elseif ($fatigue == 'OUI TOUTE LA JOURNEE') {
            $category8 = 1.5;
        } elseif ($fatigue == 'OUI EN SOIREE') {
            $category8 = 1;
        } 

        $cat1 = 1;$cat2 = 0;$cat3 = 0;$cat4 = 1;$cat5 = 0;$cat6 = 0;$cat7 = 0;
        if (empty($reveil) == 'MAUX DE TÊTE') {
            $cat1 = 1;
        } if (empty($reveil) == 'VERTIGE') {
            $cat2 = 1;
        } if (empty($reveil) == 'NAUSEE') {
            $cat3 = 1;
        } if (empty($reveil) == 'FATIGUE / SOMMEIL NON REPARATEUR') {
            $cat4 = 1;
        } if (empty($reveil) == 'BOURDONNEMENT DANS LES OREILLES') {
            $cat5 = 1;
        } if (empty($reveil) == 'DOULEUR A LA POITRINE') {
            $cat6 = 1;
        } if (empty($reveil) == 'AUCUN DE CES SIGNES') {
            $cat7 = 1;
        } $resul=$cat1+$cat2+$cat3+$cat4+$cat5+$cat6+$cat7;
 

        $cate1 = 1;$cate2 = 0;$cate3 = 1;$cate4 = 0;$cate5 = 1;
        if (empty($aliment) == 'RESTAURANT') {
            $cate1 = 1;
        } if (empty($aliment)  == 'FAST FOOD / PLATS PREPARES GRANDE SURFACE') {
            $cate2 = 1;
        } if (empty($aliment)  == 'PREPARATION PERSONNELLE PLUTOT VEGETARIENNE') {
            $cate3 = 1;
        } if (empty($aliment)  == 'PREPARATION PERSONNELLE PLUTOT LAIT / FROMMAGE') {
            $cate4 = 1;
        } if (empty($aliment)  == 'PREPARATION PERSONNELLE PLUTOT VIANDE ROUGE / BLANCHE') {
            $cate5 = 1;
        }
         $resul1=$cate1+$cate2+$cate3+$cate4+$cate5;
 

        $category9 = 0;
        if ($fumer == 'NON') {
            $category9 = 0;
        } elseif ($fumer == 'OUI UN PEU') {
            $category9 = 0.25;
        } elseif ($fumer == 'OUI BEAUCOUP') {
            $category9 = 1;
        } elseif ($fumer == 'OUI ENORMEMENT') {
            $category9 = 2;
        } 
        
        $category10 = 0;
        if ($depuis == 'MES 18 ANS OU AVANT') {
            $category10 = 1.5;
        } elseif ($depuis == 'VERS MES 25 ANS') {
            $category10 = 1.2;
        } elseif ($depuis == 'VERS MES 35 ANS') {
            $category10 = 1;
        } elseif ($depuis == 'APRES MES 40 ANS') {
            $category10 = 0.75;
        } 


        $category11 = 0;
        if ($acool == 'NULLE') {
            $category11 = 0;
        } elseif ($acool == 'TRES MODEREE') {
            $category11 = 0.25;
        } elseif ($acool == 'MODERRE') {
            $category11 = 0.5;
        } elseif ($acool == 'IMPORTANTE') {
            $category11 = 1;
        } elseif ($acool == 'TRES IMPORTANTE (EXCESSIVE)') {
            $category11 = 1.5;
        } 
        

        
        $category12 = 0;
        if ($situmilant == 'AUCUN') {
            $category12 = 0;
        } elseif ($situmilant == 'DE TYPE ENERGISANT') {
            $category12 = 0.25;
        } elseif ($situmilant == 'DE TYPE AMPHETAMINE') {
            $category12 = 0.5;
        } elseif ($situmilant == 'DE TYPE STUPEFIANT') {
            $category12 = 1;
        } 

        $category13 = 0;

        if ($manger == 'TRES PEU SALÉ') {
            $category13 = 0;
        } elseif ($manger == 'MOYENNEMENT SALÉ') {
            $category13 == 0.25;
        } elseif ($manger == 'TRES SALÉ') {
            $category13 = 0.5;
        } 

        



        // $ponderation = "
        //  {$category}  {$category1}  {$category2}{$category3} D {$category3} {$category5}
        //  {$category6}   {$category7}    {$category9}   {$category9}
        //   {$category10}  {$category11}  {$category12}
        // {$category13}";

        $ponderation = [
            'Origine' => $category,
            '<strong>SITUATION FOYER</strong>'=>$category1+$category2+$category3,
            'Vous étes' => $category1,
            'Nombre d’enfant du foyer' => $category2,
            'Combien de vos proches parants souffrent (ou souffraient-ils) d’hypertension ?' => $category3,
            '<strong>SITUATION PROFESSIONNELLE</strong>'=>$category4+$category5+$category6,
            'Votre profesion ' => $category4,
            'Etes vous ou sentez-vous étre soumis un stress important ?' => $category5,
            'Quel est votre temps de trajet pour vous rendre sur votre lieu de travail ?' => $category6,
            "<strong>VOTRE ENVIRONNEMENT</strong>"=>$category7+$category8+$resul+$category9+$category10+$category11+$category12+$category13,
            'Faites vous du sport' => $category7,
            'Vous sentez vous fatigue dans la journée ?' => $category8,
            'Lors du réveil ressentez vous ? (plusieurs choix possible)' => $resul,
            'Fumez vous' => $category9,
            'Depuis quel age' => $category10,
            'Votre consommation d’alcool est plutot' => $category11,
            'Votre consommation de stimulants' => $category12,
            'Avez vous tendance a manger sale ?' => $category13,
            'Votre tendance alimentaire ' => $resul1,
        ];

        return $ponderation;

    }





    #[Route('/{id}', name: 'app_questionnaire_show', methods: ['GET'])]
    public function show(Questionnaire $questionnaire): Response
    {
        return $this->render('questionnaire/show.html.twig', [
            'questionnaire' => $questionnaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_questionnaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Questionnaire $questionnaire, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $questionnaire->setEmail($this->getUser());
        $questionnaire->setDateReponse(new DateTimeImmutable());
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bmi = $this->calculateBMI($questionnaire->getPoids(), $questionnaire->getTaille());

            $questionnaire->setIMC($bmi);
            $entityManager->flush();

            $resultText = $this->generateResultText($questionnaire);
            $ponderation = $this->ponderer($questionnaire);
            return $this->render('questionnaire/rapport.html.twig', [
                'resultText' => $resultText,
                'ponderation' => $ponderation,
                'questionnaire' => $questionnaire,
                'form' => $form,
            ]);
        

            // return $this->redirectToRoute('app_questionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('questionnaire/edit.html.twig', [
            'questionnaire' => $questionnaire,
            'form' => $form,
        ]);
    }

   


    #[Route('/{id}', name: 'app_questionnaire_delete', methods: ['POST'])]
    public function delete(Request $request, Questionnaire $questionnaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionnaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($questionnaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_questionnaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
