<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        static $images = [
            'https://lh3.googleusercontent.com/_TxLmFEktNAchpzQdFwbEBegoKvIcrPXvabcRlYPOqrbIvC8jBV0FgupOHM96cl-biRmQZcyy8_-gKJc6OJxIXVOKe2Q3zhumSLU97gISsZuGdV2mqg8Mzo0QYI5hILrWLmnlj0r',
            'https://lh6.googleusercontent.com/lvD4yDYj3V57TIyJBe3o4zkYbJLH7-S0G9-w4_yLqA60J1k6uyS1_ZJ27d_bMG0LZPA_39C8QTpLLSu3mFqG3GsYXPisN7u_72iyhkXBUzdsZXODdksDk-u3m17velVvho7P-hRg',
            'https://blog.woba.com.br/wp-content/uploads/2021/11/CowItaim-Sala-Reflexao-1024x768.jpeg',
            'https://s32907.pcdn.co/wp-content/uploads/2020/02/ilumina%C3%A7%C3%A3o-22022020.jpg',
            'https://s2.glbimg.com/didr1kmNB1Ci_3_2XwtRdXOICAY=/smart/e.glbimg.com/og/ed/f/original/2019/12/03/salas-reunioes-lindas11.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT72ZsdL5hHCI2SFZQBfRO_QumXuUd14CDWnOdijH7uyaWa-2QoZdCX9gMrXRR5KGNDFyI&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSto8Y2VC3GsZhbpwmS5AyIETyVqy6a4WuklMCjm_z3hcHmKDzJqPcOizTRtB9v3HALR4&usqp=CAU',
            'https://static.pmweb.com.br/vR4DFXYR4p0srS3PKMgesscxQQs=/https://letsimage.s3.sa-east-1.amazonaws.com/editor/hcchotels/pt/eventos/1726077227724-qoya-curitiba-tingui.jpg',
            'https://agenda-open-site.s3.sa-east-1.amazonaws.com/uploads/07098128b8ed5c0667ede0f005be73e1_3.jpg',
            'https://www.tribunapr.com.br/wp-content/uploads/2024/01/26161203/coworking-shopping-estacao.jpeg',
        ];

        static $index = 1;

        return [
            'room_name'     => 'Sala ' . $index++,
            'location_name' => $this->faker->company,
            'address'       => $this->faker->address,
            'capacity'      => $this->faker->numberBetween(1, 50),
            'description'   => $this->faker->sentence,
            'rating'        => $this->faker->numberBetween(1, 5),
            'image'         => $this->faker->randomElement($images),
        ];
    }
}
