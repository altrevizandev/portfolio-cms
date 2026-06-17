--
-- PostgreSQL database dump
--

-- Dumped from database version 16.14
-- Dumped by pg_dump version 17.0

-- Started on 2026-06-16 23:54:42

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 228 (class 1259 OID 41174)
-- Name: contacts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contacts (
    id bigint NOT NULL,
    phone character varying(20) DEFAULT '49999458559'::character varying,
    email character varying(100) DEFAULT 'altrevizan.dev@gmail.com'::character varying,
    github character varying(100) DEFAULT 'https://github.com/AndreLucasTrevizan'::character varying,
    linkedin character varying(100) DEFAULT 'www.linkedin.com/in/andré-lucas-t-1ab366117'::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.contacts OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 41173)
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.contacts ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 226 (class 1259 OID 41156)
-- Name: project_stacks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project_stacks (
    id bigint NOT NULL,
    project_id integer,
    stack_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.project_stacks OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 41155)
-- Name: project_stacks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.project_stacks ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.project_stacks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 218 (class 1259 OID 32953)
-- Name: projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects (
    id bigint NOT NULL,
    prj_title character varying(100) NOT NULL,
    prj_description text NOT NULL,
    prj_status boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    prj_corporative boolean DEFAULT false,
    prj_challenge text,
    prj_solution text,
    prj_thumbnail text DEFAULT '/public/default.jpeg'::text
);


ALTER TABLE public.projects OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 32952)
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.projects ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.projects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 222 (class 1259 OID 41132)
-- Name: projects_results; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects_results (
    id bigint NOT NULL,
    project_id integer,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.projects_results OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 41131)
-- Name: projects_results_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.projects_results ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.projects_results_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 234 (class 1259 OID 49341)
-- Name: section_one; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_one (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    "position" character varying(100) NOT NULL,
    address character varying(100) NOT NULL,
    birth_date date,
    about text,
    studies text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    image character varying(100)
);


ALTER TABLE public.section_one OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 49340)
-- Name: section_one_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.section_one ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.section_one_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 232 (class 1259 OID 49323)
-- Name: section_stacks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_stacks (
    id bigint NOT NULL,
    stack_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    section_id integer
);


ALTER TABLE public.section_stacks OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 49322)
-- Name: section_stacks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.section_stacks ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.section_stacks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 236 (class 1259 OID 49367)
-- Name: section_three; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_three (
    id bigint NOT NULL,
    institution character varying(100) NOT NULL,
    course character varying(150),
    description text,
    still_studying boolean DEFAULT false,
    start_date date,
    final_date date,
    situation character varying(20),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.section_three OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 49366)
-- Name: section_three_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.section_three ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.section_three_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 238 (class 1259 OID 57515)
-- Name: section_two; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_two (
    id bigint NOT NULL,
    image character varying(100),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.section_two OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 57523)
-- Name: section_two_experiences; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.section_two_experiences (
    id bigint NOT NULL,
    company character varying(100) NOT NULL,
    description text,
    actual_job boolean DEFAULT false,
    start_date date,
    final_date date,
    section_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.section_two_experiences OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 57522)
-- Name: section_two_experiences_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.section_two_experiences ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.section_two_experiences_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 237 (class 1259 OID 57514)
-- Name: section_two_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.section_two ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.section_two_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 220 (class 1259 OID 32964)
-- Name: social_links; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.social_links (
    id bigint NOT NULL,
    social_name character varying(50) NOT NULL,
    social_url text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.social_links OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 32963)
-- Name: social_links_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.social_links ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.social_links_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 224 (class 1259 OID 41147)
-- Name: stacks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.stacks (
    id bigint NOT NULL,
    icon character varying(100),
    name character varying(50),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.stacks OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 41146)
-- Name: stacks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.stacks ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.stacks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 230 (class 1259 OID 41186)
-- Name: user_stacks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_stacks (
    id bigint NOT NULL,
    user_id integer,
    stack_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.user_stacks OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 41185)
