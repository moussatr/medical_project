<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Questionnaire1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pseudo')
            ->add('Nom')
            ->add('Prenom')
            ->add('Adresse')
            ->add('Code_Postal')
            ->add('Telephone')
            ->add('Email')
            ->add('Date_Naissance')
            ->add('Sexe')
            ->add('Origine')
            ->add('Poids')
            ->add('Poids_Stable')
            ->add('Taille')
            ->add('Composition_Foyer')
            ->add('Stuation_famille')
            ->add('Nb_Enfants')
            ->add('Proches_Malades')
            ->add('Profession')
            ->add('Stress')
            ->add('Trajet_du_travail')
            ->add('Sport')
            ->add('Fatigue')
            ->add('Lors_Reveil')
            ->add('Fumer_Vous')
            ->add('Depuis_Age')
            ->add('Cosommation_alcool')
            ->add('Consommation_Stimulants')
            ->add('Manger')
            ->add('Alimentaire_Principale')
            ->add('Traitement')
            ->add('Lequel')
            ->add('Hypertension')
            ->add('En_An_Debut')
            ->add('Diabetique')
            ->add('Diabete_Type')
            ->add('Traitement_Conteceptif')
            ->add('Prener_Tension')
            ->add('Dernier_Tension')
            ->add('Diastolique')
            ->add('Frenquence_Cardiaque')
            ->add('Suivi_Cardio')
            ->add('Medecin_Traitant')
            ->add('IMC')
            ->add('Date_Reponse')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
