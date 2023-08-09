<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $options = [
            '' => true,
            '8.0' => '8.0',
            '8.5' =>  '8.5' ,
            '9.0' => '9.0',
            '10.0' => '10.0',
            '10.5'=>'10.5',
            '11.0'=>'11.0',
            '11.5'=>'11.5',
            '12.0'=>'12.0',
            '12.5'=>'12.5',
            '13.0'=>'13.0',
            '13.5'=>'13.5',
            '14.0'=>'14.0',
            '14.5'=>'14.5',
            '15.2'=>'15.2',
            '15.5'=>'15.5',
            '15.7'=>'15.7',
            '16'=>'16',
            '16.2'=>'16.2',
            '16.5'=>'16.5',
            '16.7'=>'16.7',
            '17'=>'17',

        ];

        $options1 = [
            '' => true,
            '5.0' => '5.0',
            '5.5 '=>  '5.5' ,
            '6.0' => '6.0',
            '7.0' => '7.0',
            '7.2 '=> '7.2',
            '7.5'=>'7.5',
            '7.7'=>'7.7',
            '8.0'=>'8.0',
            '8.2'=>'8.2',
            '8.5'=>'8.5',
            '8.7'=>'8.7',
            '9'=>'9',
           ' 9.2'=>'9.2',
            '9.5'=>'9.5',
            '9.7'=>'9.7',
            '10'=>'10',

        ];

        $builder
            ->add('Pseudo', null,
            ['label' => 'PSEUDO
            (Si vous souhaitez maintenir une confidentialité permanente sur ce questionnaire et ne pas indiquer votre nom)']
            )
            ->add('Nom', null,
            ['label' => 'Nom'])
            ->add('Prenom', null,
            ['label' => 'Prénom'])
            ->add('Adresse', null,
            ['label' => 'VOTRE ADRESSE / LIEU DE RÉSIDENCE'])
            ->add('Code_Postal', null,
            ['label' => 'CODE POSTAL'])
            ->add('Telephone', null,
            ['label' => 'TÉLÉPHONE '])
            // ->add('Email', null,
            // ['label' => 'EMAIL'])
            ->add('Date_Naissance', null,
            ['label' => 'DATE DE NAISSANCE'])
            ->add('Sexe',
            ChoiceType::class, [
                'label' => 'SEXE',
                'choices'  => [
                    '' => true,
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                ],
            ])
            ->add('Origine', ChoiceType::class, [
                'label' => 'ORIGINE',
                'choices'  => [
                    '' => true,
                    'EUROPE DU NORD' => 'EUROPE DU NORD',
                    'EUROPE DU SUD' => 'EUROPE DU SUD',
                    'AFRIQUE NOIR' => 'AFRIQUE NOIR',
                    'AFRIQUE DU NORD' => 'AFRIQUE DU NORD',
                    'ASIE' => 'ASIE',
                    'AMERIQUE DU NORD' =>  'AMERIQUE DU NORD',
                    'AMERIQUE DU SUD' => 'AMERIQUE DU SUD',
                    'DOM-TOM' => 'DOM-TOM',
                    'AUTRE' => 'AUTRE',
                ],
            ])
            ->add('Poids', null,
            ['label' => 'POIDS'])
            ->add('Poids_Stable', ChoiceType::class, [
                'label' => 'VOTRE POIDS EST IL PLUTÔT STABLE',
                'choices'  => [
                    '' => true,
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
            ])
            ->add('Taille', null,
            ['label' => 'VOTRE TAILLE (ENVIRON)'])
            ->add('Composition_Foyer', null,
            [
                'label' => 'COMPOSITION DU FOYER',
                'required' => false,],)
            ->add('Stuation_famille', ChoiceType::class, [
                'label' => 'VOUS ÊTES',
                'choices'  => [
                    '' => true,
                    'CELIBATAIRE' => 'CELIBATAIRE',
                    'MARIE(E)' => 'MARIE(E)' ,
                    'DIVORCE(E)(E)' => 'DIVORCE(E)(E)',
                    'VEUF / VEUVE(E)' => 'VEUF / VEUVE(E)',
                ],
               
            ])
            ->add('Nb_Enfants', ChoiceType::class, [
                'label' => 'NOMBRE D\'ENFANTS DU FOYER',
                'choices'  => [
                    '' => true,
                    0 => 0,
                    1 => 1,
                   2=>   2,
                    3 => 3,
                    4 =>  4,
                   5 => 5,
                ],
            
            ])
            ->add('Proches_Malades', ChoiceType::class, [
                'label' => 'COMBIEN DE VOS PROCHES PARENTS SOUFFRENT (OU SOUFFRAIENT-ILS) D’HYPERTENSION ?',
                'choices'  => [
                    '' => true,
                    0 => 0,
                    1 => 1,
                   2=>   2,
                    3 => 3,
                    4 =>  4,
                    5 => 5,

                ],
                
            ])
            ->add('Profession', ChoiceType::class, [
                'label' => 'VOTRE PROFESSION',
                'choices'  => [
                    '' => true,
                    'SANS PROFESSION' => 'VEUF / VEUVE(E)',
                    'EN RECHERCHE D\'EMPLOI' => 'EN RECHERCHE D\'EMPLOI',
                    'EMPLOYE(E) / TECHNICIEN(NE)' =>   'EMPLOYE(E) / TECHNICIEN(NE)',
                    'OUVRIER / MAINTENANCE' => 'OUVRIER / MAINTENANCE',
                    'CADRE / CADRE SUPERIEURE' =>  'CADRE / CADRE SUPERIEURE',
                    'PROFESSION LIBERALE' => 'PROFESSION LIBERALE',
                    'ENSEIGNANT(E)' =>  'ENSEIGNANT(E)',
                    'RETRAITE' => 'RETRAITE',

                ],
            ])
            ->add('Stress', ChoiceType::class, [
                'label' => 'ÊTES VOUS OU SENTEZ-VOUS ÊTRE SOUMIS UN STRESS IMPORTANT ?',
                'choices'  => [
                    '' => true,
                    'OUI' =>   'OUI' ,
                    'NON' =>   'NON',
                ],
            ])
            ->add('Trajet_du_travail', ChoiceType::class, [
                'label' => 'QUEL EST VOTRE TEMPS DE TRAJET POUR VOUS RENDRE SUR VOTRE LIEU DE TRAVAIL ?',
                'choices'  => [
                    '' => true,
                    'SANS DÉPLACEMENT - (RETRAITÉ(E) / TÉLÉTRAVAIL)' => 'SANS DÉPLACEMENT - (RETRAITÉ(E) / TÉLÉTRAVAIL)',
                    'MOINS DE 20 MINUTES' =>    'MOINS DE 20 MINUTES',
                    'ENTRE 20 ET 40 MINUTES' => 'ENTRE 20 ET 40 MINUTES',
                    'ENTRE 40 MINUTES ET 1 HEURE' => 'ENTRE 40 MINUTES ET 1 HEURE',
                    'PLUS QUE 1 HEURE' => 'PLUS QUE 1 HEURE',
                ],
            ])
            ->add('Sport', ChoiceType::class, [
                'label' => 'FAITES VOUS DU SPORT',
                'choices'  => [
                    '' => true,
                    'NON' => 'NON',
                    'OUI TRES OCCASIONNELEMENT' =>  'OUI TRES OCCASIONNELEMENT',
                    'OUI FREQUEMMENT' => 'OUI FREQUEMMENT',
                    'OUI TRES FREQUEMMENT (AU MOINS DEUX FOIS PAR SEMAINE)' => 'OUI TRES FREQUEMMENT (AU MOINS DEUX FOIS PAR SEMAINE)' ,
                    
                ],
            ])
            ->add('Fatigue', ChoiceType::class, [
                'label' => 'VOUS SENTEZ VOUS FATIGUE DANS LA JOURNÉE?',
                'choices'  => [
                    '' => true,
                    'NON' =>  'NON',
                    'OUI AU MATIN' =>  'OUI AU MATIN' ,
                    'OUI TOUTE LA JOURNEE' =>   'OUI TOUTE LA JOURNEE' ,
                    'OUI EN SOIREE' =>  'OUI EN SOIREE' ,
                ],
            ])
            ->add('Lors_Reveil'
            , ChoiceType::class, [
                'label' => 'LORS DU RÉVEIL RESSENTEZ VOUS ? (PLUSIEURS CHOIX POSSIBLE)',
                'choices'  => [  
                
                    'MAUX DE TÊTE' => 'MAUX DE TÊTE' ,
                    'VERTIGE' => 'VERTIGE',
                    'NAUSEE' => 'NAUSEE',
                    'FATIGUE / SOMMEIL NON REPARATEUR' => 'FATIGUE / SOMMEIL NON REPARATEUR',
                    'BOURDONNEMENT DANS LES OREILLES' => 'BOURDONNEMENT DANS LES OREILLES',
                    'DOULEUR A LA POITRINE' =>  'DOULEUR A LA POITRINE' ,
                    'AUCUN DE CES SIGNES' => 'AUCUN DE CES SIGNES',
                ],
                'expanded' => true, // Rendre les cases à cocher au lieu d'un menu déroulant
                'multiple' => true, // Permettre la sélection de plusieurs options
                'required' => false,
            ]
            )
            ->add('Fumer_Vous', ChoiceType::class, [
                'label' => 'FUMEZ VOUS ?',
                'choices'  => [
                    '' => true,
                    'NON' => 'NON',
                    'OUI UN PEU' => 'OUI UN PEU',
                    'OUI BEAUCOUP' => 'OUI BEAUCOUP',
                    'OUI ENORMEMENT' => 'OUI ENORMEMENT',
                ],
            ])
            ->add('Depuis_Age', ChoiceType::class, [
                'label' => 'DEPUIS QUEL AGE FUMEZ VOUS ?',
                'choices'  => [
                    '' => true,
                    'MES 18 ANS OU AVANT' => 'MES 18 ANS OU AVANT',
                    'VERS MES 25 ANS' => 'VERS MES 25 ANS',
                    'VERS MES 35 ANS' => 'VERS MES 35 ANS',
                    'APRES MES 40 ANS' => 'APRES MES 40 ANS',
                ],
            ])
            ->add('Cosommation_alcool', ChoiceType::class, [
                'label' => 'VOTRE CONSOMMATION D\'ALCOOL EST PLUTÔT',
                'choices'  => [
                    '' => true,
                    'NULLE' =>  'NULLE',
                    'TRES MODEREE' => 'TRES MODEREE',
                    'MODERRE' => 'MODERRE' ,
                    'IMPORTANTE' => 'IMPORTANTE',
                    'TRES IMPORTANTE (EXCESSIVE)' => 'TRES IMPORTANTE (EXCESSIVE)' ,
                ],
            ])
            ->add('Consommation_Stimulants', ChoiceType::class, [
                'label' => 'VOTRE CONSOMMATION DE STIMULANTS REGULIERE OU PLUTÔT REGULIERE',
                'choices'  => [
                    '' => true,
                    'AUCUN' => 'AUCUN' ,
                    'DE TYPE ENERGISANT' => 'DE TYPE ENERGISANT',
                    'DE TYPE AMPHETAMINE' => 'DE TYPE AMPHETAMINE',
                    'DE TYPE STUPEFIANT' =>  'DE TYPE STUPEFIANT' ,
                ],
            ])
            ->add('Manger', ChoiceType::class, [
                'label' => 'AVEZ VOUS TENDANCE A MANGER',
                'choices'  => [
                    '' => true,
                    'TRES PEU SALÉ' => 'TRES PEU SALÉ' ,
                    'MOYENNEMENT SALÉ' => 'MOYENNEMENT SALÉ' ,
                    'TRES SALÉ' => 'TRES SALÉ' ,
                ],
            ])
            ->add('Alimentaire_Principale'
            , ChoiceType::class, [
                'label' => 'QUEL EST VOTRE TENDANCE ALIMENTAIRE PRINCIPALE (PLUSIEURS CHOIX POSSIBLE)',
                'choices'  => [
                    
                    'RESTAURANT' =>  'RESTAURANT',
                    'FAST FOOD / PLATS PREPARES GRANDE SURFACE' => 'FAST FOOD / PLATS PREPARES GRANDE SURFACE',
                    'PREPARATION PERSONNELLE PLUTOT VEGETARIENNE' => 'PREPARATION PERSONNELLE PLUTOT VEGETARIENNE',
                    'PREPARATION PERSONNELLE PLUTOT LAIT / FROMMAGE' =>  'PREPARATION PERSONNELLE PLUTOT LAIT / FROMMAGE',
                    'PREPARATION PERSONNELLE PLUTOT VIANDE ROUGE / BLANCHE' =>  'PREPARATION PERSONNELLE PLUTOT VIANDE ROUGE / BLANCHE',
                ],
                'expanded' => true, // Rendre les cases à cocher au lieu d'un menu déroulant
                'multiple' => true, // Permettre la sélection de plusieurs options
                'required' => false,
            ]
            )
            ->add('Traitement', ChoiceType::class, [
                'label' => 'SUIVEZ VOUS UN TRAITEMENT MÉDICAMENTEUX',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI',
                    'NON' => 'NON',
                ],
            ])
            ->add('Lequel', null,
            ['label' => 'SI OUI LEQUEL ?'])
            ->add('Hypertension', ChoiceType::class, [
                'label' => 'EN CAS D\'HYPERTENSION CONNUE SUIVEZ VOUS UN TRAITEMENT ?',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI',
                    'NON' =>  'NON' ,
                ],
            ])
            ->add('En_An_Debut',null,
            [ 'label' => 'EN CAS DE TRAITEMENT EN QUELLE ANNÉE AVEZ VOUS DEBUTER',] )
            ->add('Diabetique', ChoiceType::class, [
                'label' => 'ÊTES VOUS DIABÉTIQUE',
                'choices'  => [
                    '' => true,
                    'NON' => 'NON' ,
                    'OUI DE TYPE 1' => 'OUI DE TYPE 1',
                    'OUI DE TYPE 2' =>  'OUI DE TYPE 2',
                ],
            ])
            ->add('Diabete_Type', ChoiceType::class, [
                'label' => 'EN CAS DE DIABÈTE DE TYPE DE 2, DEPUIS QUAND ÊTES VOUS DIAGNOSTIQUÉ ?',
                'choices'  => [
                    '' => true,
                    '1 AN OU MOINS' =>  '1 AN OU MOINS',
                    'ENTRE 2 ET 5 ANS' => 'ENTRE 2 ET 5 ANS',
                    'ENTRE 5 ET 10 ANS' => 'ENTRE 5 ET 10 ANS',
                    'PLUS DE 10 ANS' =>  'PLUS DE 10 ANS' ,
                ],
            ])
            ->add('Traitement_Conteceptif', ChoiceType::class, [
                'label' => 'SUIVEZ VOUS UN TRAITEMENT CONTRACEPTIF ?',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI' ,
                    'NON' =>  'NON',
                ],
            ])
            ->add('Prener_Tension', ChoiceType::class, [
                'label' => 'PRENEZ VOUS OCCASIONNELLEMENT VOTRE TENSION ?',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI',
                    'NON' =>  'NON' ,
                ],
            ])
            ->add('Dernier_Tension', ChoiceType::class, [
                'label' => 'QUEL EST VOTRE DERNIER TENSION CONNUE ?
            SYSTOLIQUE - Le premier chiffre dans votre mesure tensionnelle en Mmg',
            'choices' => $options,
            // 'choices_as_values' => true,
            ]
            )
            ->add('Diastolique',ChoiceType::class, [
                'label' => 'DIASTOLIQUE - Le deuxième chiffre dans votre mesure tensionnelle en Mmg',
                'choices' => $options1,
            // 'choices_as_values' => true,
            ])
            ->add('Frenquence_Cardiaque', ChoiceType::class,
            ['label' => 'QUEL EST VOTRE FRÉQUENCE CARDIAQUE PAR MINUTE AU REPOS ?',
            'choices'  => [
                '' => true,
                60 => 60,
                61=>  61 ,
                62 => 62,
                63 => 63,
                64 => 64,
                65=>65,
                66=>66,
                67=>67,
                68=>68,
                69=>.69,
                70=>70,
                71=>71,
                72=>72,
                73=>73,
                74=>74,
                75=>75,
                76=>76,
                77=>77,
                78=>.78,
                79=>79,
                80=>80,
                81=>81,
                82=>82,
                83=>83,
                
            ],
            ])
            ->add('Suivi_Cardio', ChoiceType::class, [
                'label' => 'ÊTES VOUS SUIVI PAR UN CARDIOLOGUE ?',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI',
                    'NON' => 'NON',
                ],
            ])
            ->add('Medecin_Traitant', ChoiceType::class, [
                'label' => 'DISPOSEZ VOUS D\'UN MÉDECIN TRAITANT QUE VOUS CONSULTEZ OCCASIONNELLEMENT ?',
                'choices'  => [
                    '' => true,
                    'OUI' => 'OUI',
                    'NON' => 'NON',
                ],
            ])
            // ->add('Date_Reponse', null,
            // ['label' => 'DATE DE REPONSE'])
            // ->add('IMC')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