-- Name: user_stacks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.user_stacks ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.user_stacks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 216 (class 1259 OID 32940)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    user_name character varying(100) NOT NULL,
    user_email character varying(100) NOT NULL,
    user_birth_date date,
    user_password character varying(255),
    user_description text,
    user_role character varying(30) DEFAULT 'admin'::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 32939)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 3552 (class 0 OID 41174)
-- Dependencies: 228
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contacts (id, phone, email, github, linkedin, created_at, updated_at) FROM stdin;
1	49 9 9945-8559	altrevizan.dev@gmail.com	https://github.com/AndreLucasTrevizan	https://www.linkedin.com/in/andré-lucas-t-1ab366117	2026-06-12 23:36:44.469543	2026-06-12 23:36:44.469543
\.


--
-- TOC entry 3550 (class 0 OID 41156)
-- Dependencies: 226
-- Data for Name: project_stacks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project_stacks (id, project_id, stack_id, created_at, updated_at) FROM stdin;
50	12	8	2026-06-11 20:48:18.945687	2026-06-11 20:48:18.945687
51	12	4	2026-06-11 20:48:18.952063	2026-06-11 20:48:18.952063
52	12	7	2026-06-11 20:48:18.954881	2026-06-11 20:48:18.954881
53	12	10	2026-06-11 20:48:18.959101	2026-06-11 20:48:18.959101
54	12	11	2026-06-11 20:48:18.962859	2026-06-11 20:48:18.962859
55	12	9	2026-06-11 20:48:18.966726	2026-06-11 20:48:18.966726
94	13	6	2026-06-12 04:48:34.547884	2026-06-12 04:48:34.547884
95	13	5	2026-06-12 04:48:34.560497	2026-06-12 04:48:34.560497
96	13	1	2026-06-12 04:48:34.56815	2026-06-12 04:48:34.56815
97	13	4	2026-06-12 04:48:34.575462	2026-06-12 04:48:34.575462
98	13	2	2026-06-12 04:48:34.583825	2026-06-12 04:48:34.583825
99	13	3	2026-06-12 04:48:34.591203	2026-06-12 04:48:34.591203
124	11	8	2026-06-12 21:35:10.172999	2026-06-12 21:35:10.172999
125	11	12	2026-06-12 21:35:10.178003	2026-06-12 21:35:10.178003
126	11	4	2026-06-12 21:35:10.181119	2026-06-12 21:35:10.181119
127	11	7	2026-06-12 21:35:10.183223	2026-06-12 21:35:10.183223
128	11	10	2026-06-12 21:35:10.186772	2026-06-12 21:35:10.186772
129	11	11	2026-06-12 21:35:10.189623	2026-06-12 21:35:10.189623
130	11	9	2026-06-12 21:35:10.192784	2026-06-12 21:35:10.192784
131	9	8	2026-06-12 22:12:50.449388	2026-06-12 22:12:50.449388
132	9	12	2026-06-12 22:12:50.457737	2026-06-12 22:12:50.457737
133	9	4	2026-06-12 22:12:50.461188	2026-06-12 22:12:50.461188
134	9	7	2026-06-12 22:12:50.465756	2026-06-12 22:12:50.465756
135	9	11	2026-06-12 22:12:50.468631	2026-06-12 22:12:50.468631
136	9	9	2026-06-12 22:12:50.47231	2026-06-12 22:12:50.47231
143	10	8	2026-06-12 22:13:27.966779	2026-06-12 22:13:27.966779
144	10	12	2026-06-12 22:13:27.973792	2026-06-12 22:13:27.973792
145	10	4	2026-06-12 22:13:27.979706	2026-06-12 22:13:27.979706
146	10	7	2026-06-12 22:13:27.983898	2026-06-12 22:13:27.983898
147	10	11	2026-06-12 22:13:27.987924	2026-06-12 22:13:27.987924
148	10	9	2026-06-12 22:13:27.993174	2026-06-12 22:13:27.993174
\.


