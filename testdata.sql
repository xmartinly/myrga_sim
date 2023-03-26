CREATE SEQUENCE "simulateData"."testdata_testdata_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

CREATE TABLE "simulateData"."testdata" (
  "testdata_id" int4 NOT NULL DEFAULT nextval('testdata_testdata_id_seq'::regclass),
  "scan_size" int4 NOT NULL,
  "dwell_total" int4 NOT NULL,
  "scan_num" int4 NOT NULL,
  "last_request_tm" int4 NOT NULL,
  "request_ip" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  CONSTRAINT "testdata_pkey" PRIMARY KEY ("testdata_id"),
  CONSTRAINT "testdata_testdata_id_key" UNIQUE ("testdata_id")
)
;

ALTER TABLE "simulateData"."testdata" OWNER TO "mliang";


ALTER SEQUENCE "simulateData"."testdata_testdata_id_seq"
OWNED BY "simulateData"."testdata"."testdata_id";

ALTER SEQUENCE "simulateData"."testdata_testdata_id_seq" OWNER TO "mliang";

CREATE INDEX "testdata_request_ip_idx" ON "simulateData"."testdata" USING btree (
  "request_ip" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

CREATE INDEX "testdata_testdata_id_idx" ON "simulateData"."testdata" USING btree (
  "testdata_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);