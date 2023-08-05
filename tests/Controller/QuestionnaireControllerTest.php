<?php

namespace App\Test\Controller;

use App\Entity\Questionnaire;
use App\Repository\QuestionnaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuestionnaireControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private QuestionnaireRepository $repository;
    private string $path = '/admin/questionnaire/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Questionnaire::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Questionnaire index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'questionnaire[Pseudo]' => 'Testing',
            'questionnaire[Nom]' => 'Testing',
            'questionnaire[Prenom]' => 'Testing',
            'questionnaire[Adresse]' => 'Testing',
            'questionnaire[Code_Postal]' => 'Testing',
            'questionnaire[Telephone]' => 'Testing',
            'questionnaire[Email]' => 'Testing',
            'questionnaire[Date_Naissance]' => 'Testing',
            'questionnaire[Sexe]' => 'Testing',
            'questionnaire[Origine]' => 'Testing',
            'questionnaire[Poids]' => 'Testing',
            'questionnaire[Poids_Stable]' => 'Testing',
            'questionnaire[Taille]' => 'Testing',
            'questionnaire[Composition_Foyer]' => 'Testing',
            'questionnaire[Stuation_famille]' => 'Testing',
            'questionnaire[Nb_Enfants]' => 'Testing',
            'questionnaire[Proches_Malades]' => 'Testing',
            'questionnaire[Profession]' => 'Testing',
            'questionnaire[Stress]' => 'Testing',
            'questionnaire[Trajet_du_travail]' => 'Testing',
            'questionnaire[Sport]' => 'Testing',
            'questionnaire[Fatigue]' => 'Testing',
            'questionnaire[Lors_Reveil]' => 'Testing',
            'questionnaire[Fumer_Vous]' => 'Testing',
            'questionnaire[Depuis_Age]' => 'Testing',
            'questionnaire[Cosommation_alcool]' => 'Testing',
            'questionnaire[Consommation_Stimulants]' => 'Testing',
            'questionnaire[Manger]' => 'Testing',
            'questionnaire[Alimentaire_Principale]' => 'Testing',
            'questionnaire[Traitement]' => 'Testing',
            'questionnaire[Lequel]' => 'Testing',
            'questionnaire[Hypertension]' => 'Testing',
            'questionnaire[En_An_Debut]' => 'Testing',
            'questionnaire[Diabetique]' => 'Testing',
            'questionnaire[Diabete_Type]' => 'Testing',
            'questionnaire[Traitement_Conteceptif]' => 'Testing',
            'questionnaire[Prener_Tension]' => 'Testing',
            'questionnaire[Dernier_Tension]' => 'Testing',
            'questionnaire[Diastolique]' => 'Testing',
            'questionnaire[Frenquence_Cardiaque]' => 'Testing',
            'questionnaire[Suivi_Cardio]' => 'Testing',
            'questionnaire[Medecin_Traitant]' => 'Testing',
            'questionnaire[IMC]' => 'Testing',
            'questionnaire[Date_Reponse]' => 'Testing',
            'questionnaire[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/admin/questionnaire/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Questionnaire();
        $fixture->setPseudo('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCode_Postal('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setDate_Naissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setOrigine('My Title');
        $fixture->setPoids('My Title');
        $fixture->setPoids_Stable('My Title');
        $fixture->setTaille('My Title');
        $fixture->setComposition_Foyer('My Title');
        $fixture->setStuation_famille('My Title');
        $fixture->setNb_Enfants('My Title');
        $fixture->setProches_Malades('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStress('My Title');
        $fixture->setTrajet_du_travail('My Title');
        $fixture->setSport('My Title');
        $fixture->setFatigue('My Title');
        $fixture->setLors_Reveil('My Title');
        $fixture->setFumer_Vous('My Title');
        $fixture->setDepuis_Age('My Title');
        $fixture->setCosommation_alcool('My Title');
        $fixture->setConsommation_Stimulants('My Title');
        $fixture->setManger('My Title');
        $fixture->setAlimentaire_Principale('My Title');
        $fixture->setTraitement('My Title');
        $fixture->setLequel('My Title');
        $fixture->setHypertension('My Title');
        $fixture->setEn_An_Debut('My Title');
        $fixture->setDiabetique('My Title');
        $fixture->setDiabete_Type('My Title');
        $fixture->setTraitement_Conteceptif('My Title');
        $fixture->setPrener_Tension('My Title');
        $fixture->setDernier_Tension('My Title');
        $fixture->setDiastolique('My Title');
        $fixture->setFrenquence_Cardiaque('My Title');
        $fixture->setSuivi_Cardio('My Title');
        $fixture->setMedecin_Traitant('My Title');
        $fixture->setIMC('My Title');
        $fixture->setDate_Reponse('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Questionnaire');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Questionnaire();
        $fixture->setPseudo('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCode_Postal('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setDate_Naissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setOrigine('My Title');
        $fixture->setPoids('My Title');
        $fixture->setPoids_Stable('My Title');
        $fixture->setTaille('My Title');
        $fixture->setComposition_Foyer('My Title');
        $fixture->setStuation_famille('My Title');
        $fixture->setNb_Enfants('My Title');
        $fixture->setProches_Malades('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStress('My Title');
        $fixture->setTrajet_du_travail('My Title');
        $fixture->setSport('My Title');
        $fixture->setFatigue('My Title');
        $fixture->setLors_Reveil('My Title');
        $fixture->setFumer_Vous('My Title');
        $fixture->setDepuis_Age('My Title');
        $fixture->setCosommation_alcool('My Title');
        $fixture->setConsommation_Stimulants('My Title');
        $fixture->setManger('My Title');
        $fixture->setAlimentaire_Principale('My Title');
        $fixture->setTraitement('My Title');
        $fixture->setLequel('My Title');
        $fixture->setHypertension('My Title');
        $fixture->setEn_An_Debut('My Title');
        $fixture->setDiabetique('My Title');
        $fixture->setDiabete_Type('My Title');
        $fixture->setTraitement_Conteceptif('My Title');
        $fixture->setPrener_Tension('My Title');
        $fixture->setDernier_Tension('My Title');
        $fixture->setDiastolique('My Title');
        $fixture->setFrenquence_Cardiaque('My Title');
        $fixture->setSuivi_Cardio('My Title');
        $fixture->setMedecin_Traitant('My Title');
        $fixture->setIMC('My Title');
        $fixture->setDate_Reponse('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'questionnaire[Pseudo]' => 'Something New',
            'questionnaire[Nom]' => 'Something New',
            'questionnaire[Prenom]' => 'Something New',
            'questionnaire[Adresse]' => 'Something New',
            'questionnaire[Code_Postal]' => 'Something New',
            'questionnaire[Telephone]' => 'Something New',
            'questionnaire[Email]' => 'Something New',
            'questionnaire[Date_Naissance]' => 'Something New',
            'questionnaire[Sexe]' => 'Something New',
            'questionnaire[Origine]' => 'Something New',
            'questionnaire[Poids]' => 'Something New',
            'questionnaire[Poids_Stable]' => 'Something New',
            'questionnaire[Taille]' => 'Something New',
            'questionnaire[Composition_Foyer]' => 'Something New',
            'questionnaire[Stuation_famille]' => 'Something New',
            'questionnaire[Nb_Enfants]' => 'Something New',
            'questionnaire[Proches_Malades]' => 'Something New',
            'questionnaire[Profession]' => 'Something New',
            'questionnaire[Stress]' => 'Something New',
            'questionnaire[Trajet_du_travail]' => 'Something New',
            'questionnaire[Sport]' => 'Something New',
            'questionnaire[Fatigue]' => 'Something New',
            'questionnaire[Lors_Reveil]' => 'Something New',
            'questionnaire[Fumer_Vous]' => 'Something New',
            'questionnaire[Depuis_Age]' => 'Something New',
            'questionnaire[Cosommation_alcool]' => 'Something New',
            'questionnaire[Consommation_Stimulants]' => 'Something New',
            'questionnaire[Manger]' => 'Something New',
            'questionnaire[Alimentaire_Principale]' => 'Something New',
            'questionnaire[Traitement]' => 'Something New',
            'questionnaire[Lequel]' => 'Something New',
            'questionnaire[Hypertension]' => 'Something New',
            'questionnaire[En_An_Debut]' => 'Something New',
            'questionnaire[Diabetique]' => 'Something New',
            'questionnaire[Diabete_Type]' => 'Something New',
            'questionnaire[Traitement_Conteceptif]' => 'Something New',
            'questionnaire[Prener_Tension]' => 'Something New',
            'questionnaire[Dernier_Tension]' => 'Something New',
            'questionnaire[Diastolique]' => 'Something New',
            'questionnaire[Frenquence_Cardiaque]' => 'Something New',
            'questionnaire[Suivi_Cardio]' => 'Something New',
            'questionnaire[Medecin_Traitant]' => 'Something New',
            'questionnaire[IMC]' => 'Something New',
            'questionnaire[Date_Reponse]' => 'Something New',
            'questionnaire[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin/questionnaire/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPseudo());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCode_Postal());
        self::assertSame('Something New', $fixture[0]->getTelephone());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getDate_Naissance());
        self::assertSame('Something New', $fixture[0]->getSexe());
        self::assertSame('Something New', $fixture[0]->getOrigine());
        self::assertSame('Something New', $fixture[0]->getPoids());
        self::assertSame('Something New', $fixture[0]->getPoids_Stable());
        self::assertSame('Something New', $fixture[0]->getTaille());
        self::assertSame('Something New', $fixture[0]->getComposition_Foyer());
        self::assertSame('Something New', $fixture[0]->getStuation_famille());
        self::assertSame('Something New', $fixture[0]->getNb_Enfants());
        self::assertSame('Something New', $fixture[0]->getProches_Malades());
        self::assertSame('Something New', $fixture[0]->getProfession());
        self::assertSame('Something New', $fixture[0]->getStress());
        self::assertSame('Something New', $fixture[0]->getTrajet_du_travail());
        self::assertSame('Something New', $fixture[0]->getSport());
        self::assertSame('Something New', $fixture[0]->getFatigue());
        self::assertSame('Something New', $fixture[0]->getLors_Reveil());
        self::assertSame('Something New', $fixture[0]->getFumer_Vous());
        self::assertSame('Something New', $fixture[0]->getDepuis_Age());
        self::assertSame('Something New', $fixture[0]->getCosommation_alcool());
        self::assertSame('Something New', $fixture[0]->getConsommation_Stimulants());
        self::assertSame('Something New', $fixture[0]->getManger());
        self::assertSame('Something New', $fixture[0]->getAlimentaire_Principale());
        self::assertSame('Something New', $fixture[0]->getTraitement());
        self::assertSame('Something New', $fixture[0]->getLequel());
        self::assertSame('Something New', $fixture[0]->getHypertension());
        self::assertSame('Something New', $fixture[0]->getEn_An_Debut());
        self::assertSame('Something New', $fixture[0]->getDiabetique());
        self::assertSame('Something New', $fixture[0]->getDiabete_Type());
        self::assertSame('Something New', $fixture[0]->getTraitement_Conteceptif());
        self::assertSame('Something New', $fixture[0]->getPrener_Tension());
        self::assertSame('Something New', $fixture[0]->getDernier_Tension());
        self::assertSame('Something New', $fixture[0]->getDiastolique());
        self::assertSame('Something New', $fixture[0]->getFrenquence_Cardiaque());
        self::assertSame('Something New', $fixture[0]->getSuivi_Cardio());
        self::assertSame('Something New', $fixture[0]->getMedecin_Traitant());
        self::assertSame('Something New', $fixture[0]->getIMC());
        self::assertSame('Something New', $fixture[0]->getDate_Reponse());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Questionnaire();
        $fixture->setPseudo('My Title');
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCode_Postal('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setDate_Naissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setOrigine('My Title');
        $fixture->setPoids('My Title');
        $fixture->setPoids_Stable('My Title');
        $fixture->setTaille('My Title');
        $fixture->setComposition_Foyer('My Title');
        $fixture->setStuation_famille('My Title');
        $fixture->setNb_Enfants('My Title');
        $fixture->setProches_Malades('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStress('My Title');
        $fixture->setTrajet_du_travail('My Title');
        $fixture->setSport('My Title');
        $fixture->setFatigue('My Title');
        $fixture->setLors_Reveil('My Title');
        $fixture->setFumer_Vous('My Title');
        $fixture->setDepuis_Age('My Title');
        $fixture->setCosommation_alcool('My Title');
        $fixture->setConsommation_Stimulants('My Title');
        $fixture->setManger('My Title');
        $fixture->setAlimentaire_Principale('My Title');
        $fixture->setTraitement('My Title');
        $fixture->setLequel('My Title');
        $fixture->setHypertension('My Title');
        $fixture->setEn_An_Debut('My Title');
        $fixture->setDiabetique('My Title');
        $fixture->setDiabete_Type('My Title');
        $fixture->setTraitement_Conteceptif('My Title');
        $fixture->setPrener_Tension('My Title');
        $fixture->setDernier_Tension('My Title');
        $fixture->setDiastolique('My Title');
        $fixture->setFrenquence_Cardiaque('My Title');
        $fixture->setSuivi_Cardio('My Title');
        $fixture->setMedecin_Traitant('My Title');
        $fixture->setIMC('My Title');
        $fixture->setDate_Reponse('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/admin/questionnaire/');
    }
}
