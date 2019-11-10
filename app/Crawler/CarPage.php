<?php


namespace App\Crawler;

use App\Vehicle;
use Goutte\Client;

class CarPage
{

    private $url;

    /**
     * CarPage constructor.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function run()
    {
        $client = new Client();

        $crawler = $client->request('GET', 'https://seminovos.com.br/carro?registrosPagina=500');

        do {
            $nextPage = $crawler->filter("a[title='Próxima página']")->first()->parents()->attr('class');

            if (strpos($nextPage, 'disabled') !== false)
                break;

            $crawler->filter(".card-heading")->each(function ($node, $key) use ($crawler) {
                $newUrl = $node->attr('href');

                $id = $crawler->filter("meta[itemprop='productID']")->eq($key)->attr('content');

                $vehicleTest = Vehicle::find($id);
                echo $id;

                if ($vehicleTest !== null) {
                    echo " alredy exists\n";
                    return;
                }

                echo "\n";

                $c = new Client();
                $crw = $c->request('GET', 'https://seminovos.com.br' . $newUrl);

                $vehicleData = [
                    'id'           => intval($crw->filter("span[itemprop='sku']")->first()->text()),
                    'brand'        => $crw->filter("a[itemprop='brand']")->first()->attr('title'),
                    'model'        => $crw->filter("a[itemprop='model']")->first()->attr('title'),
                    'body_type'    => $crw->filter("a[itemprop='bodyType']")->first()->attr('title'),
                    'type'         => 'carro',
                    'price'        => $crw->filter(".price")->first()->text(),
                    'year'         => $crw->filter("span[itemprop='modelDate']")->first()->text(),
                    'mileage'      => $crw->filter("span[itemprop='mileageFromOdometer']")->first()->text(),
                    'transmission' => $crw->filter("span[title='Tipo de transmissão']")->first()->text(),
                    'doors'        => $crw->filter("span[title='Portas']")->first()->text(),
                    'fuel'         => $crw->filter("span[itemprop='fuelType']")->first()->text(),
                    'color'        => $crw->filter("span[itemprop='color']")->first()->text(),
                    'plate'        => $crw->filter("span[title='Final da placa']")->first()->text(),
                    'is_change'    => $crw->filter("span[title='Aceita troca?']")->first()->text(),
                    'observation'  => $crw->filter("span[itemprop='description']")->previousAll()->first()->text()
                ];


                $vehicleData['price'] = floatval(str_replace("R$", "", $vehicleData['price']));
                $vehicleData['mileage'] = intval($vehicleData['mileage']);
                $vehicleData['doors'] = intval($vehicleData['doors']);
                $vehicleData['is_change'] = $vehicleData['is_change'] != "Não Aceita Troca";

                $accessoriesNode = $crw->filter(".full-features .description-print");
                $accessories = "";

                $accessoriesNode->each(function ($node) use (&$accessories) {
                    $accessories .= $node->text() . ";";
                });

                $vehicleData['accessories'] = trim($accessories, ';');

                $vehicle = new Vehicle();

                $vehicle->fill($vehicleData);
                $vehicle->save();
            });

            $crawler = $client->click($crawler->selectLink('Próximo')->link());
        } while (true);
    }

}