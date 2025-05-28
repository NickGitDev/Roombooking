<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class RoomApiService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.roomservice.base_uri', 'http://localhost:7000');
    }

    public function all(): Collection
{
    $response = Http::get("{$this->baseUrl}/rooms");

    if ($response->successful()) {
        $json = $response->json();

        // Cas 1: données plates
        if (array_is_list($json)) {
            return collect($json);
        }

        // Cas 2: réponse API avec "data"
        if (isset($json['data']) && is_array($json['data'])) {
            return collect($json['data']);
        }

        // Sinon : erreur
        throw new \Exception('Format de réponse API inattendu.');
    }

    throw new \Exception('Erreur lors de la récupération des salles depuis l’API.');
}


    public function create(array $data): array
    {
        $response = Http::post("{$this->baseUrl}/rooms", $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Erreur lors de la création de la salle via l’API.');
    }

    public function update(int $id, array $data): void
    {
        $response = Http::put("{$this->baseUrl}/rooms/{$id}", $data);

        if (!$response->successful()) {
            throw new \Exception("Erreur lors de la mise à jour de la salle (ID: $id)");
        }
    }

    public function delete(int $id): void
    {
        $response = Http::delete("{$this->baseUrl}/rooms/{$id}");

        if (!$response->successful()) {
            throw new \Exception("Erreur lors de la suppression de la salle (ID: $id)");
        }
    }
}
