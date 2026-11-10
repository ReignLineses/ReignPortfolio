SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS reign CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE reign;

DROP TABLE IF EXISTS certificates, projects, experience, profile;

-- ---------- Tables ----------

CREATE TABLE profile (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    socials LONGTEXT NOT NULL,
    identities LONGTEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sortOrder INT NOT NULL,
    `role` VARCHAR(150) NOT NULL,
    place VARCHAR(200) NOT NULL,
    period VARCHAR(100) NOT NULL,
    isCurrent TINYINT(1) NOT NULL DEFAULT 0,
    points LONGTEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    `year` SMALLINT NOT NULL,
    description TEXT NOT NULL,
    gallery LONGTEXT NOT NULL,
    featured TINYINT(1) NOT NULL DEFAULT 1,
    motion ENUM('default', 'zoom') NOT NULL DEFAULT 'zoom'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    issuer VARCHAR(255) NOT NULL,
    issuedOn DATE NOT NULL,
    credentialUrl VARCHAR(500) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- Data ----------

INSERT INTO profile (id, name, email, socials, identities) VALUES
(1, 'Reign', 'linesesreign@gmail.com', '{"Instagram":"https://www.instagram.com/znreign/","Facebook":"https://www.facebook.com/znreign"}', '[{"title":"Graphic & UI/UX Designer","text":"Logos, posters, illustrations, pixel art and interface designs.","tags":["Logos","Illustration","Pixel Art","UI/UX"]},{"title":"Web Developer","text":"Clean, responsive websites built with PHP, HTML, CSS and JavaScript.","tags":["PHP","HTML","CSS","JavaScript"]},{"title":"IT Support & Maintenance","text":"Diagnosing and fixing computers, printers and other office devices.","tags":["Troubleshooting","Repair","Maintenance"]},{"title":"Networking","text":"Setting up and keeping local networks and connections running.","tags":["LAN","Wi-Fi","Cabling"]}]');

INSERT INTO experience (id, sortOrder, `role`, place, period, isCurrent, points) VALUES
(1, 1, 'Operations', 'RV Printing Hub/Alpas Clothing', '2025 - Present', 1, '["Oversee daily operations, from order processing to production and delivery","Manage printing and clothing production, ensuring quality and timely completion of orders."]'),
(2, 2, 'IT Support', 'Barangay Isla, Valenzuela City', '2024 - Present', 1, '["Troubleshoot and repair computers and other devices whenever problems come up.","Keep office equipment working so barangay staff can do their jobs.","Help staff with everyday technical issues."]');
INSERT INTO projects (id, image, title, category, `year`, description, gallery, featured, motion) VALUES
(1, 'project1.png', 'Isla We Ken Do More', 'Graphic Design', 2025, '', '[]', 1, 'zoom'),
(2, 'project2.png', 'Barangay Isla Feeling Pogi 2025', 'Graphic Design', 2025, '', '[]', 1, 'zoom'),
(3, 'project3.png', 'Project LAWA at BINHI', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(4, 'project4.png', 'Congratulations Senator Win Gatchalian', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(5, 'project5.png', 'Patubig ni Kap', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(6, 'project6.png', 'Mr and Ms Isla 2026', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(7, 'project7.png', 'Shoot It', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(8, 'project8.png', 'Photobooth Props', 'Graphic Design', 2026, '', '["project8a.png","project8b.png","project8c.png"]', 1, 'zoom'),
(9, 'project9.png', 'Happy Father''s Day', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(10, 'project10.png', 'Stop Human Trafficking', 'Graphic Design', 2026, '', '["project10a.png","project10b.png"]', 1, 'zoom'),
(11, 'project11.png', 'Ano Tara', 'Logo Design', 2026, '', '[]', 1, 'zoom'),
(12, 'project12.png', 'Item Cards', 'Pixel Art', 2026, '', '["project12a.png","project12b.png","project12c.png","project12d.png","project12e.png","project12f.png","project12g.png","project12h.png","project12i.png","project12j.png","project12k.png","project12l.png","project12m.png","project12o.png","project12p.png","project12q.png","project12r.png"]', 1, 'zoom'),
(13, 'project13.png', 'Karma Cards', 'Pixel Art', 2026, '', '["project13a.png","project13b.png","project13c.png","project13d.png","project13f.png","project13g.png","project13h.png","project13i.png","project13j.png"]', 1, 'zoom'),
(14, 'project14.png', 'Mini Game Cards', 'Pixel Art', 2026, '', '["project14a.png","project14b.png","project14c.png","project14d.png","project14e.png","project14f.png","project14g.png"]', 1, 'zoom'),
(15, 'project15.png', 'Mythical Creature Cards', 'Pixel Art', 2026, '', '["project15a.png","project15b.png","project15c.png","project15d.png","project15e.png","project15f.png","project15g.png","project15h.png","project15i.png","project15j.png","project15k.png","project15l.png"]', 1, 'zoom'),
(16, 'project16.png', 'Ganti Cards', 'Pixel Art', 2026, '', '["project16a.png","project16b.png","project16c.png","project16d.png","project16e.png","project16f.png","project16g.png","project16h.png"]', 1, 'zoom'),
(17, 'project17.png', 'Swerte Cards', 'Pixel Art', 2026, '', '["project17a.png","project17b.png","project17c.png","project17d.png","project17e.png"]', 1, 'zoom'),
(18, 'project18.png', 'Pixel Island', 'Pixel Art', 2026, '', '["project18a.png","project18b.png","project18c.png","project18d.png","project18e.png","project18f.png","project18g.png"]', 1, 'zoom'),
(19, 'project19.png', 'Ano Tara Tile Route', 'Pixel Art', 2026, '', '["project19a.png","project19b.png","project19c.png","project19d.png","project19e.png","project19f.png","project19g.png","project19h.png","project19i.png"]', 1, 'zoom'),
(20, 'project20.png', 'Pixel Island Map', 'Pixel Art', 2026, '', '[]', 1, 'zoom'),
(21, 'project21.png', 'Orientation/Seminar of BADAC Members', 'Graphic Design', 2026, '', '[]', 1, 'zoom'),
(22, 'project22.png', 'DAPC Week 2026', 'Graphic Design', 2026, '', '[]', 1, 'zoom');


INSERT INTO `certificates` (`image`, `title`, `issuer`, `issuedOn`, `credentialUrl`) VALUES
('certificate1.png', 'Exploring Networking with Cisco Packet Tracer', 'Cisco Networking Academy', '2025-08-22', NULL),
('certificate2.png', 'Getting Started with Cisco Packet Tracer', 'Cisco Networking Academy', '2025-08-22', NULL),
('certificate3.png', 'Exploring Internet of Things with Cisco Packet Tracer', 'Cisco Networking Academy', '2025-08-28', NULL),
('certificate4.png', 'Introduction to Packet Tracer Exam', 'Cisco Networking Academy', '2025-08-29', NULL),
('certificate5.png', 'Intro to SQL with Taylor Swift', 'CodeSignal', '2026-02-05', NULL),
('certificate6.png', 'Learning SQL Joins with Taylor Swift', 'CodeSignal', '2026-02-13', NULL),
('certificate7.png', 'Mastering SQL Functions and Clauses with Taylor Swift', 'CodeSignal', '2026-02-19', NULL),
('certificate8.png', 'Advanced Query Techniques and Conditional Logic in SQL', 'CodeSignal', '2026-02-19', NULL),
('certificate9.png', 'Journey into SQL with Taylor Swift', 'CodeSignal', '2026-02-19', NULL),
('certificate10.png', 'Introduction to SQL', 'Simplilearn SkillUp', '2026-02-27', NULL),
('certificate11.png', 'Python Libraries for Data Analysis', 'CodeSignal', '2026-04-05', NULL),
('certificate12.png', 'Descriptive and Inferential Statistics with Python', 'CodeSignal', '2026-04-12', NULL),
('certificate13.png', 'Data Cleaning and Preprocessing Techniques', 'CodeSignal', '2026-04-21', NULL),
('certificate14.png', 'Advanced Preprocessing and Collecting Techniques', 'CodeSignal', '2026-04-25', NULL),
('certificate15.png', 'Hypothesis Testing with Python', 'CodeSignal', '2026-05-02', NULL),
('certificate16.png', 'Reporting and Visualization for Data Analysts', 'CodeSignal', '2026-05-07', NULL),
('certificate17.png', 'Intro to Data Analysis with Python', 'CodeSignal', '2026-05-07', NULL),
('certificate18.png', 'Introduction to Visual Graphic Design', 'TESDA Online Program', '2026-11-04', NULL),
('certificate19.png', 'Developing Designs for a Logo', 'TESDA Online Program', '2026-11-04', NULL),
('certificate20.png', 'Developing Designs for User Interface', 'TESDA Online Program', '2026-11-04', NULL),
('certificate21.png', 'Developing Designs for User Experience', 'TESDA Online Program', '2026-11-05', NULL);