--
-- TOC entry 3542 (class 0 OID 32953)
-- Dependencies: 218
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, prj_title, prj_description, prj_status, created_at, updated_at, prj_corporative, prj_challenge, prj_solution, prj_thumbnail) FROM stdin;
9	Desbloqueio de Usuários SAP	Foi desenvolvida uma aplicação web utilizando Next.js e Node.js que consome uma API interna responsável por realizar o desbloqueio diretamente no SAP através de serviços SICF.	t	2026-06-11 18:31:20.109467	2026-06-11 18:31:20.109467	t	O processo de desbloqueio de usuários SAP era realizado manualmente pela equipe de TI, gerando filas de atendimento e tempo de espera para os colaboradores.	Foi desenvolvida uma aplicação web utilizando Next.js e Node.js que consome uma API interna responsável por realizar o desbloqueio diretamente no SAP através de serviços SICF.	/public/images/desbloqueio_de_usuarios_sap.jpeg
12	API Corporativa Tirol	Projetei e desenvolvi uma API centralizada utilizando Node.js, Fastify e PostgreSQL, responsável por concentrar regras de negócio, autenticação, auditoria e comunicação com sistemas corporativos. A arquitetura permitiu desacoplar as aplicações consumidoras, aumentar a reutilização de código e simplificar futuras expansões da plataforma.	t	2026-06-11 20:48:18.937992	2026-06-11 20:48:18.937992	t	As aplicações de desbloqueio de usuários SAP, redefinição de senhas e reset de autenticação multifator possuíam necessidades de integração semelhantes, o que poderia resultar em duplicação de código, aumento da manutenção e inconsistências entre sistemas.	Projetei e desenvolvi uma API centralizada utilizando Node.js, Fastify, SQL Server e Oracle,  responsável por concentrar regras de negócio, autenticação, auditoria e comunicação com sistemas corporativos. A arquitetura permitiu desacoplar as aplicações consumidoras, aumentar a reutilização de código e simplificar futuras expansões da plataforma.\r\n\r\n\r\n\r\nA API é responsável por atender atualmente as aplicações de desbloqueio de usuários SAP, redefinição de senhas SAP e redefinição de autenticação multifator, atuando como camada central de integração corporativa.	/public/images/api_tirol.jpeg
13	Portfólio Pessoal	Desenvolvi uma aplicação web completa utilizando PHP, PostgreSQL, Bootstrap e Docker, implementando autenticação, gerenciamento de usuários, gerenciamento de projetos, upload de imagens, relacionamentos entre entidades e área administrativa. O projeto foi construído aplicando conceitos de orientação a objetos, organização em camadas e boas práticas de desenvolvimento backend.	t	2026-06-11 20:51:34.222131	2026-06-11 20:51:34.222131	f	Criar uma plataforma própria para demonstrar conhecimentos técnicos sem depender de templates prontos ou serviços de terceiros, permitindo total controle sobre funcionalidades e estrutura da aplicação.	Desenvolvi uma aplicação web completa utilizando PHP, PostgreSQL, Bootstrap e Docker, implementando autenticação, gerenciamento de usuários, gerenciamento de projetos, upload de imagens, relacionamentos entre entidades e área administrativa. O projeto foi construído aplicando conceitos de orientação a objetos, organização em camadas e boas práticas de desenvolvimento backend.	/public/images/portfolio.png
11	Reset da Autenticação Multifator (Portal RNC)	Implementei uma aplicação web que automatiza o processo de redefinição do MFA, permitindo que usuários autorizados solicitem a remoção do vínculo anterior de autenticação e realizem um novo cadastro de forma controlada e segura, reduzindo intervenções manuais da equipe de suporte.	t	2026-06-11 20:46:31.730388	2026-06-11 20:46:31.730388	f	Usuários que trocavam de dispositivo ou perdiam acesso ao aplicativo autenticador dependiam da equipe de TI para remover e reconfigurar o segundo fator de autenticação, impactando a produtividade e o tempo de resposta.	Implementei uma aplicação web que automatiza o processo de redefinição do MFA, permitindo que usuários autorizados solicitem a remoção do vínculo anterior de autenticação e realizem um novo cadastro de forma controlada e segura, reduzindo intervenções manuais da equipe de suporte.	/public/images/reset_multifator.jpeg
10	Reset de Senhas de Usuários SAP	Desenvolvi uma aplicação web integrada ao SAP através de serviços SICF, permitindo que usuários autorizados realizem a redefinição de suas próprias senhas mediante validações de segurança. A solução automatizou o processo, reduziu o volume de chamados e aumentou a agilidade no atendimento das demandas internas.	t	2026-06-11 18:55:03.615301	2026-06-11 18:55:03.615301	t	O processo de redefinição de senha era realizado manualmente pela equipe de TI, gerando filas de atendimento, tempo de espera para os usuários e aumento da carga operacional do suporte.	Desenvolvi uma aplicação web integrada ao SAP através de serviços SICF, permitindo que usuários autorizados realizem a redefinição de suas próprias senhas mediante validações de segurança. A solução automatizou o processo, reduziu o volume de chamados e aumentou a agilidade no atendimento das demandas internas.	/public/images/reset_de_senhas_de_usuarios_sap.jpeg
\.


