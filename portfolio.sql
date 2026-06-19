CREATE TABLE IF NOT EXISTS users (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) UNIQUE NOT NULL,
    user_birth_date DATE,
    user_password VARCHAR(255),
    user_description TEXT,
    user_role VARCHAR(30) DEFAULT 'admin',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    prj_title VARCHAR(100) NOT NULL,
    prj_description TEXT NOT NULL,
    prj_status BOOLEAN DEFAULT TRUE,

    prj_corporative BOOLEAN DEFAULT FALSE,
    prj_thumbnail TEXT DEFAULT '/public/default.jpeg',
    prj_challenge TEXT,
    prj_solution TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS social_links (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    social_name VARCHAR(50) NOT NULL,
    social_url TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS stacks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    icon VARCHAR(100),
    name VARCHAR(50),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contacts (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    phone VARCHAR(20) DEFAULT '49999458559',
    email VARCHAR(100) DEFAULT 'altrevizan.dev@gmail.com',
    github VARCHAR(255) DEFAULT 'https://github.com/AndreLucasTrevizan',
    linkedin VARCHAR(255) DEFAULT 'https://www.linkedin.com/in/andre-lucas-t-1ab366117',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects_results (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    project_id BIGINT NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    description TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS project_stacks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    project_id BIGINT NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    stack_id BIGINT NOT NULL REFERENCES stacks(id) ON DELETE CASCADE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_stacks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    stack_id BIGINT NOT NULL REFERENCES stacks(id) ON DELETE CASCADE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS section_one (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,

    birth_date DATE,
    about TEXT,
    studies TEXT,
    image VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS section_two (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    image VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS section_two_experiences (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    company VARCHAR(100) NOT NULL,
    description TEXT,

    actual_job BOOLEAN DEFAULT FALSE,

    start_date DATE,
    final_date DATE,

    section_id BIGINT REFERENCES section_two(id) ON DELETE CASCADE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS section_three (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    institution VARCHAR(100) NOT NULL,
    course VARCHAR(150),
    description TEXT,

    still_studying BOOLEAN DEFAULT FALSE,

    start_date DATE,
    final_date DATE,

    situation VARCHAR(20),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS section_stacks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    section_id BIGINT NOT NULL REFERENCES section_one(id) ON DELETE CASCADE,
    stack_id BIGINT NOT NULL REFERENCES stacks(id) ON DELETE CASCADE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS testimonials (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    name VARCHAR(130),
    company VARCHAR(130),
    position VARCHAR(100),
    description TEXT
    image TEXT DEFAULT '/public/images/default-user.jpeg',
    approved BOOLEAN DEFAULT FALSE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (
    user_name,
    user_email,
    user_birth_date,
    user_password,
    user_description,
    user_role
)
VALUES (
    'Andre Lucas Trevizan',
    'altrevizan.dev@gmail.com',
    '2000-03-27',
    '$2y$10$uF7Gx7XoOoGONyOQsXDcKu52S0.shMbiraU7XSs2NUoTDJ0pqOaxm',
    'Desenvolvedor Backend com experiência em PHP, Node.js, PostgreSQL e integrações corporativas. Atualmente atuo na Tirol participando da gestão de demandas de tecnologia, desenvolvimento de APIs REST, automação de processos e integração entre sistemas SAP e aplicações corporativas. Possuo experiência com Docker, Linux, SQL Server, Oracle Database, Fastify, APIs REST e arquitetura de integrações.',
    'admin'
);

INSERT INTO users (
    user_name,
    user_email,
    user_birth_date,
    user_password,
    user_description,
    user_role
)
VALUES (
    'Visualizador',
    'portfolioviewer@gmail.com',
    '2000-03-27',
    '$2y$10$L57tGAhYXbEqxhRIHwkzs.U19cKZUh61jad.SjdcJiGbL7QcUmTZm',
    'Usuário de demonstração para acesso ao portfólio.',
    'viewer'
);