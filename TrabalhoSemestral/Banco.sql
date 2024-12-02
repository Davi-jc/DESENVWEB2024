-- Table: public.avaliacoes

-- DROP TABLE IF EXISTS public.avaliacoes;

CREATE TABLE IF NOT EXISTS public.avaliacoes
(
    id integer NOT NULL DEFAULT nextval('avaliacoes_id_seq'::regclass),
    setor_id integer,
    dispositivo_id integer,
    data_hora timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT avaliacoes_pkey PRIMARY KEY (id),
    CONSTRAINT avaliacoes_dispositivo_id_fkey FOREIGN KEY (dispositivo_id)
        REFERENCES public.dispositivos (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT avaliacoes_setor_id_fkey FOREIGN KEY (setor_id)
        REFERENCES public.setores (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.avaliacoes
    OWNER to postgres;

-----------------------------------------------------------------------------------------------

-- Table: public.dispositivos

-- DROP TABLE IF EXISTS public.dispositivos;

CREATE TABLE IF NOT EXISTS public.dispositivos
(
    id integer NOT NULL DEFAULT nextval('dispositivos_id_seq'::regclass),
    nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    status character varying(10) COLLATE pg_catalog."default" DEFAULT 'ativo'::character varying,
    setor_id integer NOT NULL,
    CONSTRAINT dispositivos_pkey PRIMARY KEY (id),
    CONSTRAINT setor_id FOREIGN KEY (setor_id)
        REFERENCES public.setores (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.dispositivos
    OWNER to postgres;

--------------------------------------------------------------------------------------------

-- Table: public.perguntas

-- DROP TABLE IF EXISTS public.perguntas;

CREATE TABLE IF NOT EXISTS public.perguntas
(
    id integer NOT NULL DEFAULT nextval('perguntas_id_seq'::regclass),
    texto text COLLATE pg_catalog."default" NOT NULL,
    ordem integer NOT NULL,
    status character varying(10) COLLATE pg_catalog."default" DEFAULT 'ativa'::character varying,
    CONSTRAINT perguntas_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.perguntas
    OWNER to postgres;

--------------------------------------------------------------------------------------------

-- Table: public.respostas

-- DROP TABLE IF EXISTS public.respostas;

CREATE TABLE IF NOT EXISTS public.respostas
(
    id integer NOT NULL DEFAULT nextval('respostas_id_seq'::regclass),
    avaliacao_id integer,
    pergunta_id integer,
    resposta integer NOT NULL,
    feedback text COLLATE pg_catalog."default",
    CONSTRAINT respostas_pkey PRIMARY KEY (id),
    CONSTRAINT respostas_avaliacao_id_fkey FOREIGN KEY (avaliacao_id)
        REFERENCES public.avaliacoes (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT respostas_pergunta_id_fkey FOREIGN KEY (pergunta_id)
        REFERENCES public.perguntas (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT respostas_resposta_check CHECK (resposta >= 0 AND resposta <= 10)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.respostas
    OWNER to postgres;

--------------------------------------------------------------------------------------------

-- Table: public.setores

-- DROP TABLE IF EXISTS public.setores;

CREATE TABLE IF NOT EXISTS public.setores
(
    id integer NOT NULL DEFAULT nextval('setores_id_seq'::regclass),
    nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    status character varying(10) COLLATE pg_catalog."default" DEFAULT 'ativo'::character varying,
    CONSTRAINT setores_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.setores
    OWNER to postgres;

-----------------------------------------------------------------------------------------

-- Table: public.usuarios_admin

-- DROP TABLE IF EXISTS public.usuarios_admin;

CREATE TABLE IF NOT EXISTS public.usuarios_admin
(
    id integer NOT NULL DEFAULT nextval('usuarios_admin_id_seq'::regclass),
    username character varying(50) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT usuarios_admin_pkey PRIMARY KEY (id),
    CONSTRAINT usuarios_admin_username_key UNIQUE (username)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.usuarios_admin
    OWNER to postgres;
