<?php

// Namespace
namespace App\Presenters;

// Usingy
use Nette;
use Nette\Application\LinkGenerator;
use Nette\Application\Responses\JsonResponse;
use Nette\Utils\Finder;

/**
* ApiPresenter je třída, jenž zajišťuje API
*
* @author Marek Kejda <Kejda.Marek@outlook.cz>
*
*/
final class ApiPresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Application\LinkGenerator */
    private $linkGenerator;

    /**
    * Konstruktor presenteru
    */
    function __construct(LinkGenerator $generator) {
        // Inicializace vnitřního stavu objektu
        $this->linkGenerator = $generator;
    }

    /**
    * Endpoint převezme URL v Nette formátu a vygeneruje
    * absolutní cestu k předané URL
    * @param string $dest adresa v Nette formátu
    * @param string $params query parametry
    * @return string absolutní URL adresa
    */
    public function actionGetLink(string $dest, string $params = null) {
        // Vrátí json response
        $this->sendResponse(new JsonResponse(
            // Vygeneruje link
            $this->linkGenerator->link($dest, $params != null ? json_decode($params, true) : [])
        ));
    }

    /**
    * Endpoint najde všechny .js soubory ve složce /www/model/
    * a předá odkazy na jejich načtení frontendu
    * @return array pole modelových tříd a jejich cest
    */
    public function actionGetModel() {
        // Získá cestu k modelovému adresáři
        $dir =  dirname(__FILE__) . '/../../www/client/model';

        // Připraví pole pro výsledky
        $files = array();

        // Prohledáme modelovou složku
        foreach (Finder::findFiles('*.js')->from($dir) as $file) {
            // Cesta k souboru
            $path = $file->getRealPath();

        	// Přidáme záznam o souboru do pole výsledků
            array_push($files, [
                // Název
                'name' => $file->getFilename(),
                // Cesta k souboru zbavena serverové části
                'path' => substr($path, strpos($path, '/client'))
            ]);
        }

        // Vrátí výsledek
        $this->sendResponse(new JsonResponse($files));
    }
}
