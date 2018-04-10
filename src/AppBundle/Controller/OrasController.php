<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Duomenys;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OrasController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $tabs = $this->getDoctrine()->getRepository('AppBundle:Duomenys')->findAll();
        $oras = new Duomenys;
        $form = $this->createFormBuilder($oras)
            ->add('apiKey', 'text', array('label' => ' ','attr' => array('class' => 'form-control', 'placeholder' => 'API')))
            ->add('miestas', 'text', array('label' => ' ','attr' => array('class' => 'form-control', 'placeholder' => 'Miestas')))
            ->add('save', 'submit', array('label' => 'Pridėti miestą', 'attr' => array('class' => 'btn btn-success', 'style' => 'margin-top: 20px; width: 100%;')))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apikey = $form['apiKey']->getData();
            $miestas = $form['miestas']->getData();
            if ((preg_match('/^[A-Za-z0-9]+$/', $apikey)) && (preg_match('/^[A-Ža-ž0-9]+$/', $miestas))) {
                $tikrinam = $this->getDoctrine()->getRepository('AppBundle:Duomenys')->findOneByMiestas($miestas);
                if ($tikrinam == null) {
                    if ($jsonfile = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$miestas&units=metric&appid=$apikey")) {
                        $jsondata = json_decode($jsonfile);
                        $temp = round($jsondata->main->temp, 0);
                        $country = strtolower($jsondata->sys->country);
                        $clouds = round($jsondata->clouds->all, 0);
                        $humidity = round($jsondata->main->humidity, 0);
                        $pressure = round($jsondata->main->pressure, 0);
                        $wind = round($jsondata->wind->speed, 0);
                        $icon = $jsondata->weather[0]->icon;

                        $oras->setMiestas($miestas);
                        $oras->setApiKey($apikey);
                        $oras->setTemperatura($temp);
                        $oras->setSalis($country);
                        $oras->setDebesuotumas($clouds);
                        $oras->setDregnumas($humidity);
                        $oras->setSlegis($pressure);
                        $oras->setVejas($wind);
                        $oras->setIcon($icon);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($oras);
                        $em->flush();

                        $this->addFlash(
                            'notice',
                            'Naujas skirtukas sėkmingai sukurtas!'
                        );
                        return $this->redirectToRoute('homepage');
                    } else {
                        $this->addFlash(
                            'error',
                            'Neteisingas API raktas arba miesto pavadinimas!'
                        );
                        return $this->redirectToRoute('homepage');
                    }
                } else {
                    $this->addFlash(
                        'error',
                        'Šis miestas jau egzistuoja!'
                    );
                    return $this->redirectToRoute('homepage');
                }
            } else {
                $this->addFlash(
                    'error',
                    'Įvesties laukeliuose yra neleistinų simbolių!'
                );
                return $this->redirectToRoute('homepage');
            }
        }

        foreach ($tabs as $tab) {
            $miestas = $tab->getMiestas();
            $apikey = $tab->getApiKey();
            if ($jsonfile = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$miestas&units=metric&appid=$apikey")) {
                $jsondata = json_decode($jsonfile);
                $temp = round($jsondata->main->temp, 0);
                $country = strtolower($jsondata->sys->country);
                $clouds = round($jsondata->clouds->all, 0);
                $humidity = round($jsondata->main->humidity, 0);
                $pressure = round($jsondata->main->pressure, 0);
                $wind = round($jsondata->wind->speed, 0);
                $icon = $jsondata->weather[0]->icon;

                $em = $this->getDoctrine()->getManager();
                $oras = $em->getRepository('AppBundle:Duomenys')->findOneByMiestas($miestas);

                $oras->setTemperatura($temp);
                $oras->setDebesuotumas($clouds);
                $oras->setDregnumas($humidity);
                $oras->setSlegis($pressure);
                $oras->setVejas($wind);

                $em->flush();
            }
        }

        return $this->render('default/index.html.twig', array(
            'tabs' => $tabs,
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/clearall", name="clear")
     */
    public function clearAction(Request $request)
    {
        $tabs = $this->getDoctrine()->getRepository('AppBundle:Duomenys')->findAll();

        foreach ($tabs as $tab) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tab);
        }
        if (isset($em)) {
            $em->flush();

            $this->addFlash(
                'notice',
                'Visi skirtukai sėkmingai pašalinti!'
            );

        } else {
            $this->addFlash(
                'error',
                'Nėra sukurtų jokių skirtukų!'
            );
        }
        return $this->redirectToRoute('homepage');
    }
}