--
-- TOC entry 3546 (class 0 OID 41132)
-- Dependencies: 222
-- Data for Name: projects_results; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects_results (id, project_id, description, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3558 (class 0 OID 49341)
-- Dependencies: 234
-- Data for Name: section_one; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_one (id, name, "position", address, birth_date, about, studies, created_at, updated_at, image) FROM stdin;
4	Andre Lucas Trevizan	Desenvolvedor Full Stack	Treze Tílias, SC	2000-03-27	Minha trajetória na tecnologia começou em 2015, estudando programação no SENAI. Desde então, passei por formações em Informática, Desenvolvimento Web e atualmente curso Engenharia de Software. Ao longo dos anos, construí experiência prática com PHP, Node.js, TypeScript, PostgreSQL, Docker e integrações corporativas, sempre buscando evoluir tecnicamente e transformar conhecimento em soluções reais para empresas e usuários.	Atuo com desenvolvimento Web, APIs e integrações corporativas, construindo soluções que conectam sistemas, automatizam processos e geram valor para o negócio.\r\n\r\nTenho experiência com Node.js, TypeScript, PHP, PostgreSQL, Docker e integrações corporativas, além de atuação em projetos envolvendo SAP e plataformas iPaaS.\r\n\r\nAtualmente sigo expandindo meus conhecimentos em arquitetura de software, desenvolvimento backend e aplicações web modernas.	2026-06-13 03:10:44.389261	2026-06-13 03:10:44.389261	/public/images/eu.jpeg
\.


--
-- TOC entry 3556 (class 0 OID 49323)
-- Dependencies: 232
-- Data for Name: section_stacks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_stacks (id, stack_id, created_at, updated_at, section_id) FROM stdin;
66	15	2026-06-14 02:06:49.91898	2026-06-14 02:06:49.91898	4
67	5	2026-06-14 02:06:49.933286	2026-06-14 02:06:49.933286	4
68	8	2026-06-14 02:06:49.936094	2026-06-14 02:06:49.936094	4
69	1	2026-06-14 02:06:49.939855	2026-06-14 02:06:49.939855	4
70	12	2026-06-14 02:06:49.942565	2026-06-14 02:06:49.942565	4
71	7	2026-06-14 02:06:49.946363	2026-06-14 02:06:49.946363	4
72	3	2026-06-14 02:06:49.948479	2026-06-14 02:06:49.948479	4
73	14	2026-06-14 02:06:49.951507	2026-06-14 02:06:49.951507	4
74	9	2026-06-14 02:06:49.953539	2026-06-14 02:06:49.953539	4
\.


--
-- TOC entry 3560 (class 0 OID 49367)
-- Dependencies: 236
-- Data for Name: section_three; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_three (id, institution, course, description, still_studying, start_date, final_date, situation, created_at, updated_at) FROM stdin;
3	UNOESC	Engenharia da Computação	Experiencia academia. Durante o curso, direcionei minha carreira para desenvolvimento de software, seguindo posteriormente para formações com foco em desenvolvimento Web	f	2018-02-06	2021-06-01	nao-finalizado	2026-06-15 16:16:32.449949	2026-06-15 16:16:32.449949
4	SENAI	Técnico em Informática para Internet	Avanço no aprendizado da programação voltada a WEB. Aqui vi Node.js e APIs	f	2021-02-14	2022-07-01	formado	2026-06-15 16:21:56.37964	2026-06-15 16:21:56.37964
5	UNIASSELVI	Engenharia de Software	Atualmente aprofundando conhecimentos em arquitetura de software, boas práticas de desenvolvimento e sistemas escaláveis.	t	2026-02-14	2026-02-14	em-andamento	2026-06-15 16:39:17.94523	2026-06-15 16:39:17.94523
6	KA Solution	Academia SAP ABAP	Programação ABAP para SAP S4 HANA.	f	2024-02-14	2024-03-14	formado	2026-06-15 17:20:07.339011	2026-06-15 17:20:07.339011
1	SENAI	Aprendizagem Industrial	Inicio na programação. Primeiros contatos com C e PHP	f	2015-02-14	2015-12-06	formado	2026-06-15 16:13:10.657493	2026-06-15 16:13:10.657493
2	SENAI	Técnico em Informática	Avançando com programação estudando C, C++, Java, PHP e Banco de Dados	f	2016-02-14	2017-12-06	formado	2026-06-15 16:15:50.71189	2026-06-15 16:15:50.71189
\.


--
-- TOC entry 3562 (class 0 OID 57515)
-- Dependencies: 238
-- Data for Name: section_two; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_two (id, image, created_at, updated_at) FROM stdin;
1	/public/images/eu_2.jpeg	2026-06-15 03:43:33.524378	2026-06-15 03:43:33.524378
\.


--
-- TOC entry 3564 (class 0 OID 57523)
-- Dependencies: 240
-- Data for Name: section_two_experiences; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.section_two_experiences (id, company, description, actual_job, start_date, final_date, section_id, created_at, updated_at) FROM stdin;
1	Lacticinios Tirol	Atuo na Tirol desde maio de 2023, participando da gestão e acompanhamento de demandas de tecnologia voltadas para sistemas corporativos. Sou responsável por realizar a interface entre usuários-chave (Key Users), áreas de negócio e consultorias externas, auxiliando na definição de requisitos, priorização de demandas e acompanhamento de projetos.\r\n\r\nAlém das atividades de gestão e coordenação, desenvolvi soluções internas para automação de processos e suporte aos usuários, incluindo aplicações para desbloqueio de usuários SAP, redefinição de senhas e gerenciamento de autenticação multifator. Também projetei e implementei uma API corporativa utilizando Node.js, Fastify, SQL Server e Oracle Database, responsável por centralizar integrações e regras de negócio compartilhadas entre diferentes aplicações internas.\r\n\r\nPossuo experiência com APIs REST, integrações entre sistemas, bancos de dados relacionais, como PostgreSQL, SQL Server e Oracle Database, ambientes Linux, Nginx, SSL, Docker e processos de implantação em infraestrutura corporativa	t	2023-05-02	2023-05-02	1	2026-06-15 12:48:52.887502	2026-06-15 12:48:52.887502
4	Mobix Software Studio	Atuei como Desenvolvedor Backend participando da manutenção e evolução de APIs e serviços utilizando Node.js, Express.js e MongoDB. Trabalhei no desenvolvimento de funcionalidades, correção de bugs e sustentação de aplicações voltadas para ambientes corporativos.\r\n\r\nDurante esse período, utilizei metodologias ágeis com Kanban e Sprints, além de ferramentas como Git e Jira para gestão das atividades. Também participei da implementação de integrações entre sistemas e da manutenção de serviços responsáveis pelo processamento e disponibilização de dados para aplicações web.	f	2022-05-01	2022-11-30	1	2026-06-15 14:40:16.013845	2026-06-15 14:40:16.013845
5	Inovadora Sistemas	Atuei como Desenvolvedor Backend PHP no desenvolvimento e manutenção de um sistema de gestão hospitalar utilizando Zend Framework. Fui responsável pela implementação de novas funcionalidades, correção de problemas e evolução contínua da plataforma. Durante o desenvolvimento, utilizei Docker e Git no fluxo de trabalho diário, atuando em um ambiente que empregava práticas de integração contínua e automação de deploys com Jenkins. A experiência contribuiu para o aprofundamento dos conhecimentos em desenvolvimento web, sistemas corporativos e metodologias ágeis baseadas em Kanban e Sprints.	f	2021-09-01	2022-05-01	1	2026-06-15 14:41:58.355754	2026-06-15 14:41:58.355754
\.


--
-- TOC entry 3544 (class 0 OID 32964)
-- Dependencies: 220
-- Data for Name: social_links; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.social_links (id, social_name, social_url, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3548 (class 0 OID 41147)
-- Dependencies: 224
-- Data for Name: stacks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.stacks (id, icon, name, created_at, updated_at) FROM stdin;
1	devicon-git-plain colored	Git	2026-06-11 15:31:32.259117	2026-06-11 15:31:32.259117
2	devicon-php-plain colored	PHP	2026-06-11 15:32:08.110136	2026-06-11 15:32:08.110136
3	devicon-postgresql-plain colored	PostgreSQL	2026-06-11 15:32:19.755703	2026-06-11 15:32:19.755703
4	devicon-nginx-original	Nginx	2026-06-11 15:32:34.329872	2026-06-11 15:32:34.329872
5	devicon-docker-plain colored	Docker	2026-06-11 15:32:42.123868	2026-06-11 15:32:42.123868
7	devicon-nodejs-plain colored	Node.js	2026-06-11 15:33:04.140872	2026-06-11 15:33:04.140872
8	devicon-fastify-plain colored	Fastify	2026-06-11 15:33:15.087123	2026-06-11 15:33:15.087123
10	devicon-oracle-original colored	Oracle Database	2026-06-11 15:33:40.102576	2026-06-11 15:33:40.102576
11	devicon-mysql-plain-wordmark	SQL Server	2026-06-11 15:33:51.474775	2026-06-11 15:33:51.474775
12	devicon-react-original	Next.js	2026-06-11 15:34:01.388347	2026-06-11 15:34:01.388347
9	devicon-typescript-plain colored	Typescript	2026-06-11 15:33:27.760905	2026-06-11 15:33:27.760905
6	devicon-cloudflare-plain colored	Cloudflare	2026-06-11 15:32:54.203393	2026-06-11 15:32:54.203393
14	devicon-tailwindcss-original colored	Tailwind CSS	2026-06-12 14:32:42.882961	2026-06-12 14:32:42.882961
15	devicon-bootstrap-plain colored	Bootstrap CSS	2026-06-12 14:33:03.94145	2026-06-12 14:33:03.94145
\.


--
-- TOC entry 3554 (class 0 OID 41186)
-- Dependencies: 230
-- Data for Name: user_stacks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_stacks (id, user_id, stack_id, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3540 (class 0 OID 32940)
-- Dependencies: 216
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, user_name, user_email, user_birth_date, user_password, user_description, user_role, created_at, updated_at) FROM stdin;
4	Andre Lucas Trevizan	altrevizan.dev@gmail.com	2000-03-27	$2y$12$AhptTUxTJ4dKiTxrG.k7q..DeIH2sTwIUIsIuIl82VtiNSZs7LBuW	Apaixonado por tecnologia e desenvolvimento de software. Atuo com desenvolvimento web, APIs e integrações corporativas, utilizando principalmente Node.js, TypeScript, PHP e PostgreSQL para construir soluções que conectam sistemas e automatizam processos de negócio.	admin	2026-06-11 00:31:24.933963	2026-06-11 00:31:24.933963
5	Visualizador	portfolioviewer@gmail.com	2026-06-10	$2y$12$nD3fu8z4aieZQ85QAg/Sme5tZ1qgqWt/sR.06ZZJATG1hjZ4Dgv5S	Usuário visualizador do sistema. Com este usuário não é possível criar ou editar nada dentro do sistema.	viewer	2026-06-11 00:32:30.230885	2026-06-11 00:32:30.230885
6	Andre Lucas Trevizan	123@123	2026-02-16	$2y$12$Py/qHxqzKNiyuhh8LbZq5.ihQgKTU1f3FMumAU1msMlNMtBwnMPQy	13123123	viewer	2026-06-12 22:21:28.108759	2026-06-12 22:21:28.108759
\.


--
-- TOC entry 3570 (class 0 OID 0)
-- Dependencies: 227
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contacts_id_seq', 1, true);


--
-- TOC entry 3571 (class 0 OID 0)
-- Dependencies: 225
-- Name: project_stacks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.project_stacks_id_seq', 148, true);


--
-- TOC entry 3572 (class 0 OID 0)
-- Dependencies: 217
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 13, true);


--
-- TOC entry 3573 (class 0 OID 0)
-- Dependencies: 221
-- Name: projects_results_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_results_id_seq', 1, false);


--
-- TOC entry 3574 (class 0 OID 0)
-- Dependencies: 233
-- Name: section_one_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.section_one_id_seq', 4, true);


--
-- TOC entry 3575 (class 0 OID 0)
-- Dependencies: 231
-- Name: section_stacks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.section_stacks_id_seq', 74, true);


--
-- TOC entry 3576 (class 0 OID 0)
-- Dependencies: 235
-- Name: section_three_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.section_three_id_seq', 7, true);


--
-- TOC entry 3577 (class 0 OID 0)
-- Dependencies: 239
-- Name: section_two_experiences_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.section_two_experiences_id_seq', 5, true);


--
-- TOC entry 3578 (class 0 OID 0)
-- Dependencies: 237
-- Name: section_two_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.section_two_id_seq', 1, true);


--
-- TOC entry 3579 (class 0 OID 0)
-- Dependencies: 219
-- Name: social_links_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.social_links_id_seq', 1, false);


--
-- TOC entry 3580 (class 0 OID 0)
-- Dependencies: 223
-- Name: stacks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.stacks_id_seq', 15, true);


--
-- TOC entry 3581 (class 0 OID 0)
-- Dependencies: 229
-- Name: user_stacks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_stacks_id_seq', 1, false);


--
-- TOC entry 3582 (class 0 OID 0)
-- Dependencies: 215
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 6, true);


