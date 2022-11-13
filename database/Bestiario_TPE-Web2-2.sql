-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2022 a las 23:28:35
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Bestiario_TPE-Web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`id`, `nombre`, `descripcion`) VALUES
(16, 'Bestias', 'Animales reales, como lobos y osos.\r\nNo todos los peligros de The Witcher 3 son seres sobrenaturales de otros mundos, una serie de animales reclaman su cuota de protagonismo e intentan sobrevivir'),
(17, 'Malditos', 'Humanos a los que les echaron una maldición mágica, por elección propia o contra su voluntad. Una de las especialidades favoritas de los brujos, que pueden optar por acabar con su vida o intentar romper la maldición.'),
(18, 'Dracónidos', 'Aunque apenas quedan dragones de verdad, estos hermanos pequeños también son una gran amenaza, y los brujos siempre obtienen grandes recompensas para acabar con ellos.'),
(19, 'Constructos', 'Representaciones del poder puro y místico de los elementos a los que se les da un propósito o conciencia, fruto de hombres poderosos con mucho conocimiento y poco juicio. Son algunos de los monstruos más raros y peligros a los que nos podremos enfrentar.'),
(20, 'Espectros', 'Los hombres y mujeres que mueren en circunstancias horribles, dejan asuntos pendientes o fueron traicionados por sus seres queridos, pueden volver al mundo de los mortales en forma de espíritus vengativos.'),
(21, 'Ogro', 'Fuerza bruta y gran tamaño son algunas de las características que definen a estas criaturas, aunque algunos como los trols tienen cierta capacidad de raciocinio, y son pacíficos.'),
(23, 'Petariicio', 'Ser sobrenatural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Monstruo`
--

CREATE TABLE `Monstruo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `debilidad` varchar(300) NOT NULL,
  `descripcion` varchar(1500) NOT NULL,
  `id_Categoria_fk` int(11) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Monstruo`
--

INSERT INTO `Monstruo` (`id`, `nombre`, `debilidad`, `descripcion`, `id_Categoria_fk`, `imagen`) VALUES
(40, 'Oso', 'aceite para bestias, Quen, Igni, Yrden', '¿Sabes esa cancioncita del oso que sube la montaña para ver qué puede ver? Es una chorrada como un templo. Cuando un oso sube una montaña, no lo hace para ver, sino para atacar. Para matar.\r\n- Jahne Oldak, cazador real\r\nLos osos son omnívoros, lo cual significa que los hombres encuentran un sitio en su dieta, aparte de las bayas, las raíces y el salmón. Cuando se toman un bocadito de humano, suelen sacarlo de la carne de los viajeros que han tenido las pocas luces de entrar en su territorio o de la de los cazadores para los que abatir una criatura así era la ambición de toda una vida.\r\nHay varias subespecies de osos -los osos negros, los polares y los de las cavernas- que difieren entre sí por el color del pelaje, el tamaño y la fuerza. Pero todos comparten un rasgo en común: una capacidad sin igual para matar.', 16, './images/634c93d595543.jpg'),
(41, 'Jabalí', 'Viento del norte, Aceite para bestias, Igni, Yrden.', 'Estas bestias de los bosques son tan \"salvajes\", indómitas, feroces y agresivas como su nombre indica. A día de hoy, muchos campesinos de las aldeas periféricas de Kaedwen siguen creyendo que los jabalíes salvajes subsisten con una dieta a base de jóvenes doncellas, aunque en realidad suelen saciar su hambre con raíces y bellotas. Sin embargo, no hay que pensar que por su dieta vegetariana sean inofensivos. De hecho, estos animales de complexión fuerte y dientes afilados son unas auténticas máquinas de combate peludas. La madre Naturaleza también los ha equipado con dos pares de colmillos, así que la suma total de este arsenal los convierte en el terror de los bosques, una amenaza para todo el que habite en ellos, sea humano o de otra clase. Los jabalíes poseen unos hocicos duros como un garrote que algunos campesinos denominan \"silbatos\", pese a que ningún jabalí ha producido nunca un sonido semejante. En su lugar, emiten un gruñido característico, parecido al ronquido de un hombre con obesidad mórbida. Otra creencia campesina afirma que los jabalíes son de una naturaleza extremadamente quisquillosa y que, cuando se sienten ofendidos, descargan toda su rabia derribando cercas y engullendo patatas. Aunque en ocasiones viven solos, los jabalíes suelen aparecer en pequeños grupos de tres o cinco individuos.', 16, './images/634c949cb940d.jpg'),
(42, 'Lobo', 'Vulnerable a los intentos de derribo; el estilo veloz es el más eficaz contra los lobos, los brujos más experimentados usan el estilo de grupo contra varios lobos.', 'Un amigo mío solía decir que con todos esos grifos, basiliscos y demás, ya no hacía falta preocuparse por los viejos lobos... Y esas malditas bestias van y devoran la mitad de su rebaño.\r\n- Yngvar, pastor\r\nHubo una vez en que los lobos eran los amos absolutos del bosque. Los hombres los usaban para asustar a los niños, mientras que los adultos también temblaban al oír sus aullidos. Los monstruos posteriores a la Conjunción no solo hicieron huir a los lobos a lo más profundo del bosque, sino que además ocuparon su lugar en las pesadillas de los humanos. Sin embargo, eso no significa que los antiguos depredadores hayan dejado de ser un peligro. Los lobos no tienen ni una gota de magia y no escupen fuego ni ácido, pero eso no les impide matar a cazadores y viajeros poco precavidos.\r\nLos huargos, una subespecie de lobos terriblemente feroces, son especialmente peligrosos, como lo son los lobos blancos que en la actualidad se pueden encontrar en las tierras altas salvajes del archipiélago de Skellige.', 16, './images/634c9808c65dd.jpg'),
(43, 'Hombre Lobo', ' Son muy vulnerables a la plata.', 'El barón Wolfstein enterró su cara entre sus manos. Su corazón palpitaba. De repente, el olor de la sangre de su esposa y de sus hijos se hizo más intenso. El cuerpo del barón se hinchó con sus músculos, y su noble atuendo cayó al suelo de mármol, hecho jirones. \"Amado mío, eres... eres peludo. ¡Eres un lobisome!\", Bianca se puso pálida, \"¿Y nuestro amor?\". En respuesta oyó un terrorífico rugido.\r\nDanielle Stone, La maldición del barón Wolfstein y otras historias de amor.\r\n', 17, './images/634c98df53e1f.jpg'),
(44, 'Malogrado', 'Aceite para malditos, Axia', 'Decir que un malogrado es feo es como decir que la mierda no es especialmente sabrosa: no se puede decir que sea una mentira, pero tampoco refleja toda la realidad.\r\n- Lambert, brujo de la escuela del Lobo\r\nLos malogrados son, quizá, las criaturas más repulsivas que un brujo haya tenido el disgusto de conocer. Nacidos de bebés indeseados que han sido desechados sin recibir una sepultura adecuada, su apariencia es la de un feto medio podrido, con su carne amorfa retorcida por el odio, el miedo y la malicia. Estas horribles criaturas se alimentan de la sangre de mujeres encintas y se ven impelidas por una voracidad tal que suele conllevar la muerte de su víctima', 17, './images/634c99f279feb.jpg'),
(45, 'Basilisco', 'Vulnerables a la plata y al aceite para ornitosaurios.', 'La gente simple llama al basilisco el rey de los desiertos de Zerrikania y a menudo los confunden con un gallotriz. Ellos afirman que la bestia está tan llena de odio hacia los seres vivos que incluso su aliento es venenoso y su mirada convierte a los descuidados en piedra. El hecho de que los brujos a encuentren a los basiliscos en calabozos y sótanos contradice la leyenda y sugiere que estas criaturas pueden reproducirse bajo cualquier condición como muchos de sus hermanos desagradables. En cuentos de fantasía, la única forma certera de matar a un basilisco es sosteniendo un espejo frente a sus ojos para desviar su mirada mortal. Los brujos responden que es mucho mejor estrellar el espejo en la cabeza de la criatura.', 18, './images/634c9a7ec7197.jpg'),
(46, 'Wyvernos', 'Vulnerables a la plata y al aceite para ornitosaurios.', 'Los wyvernos o vivernas son grandes reptiles voladores con cuellos parecidos a serpientes y largas colas que terminan en un tridente venenoso. Descendiendo desde el cielo, atrapan fácilmente a sus presas y las llevan a su nido. Y no les preocupa precisamente si es una oveja o un hombre.', 18, './images/634c9afc8eb4f.jpg'),
(47, 'Eslizón', 'Colmena Aceite para dracónidos Aard Quen', 'Unos campesinos me ofrecieron un dineral por matar a un eslizón. Una puñetera bolsa de la que chorreaba el oro... pero dije que no. ¿De qué sirve el dinero cuando estás muerto? Aparte, un eslizón no es un colihendido ni de coña.\r\n- Zator, uno de los Saqueadores de Crinfrid\r\nLos eslizones se suelen confundir con wyvernos y colihendidos, pero mucho ojo: los eslizones son bestias mezquinas y terriblemente peligrosas. Quien no los distinga de un wyverno sufrirá un fatal destino. Estos pueden destrozar y devorar a un hombre inexperto en segundos, pero un eslizón lo horneará antes con su flamígero aliento para que quede más crujiente.', 18, './images/634c9cd417433.jpg'),
(48, 'Djinn', 'Bomba de dimerita Aceite para constructos', 'Djinn es el nombre dado a los genios elementales del aire. Son criaturas poderosas capaces de realizar grandes proezas. Una vez capturados son ligados a su captor y tienen que cumplir tres deseos. Tras hacer realidad los deseos son libres nuevamente.', 19, './images/634c9d7a566b0.jpg'),
(49, 'Gárgola', 'Deithwen', 'Hace mucho tiempo, cuando los jóvenes eran más educados, todo era más barato y las chicas eran más ardientes, los hechiceros podían dar vida a materia inanimada y crear siervos de piedra con solo soplar fuego. Las gárgolas, que son los siervos que tengo en mente, se pueden encontrar hoy día en ciudades antiguas, pero su magia ha desaparecido y ahora son meros adornos en las cornisas. No obstante, existen excepciones, como las gárgolas de Loc Muinne, que siguen estando encantadas y aún son peligrosas.', 19, './images/634c9e0abb830.jpg'),
(50, 'Hyms', 'polvo lunar, aceite para espectros, Igni', 'El hym es un tipo de espectro que aparece en The Witcher 3: Wild Hunt. Esta criatura no ataca directamente a su huésped, sino que se alimenta del sentimiento de culpa del individuo, atormentándolo hasta el punto de volverlo completamente loco o empujándolo al suicidio.\r\nSegún los eruditos que escribieron el libro Más allá del gran velo, los hyms son uno de los demonios más peligrosos y no pueden ser exorcizados normalmente. Habitan diferentes esferas del multiverso, incluyendo el mundo real y el plano oscuro de Gaunter O\'Dimm', 20, './images/634c9e9672ebd.jpg'),
(51, 'Cíclope', 'aceite para ogroides, Axia, Quen, colmena, Yrden', '¿Qué os parece si... cogemos un palo muy grande, le sacamos punta, se lo clavamos en el ojo al cíclope y salimos de la cueva disfrazados de ovejas? ¿A que es una buena idea?\r\n- Odiseo Thaka, viajero, muerto trágicamente en Spikeroog\r\nLos cíclopes son fácilmente reconocibles por tener un solo ojo en medio de la frente. Si por algún motivo este no es visible, otras señales que los delatan son un tamaño enorme, una fuerza increíble y un odio ardiente hacia los humanos.', 21, './images/634c9efb3f8e6.jpg'),
(52, 'Gigante de hielo', 'Aceite para ogroides, Señal de Quen', 'Es difícil proporcionar una descripción detallada del gigante de hielo, ya que ningún brujo lo ha enfrentado. Solo se conoce por cuentos e informes de segunda mano que mezclan hechos con leyendas. Los skelligers afirman que su piel es de color azul porque nació de la nieve y el hielo, lo que, por supuesto, es claramente imposible, aunque de hecho parece capaz de resistir las heladas más feroces.\r\nTrata a sus víctimas con crueldad y es particularmente aficionado a la carne humana. Utiliza armas simples hechas de objetos saqueados de los cuerpos de aquellos que ha matado.', 21, './images/634c9f7024939.jpg'),
(65, 'Bruja del Bosque', 'Quen, Igni, Yrden', 'cualquier cosa', 16, NULL),
(66, 'Petariicio', 'Todo tipo de conjuros', 'Ser sobrenatural', 19, './images/6369e8b05fb0c.jpg'),
(67, 'CualquierMonstruo', 'Quen, Igni, Yrden', 'cualquier cosa', 18, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reporte`
--

CREATE TABLE `Reporte` (
  `id` int(11) NOT NULL,
  `narrador` varchar(100) NOT NULL,
  `historia` varchar(400) NOT NULL,
  `agresividad` int(1) NOT NULL,
  `id_Monstruo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Reporte`
--

INSERT INTO `Reporte` (`id`, `narrador`, `historia`, `agresividad`, `id_Monstruo_fk`) VALUES
(1, 'Lucas Carmusciano', 'vi un lobo en los campos', 6, 42),
(2, 'Jorge Martinez', 'un lobo ataco a mi familia', 9, 42),
(3, 'Roberto Star', 'pelee contra un jabalí y luego me lo comí', 4, 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `email`, `contrasenia`) VALUES
(1, 'Lucas', 'lucascarmusciano@gmail.com', '$2y$10$fBj.l2WMTBPrSzVofNMONOTbj9/uiNTKxZPIptLb4YUVALc70iZ3m');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Monstruo`
--
ALTER TABLE `Monstruo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Categoria_fk` (`id_Categoria_fk`),
  ADD KEY `id_Categoria_fk_2` (`id_Categoria_fk`);

--
-- Indices de la tabla `Reporte`
--
ALTER TABLE `Reporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Monstruo_fk` (`id_Monstruo_fk`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `Monstruo`
--
ALTER TABLE `Monstruo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `Reporte`
--
ALTER TABLE `Reporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Monstruo`
--
ALTER TABLE `Monstruo`
  ADD CONSTRAINT `monstruo_ibfk_1` FOREIGN KEY (`id_Categoria_fk`) REFERENCES `Categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Reporte`
--
ALTER TABLE `Reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_Monstruo_fk`) REFERENCES `Monstruo` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
