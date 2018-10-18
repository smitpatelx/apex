--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

-- Started on 2018-10-18 18:53:33

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE public.users ALTER COLUMN user_id DROP DEFAULT;
DROP SEQUENCE public.users_user_id_seq;
DROP TABLE public.users;
SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 184 (class 1259 OID 32993)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    user_id integer NOT NULL,
    user_name character varying(20) NOT NULL,
    password character varying(32) NOT NULL,
    user_type character varying(2) NOT NULL,
    first_name character varying(30) NOT NULL,
    last_name character varying(45) NOT NULL,
    email_address character varying(255) NOT NULL,
    enrol_date date NOT NULL,
    last_access date NOT NULL
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 32991)
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_user_id_seq OWNER TO postgres;

--
-- TOC entry 2108 (class 0 OID 0)
-- Dependencies: 183
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_user_id_seq OWNED BY users.user_id;


--
-- TOC entry 1985 (class 2604 OID 32996)
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN user_id SET DEFAULT nextval('users_user_id_seq'::regclass);


--
-- TOC entry 2103 (class 0 OID 32993)
-- Dependencies: 184
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (user_id, user_name, password, user_type, first_name, last_name, email_address, enrol_date, last_access) FROM stdin;
4	userd	1004c3d449a4002d2e167a7e0a3c063e	d	Smit	Patel	root@rootuser.ca	2018-10-07	2018-10-12
3	users	1004c3d449a4002d2e167a7e0a3c063e	s	Smit	Patel	root@rootuser.c	2018-10-07	2018-10-12
2	userc	1004c3d449a4002d2e167a7e0a3c063e	c	Smit	Patel	root@rootuser.co	2018-10-07	2018-10-17
1	usera	1004c3d449a4002d2e167a7e0a3c063e	a	Smit	Patel	root@rootuser.com	2018-10-07	2018-10-18
\.


--
-- TOC entry 2109 (class 0 OID 0)
-- Dependencies: 183
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_user_id_seq', 5, true);


--
-- TOC entry 1987 (class 2606 OID 32998)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


-- Completed on 2018-10-18 18:53:33

--
-- PostgreSQL database dump complete
--