--
-- TOC entry 3375 (class 2606 OID 41184)
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- TOC entry 3373 (class 2606 OID 41162)
-- Name: project_stacks project_stacks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_stacks
    ADD CONSTRAINT project_stacks_pkey PRIMARY KEY (id);


--
-- TOC entry 3365 (class 2606 OID 32962)
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- TOC entry 3369 (class 2606 OID 41140)
-- Name: projects_results projects_results_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects_results
    ADD CONSTRAINT projects_results_pkey PRIMARY KEY (id);


--
-- TOC entry 3381 (class 2606 OID 49349)
-- Name: section_one section_one_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_one
    ADD CONSTRAINT section_one_pkey PRIMARY KEY (id);


--
-- TOC entry 3379 (class 2606 OID 49329)
-- Name: section_stacks section_stacks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_stacks
    ADD CONSTRAINT section_stacks_pkey PRIMARY KEY (id);


--
-- TOC entry 3383 (class 2606 OID 49376)
-- Name: section_three section_three_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_three
    ADD CONSTRAINT section_three_pkey PRIMARY KEY (id);


--
-- TOC entry 3387 (class 2606 OID 57532)
-- Name: section_two_experiences section_two_experiences_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_two_experiences
    ADD CONSTRAINT section_two_experiences_pkey PRIMARY KEY (id);


