
-- ===================================================
-- Script SQL : Dashboard Articles + Utilisateurs + Fichiers + Logs
-- ===================================================

-- Supprimer les tables si elles existent déjà (ordre pour respecter les contraintes FK)
DROP TABLE IF EXISTS activity_log;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS users;

-- ===============================================
-- Table : Utilisateurs
-- ===============================================
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'USER' CHECK (role IN ('AdminDash', 'USER')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===============================================
-- Table : Articles
-- ===============================================
CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content TEXT,
    category VARCHAR(50) NOT NULL CHECK (category IN ('module', 'cours', 'note', 'guide')),
    author_id INT REFERENCES users(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===============================================
-- Table : Fichiers attachés aux articles
-- ===============================================
CREATE TABLE files (
    id SERIAL PRIMARY KEY,
    article_id INT REFERENCES articles(id) ON DELETE CASCADE,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===============================================
-- Table : Historique des actions
-- ===============================================
CREATE TABLE activity_log (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    action VARCHAR(100) NOT NULL,
    article_id INT REFERENCES articles(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===============================================
-- Données exemples
-- ===============================================

-- Utilisateurs
INSERT INTO users (username, email, password_hash, role) VALUES
('admin', 'admin@site.com', '$2b$10$HASHADMIN', 'AdminDash'),
('john_doe', 'john@site.com', '$2b$10$HASHUSER', 'USER');

-- Articles
INSERT INTO articles (title, slug, content, category, author_id) VALUES
('Sécurité Web', 'securite-web', 'Introduction à la sécurité web...', 'module', 1),
('Notes Gobuster', 'notes-gobuster', 'Commandes essentielles...', 'note', 1),
('Burp Suite Configuration', 'burp-config', 'Guide complet pour configurer Burp Suite...', 'guide', 1);

-- Fichiers liés aux articles
INSERT INTO files (article_id, filename, filepath) VALUES
(1, 'cours_securite.pdf', '/uploads/cours_securite.pdf'),
(2, 'gobuster_cheatsheet.txt', '/uploads/gobuster_cheatsheet.txt'),
(3, 'burp_guide.pdf', '/uploads/burp_guide.pdf');

-- Logs d’activité
INSERT INTO activity_log (user_id, action, article_id) VALUES
(2, 'view_article', 1),
(2, 'download_file', 2),
(1, 'add_article', 3);
