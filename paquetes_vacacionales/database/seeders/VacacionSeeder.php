<?php

namespace Database\Seeders;

use App\Models\Vacacion;
use App\Models\Foto;
use Illuminate\Database\Seeder;

class VacacionSeeder extends Seeder
{
    public function run(): void
    {
        $destinos = [
            // 1. Maldivas - Playa
            [
                'titulo' => 'Paraíso en Maldivas - Resort de Lujo',
                'descripcion' => 'Experimenta el lujo absoluto en un resort privado en las Maldivas. Incluye villa sobre el agua, desayuno buffet, spa ilimitado, excursiones de snorkel, cenas románticas en la playa y traslados en hidroavión. Un destino perfecto para luna de miel o escapada romántica.',
                'precio' => 4500.00,
                'pais' => 'Maldivas',
                'id_tipo' => 1, // Playa
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=800',
                    'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=800',
                    'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800',
                ]
            ],

            // 2. Suiza - Montaña
            [
                'titulo' => 'Alpes Suizos - Aventura de Esquí Premium',
                'descripcion' => 'Disfruta de 7 días de esquí en los majestuosos Alpes Suizos. Incluye hospedaje en chalet de lujo, pases de ski ilimitados, clases de esquí privadas, comidas gourmet y acceso a spa alpino. Perfecto para amantes de la nieve y deportes de invierno.',
                'precio' => 3800.00,
                'pais' => 'Suiza',
                'id_tipo' => 2, // Montaña
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=800',
                    'https://images.unsplash.com/photo-1605540436563-5bca919ae766?w=800',
                ]
            ],