--
-- TOC entry 3385 (class 2606 OID 57521)
-- Name: section_two section_two_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_two
    ADD CONSTRAINT section_two_pkey PRIMARY KEY (id);


--
-- TOC entry 3367 (class 2606 OID 32972)
-- Name: social_links social_links_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.social_links
    ADD CONSTRAINT social_links_pkey PRIMARY KEY (id);


--
-- TOC entry 3371 (class 2606 OID 41153)
-- Name: stacks stacks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stacks
    ADD CONSTRAINT stacks_pkey PRIMARY KEY (id);


--
-- TOC entry 3377 (class 2606 OID 41192)
-- Name: user_stacks user_stacks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stacks
    ADD CONSTRAINT user_stacks_pkey PRIMARY KEY (id);


--
-- TOC entry 3361 (class 2606 OID 32949)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3363 (class 2606 OID 32951)
-- Name: users users_user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_email_key UNIQUE (user_email);


--
-- TOC entry 3389 (class 2606 OID 41163)
-- Name: project_stacks project_stacks_project_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_stacks
    ADD CONSTRAINT project_stacks_project_id_fkey FOREIGN KEY (project_id) REFERENCES public.projects(id) ON DELETE CASCADE;


--
-- TOC entry 3390 (class 2606 OID 41168)
-- Name: project_stacks project_stacks_stack_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_stacks
    ADD CONSTRAINT project_stacks_stack_id_fkey FOREIGN KEY (stack_id) REFERENCES public.stacks(id) ON DELETE CASCADE;


