-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 04:51 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediplus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kode_verifikasi` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `nama_lengkap`, `username`, `password`, `phone`, `alamat`, `kode_verifikasi`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Owner', 'admin_owner', '0192023a7bbd73250516f069df18b500', '08122122122', 'Jalan Apa', 'R1BGN2', '2019-09-16 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `antrian_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL,
  `category_poli_id` int(11) NOT NULL,
  `nomor_antri` int(11) NOT NULL,
  `notifikasi_antrian` int(11) NOT NULL,
  `status_antrian` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`antrian_id`, `pasien_id`, `dokter_id`, `klinik_id`, `category_poli_id`, `nomor_antri`, `notifikasi_antrian`, `status_antrian`) VALUES
(180, 62, 7, 3, 21, 1, 3, 1),
(181, 61, 7, 3, 21, 2, 3, 2),
(182, 61, 7, 3, 21, 3, 3, 1),
(183, 59, 7, 3, 21, 4, 3, 2),
(184, 63, 7, 3, 21, 5, 3, 1),
(185, 59, 7, 3, 21, 6, 3, 1),
(186, 61, 7, 3, 21, 7, 3, 2),
(187, 59, 7, 3, 21, 8, 3, 1),
(188, 61, 7, 3, 21, 9, 3, 1),
(189, 63, 7, 3, 21, 10, 3, 1),
(190, 63, 7, 3, 21, 11, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `asisten_dokter`
--

CREATE TABLE `asisten_dokter` (
  `asisten_dokter_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `sumber` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `judul`, `deskripsi`, `img_file`, `sumber`, `created_at`, `is_deleted`) VALUES
(1, '4 Cara Mengatasi Kaki Bengkak Saat Hamil', 'Fimela.com, Jakarta Kaki Anda menopang paling berat dari berat kehamilan Anda. Selain itu, tubuh Anda memproduksi hampir 50 persen lebih banyak cairan dan darah selama kehamilan yang dapat menyebabkan tangan, kaki, wajah, dan kaki Anda membengkak [1]. Sebagian besar wanita mengalami pembengkakan di bagian tubuh mereka sekitar 5 bulan setelah kehamilan, yang mungkin berlanjut sampai melahirkan.\r\n\r\nNamun, ada banyak pengobatan rumahan yang tersedia bagi Anda untuk membantu mengelola welling. Teruslah membaca untuk mengetahui penyebab kondisi yang cukup umum ini selama kehamilan dan bagaimana Anda dapat menggunakan beberapa pengobatan rumahan untuk menghilangkannya.\r\nPenyebab Kaki Bengkak Saat Kehamilan\r\n\r\nSalah satu alasan utama kaki bengkak selama kehamilan adalah retensi cairan. Selain itu, kapiler di kaki Anda membesar karena tekanan tambahan dari bayi Anda, sehingga menyebabkan kaki bengkak. Jika Anda perhatikan bahwa kaki Anda lebih bengkak pada waktu-waktu tertentu daripada yang lain, itu mungkin karena alasan berikut.\r\n\r\nBerdiri terlalu lama: Berdiri terlalu lama bisa mengarahkan semua darah ke kaki Anda menyebabkan mereka membengkak.\r\n\r\nMemiliki gaya hidup yang terlalu aktif meskipun sedang hamil: Terlalu banyak aktivitas berarti banyak berjalan. Ini hanya meningkatkan tekanan berat kehamilan pada kaki Anda dan membengkak sebagai respons.\r\n\r\nKonsumsi natrium dan kafein yang tinggi: Kadar garam dan kafein yang tinggi dalam diet Anda hanya membuat tubuh Anda mempertahankan lebih banyak cairan, yang menyebabkan pembengkakan. Asupan kalium rendah: Kalium diketahui menyempitkan pembuluh darah dan mengurangi pembengkakan. Jika diet Anda tidak mengandung cukup kalium, itu berarti lebih banyak pembengkakan.\r\n\r\nDehidrasi dalam waktu lama: Dehidrasi tidak hanya berisiko selama kehamilan tetapi juga akan membuat tubuh Anda mempertahankan lebih banyak cairan.\r\n\r\n \r\n\r\nKaki Bengkak Saat Hamil, Ini Solusinya!\r\nKaki Bengkak Saat Hamil, Ini Solusinya!\r\nBerikut home remedies Untuk Kaki Bengkak Selama Kehamilan\r\n1. Sertakan lebih banyak makanan utuh dalam diet Anda\r\n\r\nIni adalah alasan lain bagi Anda untuk menjauhkan diri dari makanan yang dikemas dan dibeli di toko. Mereka tinggi sodium yang hanya akan membuat Anda mempertahankan lebih banyak cairan dalam tubuh Anda [6]. Sebaliknya, pilihlah makanan alami dan utuh.\r\n\r\n2. Berolahraga secara teratur\r\n\r\nMemimpin gaya hidup yang tidak aktif tidak dianjurkan selama kehamilan. Di sisi lain, penting untuk tidak terlalu aktif karena berada di kaki Anda untuk sebagian besar hari hanya akan memperburuk keadaan bagi Anda. Olahraga ringan akan membantu Anda mengatur sirkulasi darah dan cairan, mengurangi kemungkinan kaki bengkak [7].\r\n\r\n3. Rendam kaki Anda dalam air garam\r\n\r\nMencelupkan kaki Anda ke dalam air hangat dengan garam Epsom dikenal sangat menenangkan dan obat terbaik untuk kaki bengkak [8]. Garam akan membantu menyempitkan pembuluh darah dan mengarahkan darah menjauh dari kaki Anda, sehingga mengurangi pembengkakan.\r\n\r\n4. Kurangi asupan kafein\r\n\r\nKafein meningkatkan retensi air dalam tubuh Anda, yang merupakan salah satu penyebab utama kaki bengkak. Selain itu, kelebihan kafein membuat Anda lebih sering buang air kecil, sehingga menyebabkan dehidrasi [4]. Anda dapat mengganti minuman berkafein dengan teh herbal hangat sebagai gantinya.', '8eb2d353de06d70512b0b84cd0ef3526.jpeg', 'https://www.fimela.com/parenting/read/4153591/4-cara-mengatasi-kaki-bengkak-saat-hamil', '2020-01-28 15:50:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_poli`
--

CREATE TABLE `category_poli` (
  `category_poli_id` int(11) NOT NULL,
  `nama_poli` varchar(100) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_poli`
--

INSERT INTO `category_poli` (`category_poli_id`, `nama_poli`, `img_file`, `is_deleted`) VALUES
(1, 'Poli Kandungan', '87a052a214bd1fb82720a65d24de30ee.png', 1),
(2, 'Poli Anak', '1d279212774fa2e5723ae61c79d0d8bf.jpg', 1),
(3, 'Poli Akupuntur', '733e9ee1d211cc148168e4e09e598ccd.png', 0),
(4, 'Poli Anak', '30d94c8c0eed9018ab564f93a35a0d1b.png', 0),
(5, 'Poli Anastesi', '52984ceba1ff4fd51871ac149ffa5663.png', 0),
(6, 'Poli Andrologi', '9a4d993067edfe1f9d3ccb67604b5be2.png', 0),
(7, 'Poli Bedah', '07932591bcc8732a63c14d2f1808e71e.png', 0),
(8, 'Poli Farmasi', '48ebe1f14fec93e5c8f5059b592d4773.png', 0),
(9, 'Poli Forensik', '0347f83960d766a2cc6e180c74024155.png', 0),
(10, 'Poli Gigi Spesialis', '7aa8c8baa2e38931efbcaf4135e05338.png', 0),
(11, 'Poli Gigi Umum', 'db0961f7a2f5f18c53503ce2e030bbfc.png', 0),
(12, 'Poli Gizi', '8327929ec11b8436373a742d42237b58.png', 0),
(13, 'Poli Homecare', '6d532939185a3c53f54a7dd04f63e8bc.png', 0),
(14, 'Poli Jantung', '1df26fb38fac152f3e595120ef49a72b.png', 0),
(15, 'Poli Jiwa', 'aaa4fe51f250dd4bbd24f55632b15a91.png', 0),
(16, 'Poli Kulit dan Kelamin', '5bc4a785dc448aa10a6182d61f239945.png', 0),
(17, 'Poli Laboratorium', '4f5bdd2202971936cfedc10329d886bf.png', 0),
(18, 'Poli Mata', '0394dd06fdb92598fb4a4b27954b3367.png', 0),
(19, 'Poli Medical Checkup', '151c4ad6504fd54668644c8754cec1cf.png', 0),
(20, 'Poli Mikrobiologi', 'f54e13fe751e2f33f2cfcc35bfa375d4.png', 0),
(21, 'Poli Obgyn', '8a7bf5b0664e8a4ecda25a83ab873fe2.png', 0),
(22, 'Poli Olahraga', '39fd5090260af9fd0e6a5f3d0e66ee19.png', 0),
(23, 'Poli Paru', '56c0ed83077b243a5e4618b9b9b0367e.png', 0),
(24, 'Poli Patologi Anatomi', 'aa0414b5c3f3ca909bd42e4b9f127748.png', 0),
(25, 'Poli Patologi', '4ec17ea82d331cb4d676dfa1ac2ba246.png', 0),
(26, 'Poli Penyakit Dalam', '80068fa51344c959454f2d6e6ce1e514.png', 0),
(27, 'Poli Radiologi', 'fe777940d10eca3d3345e02274c290c0.png', 0),
(28, 'Poli Rehabilitasi', '565c82b33d76ec2920590e5ab9f03655.png', 0),
(29, 'Poli Syaraf', '5141dbee8aa7824743b2a7167531514f.png', 0),
(30, 'Poli THT', '4ed3a340888175955ab762d7e0c16707.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `chat` text NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `customer_is_sender` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `chatroom_id`, `chat`, `dokter_id`, `pasien_id`, `img_file`, `created_at`, `is_deleted`, `customer_is_sender`) VALUES
(1, 0, 'selamat dok', 7, 63, '', '2020-01-30 11:07:32', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat_asisten_dokter`
--

CREATE TABLE `chat_asisten_dokter` (
  `chat_id` int(11) NOT NULL,
  `chatroom_id` int(11) NOT NULL,
  `chat` text NOT NULL,
  `asisten_dokter_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `customer_is_sender` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_data_scan`
--

CREATE TABLE `detail_data_scan` (
  `detail_data_scan_id` int(11) NOT NULL,
  `histori_data_scan_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `type_file` int(1) NOT NULL,
  `save_video` varchar(255) NOT NULL,
  `save_img` varchar(255) NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_data_scan`
--

INSERT INTO `detail_data_scan` (`detail_data_scan_id`, `histori_data_scan_id`, `pasien_id`, `dokter_id`, `type_file`, `save_video`, `save_img`, `video_file`, `img_file`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 3, 2, 0, '', '', '', '9a21c5f481e316d7983193363b069177.JPG', '2019-12-27 17:21:48', NULL, 0),
(2, 1, 3, 2, 0, '', '', '', 'b1d11760591a40025fb6a5e161eb2a36.JPG', '2019-12-27 17:21:48', NULL, 0),
(3, 1, 3, 2, 0, '', '', '', 'c190128824bc8f0195ff72a1de248217.JPG', '2019-12-27 17:21:48', NULL, 0),
(4, 1, 3, 2, 0, '', '', '', '9741cc0066dd665fb65bb76664cc560e.JPG', '2019-12-27 17:21:48', NULL, 0),
(5, 1, 3, 2, 1, '', '', '72029c4735013749e35bb666bfa53eba.mp4', '', '2019-12-27 17:22:36', NULL, 0),
(6, 1, 3, 2, 1, '', '', '8f0e87af58e56adadec694abf5ab64c9.mp4', '', '2019-12-27 17:22:47', NULL, 0),
(7, 1, 3, 2, 1, '', '', 'cb5b832b092c719ff3aa2ac5a3524d9e.mp4', '', '2019-12-27 17:22:58', NULL, 0),
(8, 1, 3, 2, 1, '', '', '1da56ff0692d702c39d76c0ccb942339.mp4', '', '2019-12-27 17:23:07', NULL, 0),
(9, 2, 4, 2, 1, '', '', '98d70ab0e9368f09f80dc7b80c44f5a9.mp4', '', '2019-12-27 17:26:41', NULL, 0),
(10, 3, 5, 2, 0, '', '', '', 'bb176e7048b7795d11da7058177dba68.JPG', '2019-12-27 17:35:09', NULL, 0),
(11, 3, 5, 2, 0, '', '', '', '512034ef71bc8a3575252fc08e685490.JPG', '2019-12-27 17:35:09', NULL, 0),
(12, 3, 5, 2, 0, '', '', '', '7b09ca570647346666fa169945b41c76.JPG', '2019-12-27 17:35:09', NULL, 0),
(13, 3, 5, 2, 0, '', '', '', '5de011cc1042fd72d670d78b7c1de100.JPG', '2019-12-27 17:35:09', NULL, 0),
(14, 3, 5, 2, 0, '', '', '', 'd28194cda3d7474029850859450ce1c9.JPG', '2019-12-27 17:35:09', NULL, 0),
(15, 3, 5, 2, 0, '', '', '', 'c79177bc95c12d15dbfb88252f38d9b6.JPG', '2019-12-27 17:35:09', NULL, 0),
(16, 3, 5, 2, 1, '', '', 'afd3e7d745de3878b1c0398c195ecb2f.mp4', '', '2019-12-27 17:36:33', NULL, 0),
(17, 3, 5, 2, 1, '', '', 'adb32d19495e50c2e37fdc055052141c.mp4', '', '2019-12-27 17:37:05', NULL, 0),
(18, 2, 4, 2, 1, '', '', '7625647b495f71fa08b22a6920d71dc3.mp4', '', '2019-12-27 17:37:47', NULL, 0),
(19, 2, 4, 2, 1, '', '', '0ca5e9c80241a96ad567dbd1e1623b74.mp4', '', '2019-12-27 17:39:43', NULL, 0),
(20, 4, 6, 2, 0, '', '', '', 'abe024a69ad46eb985354726feb44778.JPG', '2019-12-27 18:16:54', NULL, 0),
(21, 4, 6, 2, 0, '', '', '', '2551b2c8a33a3f11073b06a01b8440b8.JPG', '2019-12-27 18:16:54', NULL, 0),
(22, 4, 6, 2, 0, '', '', '', '79f1b81000b78cac63fed25da28efef1.JPG', '2019-12-27 18:16:54', NULL, 0),
(23, 4, 6, 2, 0, '', '', '', '6160cf644e9d2049f3bb4e9a2618ee16.JPG', '2019-12-27 18:16:54', NULL, 0),
(24, 4, 6, 2, 1, '', '', '366adc63f7e15230894320c44dac45e8.mp4', '', '2019-12-27 18:17:26', NULL, 0),
(25, 4, 6, 2, 1, '', '', '1e665699ca228c02858116c464715671.mp4', '', '2019-12-27 18:17:32', NULL, 0),
(26, 4, 6, 2, 1, '', '', 'e9ce23606ffbcf5e14d1df63ac28299c.mp4', '', '2019-12-27 18:17:37', NULL, 0),
(27, 4, 6, 2, 1, '', '', 'c989187699a6c0a56ea3265a68ce835e.mp4', '', '2019-12-27 18:17:42', NULL, 0),
(30, 6, 9, 2, 0, '', '', '', '7d5072da5095962d8a5f701d7ce86cb4.JPG', '2019-12-30 17:46:20', NULL, 0),
(31, 6, 9, 2, 0, '', '', '', '71f721537b51ebba6ab9f10611ec473d.JPG', '2019-12-30 17:46:20', NULL, 0),
(32, 6, 9, 2, 0, '', '', '', '37f021a28e1f7d6a5045fdf9b1e1f1be.JPG', '2019-12-30 17:46:20', NULL, 0),
(33, 6, 9, 2, 0, '', '', '', '170e7bdc2a175b5d6a9d893e645e10d3.JPG', '2019-12-30 17:46:20', NULL, 0),
(34, 6, 9, 2, 0, '', '', '', '0585650f352107d9a735a4b2cbb95d29.JPG', '2019-12-30 17:46:20', NULL, 0),
(35, 6, 9, 2, 0, '', '', '', 'bc9b84daaf59f6f94161331f57303867.JPG', '2019-12-30 17:46:20', NULL, 0),
(36, 6, 9, 2, 0, '', '', '', '339f397bfacda8684ba6859930173714.JPG', '2019-12-30 17:46:20', NULL, 0),
(37, 6, 9, 2, 0, '', '', '', '48fd56efe9ba41fb41ad428e337629fb.JPG', '2019-12-30 17:46:20', NULL, 0),
(38, 6, 9, 2, 1, '', '', '314078ef5ec62580883a5fcafb9f2ad9.mp4', '', '2019-12-30 17:47:51', NULL, 0),
(39, 6, 9, 2, 1, '', '', 'dbf3a7c619250938d51aacf0fa5948f0.mp4', '', '2019-12-30 17:48:03', NULL, 0),
(40, 6, 9, 2, 1, '', '', '705d7d819cea02642c7f3b13b71c3618.mp4', '', '2019-12-30 17:48:07', NULL, 0),
(41, 6, 9, 2, 1, '', '', '8235f5e2a2b7db9c5c3018ca038cff42.mp4', '', '2019-12-30 17:48:11', NULL, 0),
(42, 6, 9, 2, 1, '', '', '17bc8e6dc46b78fe72f6301d6cc5b46b.mp4', '', '2019-12-30 17:48:15', NULL, 0),
(43, 6, 9, 2, 1, '', '', '0b181b9e028b0aecb462a986bb5004cf.mp4', '', '2019-12-30 17:49:13', NULL, 0),
(44, 6, 9, 2, 1, '', '', '53bb8535f0d23bbe215c7858c50e8d21.mp4', '', '2019-12-30 17:49:24', NULL, 0),
(45, 6, 9, 2, 1, '', '', 'fe76895484fb3927c0eacb9be83fbcb8.mp4', '', '2019-12-30 17:49:28', NULL, 0),
(46, 6, 9, 2, 1, '', '', '3b9be7b3ebedeae6e7c5b88f2f33e4cf.mp4', '', '2019-12-30 17:49:31', NULL, 0),
(47, 6, 9, 2, 1, '', '', 'e29af9eca757369859f7e81a630d652f.mp4', '', '2019-12-30 17:49:35', NULL, 0),
(48, 7, 4, 2, 0, '', '', '', 'd496623e4a95cad994ca1b489a2694f2.JPG', '2019-12-30 17:53:01', NULL, 0),
(49, 7, 4, 2, 0, '', '', '', '9737806b2043ec43a117dcd3bc718c93.JPG', '2019-12-30 17:53:02', NULL, 0),
(50, 7, 4, 2, 0, '', '', '', 'a693a560bcdc138a22d429a30415c326.JPG', '2019-12-30 17:53:02', NULL, 0),
(51, 7, 4, 2, 0, '', '', '', '11c9424ffa74c4411d3aacee1f219701.JPG', '2019-12-30 17:53:02', NULL, 0),
(52, 7, 4, 2, 0, '', '', '', '59c0f9349a7697faf7551fbf1db39e13.JPG', '2019-12-30 17:53:02', NULL, 0),
(53, 7, 4, 2, 0, '', '', '', '842536ef798adcb63d4d33c13458f0be.JPG', '2019-12-30 17:53:02', NULL, 0),
(54, 7, 4, 2, 0, '', '', '', 'd6d1943a7e85806f7d23f88168faa771.JPG', '2019-12-30 17:53:02', NULL, 0),
(55, 7, 4, 2, 0, '', '', '', 'b8a514aaf09e62f972c0e7a698d9202d.JPG', '2019-12-30 17:53:02', NULL, 0),
(56, 7, 4, 2, 1, '', '', 'dec97a921ab5e50a410381c5f0dae82b.mp4', '', '2019-12-30 17:54:22', NULL, 0),
(57, 8, 3, 3, 0, '', '', '', 'dd806b5c5874371c0773f5d21a089c5d.JPG', '2020-01-02 19:38:39', NULL, 0),
(58, 8, 3, 3, 0, '', '', '', '8ddcd07a28851bd0c5e332ab01cd5259.JPG', '2020-01-02 19:38:39', NULL, 0),
(59, 8, 3, 3, 1, '', '', '653edac04728baa614e64564a35079ff.mp4', '', '2020-01-02 19:39:32', NULL, 0),
(60, 9, 7, 3, 0, '', '', '', 'd22927676de0a6d822cefd4a79ac18e2.JPG', '2020-01-02 20:00:49', NULL, 0),
(61, 10, 13, 3, 0, '', '', '', '4516c21ba4327cdafa104f2b6f28af29.JPG', '2020-01-02 20:14:20', NULL, 0),
(62, 13, 18, 3, 0, '', '', '', '8effae682403ac156aabb61ad3082f38.JPG', '2020-01-02 20:47:06', NULL, 0),
(63, 14, 11, 3, 0, '', '', '', 'c850a5387adf19e594cc01abfeb8b4ab.JPG', '2020-01-02 21:23:58', NULL, 0),
(64, 14, 11, 3, 0, '', '', '', '4a4949a7ecf38bcc76f60d3acc1e4abb.JPG', '2020-01-02 21:23:58', NULL, 0),
(65, 14, 11, 3, 1, '', '', '97e03cb1dda0d2a46fe0130c8bae1d24.mp4', '', '2020-01-02 21:24:50', NULL, 0),
(66, 14, 11, 3, 1, '', '', '2fbe35e75920ebf0096ce8949359e84e.mp4', '', '2020-01-02 21:25:32', NULL, 0),
(67, 15, 17, 3, 0, '', '', '', '0fc44cc23dd2b4d373500e1fcac74206.JPG', '2020-01-02 21:42:30', NULL, 0),
(68, 15, 17, 3, 0, '', '', '', '84a348de7a585b84e457215c55a90c38.JPG', '2020-01-02 21:42:30', NULL, 0),
(69, 15, 17, 3, 1, '', '', 'bd7e284e396b8dccf940634cd3c2bb3c.mp4', '', '2020-01-02 21:45:17', NULL, 0),
(72, 8, 3, 3, 1, '', '', '81668cb79bd69aac980cb113fcd9f7a5.mp4', '', '2020-01-03 17:35:39', NULL, 0),
(73, 8, 3, 3, 1, '', '', '4471b45d51687f809cd6d7315ec2c519.mp4', '', '2020-01-03 17:35:39', NULL, 0),
(74, 8, 3, 3, 1, '', '', 'd5871bac12455bfaadf2e533e501749d.mp4', '', '2020-01-03 17:35:40', NULL, 0),
(75, 17, 3, 3, 1, '', '', '74055a02e95b38374c6f5be8deefeb05.mp4', '', '2020-01-03 17:46:32', NULL, 0),
(76, 17, 3, 3, 1, '', '', 'f168a9c3c1fb08ee9a644a8d4e81a86e.mp4', '', '2020-01-03 17:46:33', NULL, 0),
(77, 17, 3, 3, 1, '', '', '122f838f4e3f4f4c7e9ef2d2d3d219c7.mp4', '', '2020-01-03 17:46:34', NULL, 0),
(78, 19, 24, 2, 1, '', '', '9dac5c7649f4fb326ce611f53890b50c.mp4', '', '2020-01-03 19:57:42', NULL, 0),
(79, 20, 23, 2, 1, '', '', 'f2cbfff728c384aea102db7e07aab3ad.mp4', '', '2020-01-03 20:35:36', NULL, 0),
(80, 20, 23, 2, 1, '', '', '67bc2335bd51d33d616f3aeceafc1b80.mp4', '', '2020-01-03 20:35:37', NULL, 0),
(81, 20, 23, 2, 1, '', '', '333a29f28e9f19540ff88824ec977bad.mp4', '', '2020-01-03 20:35:56', NULL, 0),
(82, 20, 23, 2, 1, '', '', '962d280249b0d1b2981dab942502d412.mp4', '', '2020-01-03 20:35:57', NULL, 0),
(83, 20, 23, 2, 1, '', '', '58b7f1a22b24ea630f700121a49ec65b.mp4', '', '2020-01-03 20:36:11', NULL, 0),
(84, 20, 23, 2, 1, '', '', '06602ad579ba9ef3f09cd8fe7bd0322a.mp4', '', '2020-01-03 20:36:12', NULL, 0),
(85, 20, 23, 2, 1, '', '', '977ef5b9929cb803f2af4f70e17d32c8.mp4', '', '2020-01-03 20:36:17', NULL, 0),
(86, 20, 23, 2, 1, '', '', 'f8e4c2643116d089528f113e79910df4.mp4', '', '2020-01-03 20:36:18', NULL, 0),
(87, 20, 23, 2, 1, '', '', '3e89f4b681fb24786982e32adaa35086.mp4', '', '2020-01-03 20:36:19', NULL, 0),
(88, 20, 23, 2, 1, '', '', 'db34c178f7bfc9cfb2a9938d7a679df7.mp4', '', '2020-01-03 20:36:20', NULL, 0),
(89, 20, 23, 2, 1, '', '', '170012ecd205c4affe6db83e055d40d2.mp4', '', '2020-01-03 20:36:21', NULL, 0),
(90, 20, 23, 2, 1, '', '', '80c15b9271a2c60e9042a8aa77f7721a.mp4', '', '2020-01-03 20:36:22', NULL, 0),
(91, 20, 23, 2, 1, '', '', 'b01176f18e1a1aa9adb728c523fa6311.mp4', '', '2020-01-03 20:36:32', NULL, 0),
(92, 20, 23, 2, 1, '', '', '54d7f6f0b13e1c0876a44a823872450d.mp4', '', '2020-01-03 20:36:33', NULL, 0),
(93, 20, 23, 2, 1, '', '', '528d62b5990c3a9d44a9466c8d962c1e.mp4', '', '2020-01-03 20:36:43', NULL, 0),
(94, 20, 23, 2, 1, '', '', 'ac5013606727ca0bdc52709cad38ab51.mp4', '', '2020-01-03 20:36:44', NULL, 0),
(95, 20, 23, 2, 1, '', '', 'cfccb2fa5574712ee0260a383263a777.mp4', '', '2020-01-03 20:36:56', NULL, 0),
(96, 20, 23, 2, 1, '', '', '350d352d54aa404378b46158b455b771.mp4', '', '2020-01-03 20:36:57', NULL, 0),
(97, 20, 23, 2, 1, '', '', '61d7a26bb22e1852647dc1366e6a1229.mp4', '', '2020-01-03 20:37:08', NULL, 0),
(98, 20, 23, 2, 1, '', '', '7f3a0eda26d033776323b6652165f0cb.mp4', '', '2020-01-03 20:37:09', NULL, 0),
(99, 20, 23, 2, 1, '', '', 'fa862b2eea8ab441e55c0a4bf929be84.mp4', '', '2020-01-03 20:37:51', NULL, 0),
(100, 20, 23, 2, 1, '', '', '1fa80dcaa981397a859f13209fd090ca.mp4', '', '2020-01-03 20:37:52', NULL, 0),
(101, 20, 23, 2, 1, '', '', '7358d9a42c3441245276b9cdd7fcc72e.mp4', '', '2020-01-03 20:38:11', NULL, 0),
(102, 20, 23, 2, 1, '', '', 'bcda7617094c70bae97b86ac29eddadd.mp4', '', '2020-01-03 20:38:11', NULL, 0),
(103, 21, 27, 2, 1, '', '', '6c38acfd62c9b32879f4b01bdd32dae1.mp4', '', '2020-01-03 20:55:35', NULL, 0),
(104, 21, 27, 2, 1, '', '', '890cd47c5e876e82e94a8492dba703aa.mp4', '', '2020-01-03 20:55:36', NULL, 0),
(105, 21, 27, 2, 1, '', '', '78bb2dfdef3ba6e83da1d2d6859630d4.mp4', '', '2020-01-03 20:55:37', NULL, 0),
(106, 23, 29, 2, 1, '', '', 'f4b6d9139bb520c748921e8ccc6cec3d.mp4', '', '2020-01-03 22:03:04', NULL, 0),
(107, 23, 29, 2, 1, '', '', '1d15ea04af734b519b45098ca02bfeb8.mp4', '', '2020-01-03 22:03:17', NULL, 0),
(108, 23, 29, 2, 1, '', '', '7ae651ed54e5b15e537ecfd4f405222d.mp4', '', '2020-01-03 22:03:19', NULL, 0),
(109, 25, 32, 2, 1, '', '', 'd5a02b0a8fe006caa55e2497bd957b34.mp4', '', '2020-01-03 22:12:54', NULL, 0),
(110, 25, 32, 2, 1, '', '', '72afe688554f009c960bb2b266e2f07d.mp4', '', '2020-01-03 22:12:54', NULL, 0),
(111, 25, 32, 2, 1, '', '', '459ec663f05db62f690e9077eadfa7ea.mp4', '', '2020-01-03 22:12:55', NULL, 0),
(112, 24, 31, 2, 1, '', '', '7b1b20e29953734dd120353fb3bd0d3c.mp4', '', '2020-01-03 22:39:32', NULL, 0),
(113, 27, 34, 2, 1, '', '', '9475fb8342dd89c0b8b270b80c06bedd.mp4', '', '2020-01-03 23:24:25', NULL, 0),
(114, 30, 39, 2, 1, '', '', 'f54214c7a6a6c53e23b47f63cea471c4.mp4', '', '2020-01-04 14:01:57', NULL, 0),
(115, 30, 39, 2, 1, '', '', 'a43c591ca767a6b4213a57e21190620c.mp4', '', '2020-01-04 14:01:58', NULL, 0),
(116, 30, 39, 2, 1, '', '', 'd96d7dff03dd076490f2cebbe662ce29.mp4', '', '2020-01-04 14:01:59', NULL, 0),
(117, 29, 38, 2, 1, '', '', '14cc9c792b6d313eec6817917efdca52.mp4', '', '2020-01-04 14:07:54', NULL, 0),
(118, 29, 38, 2, 1, '', '', '2cb47e17ee1f44984fb3464c6de5487d.mp4', '', '2020-01-04 14:07:55', NULL, 0),
(119, 31, 40, 2, 1, '', '', '56c641423a03c4ca5dc9387fee7e345b.mp4', '', '2020-01-04 14:49:04', NULL, 0),
(120, 32, 41, 2, 1, '', '', 'ad43e9cf314143b5b901c27ee24fa5c3.mp4', '', '2020-01-04 15:15:58', NULL, 0),
(121, 34, 56, 7, 0, '', '', '', 'f501076828846e0a54bb1c488d4fcaec.jpg', '2020-01-14 11:27:52', NULL, 0),
(122, 34, 56, 7, 0, '', '', '', 'f80b6e3d8747012bedd662c8d051edcc.jpg', '2020-01-14 11:27:52', NULL, 0),
(123, 33, 3, 7, 1, '', '', 'ef06a480c889848da405f47b3af94f71.mp4', '', '2020-01-17 19:56:58', NULL, 0),
(126, 18, 3, 3, 0, '', '', '', '93f0d8baac89015ec89cacd4ded08df8.jpg', '2020-01-18 08:13:00', NULL, 0),
(127, 18, 3, 3, 1, '', '', '276f129720c2934bb243bbdce292858a.mp4', '', '2020-01-18 08:13:01', NULL, 0),
(128, 35, 5, 9, 0, '', '', '', '021f4ef0806f267473737106cef48b28.jpg', '2020-01-26 16:50:45', NULL, 0),
(129, 35, 5, 9, 0, '', '', '', '2bff0fe1158602d8d882c2232d0a2611.jpg', '2020-01-26 16:51:36', NULL, 0),
(133, 35, 5, 9, 0, '', '', '', 'b064884086ceccd465fb7d41e2499e44.jpg', '2020-01-26 17:04:28', NULL, 0),
(134, 39, 3, 9, 0, '', '', '', '35599039d9c847e69821527798d286b7.jpg', '2020-01-27 13:01:58', NULL, 0),
(135, 39, 3, 9, 0, '', '', '', '46f2dcb570338f9746bb109835ceacf9.jpg', '2020-01-27 13:01:58', NULL, 0),
(136, 39, 3, 9, 0, '', '', '', 'e67c1b6f4634898f72cbcf8d4207f84d.jpg', '2020-01-27 13:01:58', NULL, 0),
(137, 39, 3, 9, 0, '', '', '', '8be4cac5318c76eadfaa63ba40146a55.jpg', '2020-01-27 13:01:58', NULL, 0),
(138, 40, 8, 9, 0, '', '', '', '56a619107ed71beec78b91e4794d8fbb.jpg', '2020-01-27 13:06:11', NULL, 0),
(139, 40, 8, 9, 0, '', '', '', '1382bc8c730d032c069104644a01dc6e.jpg', '2020-01-27 13:06:11', NULL, 0),
(140, 40, 8, 9, 0, '', '', '', 'ad1a9eaa16a189355a08c0cb58c33e8d.jpg', '2020-01-27 13:06:11', NULL, 0),
(141, 40, 8, 9, 0, '', '', '', '645c3155b6018211a6d6c3430afab381.jpg', '2020-01-27 13:06:11', NULL, 0),
(142, 40, 8, 9, 0, '', '', '', '1c74818dfd27deace09278081efa0edf.jpg', '2020-01-27 13:13:59', NULL, 0),
(143, 44, 5, 9, 0, '', '', '', '9dea62badddd623d612594a297f2efdd.bmp', '2020-01-28 10:12:47', NULL, 0),
(144, 44, 5, 9, 0, '', '', '', '47d54d76df76b9bb064cd658947dfece.bmp', '2020-01-28 10:13:39', NULL, 0),
(145, 45, 59, 9, 1, '', '', '1fcf92cf66c668b35d5ec2251b414a6e.mp4', '', '2020-01-28 10:23:23', NULL, 0),
(146, 45, 59, 9, 0, '', '', '', 'c2ad7e328dc640e959cc12db5f053fa0.bmp', '2020-01-28 10:23:23', NULL, 0),
(147, 45, 59, 9, 0, '', '', '', 'b9263394a2da0c3f5e5bc7a08732d2f7.bmp', '2020-01-28 10:23:23', NULL, 0),
(148, 46, 3, 9, 1, '', '', '97622d79d2a6fe9fe538750ec4f2f777.mp4', '', '2020-01-28 10:26:28', NULL, 0),
(149, 46, 3, 9, 0, '', '', '', '72a109270f15733f8b2fe417a9a3b662.bmp', '2020-01-28 10:26:28', NULL, 0),
(150, 46, 3, 9, 0, '', '', '', 'c43a7c18fce008b379cfe7065100b75e.bmp', '2020-01-28 10:26:28', NULL, 0),
(151, 47, 5, 9, 1, '', '', 'fc76a5bb2271d3d1ab2a12d3bf2b1ccf.mp4', '', '2020-01-28 10:36:19', NULL, 0),
(152, 47, 5, 9, 0, '', '', '', '433605b7ebf65038fbb678df8131c3fe.bmp', '2020-01-28 10:36:19', NULL, 0),
(153, 47, 5, 9, 0, '', '', '', 'b79f626c4fe26006a83a9b02cc238205.bmp', '2020-01-28 10:36:19', NULL, 0),
(154, 48, 59, 9, 0, '', '', '', 'ff1757b5d693aaa0737820589532dff5.bmp', '2020-01-28 11:14:26', NULL, 0),
(155, 50, 61, 7, 0, '', '', '', 'd63b74ccb2f5b6e0d20cc0e2e62cc526.jpg', '2020-01-30 10:48:38', NULL, 0),
(156, 50, 61, 7, 1, '', '', 'dc734dd2e2c5740f4c34c52ea4336944.mp4', '', '2020-01-30 10:50:06', NULL, 0),
(157, 50, 61, 7, 0, '', '', '', '8bb388b84f6baaf8b1b1c088018014a4.jpg', '2020-01-30 10:50:06', NULL, 0),
(158, 52, 59, 7, 0, '', '', '', '6dc39dc33d583c2ce17a7751121dfa74.jpg', '2020-01-30 10:52:58', NULL, 0),
(159, 52, 59, 7, 1, '', '', '289d9c238d2d6f6f71d8d321d9812a6a.mp4', '', '2020-01-30 10:54:28', NULL, 0),
(160, 52, 59, 7, 0, '', '', '', '08af284b74a3f92f1e096442b71a4e05.jpg', '2020-01-30 10:54:29', NULL, 0),
(161, 52, 59, 7, 0, '', '', '', '64d6b764f5e701f66c328fd1f270316a.jpg', '2020-01-30 10:54:29', NULL, 0),
(162, 52, 59, 7, 0, '', '', '', 'cc4f44ffed24d982483596f98c861ff7.jpg', '2020-01-30 10:54:29', NULL, 0),
(163, 52, 59, 7, 1, '', '', '39b8979aefe4d8e1e274d64d9cbac860.mp4', '', '2020-01-30 10:56:00', NULL, 0),
(164, 52, 59, 7, 0, '', '', '', '98baa41a3983b5d3052d4308e6ab89a5.jpg', '2020-01-30 10:56:00', NULL, 0),
(165, 52, 59, 7, 0, '', '', '', '78ca759d220514c9f3f8924f48a7ab28.jpg', '2020-01-30 10:56:00', NULL, 0),
(166, 55, 63, 7, 1, '', '', 'f27a02b2b6f1348da79ea72d48f6164c.mp4', '', '2020-01-30 11:03:34', NULL, 0),
(167, 55, 63, 7, 0, '', '', '', '24d96a9a7ec502511ecd05faef22b197.jpg', '2020-01-30 11:03:34', NULL, 0),
(168, 55, 63, 7, 1, '', '', '9ddaf027158e34bb6c9b8262a708684c.mp4', '', '2020-01-30 11:05:03', NULL, 0),
(169, 55, 63, 7, 0, '', '', '', '28c816adddc0af2ed82437d9f34900da.jpg', '2020-01-30 11:05:03', NULL, 0),
(170, 55, 63, 7, 1, '', '', '3b1ee8a5256e9552f84b728160e1e6be.mp4', '', '2020-01-30 11:06:34', NULL, 0),
(171, 55, 63, 7, 0, '', '', '', 'fb19f2a17e993e5519fb5108b2e272e1.jpg', '2020-01-30 11:06:34', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `dokter_id` int(11) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `nomor_sip` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `category_poli_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `biaya` int(11) NOT NULL,
  `batas_antrian` int(11) NOT NULL,
  `status_pembayaran` int(50) NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `biaya_pembayaran` int(11) NOT NULL,
  `expired` datetime DEFAULT NULL,
  `status_aktif` int(1) NOT NULL,
  `is_aktif` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`dokter_id`, `nama_dokter`, `phone`, `alamat`, `email`, `img_file`, `nomor_sip`, `username`, `password`, `token`, `category_poli_id`, `klinik_id`, `ruangan`, `biaya`, `batas_antrian`, `status_pembayaran`, `tanggal_pembayaran`, `biaya_pembayaran`, `expired`, `status_aktif`, `is_aktif`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'dr. Dode', '081558558595', 'Jl. Ngagel', 'dode@mail.com', '6c8e2b2ce2c31579455ee39f1c90fefe.jpg', '', 'dokter_dode', '5d6afaad77266d3facfc8da6f0c2a3a4', 'e45272be35c25a544de0c152b4020e7d', 1, 1, 'Kandungan', 0, 20, 0, NULL, 0, NULL, 1, 0, '2019-12-27 15:04:10', '0000-00-00 00:00:00', 0),
(2, 'dr. Maya Sri K, Sp.OG(K)FER', '082177791566', '', 'rsiakartika@gmail.com', '41b38402430b66c9f608f38f5ce13189.jpg', '', 'dr.maya', '25d55ad283aa400af464c76d713c07ad', '77ea01132b78e8a3265174a2916f65bb', 21, 1, 'Kandungan', 0, 10, 0, NULL, 0, NULL, 1, 0, '2019-12-27 15:52:03', '2019-12-28 16:32:26', 0),
(3, 'dr. Vita Maya Paramita, Sp.OG', '0315042392', '', 'vita@gmail.com', 'd7ad849aca54a910f455ebd3417ac9b7.jpg', '', 'dr.Vita', 'f3d336a9f4305d5a1051f52c76124cda', '5c44d09c94ed11305bd3b850ef329f97', 21, 1, 'Kandungan', 0, 0, 0, NULL, 0, NULL, 0, 0, '2020-01-02 16:55:10', '0000-00-00 00:00:00', 0),
(7, 'dr.medi,SpOG', '081234567891', '', 'drmedi@gmail.com', '43b564f99ed72f172e241135046cf5fb.jpg', '', 'dr.medi', 'e10adc3949ba59abbe56e057f20f883e', '169469336e54df7bf0328ca733472bd4', 21, 3, 'Kandungan 1', 0, 21, 0, NULL, 0, NULL, 1, 1, '2020-01-13 12:40:33', '2020-01-28 16:04:13', 0),
(8, 'drg.medi', '081234567891', '', 'drg.medi@gmail.com', 'aa6d1aa7fde047b659f6588e5731ccb0.jpg', '', 'drg.medi', 'e10adc3949ba59abbe56e057f20f883e', 'f3166375943f1a5e1f66c609eebb5a90', 11, 2, '', 0, 10, 0, NULL, 0, NULL, 1, 0, '2020-01-13 12:41:54', '0000-00-00 00:00:00', 0),
(10, 'dr.medica SpA', '6789', '', 'medica@gmail.com', '4a1f1b6ed35256f84ce197da60cf9244.jpg', '', 'dr.geMedica SpA', '827ccb0eea8a706c4c34a16891f84e7b', 'bf03720029335514f17b122aa3efe4f5', 4, 3, '', 0, 0, 0, NULL, 0, NULL, 1, 1, '2020-01-26 16:04:29', '0000-00-00 00:00:00', 0),
(11, 'dr.gm', '031223333', '', 'dr.gm@gmail.com', '22efd9d296ad246185321a17f97973a9.jpg', '', 'dr.gm', '827ccb0eea8a706c4c34a16891f84e7b', '42dda5c7e557b8118b77ad3919191154', 11, 3, '', 0, 10, 0, NULL, 0, NULL, 1, 1, '2020-01-28 16:22:50', '0000-00-00 00:00:00', 0),
(12, 'Dr. Green .SpOG', '0898865454', 'Surabaya', 'dr.green@gmail.com', '7e9c82023d38f5af41115b94c83afe0e.jpg', '123', 'dr.green', 'e10adc3949ba59abbe56e057f20f883e', '956bc662715a0d4e4421b0660be2c9d2', 21, 3, '', 0, 0, 0, NULL, 0, NULL, 1, 1, '2020-01-30 10:55:56', '2020-01-30 10:59:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expired_payment`
--

CREATE TABLE `expired_payment` (
  `expired_payment_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `date_payment` datetime NOT NULL,
  `date_expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hantrian_dokter`
--

CREATE TABLE `hantrian_dokter` (
  `hantrian_dokter_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `biaya` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hantrian_dokter`
--

INSERT INTO `hantrian_dokter` (`hantrian_dokter_id`, `dokter_id`, `pasien_id`, `klinik_id`, `ruangan`, `created_at`, `biaya`, `is_deleted`) VALUES
(1, 2, 3, 1, 'Kandungan', '2019-12-27 17:20:08', 150000, 1),
(2, 2, 4, 1, 'Kandungan', '2019-12-27 17:24:46', 150000, 1),
(3, 2, 5, 1, 'Kandungan', '2019-12-27 17:33:48', 150000, 1),
(4, 2, 6, 1, 'Kandungan', '2019-12-27 18:16:24', 150000, 1),
(5, 2, 3, 1, 'Kandungan', '2019-12-28 19:22:27', 0, 0),
(6, 2, 9, 1, 'Kandungan', '2019-12-30 17:40:56', 0, 0),
(7, 2, 4, 1, 'Kandungan', '2019-12-30 17:51:34', 0, 0),
(8, 3, 3, 1, 'Kandungan', '2020-01-02 19:37:40', 0, 0),
(9, 3, 7, 1, 'Kandungan', '2020-01-02 19:59:34', 0, 0),
(10, 3, 13, 1, 'Kandungan', '2020-01-02 20:10:22', 0, 0),
(11, 3, 15, 1, 'Kandungan', '2020-01-02 20:19:36', 0, 0),
(12, 3, 16, 1, 'Kandungan', '2020-01-02 20:20:00', 0, 0),
(13, 3, 18, 1, 'Kandungan', '2020-01-02 20:37:48', 0, 0),
(14, 3, 11, 1, 'Kandungan', '2020-01-02 21:19:05', 0, 0),
(15, 3, 17, 1, 'Kandungan', '2020-01-02 21:41:42', 0, 0),
(16, 2, 3, 1, 'Kandungan', '2020-01-03 15:13:46', 0, 0),
(17, 3, 3, 1, 'Kandungan', '2020-01-03 17:38:18', 0, 0),
(18, 3, 3, 1, 'Kandungan', '2020-01-03 18:01:21', 0, 0),
(19, 2, 24, 1, 'Kandungan', '2020-01-03 19:44:54', 0, 0),
(20, 2, 23, 1, 'Kandungan', '2020-01-03 20:05:54', 0, 0),
(21, 2, 27, 1, 'Kandungan', '2020-01-03 20:54:46', 0, 0),
(22, 2, 29, 1, 'Kandungan', '2020-01-03 21:28:02', 0, 0),
(23, 2, 29, 1, 'Kandungan', '2020-01-03 21:32:42', 0, 0),
(24, 2, 31, 1, 'Kandungan', '2020-01-03 21:52:12', 0, 0),
(25, 2, 32, 1, 'Kandungan', '2020-01-03 22:12:06', 0, 0),
(26, 2, 29, 1, 'Kandungan', '2020-01-03 22:17:46', 0, 0),
(27, 2, 34, 1, 'Kandungan', '2020-01-03 23:23:50', 0, 0),
(28, 2, 29, 1, 'Kandungan', '2020-01-03 23:23:53', 0, 0),
(29, 2, 38, 1, 'Kandungan', '2020-01-04 13:52:24', 0, 0),
(30, 2, 39, 1, 'Kandungan', '2020-01-04 14:01:02', 0, 0),
(31, 2, 40, 1, 'Kandungan', '2020-01-04 14:41:18', 0, 0),
(32, 2, 41, 1, 'Kandungan', '2020-01-04 15:15:16', 0, 0),
(33, 7, 3, 2, 'Kandungan 1', '2020-01-14 11:21:35', 0, 0),
(34, 7, 56, 2, 'Kandungan 1', '2020-01-14 11:21:39', 0, 0),
(35, 9, 5, 3, 'obgyn', '2020-01-26 16:49:19', 0, 1),
(36, 9, 3, 3, 'obgyn', '2020-01-26 16:49:45', 0, 1),
(37, 9, 5, 3, 'obgyn', '2020-01-26 17:05:18', 0, 1),
(38, 9, 7, 3, 'obgyn', '2020-01-26 17:07:59', 0, 1),
(39, 9, 3, 3, 'obgyn', '2020-01-27 12:59:10', 0, 1),
(40, 9, 8, 3, 'obgyn', '2020-01-27 13:05:28', 0, 1),
(41, 9, 59, 3, 'obgyn', '2020-01-28 10:01:53', 0, 1),
(42, 9, 5, 3, 'obgyn', '2020-01-28 10:02:23', 0, 1),
(43, 9, 59, 3, 'obgyn', '2020-01-28 10:04:11', 0, 1),
(44, 9, 5, 3, 'obgyn', '2020-01-28 10:10:37', 0, 1),
(45, 9, 59, 3, 'obgyn', '2020-01-28 10:13:42', 0, 1),
(46, 9, 3, 3, 'obgyn', '2020-01-28 10:24:54', 0, 1),
(47, 9, 5, 3, 'obgyn', '2020-01-28 10:34:07', 0, 1),
(48, 9, 59, 3, 'obgyn', '2020-01-28 11:26:58', 0, 1),
(49, 7, 62, 3, 'Kandungan 1', '2020-01-30 10:46:08', 0, 0),
(50, 7, 61, 3, 'Kandungan 1', '2020-01-30 10:46:44', 0, 0),
(51, 7, 63, 3, 'Kandungan 1', '2020-01-30 10:51:10', 0, 0),
(52, 7, 59, 3, 'Kandungan 1', '2020-01-30 10:51:21', 0, 0),
(53, 7, 59, 3, 'Kandungan 1', '2020-01-30 10:59:16', 0, 0),
(54, 7, 61, 3, 'Kandungan 1', '2020-01-30 10:59:26', 0, 0),
(55, 7, 63, 3, 'Kandungan 1', '2020-01-30 10:59:58', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `histori_data_scan`
--

CREATE TABLE `histori_data_scan` (
  `histori_data_scan_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL,
  `category_poli_id` int(11) NOT NULL,
  `alasan_kunjungan` longtext NOT NULL,
  `keluhan_utama` longtext NOT NULL,
  `riwayat_medis` longtext NOT NULL,
  `keterangan_obat` longtext NOT NULL,
  `keterangan_lain` longtext NOT NULL,
  `nomor_antri` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_data_scan`
--

INSERT INTO `histori_data_scan` (`histori_data_scan_id`, `pasien_id`, `dokter_id`, `klinik_id`, `category_poli_id`, `alasan_kunjungan`, `keluhan_utama`, `riwayat_medis`, `keterangan_obat`, `keterangan_lain`, `nomor_antri`, `biaya`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 3, 2, 1, 1, '', '', '', '', '', 1, 150000, '2019-12-27 17:20:08', NULL, 1),
(2, 4, 2, 1, 1, '', '', '', '', '', 2, 150000, '2019-12-27 17:24:46', NULL, 1),
(3, 5, 2, 1, 1, '', '', '', '', '', 3, 150000, '2019-12-27 17:33:48', NULL, 1),
(4, 6, 2, 1, 1, '', '', '', '', '', 4, 150000, '2019-12-27 18:16:24', NULL, 1),
(5, 3, 2, 1, 21, '', '', '', '', '', 1, 0, '2019-12-28 19:22:27', NULL, 1),
(6, 9, 2, 1, 21, '', '', '', '', '', 1, 0, '2019-12-30 17:40:56', NULL, 1),
(7, 4, 2, 1, 21, '', '', '', '', '', 2, 0, '2019-12-30 17:51:34', NULL, 1),
(8, 3, 3, 1, 21, '', '', '', '', '', 1, 0, '2020-01-02 19:37:40', NULL, 0),
(9, 7, 3, 1, 21, '', '', '', '', '', 2, 0, '2020-01-02 19:59:34', NULL, 0),
(10, 13, 3, 1, 21, '', '', '', '', '', 3, 0, '2020-01-02 20:10:22', NULL, 0),
(11, 15, 3, 1, 21, '', '', '', '', '', 4, 0, '2020-01-02 20:19:36', NULL, 0),
(12, 16, 3, 1, 21, '', '', '', '', '', 5, 0, '2020-01-02 20:20:00', NULL, 0),
(13, 18, 3, 1, 21, '', '', '', '', '', 6, 0, '2020-01-02 20:37:48', NULL, 0),
(14, 11, 3, 1, 21, '', '', '', '', '', 7, 0, '2020-01-02 21:19:05', NULL, 0),
(15, 17, 3, 1, 21, '', '', '', '', '', 8, 0, '2020-01-02 21:41:42', NULL, 0),
(16, 3, 2, 1, 21, '', '', '', '', '', 1, 0, '2020-01-03 15:13:46', NULL, 0),
(17, 3, 3, 1, 21, '', '', '', '', '', 1, 0, '2020-01-03 17:38:18', NULL, 0),
(18, 3, 3, 1, 21, '', '', '', '', '', 2, 0, '2020-01-03 18:01:21', NULL, 0),
(19, 24, 2, 1, 21, '', '', '', '', '', 2, 0, '2020-01-03 19:44:54', NULL, 0),
(20, 23, 2, 1, 21, '', '', '', '', '', 3, 0, '2020-01-03 20:05:54', NULL, 0),
(21, 27, 2, 1, 21, '', '', '', '', '', 4, 0, '2020-01-03 20:54:46', NULL, 0),
(22, 29, 2, 1, 21, '', '', '', '', '', 5, 0, '2020-01-03 21:28:02', NULL, 0),
(23, 29, 2, 1, 21, '', '', '', '', '', 6, 0, '2020-01-03 21:32:42', NULL, 0),
(24, 31, 2, 1, 21, '', '', '', '', '', 7, 0, '2020-01-03 21:52:12', NULL, 0),
(25, 32, 2, 1, 21, '', '', '', '', '', 8, 0, '2020-01-03 22:12:06', NULL, 0),
(26, 29, 2, 1, 21, '', '', '', '', '', 9, 0, '2020-01-03 22:17:46', NULL, 0),
(27, 34, 2, 1, 21, '', '', '', '', '', 10, 0, '2020-01-03 23:23:50', NULL, 0),
(28, 29, 2, 1, 21, '', '', '', '', '', 11, 0, '2020-01-03 23:23:53', NULL, 0),
(29, 38, 2, 1, 21, '', '', '', '', '', 1, 0, '2020-01-04 13:52:24', NULL, 0),
(30, 39, 2, 1, 21, '', '', '', '', '', 2, 0, '2020-01-04 14:01:02', NULL, 0),
(31, 40, 2, 1, 21, '', '', '', '', '', 3, 0, '2020-01-04 14:41:18', NULL, 0),
(32, 41, 2, 1, 21, '', '', '', '', '', 4, 0, '2020-01-04 15:15:16', NULL, 0),
(33, 3, 7, 2, 21, '', '', '', '', '', 1, 0, '2020-01-14 11:21:35', NULL, 0),
(34, 56, 7, 2, 21, '', '', '', '', '', 2, 0, '2020-01-14 11:21:39', NULL, 0),
(35, 5, 9, 3, 21, '', '', '', '', '', 1, 0, '2020-01-26 16:49:19', NULL, 1),
(36, 3, 9, 3, 21, '', '', '', '', '', 2, 0, '2020-01-26 16:49:45', NULL, 1),
(37, 5, 9, 3, 21, '', '', '', '', '', 3, 0, '2020-01-26 17:05:18', NULL, 1),
(38, 7, 9, 3, 21, '', '', '', '', '', 4, 0, '2020-01-26 17:07:59', NULL, 1),
(39, 3, 9, 3, 21, '', '', '', '', '', 1, 0, '2020-01-27 12:59:10', NULL, 1),
(40, 8, 9, 3, 21, 'pemeriksaan kandungan', 'pendarahan', 'op', '', '', 2, 250000, '2020-01-27 13:05:28', '2020-01-27 13:13:22', 1),
(41, 59, 9, 3, 21, '', '', '', '', '', 4, 0, '2020-01-28 10:01:53', NULL, 1),
(42, 5, 9, 3, 21, '', '', '', '', '', 5, 0, '2020-01-28 10:02:23', NULL, 1),
(43, 59, 9, 3, 21, '', '', '', '', '', 6, 0, '2020-01-28 10:04:11', NULL, 1),
(44, 5, 9, 3, 21, '', '', '', '', '', 8, 0, '2020-01-28 10:10:37', NULL, 1),
(45, 59, 9, 3, 21, '', '', '', '', '', 9, 0, '2020-01-28 10:13:42', NULL, 1),
(46, 3, 9, 3, 21, '', '', '', '', '', 10, 0, '2020-01-28 10:24:54', NULL, 1),
(47, 5, 9, 3, 21, '', '', '', '', '', 11, 0, '2020-01-28 10:34:07', NULL, 1),
(48, 59, 9, 3, 21, 'timbul flek', 'mulas', '', 'wwww', '', 12, 250000, '2020-01-28 10:37:46', '2020-01-28 11:29:16', 1),
(49, 62, 7, 3, 21, '', '', '', '', '', 1, 0, '2020-01-30 10:46:08', NULL, 0),
(50, 61, 7, 3, 21, '', '', '', '', '', 3, 0, '2020-01-30 10:46:44', NULL, 0),
(51, 63, 7, 3, 21, '', '', '', '', '', 5, 0, '2020-01-30 10:51:10', NULL, 0),
(52, 59, 7, 3, 21, '', '', '', '', '', 6, 0, '2020-01-30 10:51:21', NULL, 0),
(53, 59, 7, 3, 21, '', '', '', '', '', 8, 0, '2020-01-30 10:59:16', NULL, 0),
(54, 61, 7, 3, 21, '', '', '', '', '', 9, 0, '2020-01-30 10:59:26', NULL, 0),
(55, 63, 7, 3, 21, '', 'mual, muntah', 'maag ', 'inpepsa', '', 10, 0, '2020-01-30 10:59:58', '2020-01-30 11:01:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `jadwal_dokter_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `senin` varchar(30) NOT NULL,
  `selasa` varchar(30) NOT NULL,
  `rabu` varchar(30) NOT NULL,
  `kamis` varchar(30) NOT NULL,
  `jumat` varchar(30) NOT NULL,
  `sabtu` varchar(30) NOT NULL,
  `minggu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`jadwal_dokter_id`, `dokter_id`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`, `sabtu`, `minggu`) VALUES
(1, 1, '', '', '', '', '00.00-24.00', '', ''),
(2, 2, '19.00-24.00', '', '19.00-24.00', '', '19.00-24.00', '11.00-16.00', ''),
(3, 3, '', '20.00-24.00', '', '20.00-24.00', '', '20.00-24.00', ''),
(4, 7, '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', ''),
(5, 8, '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', '18.00 - 21.00', ''),
(6, 9, '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', ''),
(7, 10, '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', '08.00 -12.00', ''),
(8, 11, '08.00-12.00', '08.00-12.00', '08.00-12.00', '08.00-12.00', '08.00-12.00', '08.00-12.00', ''),
(9, 12, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `klinik`
--

CREATE TABLE `klinik` (
  `klinik_id` int(11) NOT NULL,
  `nama_klinik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `biaya` int(11) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `tanggal_expired` datetime DEFAULT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `jam_buka_tutup` varchar(20) NOT NULL,
  `hari_buka_tutup` varchar(20) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klinik`
--

INSERT INTO `klinik` (`klinik_id`, `nama_klinik`, `alamat`, `latitude`, `longitude`, `img_file`, `email`, `phone`, `tanggal_pembayaran`, `biaya`, `paket`, `tanggal_expired`, `status_pembayaran`, `jam_buka_tutup`, `hari_buka_tutup`, `is_deleted`) VALUES
(1, 'Klinik Kartika', 'Jl. Ngagel Jaya Utara 2A-2B', '112.752613', '-7.289285', '1f3d4549d9d9e45aaaebc1fecc35c760.gif', '', '0315042395', '2019-12-27 00:00:00', 500000, '1 Tahun', '2020-12-27 00:00:00', 1, '00.00-24.00', 'senin-minggu', 1),
(2, 'APOTEK & PRAKTEK DOKTER MEDIPLUS', 'Jalan Werkudoro I', '112.708110', '-7.468545', '9d2a829db04987515142d2452e781642.jpg', '', '03199160541', '2020-01-13 00:00:00', 500000, '1 Tahun', '2021-01-13 00:00:00', 1, '00.00-24.00', 'senin-minggu', 1),
(3, 'Green Hospital', 'Jl. Otto Iskandardinata No.390, RT.6/RW.12, Kp. Melayu, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13330', '106.869139', '-6.243898', '8d46bc91139eee9c3f20f5438922d225.jpg', '', '01234', '2020-01-26 00:00:00', 500, '1 Bulan', '2020-02-26 00:00:00', 1, '08,00 - 21.00', 'senin - minggu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_pasien`
--

CREATE TABLE `notifikasi_pasien` (
  `id_notifikasi_pasien` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_asisten` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi_pasien`
--

INSERT INTO `notifikasi_pasien` (`id_notifikasi_pasien`, `title`, `deskripsi`, `id_pasien`, `id_asisten`, `tanggal`) VALUES
(1, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 1 Silahkan Menemui Dokter', 62, 7, '2020-01-30 10:46:08'),
(2, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 3 Silahkan Menemui Dokter', 61, 7, '2020-01-30 10:46:44'),
(3, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 5 Silahkan Menemui Dokter', 63, 7, '2020-01-30 10:51:10'),
(4, 'Notifikasi Pengingat Antrian Mediplus', 'Nomor Antrian 5, Sisa antrian 0 antrian lagi. Silahkan bersiap untuk menemui Dokter', 63, 7, '2020-01-30 10:51:10'),
(5, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 6 Silahkan Menemui Dokter', 59, 7, '2020-01-30 10:51:21'),
(6, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 8 Silahkan Menemui Dokter', 59, 7, '2020-01-30 10:56:43'),
(7, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 8 Silahkan Menemui Dokter', 59, 7, '2020-01-30 10:59:16'),
(8, 'Notifikasi Pengingat Antrian Mediplus', 'Nomor Antrian 8, Sisa antrian 2 antrian lagi. Silahkan bersiap untuk menemui Dokter', 59, 7, '2020-01-30 10:59:16'),
(9, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 9 Silahkan Menemui Dokter', 61, 7, '2020-01-30 10:59:26'),
(10, 'Notifikasi Antrian Mediplus', 'Nomor Antrian 10 Silahkan Menemui Dokter', 63, 7, '2020-01-30 10:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasien_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `fcm_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `pengingat_sisa_antrian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasien_id`, `nama_lengkap`, `phone`, `alamat`, `latitude`, `longitude`, `email`, `tanggal_lahir`, `fcm_id`, `token`, `img_file`, `username`, `password`, `is_deleted`, `pengingat_sisa_antrian`) VALUES
(1, 'bayu', '083831298057', 'jl.wiyung', '106.723597', '-6.149234', 'bayusyafresalizdham@gmail.com', '1999-12-13', 'diU2yO0elmU:APA91bG6E304pN5OwBPFB9oV5DCM-BTH1wMLPPugXHQdwcrzL5VLvNHF6TWm4rlA7O61ySUJyDSqsJcT6r_dhFE93hRZdBphkXh1lBK2sifrWbFZXrMlE1Eg5SGzPVJnFA7-CoDAA5vv', '73e572c52417a2c7ab6b286fb4305709', 'kosong.png', 'bayusi', 'a24b7dceeb4f426aed3857ca8c342057', 0, 3),
(2, 'Riskita Asari A', '085649471820', 'Valencia Terrace CC2/24 Gedangan', '-7.394560', '112.749049', 'thitaqais@gmail.com', '1991-05-28', 'f3sImFF5QWo:APA91bHTyoVTz0uPklQhCxDsj8gJ8Rr3dKS8MuDNlmGUN9WZM9rVn3HXIb0Rk90BPB6BngplwIlr5xNihMxPKDbD4yY7jMLAoj_bmJrKp0bzCU_bHYUbfxCD9SWLO58PlfdGSJiurool', 'f792dbbd806d2fbc851474f90d1a46e2', 'kosong.png', 'thitariskita', '7aecaa28143ec98c49aec7f36f3624fe', 0, 0),
(3, 'Amala', '0812345678123', 'jalan dukuh kupang no 12', '112.710612', '-7.468310', 'amala@gmail.com ', '1985-09-24', 'dnAzL8EU0gk:APA91bHZKQERYs549097L0YC5RRhrOCU13cr9HR3RtOxRthYkejSxfIT1uqgD9kgsKgyitKRfA7H6s6F0PYs_7Hn0lP015VJHNm3_zqFKe7erDRpqp3m6twK_atoRDmNEW8KXMwnd_du', '72534d62ecf730edca31fce46771468b', 'kosong.png', 'amala', 'c92c197edffcc737b5181b6e3a8095ad', 0, 3),
(4, 'dodewira', '081558558595', 'jl. bali', '112.754504', '-7.285641', 'wira@mail.com', '1998-04-30', 'eIxjhkPmqF0:APA91bE0YDel1fnJeV-5QK1bNFGUpl2k1MJ2SbtRRg-K1K_wuwoNKRf8ZjCKq6uSXjeUduKHYtOZZ_fIgGe_eduvGTIfQeChPasg3Tdcav8mVWJS4M0djLx5-mDC350ZKDFqAHFWWW77', '88e0d0f5c95f7f8fa604a38278bdeb2f', 'kosong.png', 'wirayudadewa', '064756a2f9a64e2fb158817356290d20', 0, 0),
(5, 'teguh', '082143993109', 'jalan. petemon 3 surabaya', '112.769624', '-7.274235', 'teguhsimo10@gmail.com', '1989-04-10', 'eAahfDb0Dn8:APA91bF8KPzEhNgzPzhdxfHthyaq4StnLd80DTa7dmNFYcS6mOAGHVzEGdJoGbj1rzVoKZumWVeEFeKV5Rl7h5ycrK2lPFPQij86qmonwY0rnNWgujQtPDauQwdPZZxHNI-ogSmUV-ky', '8c844ab9324104eb66358c709b1626bc', 'kosong.png', 'teguh', '80cc3b9cfac521f047e88a087157a2c6', 0, 2),
(6, 'evrinka hikaristiana maulidia', '081358955583', 'perum. gunungsari indah blok bb/64b', '112.761090', '-7.285191', 'evrinkahm@gmail.com', '1999-06-27', 'ekJB96q02lI:APA91bFlAQTS3uazbDX_pX3gFQOtEPvlt5sftssxA6eLiPhsM1BrjbbooCvV8KitvqWxb5yEf5_XZgeU8vC2z564fF4o6gWbSBfNjxlwZbnIuifZbUmnjECCHgN77WG8nRB7Pn6CE9GF', '348d1220d58ab03127d79e80cfdb6cc0', 'kosong.png', 'evrinka', '2ca771b1c60ee4e88c60448c447b4091', 0, 0),
(7, 'arik arianto', '085236728860', 'jl. bungaran 3 no. 171 surabaya', '112.670693', '-7.259189', 'ariantoarik243@gmail.com', '1981-04-04', 'd3eQIq6gVJc:APA91bGEGW0Elxm5jIScUP9hD7Jz1PJq6eTpe6GsEelcq5JxhFOQlWyKhlroEQ1Gq9Gqgrl-XDQfqX-i9H3c1FqxAAbz2-rUukDUWNIoM6ipZq08SWFV0US0ts1C8ma1vdZ20Fk7oI1S', '5d59cca74b6e301c3f486017e5ca5d7b', 'kosong.png', 'arik arianto', '92c80ad96930d25c430fc358155b7ebe', 0, 0),
(8, 'Titik Widayati', '087854849292', 'Jl. Buntaran III no 171', '112.670697', '-7.259191', 'cupu2souvenir@gmail.com', '1980-06-28', 'fNNroceXKHc:APA91bGg3hmUgjNsyK-Vre_ZV5ic9vNIMsFAVGL4Fne6jAjn5EXkBraI8pJT0juqanqo7X8rQMHvCLm-ceijUE10lx7PuA1Bu9FPmQXKx0LO0n-sM62M5yzYp7n3ILawcu1NuaLokxSP', '96f4b8f4e31db4fa6a132aa572c85a3e', 'kosong.png', 'aistha', 'bf12da62e4a787f89913c01afd419ad0', 0, 0),
(9, 'Yuyun Zuniawati', '081332500508', 'Manukan subur gang 4 no 24', '112.752704', '-7.289286', 'yzuniawati@gmail.com', '1981-07-11', 'dCtLU3VHLaA:APA91bFzJLwAlQ2VfCHsRsFCAvUBkyaZZGX5zBRIv8xu8PJtg-YPtjIh2veMVl6dm0BwpQU_g0jd7c6Bj-DkRoA6DnSWmpcDgxWb-Izyxlwl3HEer9KHdPzJ6uA_3NrWSpKhVp7AoQLf', '0dc5861e55f61bbd25de671a53141e91', 'kosong.png', 'yuyun', '7d29709db0e56c3bdb78ae11366b83ba', 0, 0),
(10, 'klinik utama rawat inap kartika', '082177791566', 'ngagel jaya utara no 2 a 2 b', '112.752632', '-7.289343', 'rsiakartika@gmail.com', '2015-01-03', 'cguxHDqoIE8:APA91bFHdpVy7GdbiTR9tceOmlPgGewMxxRtCRmfvl-B24GEU8eieEezBaLHMoK8OuqHgxdwX7GypjoDERy3mxptE0VviDP-snZ4Ud0iXapAhbwzsu2JvsKmuMbOb_R9hulXs-q1a7OV', 'fcb41a0921781a20e6c5fa2a294c68da', 'kosong.png', 'kartika', 'a73c3bb3f7574af304a7ebc37692c9bd', 0, 0),
(11, 'I Dewa Gede Hari Wisana', '08123590976', 'Pakis Tirtosari 14 No.2-4 ', '112.741203', '-7.264376', 'hariwisana88@gmail.com', '0000-00-00', 'd8pCu6wn86Q:APA91bGg3Cx5vrWz1B8pdqTyYD8Yym2pDnU-imDk_sI4khYGthGcM7_YWTwN6q33qpEAJvMfdylyUYCz5r0DRbXARWhoQPFmTPNW96AXNoy2Rizm6OXLZrAx6I-H_-QGBlx1pbBwrh0z', 'd03eed4fcfec027de04c71a236f7818a', 'kosong.png', 'Dewa G', 'db7552da809ab28b28ee5aeb879f0541', 0, 0),
(12, 'dodex', '081558558555', 'dodex', '112.761291', '-7.285181', 'dodex@gmail.com', '1998-01-02', 'fHXMKXIXrtM:APA91bE4iR77tYk4VdqsYNq9gZ9bnMSA3PYLC1hqJwzbVHMBm2XRzRNHOIJTWdOmvxvuX0v8cW_Qiimf0VQ5Mlpnn5NHtCxoohqrE7QkWYHgiD8dhhFrJkEPoFlgt0BjsUwkqlZWoWnN', '63b2c68de4193e71da25b8cff043894d', 'kosong.png', 'dodexwira', 'e8c1c3de147298d82c28472616deac2b', 0, 0),
(13, 'adminmediplus1', '12345678', 'kantor mediplus', '112.752623', '-7.289104', 'adminmediplus1@gmail.com', '2020-01-02', 'cOxYhFG66pY:APA91bEFAoYLWOIONj0uh8Fbr0zx0b9B1mfDKrqfeDoL2-aqr6Am737Tu5vRmPadAfvStnbbiEly6kK4DclXfGEQCBMZoasRcs7qwJRu-Ac9p7zmPP0UbQLBHolsxbxqVr-xIs0EPLRW', '599afc540e1f7f42beaab2bdc45382d1', 'kosong.png', 'adminmediplus1', '63580943c895245e96a49699415a70ea', 0, 0),
(14, 'sanna ayu rachmayanti', '081370317303', 'jl.rungkut lor 8 no.27', '0.000000', '0.000000', 'sanna.ayu@gmail.com', '1991-08-27', '', '8d8cb2c171d09d6ecc739c9dce85952a', 'kosong.png', 'sannaayy', 'd1b2bd8171937165bc0cf06425041d10', 0, 0),
(15, 'Pratnya Paramitha Oktaviana', '085716722107', 'Green Lake D1-20 Wonorejo Rungkut Surabaya', '112.808308', '-7.303550', 'paramitha.oktaviana@gmail.com', '1990-10-16', 'eVsR1rCQ7yM:APA91bGGu5-ifRcTtAwQX4boZ9BwDIa0C_K04gszyhVteStkvNtVru-7KLkpZ5cJE7niU5Ja76N06M9KWqybdoXpDz68ndRScwhx485YW46R2eu2ctZ4_TOp4xUa9oiGCD39Wt7bdMOm', '9aeb60662e97f1134929e1ccdb1d8dc0', 'kosong.png', 'paramitha16', 'ae82d836591f1c5694c64383b830468b', 0, 0),
(16, 'sanna ayu', '081230008994', 'jl.rungkut lor 8 no.27', '112.752651', '-7.289122', 'sannaayu@gmail.com', '1991-08-27', 'fIvT_3ISb4A:APA91bEGHzLHQrs_xmTMVUKgwX-pZ_mrrYBX8PCakps5_7BS4FNw-nYEkT_4GRdNvzoOvYF6WrN5kDdqW_W1qjKI9qZgXoCXrSqldmwCdMsgxv6Vy1_gdF_ZeY7nv8blXBT6HxsWwvkJ', 'a071938a8487d7b2e6d1c38ebedacc03', 'kosong.png', 'sanna', 'd6c9c34bc57f442f6284e7c8579f8494', 0, 0),
(17, 'Dewi Wilyawati', '081331276194', 'Pakis Tirtosari 6A No.41', '112.722931', '-7.289092', 'hariwisana88@gmail.com', '0000-00-00', 'cNK6SLlY7d4:APA91bGxiIO34EW4SjmfrKlWDsEHN3rocxGwi6_lceVxrlENOnobfUp58QTzTDjxVqsdtuX86LHBtSnt8ZeHv8zKPIV9FmbeDnxq-6ndriJBHOVifWrgP7Lxv7FQJkrdpoHNWkGN4SLC', '2f0522a52b9c361cfd0422758364a55e', 'kosong.png', 'Dewi Wil', 'db7552da809ab28b28ee5aeb879f0541', 0, 0),
(18, 'Ulfia Hazna Safira', '085607209204', 'Rungkut Asri Utara RL3M Gg XVIII no 13 Surabaya', '112.777036', '-7.323636', 'ulfia_hazna@yahoo.co.id', '1995-01-08', 'dx79cnXHpgA:APA91bFtB6cY16gqw4kxlm7JmPhdBPf7RotUDeZexp7p55BqmNdTt-m8x0OFFeE_023J3NiSX1YfGYSKBRwkjRmsQq-Dc5PLqzhBt_CShJ1_rY4RjcCqH6vz-34OpDb-Uw3tEUr8XaUG', '5044cb5624a452afeef2d2e83aa3602e', 'kosong.png', 'Ulfia_Hazna', '77530f1e94a4c59fb31a44765bd39c72', 0, 0),
(19, 'Anggita Setyo Rahmawati', '085655220790', 'Setro Tengah no. 53 Surabaya', '112.760285', '-7.244192', 'ghitanggita@gmail.com', '1994-08-05', 'c3jOTs0qc5Q:APA91bHLd4ykXKuy5VgYizKS-hEdqie-lIba-5oupuKLS9SlB1Fj748EYJeb_n9V9nNAUt8oK7bFlLFI7pcHTIitzBzC7FRtr05TPv2f4HRvFLVmrQDLc6VGv6HOaQ92aO0HFkK7t8Ak', '26eee8225e133a39750a477363bf3469', 'kosong.png', 'anggita02', '484a4d3ecf8dc2653874ca292f799b6c', 0, 0),
(20, 'ARDHANI SETYANINGSIH', '085850490154', 'JL. KALIBOKOR KENCANA 2 NO 48', '112.747736', '-7.289379', 'ardhanisetyaningsih63@gmail.com', '1993-06-21', 'c5cf_RF_ThQ:APA91bFwnM3VXygGwzXQg4Ipwozx7IUuccThLZ46iIi_Hp1BOTM_fkfFWDEOHYxOFl6LwhdDrqzJQ_4p0IrgdoglpXVmZ9Bt9xHlgSwLOMwfgQB8HrL7vPzfUDz8RW9kr6akP6kCXws4', '2dd2d1432f549a50da08aa41b28b4788', 'kosong.png', 'ARDHANI SETYANINGSIH', '3afbd128bbcecb6578140ec879670c20', 0, 0),
(21, 'zuni Rahmawati', '081230228383', 'Wonokusumo kidul  no 44 Surabaya', '112.752003', '-7.226319', 'zunira_mz@yahoo.con', '1984-06-03', 'd0iboIa4bSQ:APA91bHe8yDgNOxJrpSMpVlDeRmyRS8OH9blVPOYkEMR_336oebw4L9Um0V9EIwVaph0fPwgRoB9YRqRs3ieWSBJC2c3UKRsaqycGl_TT0vXVPjdAwR3mdEe6N_qeKtTAjCu7eiluRM7', '07342af3e2fb725845a55f1abacc9b49', 'kosong.png', 'zunira', '5adb9d1762c65abe0ded38d7aa5c4a7a', 0, 0),
(22, 'Fitry Noer Laela', '082233371860', 'Jl. Tanah Merah Indah No. 51, Rt.030 Rw.004, Tanah Kali Kedinding, Kenjeran, Surabaya', '112.747238', '-7.242605', 'fitrywijaya17@gmail.com', '1995-09-15', 'epFjDkVmdI0:APA91bFGLtCqoAqmFn-P43_3HsGOiGxt8lcEhnp4oVIb_89iRltE8C4NZC4C71EMIwGbbDQg_wXaJQlyLf7qSNLwZ3TAvZF2oi5x-Glad8dsM-vS_iVvlTxkjFk3pXgWOYkEreZBvtRE', 'f581eb2e7e8a62fc5e430c120ee02c7f', 'c93265d7b1b901192a5f630073a96a60.png', 'fitrynl', 'aee0133ddaff525bdf120d9a1b414afa', 0, 0),
(23, 'nurul iftitah hayati', '081234567510', 'jl.tumapel 93 surabaya', '112.752935', '-7.312414', 'dhita_alamuda@yahoo.com', '1985-10-11', 'ekASNke29PU:APA91bEdhkLnkGFIymzvz4SKbYye5MeU3Q-8_TDccYoVMr-CI0n-R5jn6pS-HNdpGiS2iq0FaS4BZgw_2YnJYhmk-bRPO7ccZ0mBWTczxI2OiYw5HM9k_zHRlLj29BM-U2UN5ngDftTi', 'a534ee1daf63ae661f487fb26c172bf2', 'kosong.png', 'dhita', '080745e2aff6be6e0546948d6f6c9a87', 0, 0),
(24, 'indah sugiarti', '082229453966', 'jln dupak bandarejo gang 2 no 01', '112.740755', '-7.258888', '', '1996-01-30', 'daKAwa2GEeM:APA91bHiMK8tMmleM7srM_e-YvSxkDsFvWVgVdZdQHOQFhib7ac8zE5bworY75WAs4mnFPJZ6wqSlXv8ijExUj1p8a8ezaaim6emPDQOjVQggK9ytlyHVn82zig_p1Ps2pi5QF4mAVa5', 'efd41c291f62b52e66e0cdaee9146f6e', 'kosong.png', 'indah', 'cad3edf8f0fee9174da7fabc4f5e07e4', 0, 0),
(25, 'Miracle ', '081330163743', 'Jl. Pucang ', '110.371763', '-7.768513', 'zavierdixon@gmail.com', '1998-08-25', 'cwrjD8r7BmU:APA91bHVAJpJZbV6G7kLqAuZU9PObiGLHe1CgGqUk-vITmRdfg67G1TzYrruGXW6AnDQOBXd1X3TPl6I4Ji-Alo_JX9yWvP0xmQbr7N47dcT-08xoWfd_qqnx5ShdcOVyXUUzGQ1bacp', '22888287e0ec6e81e71dcaa1afa0e749', 'kosong.png', 'Miracle', '79e94f7e7f4cd890fbaa90582fba24e1', 0, 2),
(26, 'dewi sulaidah', '085648749006', 'babatan 2A no 6 wiyung', '0.000000', '0.000000', 'dewi.jaiko86@gmail.com', '1986-07-18', 'cQoXt9EMsUI:APA91bGjmvTTXLgYswl7gJX3xyP4q26sLtWtvHPa18jv_NiK7kKvSjhj3s5i9FPiju5_NYqmiOyoLceHe_Ulp2FHRs9Va_jXvN62S6Yuz0yPHt2bkx8cWSB8-ENvVkHWOjUlbToAbCEZ', '32373bb85867934b97031c207fd22e02', 'kosong.png', 'dewi sulaidah', '80851c3e143b3bd8c43bf36dd01f9123', 0, 0),
(27, 'Yungke Trisnawati', '087853102494', 'Bratang Gede 6C no. 24', '112.764612', '-7.288028', 'tyungke@yahoo.com', '1981-01-13', 'dcnwfgnnCt0:APA91bGLGYAq_13bQdKAY53If_NYT7dAaI_ss5l6YXN6QYSi1MbZwfN-oKwEz-eDfPivKUAsnwZnoNAmcy1mAa2L8u0d79_5qx7IKd34beJ858beQT5crPScqwEmyzF3sI3MdqIQp6vh', '0c6f92b5dfbd2a55327866ce7cfe505d', 'kosong.png', 'tyungke', 'f5358e705d12466c7f808adf2d1f0c23', 0, 0),
(28, 'tiara ayu anggraini', '085733131828', 'driyorejo', '112.636812', '-7.337512', 'tiara. anggraini@gmail.com', '1991-04-27', 'emUYyp5oCRE:APA91bGR-ED_AHNz0Fk8eKz-TbYvZ1jNm0bBAmjKQP8-3OdChKrRO3ol4CHsGksG8Q_HHn0a24I37LXWynlyGQTGjpHB5pkUxon22VzG6LUj3bcX9oSZ7FF8_CHX7nF7ve4LZU0dSO9P', '5adf8e3e68d5cbb0d00eee008c976c40', 'kosong.png', 'tiaraayu', '5f4afb5ab51a13a7569244dee0a55308', 0, 0),
(29, 'novie elok setiawati', '089677731420', 'manukan indah 19h/8', '0.000000', '0.000000', 'novie.elok@gmail.com', '1992-11-22', 'eHSNSFZ9t0Q:APA91bG0GrdLNCGWHpu-VvPqV6W47_QApLHETYoM1zCNmqPsIPpp68JYVDdHB6TI3TMheqOstZAzuo2RU75wnVq37xopxMFkKBGTmg3yEA_aA6rNBqY6-F7beqJF7DPzz_0QOW-lX7CZ', '0de2d9d87b0fd86843d1998f6590cdcc', 'kosong.png', 'novieelok', '747759e52fe89d05328c25aea5884868', 0, 3),
(30, 'Yuli Hernawati', '085735777051', 'Jl. Raya Dukuh Kupang no. 39A', '112.748969', '-7.278610', 'yuli.hernawati9@gmail.com', '1987-07-09', 'cPWb4awvlPQ:APA91bFpHFISaw33C7c50iiZsxQ-0A6VWlzjirCfEfjIaXVYSRu9PH9qCuxW1HF7sAl0z16Bcx3cVshEactCKTwBa7uR_Aphb5s67SUfK8xN0SgnUlhVmeE1uxeCUMI2J4XfkxaORoSt', '73dcb206f9e318221e956d535351bbe6', 'kosong.png', 'Yuli Hernawati', '46a0e65b289471c0c7b63e2137fd366e', 0, 0),
(31, 'veronica ratna widjaja', '082230026622', 'lebak rejo utara 2 no. 37', '112.777029', '-7.251577', 'veronicaratnawidjaja@gmail.com', '1978-03-01', 'cHD6qeXAmDc:APA91bEOhOCM0jI392_YFT9GnknKDAQPBSR-tdN1WZUjpV7ZLq5stvv5nTHXwAGTUA5QAlcNEZRTTDdL56xbelngURDz1HnHttBoCBvigaODKY_7J_5c6-6VS4fIpVBlko4x_jPA5q5D', 'ff0287636e058f6b30d949da5712e100', 'kosong.png', 'veronica78', '075a80e882e046ab75f170e259953253', 0, 0),
(32, 'yanna firda', '082233866566', 'pondok nirwana VI B-14', '112.778537', '-7.319200', 'yannafirda93@gmail.com', '1993-01-25', 'cprLwdznyPU:APA91bEv9blY2gi5OITXa-MvIwifQDYSy45e1XIGmZZt_5lXoJmaVwZu1VB-gq7EYyrUFgLBtXXQyU2WHLUE5wYLv7DZousm5BRL7KnE_-N3oDcGnZnBgec9xbZ_hVLSEOehLWQnDb8i', 'b39b2cf85a9acff97f3c4c722239ce03', 'kosong.png', 'yanna', 'd5de17757bd69e9718e580db7ff66e3d', 0, 0),
(33, 'erisca putri', '083856321406', 'Bratang gede 5 nomer 37a', '0.000000', '0.000000', 'erisca10putri@gmail.com', '1982-01-10', '', 'f443d87d28b7f0c4eb80a4c441f0a440', 'kosong.png', 'erisca', '900faf922b7f62f348cb783e5a5c1ec9', 0, 0),
(34, 'Syafrida Alvi Nabila', '085299655576', 'Mojo Klanggru Lor no. 65 A Surabaya', '112.758798', '-7.264713', 'syalvina08@gmail.com', '1996-10-08', 'fAlJEZIEH5I:APA91bFqhWIoiPgXfAR6XEbkG1KHq97EcvOvG0Rtf-ci4E64-PxvhMqu8grU0F_7CPcU-ODBlix7iFrg4Q5K66p-rzjstpfV7Bp1SOiH-gaS_tz6R6XfhdekBmn_5dOUHpanHVhvkdmq', '87ef9e4c9408519abf7746af07503008', 'kosong.png', 'syafridaalvi', '3a6c3d0d600f7aaf30af50518aa8e0e1', 0, 0),
(35, 'Syaifana Fauziyah ', '081216541233', 'Graha Kebonsari Elveka X/34', '112.752531', '-7.289086', 'fauziyahsyaifana@gmail.com', '1993-01-06', 'dpEZ3Mr8zUk:APA91bEgf5UL0ApuTnZhh_ik9pm8EoBrudUfh5Fjk0Xp1eHMB8L0aSuAeeRbnjwKyfrw238bL3bu3WMCvKnnE6z0uNwzzxoVv7T3L6ncJs4Rce4RJ1EQkjVj0mMbPO-r1rk6F64mbhd7', 'd73ddbdd0145fbf71504a832a995ad31', 'kosong.png', 'ipe._', 'dea7e90c6ad6fc475f9e90a799bc6564', 0, 2),
(36, 'Rahma Damayanti', '081334467907', 'Jl.Kedinding Tengah Sekolahan 4 no 35', '112.779510', '-7.226286', 'rahmadamayanti04@gmail.com', '1993-03-05', 'eF7AJvyOVQM:APA91bHmAUBgDGKPRI8JVDR9PuypcgsLG-_4eKA6VZPKv7gF4LvB03kLUq_Acj0VIY8aDS-yPCUcQ8dOHqUEnhTfEKS60QHtjVQHhPW5vqAFobI9CqtNY-jBfQ3NuXA3JqyWv_8jxRQU', '547d59663f0a2890a3c0ffbc1940f286', 'kosong.png', 'Rahma', '96e79218965eb72c92a549dd5a330112', 0, 0),
(37, 'nina agustiningtyas', '087853436013', 'surabaya', '112.752614', '-7.289154', 'ninabpua1011@gmail.com', '1992-08-10', 'fgUJV6M1isQ:APA91bHJ8Z9D8f18AeUj0zcAV71EQDTyYgPZyJBxJin0jRRvVdRA1g8cupYo8RWiSBjOUfpa4JV4atHLA3xFEEJfl1X0joljkmpJ_crssjaA1AoMaBK--pF-Dt0oSpBuUxIruHb2HVRz', '17dbdc643967896c2cc869745f858c6e', 'kosong.png', 'nina', '10beedba772c1e6b0b9f8a7b77a19fd4', 0, 0),
(38, 'Surya Neng Lestari', '085731244923', 'Kalilom Lor Baru III No 35A', '112.770221', '-7.232494', 'suryaneng@gmail.com', '1995-03-02', 'enmWJ9uP5aM:APA91bE4YGxBgaivwFPggmrnQnpysWHz1-MMNnA_5ZWzXT6aniOyPczro5IjWR9WSMNqbLSkW2phOga9hSXKDZYIhFjtQn_GFYKCEogbFY_6Knh55FhiAlLH3tA6zFW1N_dnIKtchgHt', 'd452907aaf7577272d9821cb3bc11e67', 'kosong.png', 'suryanenglestari', '13117ea753a67577958443809fcd96ce', 0, 0),
(39, 'Farida budi indrayati', '082232506619', 'jl hoscokro aminoto 55b', '112.758484', '-7.042516', 'ririnrien31@gmail.com', '1981-10-31', 'cBjH3PBBFiE:APA91bGi99pLbY5XAxJ9-GJrulICyJ1jMfZ_msS-3uCnRAekNHncP_xAg8tCPgYYOvDWGKxZZX8Aoo3Ep99ZwPGDNTCGKuanao0uV1lWsmJ5NcukX3UZJ-Qv7jwVgTdMzRqE2YyVCirH', '7445876879d1d0897f665bfda911a427', 'kosong.png', 'ririn', 'b84a4059d1af6c8b50bb7a28290dbd63', 0, 0),
(40, 'martalia', '081252836780', 'jl libra 87', '112.731387', '-7.332607', 'Akuumartalia@yahoo.com', '1988-03-13', 'ePYAReSVol8:APA91bGytLM-CRtPjFfFgTQpmJda5BZJHg1Xphpwu7U5MwRQ4dbMV4-NeUHfjuBI6O4qvthO2huLfRQbtl_SMNbbof8BMnk22UMnw7gNhZPUGp7hwcRHUUE7R3MK8sKedPbZeGGnUc8A', 'e59e7d67b53f8a21c59960b52d314570', 'kosong.png', 'lialia', '8cf74dd49085e27e05dcdbd61330113f', 0, 0),
(41, 'syahlendra gerry', '082233537927', 'blimbing IV/12', '112.769551', '-7.345244', 'syahlendra.gerry01@gmail.com', '1976-01-11', 'eqkDps9o4L0:APA91bEFfMcrFWZyVrMbH7OvgNbUbxRPkOAUvaEwNX5dwwuARGguO4PgaXaUf6vTgmqcZQvIAamE-NVVFWKSK-iFHfHmsNzQ-VPJ-LXjnLdCzTr2UegvFMflRQrNwF_pD2uyxSA2i8Rp', 'a947bf5bd2b577e515986df523fd1a5f', 'kosong.png', 'gerry', '8dd87e8218567b95dfcda06c86d7aa76', 0, 0),
(42, 'MARISSA ANTASIA', '08113291983', 'griya taman asri blok GA nomer 23', '112.680389', '-7.353167', 'marissaantasia83@gmail.com', '1983-03-19', 'dZjJTqvbOoQ:APA91bHPRyv2ETNJWV3yfza0h--KHo8pQcMTSmqZxrEuE3gLf2P-BBhXDhbqMUlTW-0Mp-xKHwTtcxt8nCnVKXQ5lXGvP_UXS89WddAizCfDo_kjq3duroB8_aHA_iD6K9-2aVleB99x', '115a8a72712d12b447a37bc4e183128a', 'kosong.png', 'marissaicha', 'a4a53cf3aae2969054c172f5f14e861b', 0, 0),
(43, 'Nuril Fadlila', '081216851689', 'Jl. Bungurasih Tengah No.1,RT 01 RW 02, Kec. Waru, Kab. Sidoarjo', '112.719318', '-7.351123', 'nurilfadlila29@gmail.com', '1992-04-29', 'e7q1vsIX2eI:APA91bFttz9aQPLAtwOm7M_vP7E2AghVHIA3LDpTxrGsS3UlGYO24MBJMbQX5IhMMhmShQHmPiNmCaWEv97NPXWuQd-dsF3Y7wqmZAbYXubNxJaABxMfJPfW-7GE0FxnvNleVHvfWaKQ', 'd1bd9e5f719d24a189591ce8ae968d19', 'kosong.png', 'Nuril Fadlila', 'dc8603ef810f7a22d8db64865a827afc', 0, 0),
(44, 'trihapsari ', '081331776076', 'kapas madya 2E no.8', '112.749100', '-7.279628', 'trihapsarisanti@gmail.com', '1990-04-30', 'eVk-UcDb5Wo:APA91bGOCWyaq5ASi9AT5g_6lCeFDAHjVMB4tuUSq9PXJzXrPqoSaHxgFKcGOmiAVooFqgsRkybID6Zn6EdoCl8hHhhAumTctoWC7oVtcHXtQ0dTLop53-SPdCkb7ost_-ggitYQCcuT', 'e9ca7f7bfafe2c0f4c3fad2285817313', 'kosong.png', 'trihapsari', 'de089fc3879bba83260a72b034133b49', 0, 0),
(46, '', '', '', '0.000000', '0.000000', '', '0000-00-00', '', '2e0f426658ec349ec230246182594202', 'kosong.png', '', 'd41d8cd98f00b204e9800998ecf8427e', 1, 0),
(47, '', ' I m l', '', '0.000000', '0.000000', '', '0000-00-00', '', '78a7cc5691a7929ae8b488339f2fed54', 'kosong.png', '! ', 'd41d8cd98f00b204e9800998ecf8427e', 1, 0),
(48, 'Ani Christina ', '081330531203 ', 'Jl. Indrakila 6e Surabaya', '112.758600', '-7.270325', 'anichristina08@gmail.com ', '1982-03-30', 'c_MYEzLLSwA:APA91bHwifzhdb7uo-A5dGw_yfPDHahnTkFpX3IajQd8VvllWU9peVI-63OC-yJXKnRUCEiQnkOiJCVlPTGE6612pW_InrSiTQ1azmsBvJmPo_icPN1_wNHisGhyWc1_ioGz3QbDvEH2', '6b833d0a5168f8b0d443253a3600be19', 'kosong.png', 'AniCh', '73a7d1ecc03d5b0848ca5e6c92e5e775', 0, 0),
(49, 'Puri Rarasati', '08113118895', 'Surabaya Jl simpang darmo permai selatan', '112.684315', '-7.279962', 'purirarasati7@gmail.com', '0000-00-00', 'dQ6nmDBBtwk:APA91bEhQJXT9G84WMZ8PaNPKn5QQpw_Ge4ygRcendV1mOI1IRcTMZGNah_yRXQW3iWdfWQ1Id-xrNZFZ4V6sf-izeBJKlXPPLL6mA0iDvhj8rlsRzA5T6JSJjqgo3uVFV3C21-rvBBq', 'ca5a307d1229fef00ff5df4f88a77f2d', 'kosong.png', 'Puri', '759c1345f213b662c6c0d881c63c4b6f', 0, 0),
(50, 'noviyan angga putranto', '082253008977', 'jl. raya sabiyan, ds. timur sungai kelurahan sabiyan kec. bangkalan, kab. bangkalan', '112.752641', '-7.289089', 'reventfieldtheowner@gmail.com', '1987-11-06', 'dE78ozVY_NU:APA91bE5WzyC1wrcljUT1rmZhCs4BHhyfHMx9XpmwAaGtK5SEScxY13RHmE3Yn8Qzh1CC6BdZF1OZ1J9yW99ZT1Z687ISqiJs1Ff6DMKOC5IAviPpU-R-EhNcf-wqCBrP_dnw6U16f6_', 'fadd5457cc636d42e6a62b1972b86956', 'kosong.png', 'angga putranto', 'b232c310a6c9458e8669feae92e558a0', 0, 0),
(51, 'puspita ayuningtyas', '08123200910', '', '112.770044', '-7.322435', 'puspita.ayuningtyas@gmail.com', '0000-00-00', 'fSf3yVKvVmE:APA91bGYOuVG4d4XeZl9jCZ5LyVyS8o7ZwSll2ecRO3ppy8xFhzipXv-48FZ_lWcM-3edZXnCgqeOBVIpXnuvSG-0X1Q5F_INzTJrYwTlDt4Z8QSaVwITki7u3Cfwew4uaPax3aqfAv9', 'cfa05322639a5794e9932633a5049a1f', 'kosong.png', 'ayoe1812', '983ba83d448d3716d263b800982e875b', 0, 0),
(52, 'Calvien Danny N', '089861704459', 'Graha Sunan Ampel D.38', '0.000000', '0.000000', 'calviendanny@gmail.com', '2004-08-27', '', '2dcc5e275df982af0fbe3d9b8babf2ea', 'kosong.png', 'calvien21', 'e7645d0332239c2f72176495aa993597', 0, 0),
(53, 'Maghfirotika Argha Tantri', '081249679293', 'mojokerto', '112.426275', '-7.583389', 'arghatantri94@gmail.com', '1994-05-24', 'exzYYbor-ZI:APA91bFw2sOraNYJd-QeBb_eJ0Dw9kvXiD0FKGovNsSnAz4oiHzjZ1F5KGp8g_04zt32BCnm3CBAtF7DPnhwy-mPJy0ROwN74yq2hkABTwDNNVH6e26cFClu0wGnZYGF-b_1wkTVT5-X', '6e1bdbb23cc30f4a29e682d095cf2ad0', 'kosong.png', 'Argha tantri', '7d125d6af6d0acf5a4761cd86f744d73', 0, 0),
(54, 'Gisca elsah miranda', '081334159388', 'setro RT 02 RW 01 Menganti gresik', '112.612974', '-7.293086', 'giscamiranda8@gmail.com', '1989-05-30', 'f3ecpvlL22Q:APA91bHsMUTn0b6WCUQ1kFjIUs5ajwXDh1XbZv_zsDB_5KuZ43i8QGpnteYLdVUqWPf2zi-asaDQacGADuzrJwJT3IPC2_wAWlmtWBJuunTdVlKQZZQj8tlSI-agyaRHkrR6bZRDqp9M', '8fed9139dd7f7ca4cb0fcbba4b6df7fd', 'kosong.png', 'Gisca miranda', '50bfb45d07107e91b788bed43ce8fbec', 0, 0),
(55, 'ridwan', '081354844400', 'Amaya townhouse ', '106.828091', '-6.293701', 'drridwanspog@gmail.com ', '1974-08-19', 'fAb_6yOmUz0:APA91bHgg9TkuPIXUvUKietKw90NpZIYM7Dc0KnbrPNgwZUk2ybbG3zv7cyDw3t7APHDtYW8v-baK3mP3WFeZymgyxHddMJiRm1bR-7sT5wt2F1ZYCbLPCg_sRet30nXQ-WDm7iHA3mm', '579ddfdba8414d09c877bbf16fe4aa16', 'kosong.png', 'ridwan', 'b26d49ff9b2bd4b4e0503cb04fe40b80', 0, 0),
(56, 'dwindradi yudhistira', '081217845926', 'banyu urip kidul 1/16', '0.000000', '0.000000', 'dwindradi02@gmail.com', '1988-07-02', 'dldmBux2rSU:APA91bF66Upv5FK5W1xqHiRyJHOG_alBDrLDvAj0G35zV8KMTSlekWkX6v5LTtuXkLWjBIZtCAaC-K7h8JiKBHGfL-3FXBx_oMLS20GhomP9MldASt01Xeh8F1SUcazT61P4e-oXswH4', '4f128f5729ab420dd2f6bfb03b38b2c9', 'kosong.png', 'dwindradi', '306752e1d6a9a8b241e57b6893ec439f', 0, 3),
(57, 'Rifqi Afif Ferdiansyah', '081999930195', 'Desa Mulung Rt 14 Rw 07', '112.653200', '-7.341688', 'rifqiapop1922@gmail.com', '2001-05-22', 'erwhHAeXCuE:APA91bHNe-cf78d1MlbG5iE-XGF4n1rDlKHhzeHrRXXbdEa1WWihRyOfpqJqRuwypUpBExieYxSF9FvrDuOJoejpOxFBgOkNz2ODCpBOLUBaeO2gbsAV1fSXVpFWMPpP-gLzAejB2jOb', '67b0872ac9f264420fb0c8091ea5a2ae', 'kosong.png', 'afif22', 'ca36b60e23f3443cb9a6ed631c6f3fbd', 0, 3),
(58, 'Sonu Kumar Yadav', '8084550695', 'Sonu Kumar Yadav', '76.858371', '30.711738', 'sky808455@gmail.com', '1996-03-02', 'f1tAxnb5s5g:APA91bGk6MO_j1yRZzrluXIR8duM2BOYt68q7Ok-uEUnKcWJb9S-NuycM_RFawQaWtEY5OncG3rr0OUtRJbcEazQRkZbzO6QZS3PFnj5x3_HOwLDZ0s9KwQTn6YRsA6yce4zDVCTxOgZ', 'af0fc4f5a4618cca8eff0402a033d511', 'kosong.png', 'Sonu Kumar Yadav', '43a3c94c8906c140ab21813a8553e8e5', 0, 0),
(59, 'denty sulistyani', '082179011991', 'jln kyai satari rungkut', '106.868703', '-6.244178', 'dentystyani@yahoo.co.id', '1990-12-28', 'fbvlkXdSJas:APA91bGRNIQRbeiTSqV3q7PchdoYf-Zgp0Ej843wzm8P0jNk3SpHUm7pGF8vwE5_jaEcxVkWXrPCdz9O6JGk23JOfb7ynrL6Crlnk1maKlulip4ohkzb39rU-sP9rDqpzidOIHYFYUHO', 'b43e560afad0f59fdcc66953f59e1fa3', 'kosong.png', 'dentysulistyani', '9fb6c512968c2a5fb90de502d3fe0168', 0, 2),
(60, 'cahyo', 'dd', 'bhaskara', '112.801884', '-7.268487', 'c@c.com', '0000-00-00', 'en2IdUqtoAc:APA91bHLwy7OC3E-0N_t_Ro8FVwIK7LVnXI-qSIFOe1B063Ef9M-C5xg08UnbQvh7xVjHY2JcNH6CNJa7PstrybbVrmJBb9fjZsZ1f3MAStvzmEUdAsABGMjC_68GGnooYFmIN0nk3GI', '9bf053a0e63b6be1b0937119cad5b1cb', 'kosong.png', 'cahyo', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 0),
(61, 'Syahla Ikhlasiah Rahmah', '081362599275', 'Jurumudi Baru', '106.869169', '-6.243881', 'syahla@greenmedica.co.id', '1994-07-30', 'e0vmd_un90U:APA91bH28Y5tDgECAiSJgtfSjSv_qiewjfVC9MO3J5XdyFUNnIqF8h5zTo4UCgbejgpmdiWbBqSOCKWjnKuRgdnnY7uV5iIpYudd00uYBOwwws0KVAPI40HfZkCNfadtlsJadsluh77S', '31779bb3d6ed7914a54a49095d0dbbf9', 'kosong.png', 'lalasyahla', '5387406a32498671570d27cc6c58a9f0', 0, 3),
(62, 'anita', '0812345678', 'sidoarjo', '112.710668', '-7.468458', 'anita@gmail.com', '1996-01-30', 'dpPK8beHqwM:APA91bEkqD2ThnEk_ELyaFu6XyB-EdAiwZEDhpM9L7H8olXJN0bHPmNnSwQIvUM2GJR_8ItZpo9_DT_I6p9ua3ni6p-oey9TMbbIyK6kdOswPv6sAGnru71SfZ6aYNv-i-DaB_XM9fqY', '2d4f68789abdfd31b7ceac511c7ec8c3', 'kosong.png', 'anita', 'e10adc3949ba59abbe56e057f20f883e', 0, 6),
(63, 'hery tarigan', '08158728202', 'pamulang', '106.869166', '-6.243885', 'herytarigan@gmail.com', '1975-01-01', 'dKZ8xoHHBx0:APA91bHo_zv59Sk1wpTxDpRePNXSFVjaFGAhulDiQfuSACIpXR4vXblkizMn8-fQuekK7FtiLDshIIT2gyL-eh-VVQf2hoIYTg7LGnTtTFxczyxfshEoFbtTcGdZXzRhvadXw4XKITvF', '4ce6baf4cdde17713e885315ec05d08a', 'kosong.png', 'herytarigan', '9331e57358a735d331dd2e71e0d31d78', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `poli_dokter`
--

CREATE TABLE `poli_dokter` (
  `poli_dokter_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `category_poli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poli_klinik`
--

CREATE TABLE `poli_klinik` (
  `poli_klinik_id` int(11) NOT NULL,
  `category_poli_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli_klinik`
--

INSERT INTO `poli_klinik` (`poli_klinik_id`, `category_poli_id`, `klinik_id`) VALUES
(5, 4, 3),
(6, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `trans_dokter`
--

CREATE TABLE `trans_dokter` (
  `trans_dokter_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `biaya_pembayaran` int(11) NOT NULL,
  `expired` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trans_klinik`
--

CREATE TABLE `trans_klinik` (
  `trans_klinik_id` int(11) NOT NULL,
  `klinik_id` int(11) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `tanggal_expired` datetime DEFAULT NULL,
  `biaya` int(11) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trans_klinik`
--

INSERT INTO `trans_klinik` (`trans_klinik_id`, `klinik_id`, `paket`, `tanggal_pembayaran`, `tanggal_expired`, `biaya`, `status_pembayaran`, `created_at`, `is_deleted`) VALUES
(1, 1, '1 Tahun', '2019-12-27 00:00:00', '2020-12-27 00:00:00', 500000, 1, '2019-12-27 15:45:36', 0),
(4, 2, '1 Tahun', '2020-01-13 00:00:00', '2021-01-13 00:00:00', 500000, 1, '2020-01-13 13:29:37', 0),
(5, 3, '1 Bulan', '2020-01-27 00:00:00', '2020-02-27 00:00:00', 500000, 1, '2020-01-26 16:06:24', 0),
(6, 3, '1 Bulan', '2020-01-26 00:00:00', '2020-02-26 00:00:00', 500, 1, '2020-01-26 16:21:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trans_pasien`
--

CREATE TABLE `trans_pasien` (
  `trans_pasien_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `biaya_pembayaran` int(11) NOT NULL,
  `expired` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`antrian_id`);

--
-- Indexes for table `asisten_dokter`
--
ALTER TABLE `asisten_dokter`
  ADD PRIMARY KEY (`asisten_dokter_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_id`);

--
-- Indexes for table `category_poli`
--
ALTER TABLE `category_poli`
  ADD PRIMARY KEY (`category_poli_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_asisten_dokter`
--
ALTER TABLE `chat_asisten_dokter`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `detail_data_scan`
--
ALTER TABLE `detail_data_scan`
  ADD PRIMARY KEY (`detail_data_scan_id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokter_id`);

--
-- Indexes for table `expired_payment`
--
ALTER TABLE `expired_payment`
  ADD PRIMARY KEY (`expired_payment_id`);

--
-- Indexes for table `hantrian_dokter`
--
ALTER TABLE `hantrian_dokter`
  ADD PRIMARY KEY (`hantrian_dokter_id`);

--
-- Indexes for table `histori_data_scan`
--
ALTER TABLE `histori_data_scan`
  ADD PRIMARY KEY (`histori_data_scan_id`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`jadwal_dokter_id`);

--
-- Indexes for table `klinik`
--
ALTER TABLE `klinik`
  ADD PRIMARY KEY (`klinik_id`);

--
-- Indexes for table `notifikasi_pasien`
--
ALTER TABLE `notifikasi_pasien`
  ADD PRIMARY KEY (`id_notifikasi_pasien`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indexes for table `poli_dokter`
--
ALTER TABLE `poli_dokter`
  ADD PRIMARY KEY (`poli_dokter_id`);

--
-- Indexes for table `poli_klinik`
--
ALTER TABLE `poli_klinik`
  ADD PRIMARY KEY (`poli_klinik_id`);

--
-- Indexes for table `trans_dokter`
--
ALTER TABLE `trans_dokter`
  ADD PRIMARY KEY (`trans_dokter_id`);

--
-- Indexes for table `trans_klinik`
--
ALTER TABLE `trans_klinik`
  ADD PRIMARY KEY (`trans_klinik_id`);

--
-- Indexes for table `trans_pasien`
--
ALTER TABLE `trans_pasien`
  ADD PRIMARY KEY (`trans_pasien_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `antrian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `asisten_dokter`
--
ALTER TABLE `asisten_dokter`
  MODIFY `asisten_dokter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `berita_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category_poli`
--
ALTER TABLE `category_poli`
  MODIFY `category_poli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chat_asisten_dokter`
--
ALTER TABLE `chat_asisten_dokter`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_data_scan`
--
ALTER TABLE `detail_data_scan`
  MODIFY `detail_data_scan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `dokter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `expired_payment`
--
ALTER TABLE `expired_payment`
  MODIFY `expired_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hantrian_dokter`
--
ALTER TABLE `hantrian_dokter`
  MODIFY `hantrian_dokter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `histori_data_scan`
--
ALTER TABLE `histori_data_scan`
  MODIFY `histori_data_scan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `jadwal_dokter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `klinik`
--
ALTER TABLE `klinik`
  MODIFY `klinik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifikasi_pasien`
--
ALTER TABLE `notifikasi_pasien`
  MODIFY `id_notifikasi_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `pasien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `poli_dokter`
--
ALTER TABLE `poli_dokter`
  MODIFY `poli_dokter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poli_klinik`
--
ALTER TABLE `poli_klinik`
  MODIFY `poli_klinik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trans_dokter`
--
ALTER TABLE `trans_dokter`
  MODIFY `trans_dokter_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trans_klinik`
--
ALTER TABLE `trans_klinik`
  MODIFY `trans_klinik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trans_pasien`
--
ALTER TABLE `trans_pasien`
  MODIFY `trans_pasien_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