            // 3. París - Ciudad/Romántico
            [
                'titulo' => 'París Romántico - Ciudad del Amor',
                'descripcion' => 'Vive la magia de París con este paquete romántico de 5 días. Incluye hotel boutique en el Barrio Latino, cena en la Torre Eiffel, crucero por el Sena, entradas a museos principales, desayunos franceses y tour privado por Montmartre.',
                'precio' => 2400.00,
                'pais' => 'Francia',
                'id_tipo' => 6, // Romántico
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800',
                    'https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?w=800',
                ]
            ],

            // 4. Nueva Zelanda - Aventura
            [
                'titulo' => 'Nueva Zelanda Extrema - Aventura Total',
                'descripcion' => 'Paquete de aventura de 10 días incluyendo bungee jumping, rafting, paracaidismo, trekking en glaciares, visita a Hobbiton, kayak en fiordos y mucho más. Para los verdaderos amantes de la adrenalina. Incluye alojamiento, transporte y todas las actividades.',
                'precio' => 5200.00,
                'pais' => 'Nueva Zelanda',
                'id_tipo' => 4, // Aventura
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1507699622108-4be3abd695ad?w=800',
                    'https://images.unsplash.com/photo-1469521669194-babb9326e4c4?w=800',
                ]
            ],

            // 5. Japón - Cultural
            [
                'titulo' => 'Japón Tradicional - Experiencia Cultural',
                'descripcion' => 'Sumérgete en la cultura japonesa con este tour de 12 días por Tokio, Kioto y Osaka. Incluye ceremonia del té, clases de sushi, visita a templos antiguos, experiencia en ryokan tradicional, festival de sakura y guías culturales expertos.',
                'precio' => 4100.00,
                'pais' => 'Japón',
                'id_tipo' => 5, // Cultural
                'user_id' => 3,
                'fotos' => [
                    'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800',
                    'https://images.unsplash.com/photo-1528164344705-47542687000d?w=800',
                ]
            ],

            // 6. Bali - Playa/Lujo
            [
                'titulo' => 'Bali Espiritual - Retiro de Bienestar',
                'descripcion' => 'Reconecta contigo mismo en este retiro de 8 días en Bali. Incluye villa privada con piscina, sesiones diarias de yoga, masajes balineses, meditación guiada, comida orgánica, tours a templos sagrados y cascadas escondidas.',
                'precio' => 2800.00,
                'pais' => 'Indonesia',
                'id_tipo' => 8, // Lujo
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800',
                    'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800',
                ]
            ],

            // 7. Grecia - Islas
            [
                'titulo' => 'Islas Griegas - Tour Santorini y Mykonos',
                'descripcion' => 'Explora las hermosas islas griegas en este paquete de 10 días. Incluye vuelos inter-islas, hoteles con vistas al mar Egeo, tours de vino, paseos en barco, cenas mediterráneas y puestas de sol en Oia. Historia, playa y gastronomía en un solo viaje.',
                'precio' => 3200.00,
                'pais' => 'Grecia',
                'id_tipo' => 12, // Islas
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?w=800',
                    'https://images.unsplash.com/photo-1533105079780-92b9be482077?w=800',
                ]
            ],

            // 8. Kenia - Safari
            [
                'titulo' => 'Safari en Kenia - Gran Migración',
                'descripcion' => 'Presencia el espectáculo de la gran migración en este safari de 8 días. Incluye lodge de lujo en Masai Mara, game drives diarios, visita a comunidad Masai, vuelos internos, todas las comidas y guías naturalistas. Una experiencia única en la vida.',
                'precio' => 5800.00,
                'pais' => 'Kenia',
                'id_tipo' => 10, // Safari
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800',
                    'https://images.unsplash.com/photo-1489392191049-fc10c97e64b6?w=800',
                ]
            ],

            // 9. Islandia - Aventura
            [
                'titulo' => 'Islandia Mágica - Auroras y Glaciares',
                'descripcion' => 'Descubre la tierra de hielo y fuego en 7 días inolvidables. Incluye tour por el Círculo Dorado, baño en la Laguna Azul, caminata en glaciar, cuevas de hielo, avistamiento de auroras boreales y aguas termales naturales. Magia nórdica pura.',
                'precio' => 3600.00,
                'pais' => 'Islandia',
                'id_tipo' => 4, // Aventura
                'user_id' => 3,
                'fotos' => [
                    'https://images.unsplash.com/photo-1504829857797-ddff29c27927?w=800',
                    'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=800',
                ]
            ],

            // 10. Tailandia - Económico/Playa
            [
                'titulo' => 'Tailandia Express - Bangkok y Phuket',
                'descripcion' => 'Paquete económico de 9 días combinando ciudad y playa. Incluye hoteles 3 estrellas, desayunos, tours por templos de Bangkok, mercados flotantes, ferry a Phuket, días de playa y clases de cocina tailandesa. Excelente relación calidad-precio.',
                'precio' => 1200.00,
                'pais' => 'Tailandia',
                'id_tipo' => 9, // Económico
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800',
                    'https://images.unsplash.com/photo-1528181304800-259b08848526?w=800',
                ]
            ],

            // 11. Italia - Cultural/Ciudad
            [
                'titulo' => 'Italia Clásica - Roma, Florencia y Venecia',
                'descripcion' => 'Tour cultural de 10 días por las ciudades más emblemáticas de Italia. Incluye hoteles céntricos, entradas a Coliseo, Vaticano, Uffizi, paseo en góndola, catas de vino en Toscana, clases de pasta y guías expertos en historia del arte.',
                'precio' => 2900.00,
                'pais' => 'Italia',
                'id_tipo' => 5, // Cultural
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800',
                    'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=800',
                ]
            ],

            // 12. Caribe - Crucero
            [
                'titulo' => 'Crucero por el Caribe - 7 Islas Paradisíacas',
                'descripcion' => 'Crucero de lujo de 10 días visitando 7 islas del Caribe. Incluye camarote con balcón, todas las comidas, bebidas premium, entretenimiento nocturno, excursiones en cada puerto y acceso a todas las instalaciones del barco. Diversión garantizada.',
                'precio' => 3400.00,
                'pais' => 'Caribe',
                'id_tipo' => 11, // Crucero
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
                    'https://images.unsplash.com/photo-1520454974749-611b7248ffdb?w=800',
                ]
            ],

            // 13. Perú - Aventura/Cultural
            [
                'titulo' => 'Perú Místico - Machu Picchu y Amazonas',
                'descripcion' => 'Viaje de 12 días explorando lo mejor de Perú. Incluye Cusco, Valle Sagrado, tren a Machu Picchu, lodge en el Amazonas, avistamiento de fauna, comidas típicas, guías especializados y ceremonias ancestrales. Historia viva y naturaleza salvaje.',
                'precio' => 2600.00,
                'pais' => 'Perú',
                'id_tipo' => 4, // Aventura
                'user_id' => 3,
                'fotos' => [
                    'https://images.unsplash.com/photo-1587595431973-160d0d94add1?w=800',
                    'https://images.unsplash.com/photo-1526392060635-9d6019884377?w=800',
                ]
            ],

            // 14. Dubai - Lujo/Ciudad
            [
                'titulo' => 'Dubai Extravagante - Lujo en el Desierto',
                'descripcion' => 'Experimenta el lujo árabe en 6 días inolvidables. Incluye hotel 5 estrellas, safari en desierto, cena en Burj Khalifa, compras en Dubai Mall, tour en yate, spa de lujo y vuelo en helicóptero sobre la ciudad. Opulencia y modernidad.',
                'precio' => 4200.00,
                'pais' => 'Emiratos Árabes Unidos',
                'id_tipo' => 8, // Lujo
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800',
                    'https://images.unsplash.com/photo-1518684079-3c830dcef090?w=800',
                ]
            ],

            // 15. Canadá - Montaña/Familiar
            [
                'titulo' => 'Rocosas Canadienses - Aventura Familiar',
                'descripcion' => 'Paquete familiar de 8 días en las Montañas Rocosas. Incluye alojamiento familiar, tours en Banff y Jasper, avistamiento de vida salvaje, paseos en canoa, caminatas adaptadas, visita a glaciares y aguas turquesas. Perfecto para todas las edades.',
                'precio' => 3100.00,
                'pais' => 'Canadá',
                'id_tipo' => 7, // Familiar
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?w=800',
                    'https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=800',
                ]
            ],

            // 16. Marruecos - Cultural
            [
                'titulo' => 'Marruecos Imperial - Ciudades Milenarias',
                'descripcion' => 'Tour de 10 días por Marrakech, Fez, Casablanca y desierto del Sahara. Incluye riads tradicionales, paseo en camello, noche en desierto bajo las estrellas, zocos tradicionales, comida marroquí auténtica y tours guiados por medinas históricas.',
                'precio' => 1800.00,
                'pais' => 'Marruecos',
                'id_tipo' => 5, // Cultural
                'user_id' => 3,
                'fotos' => [
                    'https://images.unsplash.com/photo-1489749798305-4fea3ae63d43?w=800',
                    'https://images.unsplash.com/photo-1597212618440-806262de4f6b?w=800',
                ]
            ],

            // 17. Polinesia - Romántico/Islas
            [
                'titulo' => 'Polinesia Francesa - Bora Bora Dreams',
                'descripcion' => 'Luna de miel perfecta en Bora Bora y Tahití. 9 días en bungalows sobre el agua, desayunos flotantes, excursiones privadas en laguna, cenas románticas en la playa, masajes de parejas, snorkel en arrecifes y puestas de sol inolvidables.',
                'precio' => 6500.00,
                'pais' => 'Polinesia Francesa',
                'id_tipo' => 6, // Romántico
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1589197331516-6c1c21d1ffab?w=800',
                    'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
                ]
            ],

            // 18. Australia - Ciudad/Playa
            [
                'titulo' => 'Australia Completa - Sydney y Gran Barrera',
                'descripcion' => 'Experimenta lo mejor de Australia en 14 días. Incluye Sydney Opera House, playas de Bondi, buceo en Gran Barrera de Coral, vuelo interno, tours en 4x4 por el outback, vida salvaje única y comida australiana moderna. Aventura down under.',
                'precio' => 5400.00,
                'pais' => 'Australia',
                'id_tipo' => 3, // Ciudad
                'user_id' => 2,
                'fotos' => [
                    'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=800',
                    'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?w=800',
                ]
            ],

            // 19. Noruega - Crucero/Aventura
            [
                'titulo' => 'Fiordos Noruegos - Crucero Espectacular',
                'descripcion' => 'Crucero de 8 días navegando por los majestuosos fiordos noruegos. Incluye camarote premium, excursiones en cada puerto, tren de Flåm, visita a glaciares, pueblos vikingos, avistamiento de auroras (en temporada) y gastronomía escandinava.',
                'precio' => 4800.00,
                'pais' => 'Noruega',
                'id_tipo' => 11, // Crucero
                'user_id' => 1,
                'fotos' => [
                    'https://images.unsplash.com/photo-1601439678777-b2b3c56fa627?w=800',
                    'https://images.unsplash.com/photo-1513519245088-0e12902e35ca?w=800',
                ]
            ],

            // 20. Costa Rica - Aventura/Familiar
            [
                'titulo' => 'Costa Rica Pura Vida - Eco Aventura',
                'descripcion' => 'Ecoturismo de 10 días en el paraíso centroamericano. Incluye zip-lining por la selva, rafting, volcanes activos, aguas termales, playas del Caribe y Pacífico, avistamiento de perezosos y tortugas, lodges ecológicos y mucha biodiversidad.',
                'precio' => 2200.00,
                'pais' => 'Costa Rica',
                'id_tipo' => 4, // Aventura
                'user_id' => 3,
                'fotos' => [
                    'https://images.unsplash.com/photo-1564500677263-eac9174a482b?w=800',
                    'https://images.unsplash.com/photo-1523474253046-8cd2748b5fd2?w=800',
                ]
            ],
        ];

        foreach ($destinos as $destino) {
            $fotos = $destino['fotos'];
            unset($destino['fotos']);

            $vacacion = Vacacion::create($destino);

            // Crear fotos asociadas
            // Las URLs de Unsplash se guardan directamente como rutas externas
            foreach ($fotos as $index => $fotoUrl) {
                Foto::create([
                    'id_vacacion' => $vacacion->id,
                    'ruta' => $fotoUrl,
                ]);
            }
        }
    }
}