--
-- TOC entry 3388 (class 2606 OID 41141)
-- Name: projects_results projects_results_project_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects_results
    ADD CONSTRAINT projects_results_project_id_fkey FOREIGN KEY (project_id) REFERENCES public.projects(id) ON DELETE CASCADE;


--
-- TOC entry 3393 (class 2606 OID 49381)
-- Name: section_stacks section_stacks_section_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_stacks
    ADD CONSTRAINT section_stacks_section_id_fkey FOREIGN KEY (section_id) REFERENCES public.section_one(id) ON DELETE CASCADE;


--
-- TOC entry 3394 (class 2606 OID 49335)
-- Name: section_stacks section_stacks_stack_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_stacks
    ADD CONSTRAINT section_stacks_stack_id_fkey FOREIGN KEY (stack_id) REFERENCES public.stacks(id) ON DELETE CASCADE;


--
-- TOC entry 3395 (class 2606 OID 57533)
-- Name: section_two_experiences section_two_experiences_section_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.section_two_experiences
    ADD CONSTRAINT section_two_experiences_section_id_fkey FOREIGN KEY (section_id) REFERENCES public.section_two(id) ON DELETE CASCADE;


--
-- TOC entry 3391 (class 2606 OID 41198)
-- Name: user_stacks user_stacks_stack_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stacks
    ADD CONSTRAINT user_stacks_stack_id_fkey FOREIGN KEY (stack_id) REFERENCES public.stacks(id) ON DELETE CASCADE;


--
-- TOC entry 3392 (class 2606 OID 41193)
-- Name: user_stacks user_stacks_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_stacks
    ADD CONSTRAINT user_stacks_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


-- Completed on 2026-06-16 23:54:42

--
-- PostgreSQL database dump complete
--

