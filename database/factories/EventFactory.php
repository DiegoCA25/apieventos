<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activities = [
            'Concierto de Música',
            'Taller de Pintura',
            'Cine Bajo las Estrellas',
            'Maratón de Programación',
            'Feria de Comida',
            'Exposición de Arte',
            'Festival de Jazz',
            'Carrera de Autos',
            'Competencia de Baile',
            'Seminario de Tecnología'
        ];

        return [
            'name' => $this->faker->randomElement($activities), // Selecciona una actividad aleatoria
            'datei' => $this->faker->date,
            'datef' => $this->faker->date,
            'promo' => ' ',
            'city_id' => $this->faker->numberBetween(1, 6)
        ];
    }
}
