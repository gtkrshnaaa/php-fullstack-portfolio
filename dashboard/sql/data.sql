-- -- sql/data.sql


-- Hapus tabel jika sudah ada
DROP TABLE IF EXISTS gtkprofileCardHeroTable;

-- Buat tabel gtkprofileCardHeroTable baru dengan gambar dari link internet
CREATE TABLE gtkprofileCardHeroTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cardphoto_blob LONGBLOB NOT NULL, -- Tipe data BLOB untuk menyimpan gambar
    githubrepo TEXT NOT NULL,
    repostar TEXT NOT NULL,
    clientt TEXT NOT NULL
);



-- Hapus tabel jika sudah ada
DROP TABLE IF EXISTS gtkprofileProjectTable;

-- Buat tabel gtkprofileProjectTable baru dengan gambar dari link internet
CREATE TABLE gtkprofileProjectTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_blob LONGBLOB NOT NULL, -- Tipe data BLOB untuk menyimpan gambar
    descript TEXT NOT NULL,
    techstack TEXT NOT NULL,
    projectlink TEXT NOT NULL
);

