--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

-- Started on 2018-10-05 18:01:06
DROP TABLE IF EXISTS listing_demo;
SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 183 (class 1259 OID 32952)
-- Name: listing_demo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE listing_demo (
    id integer NOT NULL,
    list_heading character varying(15) NOT NULL,
    img character varying(50) NOT NULL,
    location character varying(30) NOT NULL,
    price character varying(20) NOT NULL,
    sqft character varying(10) NOT NULL,
    phone character varying(15) NOT NULL
);


ALTER TABLE listing_demo OWNER TO group19_admin;

--
-- TOC entry 182 (class 1259 OID 32950)
-- Name: listing_demo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE listing_demo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE listing_demo_id_seq OWNER TO group19_admin;

--
-- TOC entry 2106 (class 0 OID 0)
-- Dependencies: 182
-- Name: listing_demo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE listing_demo_id_seq OWNED BY listing_demo.id;


--
-- TOC entry 1983 (class 2604 OID 32955)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY listing_demo ALTER COLUMN id SET DEFAULT nextval('listing_demo_id_seq'::regclass);


--
-- TOC entry 2101 (class 0 OID 32952)
-- Dependencies: 183
-- Data for Name: listing_demo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY listing_demo (id, list_heading, img, location, price, sqft, phone) FROM stdin;
7	test-4	./images/day_10_05_2018/time_5_41_06_amCVgvDYC.jpg	oshawa	3232322	6565556	232232323232
8	smitpatelx	./images/day_10_05_2018/time_5_41_31_amCVgvDYC.jpg	oshawa	556565	8686868	666666
9	test5	./images/day_10_05_2018/time_5_43_29_am1a.jpg	oshawa	99999	999999	6666668888
10	post 35	./images/day_10_05_2018/time_5_43_56_am2a.jpg	oshawa	464666	4664646	6666668888
11	smitpatelx	./images/day_10_05_2018/time_5_44_14_am3a.jpg	oshawa	556565	8686868	6666668888
12	smitpatelx	./images/day_10_05_2018/time_5_44_30_am3a.jpg	oshawa	99999	6565556	6666668888
13	smitpatelx	./images/day_10_05_2018/time_5_46_23_am6a.jpg	oshawa	99999	6565556	6666668888
14	robo	./images/day_10_05_2018/time_6_00_46_am3.jpg	oshawa	99999	999999	6666668888
\.


--
-- TOC entry 2107 (class 0 OID 0)
-- Dependencies: 182
-- Name: listing_demo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('listing_demo_id_seq', 14, true);


--
-- TOC entry 1985 (class 2606 OID 32957)
-- Name: listing_demo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY listing_demo
    ADD CONSTRAINT listing_demo_pkey PRIMARY KEY (id);


-- Completed on 2018-10-05 18:01:06

--
-- PostgreSQL database dump complete
--

